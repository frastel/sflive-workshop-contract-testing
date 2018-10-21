<?php

namespace App\Tests\Consumer;

use App\Entity\Recipe;
use App\Gateway\RecipeGateway;
use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Matcher\Matcher;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Standalone\MockService\MockServerEnvConfig;
use PHPUnit\Framework\TestCase;

/**
 * @group contract-consumer
 */
class RecipeGatewayTest extends TestCase
{
    /**
     * @throws \PhpPact\Standalone\Exception\MissingEnvVariableException
     * @throws \Exception
     */
    public function testSearchRecipes()
    {
        $matcher = new Matcher();

        // Create your expected request from the consumer.
        $request = new ConsumerRequest();
        $request
            ->setMethod('GET')
            ->setPath('/api/recipes/1');

        $dateTimeTerm = '^\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}$';
        // Create your expected response from the provider.
        $response = new ProviderResponse();
        $response
            ->setStatus(200)
            ->addHeader('Content-Type', 'application/json;charset=utf-8')
            ->setBody(
                [
                    'id' => $matcher->integer(),
                    'title' => $matcher->like('Spiegeleier'),
                    'subtitle' => $matcher->like('Spiegeleier'),
                    'rating' => $matcher->decimal(4.5),
                    'instructions' => $matcher->like('Eier in einer Pfanne aufschlagen und braten.'),
                    'published' => $matcher->term('2017-12-24 20:00:00', $dateTimeTerm),
                    'authorId' => $matcher->integer(1),
                    'preparationTime' => $matcher->integer(1),
                    'difficulty' => $matcher->term('simple', '(simple|advanced|expert)'),
                    'image' => $matcher->like('spiegeleier.jpeg'),
                ]
            );

        // Create a configuration that reflects the server that was started. You can create a custom MockServerConfigInterface if needed.
        $config = new MockServerEnvConfig();
        $builder = new InteractionBuilder($config);
        $builder
            ->given('recipe with #1 exists')
            ->uponReceiving('recipe data')
            ->with($request)
            ->willRespondWith(
                $response
            ); // This has to be last. This is what makes an API request to the Mock Server to set the interaction.

        //$uri = str_replace('0.0.0.0', '127.0.0.1', $config->getBaseUri());

        $gateway = new RecipeGateway($config->getBaseUri()); // Pass in the URL to the Mock Server.
        $result = $gateway->findById(1); // Make the real API request against the Mock Server.

        $builder->verify(); // This will verify that the interactions took place.

        $this->assertInstanceOf(Recipe::class, $result);
        $this->assertEquals('Spiegeleier', $result->getTitle());
        $this->assertEquals(1, $result->getAuthorId());
    }
}

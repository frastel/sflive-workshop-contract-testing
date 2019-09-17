<?php

namespace App\Tests\Consumer;

use App\Entity\RecipeSearch;
use App\Gateway\RecipeSearchGateway;
use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Matcher\Matcher;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Standalone\Exception\MissingEnvVariableException;
use PhpPact\Standalone\MockService\MockServerEnvConfig;
use PHPUnit\Framework\TestCase;

/**
 * @group contract-consumer
 */
class RecipeSearchGatewayTest extends TestCase
{
    /**
     * @throws MissingEnvVariableException
     * @throws \Exception
     */
    public function testSearchRecipes()
    {
        $matcher = new Matcher();

        // Create your expected request from the consumer.
        $request = new ConsumerRequest();
        $request
            ->setMethod('GET')
            ->setPath('/api');

        $dateTimeTerm = '^\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}$';
        // Create your expected response from the provider.
        $response = new ProviderResponse();
        $response
            ->setStatus(200)
            ->addHeader('Content-Type', 'application/json;charset=utf-8')
            ->setBody(
                $matcher->eachLike(
                    [
                        'id' => $matcher->integer(),
                        'name' => $matcher->like('Spiegeleier'),
                        //'title' => $matcher->like('Spiegeleier'),
                        'subtitle' => $matcher->like('Spiegeleier'),
                        'rating' => $matcher->decimal(4.5),
                        'instructions' => $matcher->like('Eier in einer Pfanne aufschlagen und braten.'),
                        'published' => $matcher->term('2017-12-24 20:00:00', $dateTimeTerm),
                        'authorName' => $matcher->like('Chefkoch'),
                        'authorId' => $matcher->integer(1),
                        'praparationTime' => $matcher->integer(1),
                        'difficulty' => $matcher->term('simple', '(simple|advanced|expert)'),
                        'image' => $matcher->like('spiegeleier.jpeg'),
                    ]
                )
            );

        // Create a configuration that reflects the server that was started. You can create a custom MockServerConfigInterface if needed.
        $config = new MockServerEnvConfig();
        $builder = new InteractionBuilder($config);
        $builder
            ->given('search data for recipes are loaded')
            ->uponReceiving('all found recipe data')
            ->with($request)
            ->willRespondWith(
                $response
            ); // This has to be last. This is what makes an API request to the Mock Server to set the interaction.

        $gateway = new RecipeSearchGateway($config->getBaseUri()); // Pass in the URL to the Mock Server.
        $result = $gateway->findLatest([]); // Make the real API request against the Mock Server.

        $builder->verify(); // This will verify that the interactions took place.

        $this->assertCount(1, $result); // Make your assertions.
        $this->assertInstanceOf(RecipeSearch::class, $result[0]);
    }
}

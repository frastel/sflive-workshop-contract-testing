<?php

namespace App\Tests\Consumer;

use App\Entity\User;
use App\Gateway\UserGateway;
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
class UserGatewayTest extends TestCase
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
            ->setPath('/api/users/1');

        $dateTimeTerm = '^\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}$';
        // Create your expected response from the provider.
        $response = new ProviderResponse();
        $response
            ->setStatus(200)
            ->addHeader('Content-Type', 'application/json;charset=utf-8')
            ->setBody(
                [
                    'id' => $matcher->integer(),
                    'name' => $matcher->like('Chefkoch'),
                    'about' => $matcher->like('text'),
                    'registered' => $matcher->integer(),
                    //'registeredAt' => $matcher->term('2017-12-24 20:00:00', $dateTimeTerm),
                ]
            );

        // Create a configuration that reflects the server that was started. You can create a custom MockServerConfigInterface if needed.
        $config = new MockServerEnvConfig();
        $builder = new InteractionBuilder($config);
        $builder
            ->given('user with #1 exists')
            ->uponReceiving('user data')
            ->with($request)
            ->willRespondWith(
                $response
            ); // This has to be last. This is what makes an API request to the Mock Server to set the interaction.

        $gateway = new UserGateway($config->getBaseUri()); // Pass in the URL to the Mock Server.
        $result = $gateway->findById(1); // Make the real API request against the Mock Server.

        $builder->verify(); // This will verify that the interactions took place.

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals('Chefkoch', $result->getName());
    }
}

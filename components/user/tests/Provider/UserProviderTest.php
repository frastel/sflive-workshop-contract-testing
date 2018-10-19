<?php

namespace App\Tests;

use GuzzleHttp\Psr7\Uri;
use PhpPact\Standalone\Installer\Exception\FileDownloadFailureException;
use PhpPact\Standalone\Installer\Exception\NoDownloaderFoundException;
use PhpPact\Standalone\ProviderVerifier\Model\VerifierConfig;
use PhpPact\Standalone\ProviderVerifier\Verifier;
use PHPUnit\Framework\TestCase;

/**
 * @group contract-provider
 */
class UserProviderTest extends TestCase
{
    /**
     * The setup process for this workshow was simplified.
     * Please check
     * https://github.com/pact-foundation/pact-php/blob/master/example/tests/Provider/PactVerifyTest.php
     * to see how the setup process is done correctly.
     * Actually you have to create a dedicated server for this verification!
     *
     * @throws FileDownloadFailureException
     * @throws NoDownloaderFoundException
     */
    public function testProviderDoesNotBreakThings()
    {
        $config = new VerifierConfig();
        $config
            ->setProviderName('user') // Providers name to fetch.
            ->setProviderVersion('1.0.0')
            ->setProviderBaseUrl(new Uri('http://user')) // URL of the Provider.
            ->setBrokerUri(new Uri('http://pact-broker')) // URL of the Pact Broker to publish results.
            ->setPublishResults(true) // Flag the verifier service to publish the results to the Pact Broker.
            ->setProcessTimeout(60)
            ->setProcessIdleTimeout(20)
            ->setProviderStatesSetupUrl('http://user/api/users/dev/provider-state');

        // Verify that all consumers of 'someProvider' are valid.
        $verifier = new Verifier($config);
        $verifier->verifyAll();

        // This will not be reached if the PACT verifier throws an error, otherwise it was successful.
        $this->assertTrue(true, 'Pact Verification has failed.');
    }
}

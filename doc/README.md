## Standalone Tools of pact

Provider Verification tests trigger
    
    '/code/vendor/pact-foundation/pact-php/src/PhpPact/Standalone/Installer/../../../../pact/bin/pact-provider-verifier' 'http://pact-broker/pacts/provider/user/consumer/frontend/version/1.0.0' '--provider-base-url=http://user' '--provider-app-version=1.0.0' '--publish-verification-results'

Equals to

    /code/vendor/pact-foundation/pact-php/pact/bin/pact-provider-verifier http://pact-broker/pacts/provider/user/consumer/frontend/version/1.0.0 --provider-base-url=http://user --provider-app-version=1.0.0 --publish-verification-results


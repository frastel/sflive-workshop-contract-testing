# Workshop Contract Testing

## Installation

    vagrant up
    cd /vagrant
    ./bin/install
    
## Start/stop environment

Start

    ./bin/start
    
Stop

    ./bin/stop
    
## Project Overview

Services:
* **frontend:** the UI
* **recipe-detail:** holds all details of a recipe and according data 
* **recipe:** service for basic recipe data
* **user:** service for basic user data
* **recipe-search:** service for searching for recipes


## Services

For running the tests the complete environment has to be started.

    ./bin/start
    
Afterwards you have to jump in the according service for executing the tests

    ./bin/enter frontend bash
    
### Frontend

* [http://192.168.33.10:8080](http://192.168.33.10:8080)

Consumer Tests:

    ./bin/phpunit-contract-consumer-user
    ./bin/phpunit-contract-consumer-recipe-detail
    ./bin/phpunit-contract-consumer-recipe-search

### Recipe Service

* [http://192.168.33.10:8081/api/recipes/1](http://192.168.33.10:8081/api/recipes/1)


    http://192.168.33.10:8081/api/recipes/1

### User Service

* [http://192.168.33.10:8082/api/users/1](http://192.168.33.10:8082/api/users/1)


    http://192.168.33.10:8082/api/users/1
    
Provider Test:

    ./bin/phpunit
    
Triggers
    
    '/code/vendor/pact-foundation/pact-php/src/PhpPact/Standalone/Installer/../../../../pact/bin/pact-provider-verifier' 'http://pact-broker/pacts/provider/user/consumer/frontend/version/1.0.0' '--provider-base-url=http://user' '--provider-app-version=1.0.0' '--publish-verification-results'

Equals to

    /code/vendor/pact-foundation/pact-php/pact/bin/pact-provider-verifier http://pact-broker/pacts/provider/user/consumer/frontend/version/1.0.0 --provider-base-url=http://user --provider-app-version=1.0.0 --publish-verification-results

### RecipeSearch Service

* [http://192.168.33.10:8083/api](http://192.168.33.10:8083/api)
* [http://192.168.33.10:8083/api?needle=lorem&limit=2](http://192.168.33.10:8083/api?needle=lorem&limit=2)


    http://192.168.33.10:8083/api
    http://192.168.33.10:8083/api?needle=lorem&limit=2

### RecipeDetail Service

* [http://192.168.33.10:8084/api/recipe-details/1](http://192.168.33.10:8084/api/recipe-details/1)


    http://192.168.33.10:8084/api/recipe-details/1

### PactBroker

* [http://192.168.33.10:8888](http://192.168.33.10:8888)


    http://192.168.33.10:8888

# Cheatsheet

    time bin/phpunit --testsuite "Pact Consumer Test Suite"

    curl -H "X-Pact-Mock-Service: true" http://192.168.33.10:8082/interactions/verification
    
    curl -X POST -H "X-Pact-Mock-Service: true" -H "Content-Type: application/json" -d '{"consumer" : {"name": "dummy"}, "provider": {"name": "user"}}' \http://192.168.33.10:8082/pact
    
    curl -X POST -H "X-Pact-Mock-Service: true" -H "Content-Length: 0" http://192.168.33.10:8082/pact

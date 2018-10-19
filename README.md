# Workshop Contract Testing

Demo project for demonstrating the functionality and power of contract testing.

Contract testing is done with [Pact](https://docs.pact.io/).

## Requirements

This demo contains a [Vagrant](https://www.vagrantup.com/) + [Docker](https://docs.docker.com/compose/) setup. Docker native (without Vagrant) may work but is not really supported.

## Installation

    vagrant up
    vagrant ssh
    cd /vagrant
    ./bin/install
    
**Joining the workshop? Then stop reading and look forward to the upcoming [Symfony Live Berlin 2018](http://berlin2018.live.symfony.com/workshops) :)**
    
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

    ./bin/enter frontend
    
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

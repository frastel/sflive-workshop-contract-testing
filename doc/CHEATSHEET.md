# Cheatsheet

Some useful copy&paste stuff

    time bin/phpunit --testsuite "Pact Consumer Test Suite"

    curl -H "X-Pact-Mock-Service: true" http://192.168.33.10:8082/interactions/verification
    
    curl -X POST -H "X-Pact-Mock-Service: true" -H "Content-Type: application/json" -d '{"consumer" : {"name": "dummy"}, "provider": {"name": "user"}}' \http://192.168.33.10:8082/pact
    
    curl -X POST -H "X-Pact-Mock-Service: true" -H "Content-Length: 0" http://192.168.33.10:8082/pact

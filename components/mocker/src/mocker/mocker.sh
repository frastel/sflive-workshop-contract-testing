#!/bin/bash

/wait-for-it.sh user:80
/wait-for-it.sh recipe-detail:80
/wait-for-it.sh recipe-search:80

user_interactions_file=/mocker/data/user_1_interaction.json
recipe_details_interactions_file=/mocker/data/recipe_details_1_interaction.json
recipe_search_interactions_file=/mocker/data/recipe_search_interaction.json

curl -XDELETE -s -H "X-Pact-Mock-Service: true" user/interactions
curl -XDELETE -s -H "X-Pact-Mock-Service: true" recipe-detail/interactions
curl -XDELETE -s -H "X-Pact-Mock-Service: true" recipe-search/interactions

curl -X POST -s \
    -H "X-Pact-Mock-Service: true" \
    -H "Content-Type: application/json" \
    user/interactions "-d@${user_interactions_file}"

curl -X POST -s \
    -H "X-Pact-Mock-Service: true" \
    -H "Content-Type: application/json" \
    recipe-detail/interactions "-d@${recipe_details_interactions_file}"

curl -X POST -s \
    -H "X-Pact-Mock-Service: true" \
    -H "Content-Type: application/json" \
    recipe-search/interactions "-d@${recipe_search_interactions_file}"

<?php

namespace App\Gateway;

use App\Entity\Recipe;

class RecipeGateway extends Gateway
{
    /**
     * @var string
     */
    private $baseUri;

    /**
     * RecipeSearchGateway constructor.
     *
     * @param string $baseUri
     */
    public function __construct($baseUri = 'http://recipe')
    {
        $this->baseUri = $baseUri;
    }

    public function findById($id)
    {
        $url = $this->baseUri.'/api/recipes/'.$id;

        $data = $this->fetch($url);
        if (!$data) {
            throw new \InvalidArgumentException('recipe not found');
        }

        return new Recipe($data);
    }
}

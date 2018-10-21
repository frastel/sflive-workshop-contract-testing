<?php

namespace App\Gateway;

use App\Entity\RecipeDetail;

class RecipeDetailGateway extends Gateway
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
    public function __construct($baseUri = 'http://recipe-detail')
    {
        $this->baseUri = $baseUri;
    }

    public function findById($id)
    {
        $data = $this->fetch($this->baseUri.'/api/recipe-details/'.$id);
        if (!$data) {
            throw new \InvalidArgumentException('recipe not found');
        }

        return new RecipeDetail($data);
    }
}

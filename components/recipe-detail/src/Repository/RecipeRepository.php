<?php

namespace App\Repository;

use App\Entity\Recipe;

class RecipeRepository extends Repository
{
    /**
     * @var string
     */
    private $baseUri;

    /**
     * RecipeSearchRepository constructor.
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

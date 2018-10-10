<?php

namespace App\Repository;

use App\Entity\RecipeDetail;

class RecipeDetailRepository extends Repository
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

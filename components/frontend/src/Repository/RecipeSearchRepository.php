<?php

namespace App\Repository;

use App\Entity\RecipeSearch;

class RecipeSearchRepository extends Repository
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
    public function __construct($baseUri = 'http://recipe-search')
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @return RecipeSearch[]
     */
    public function findLatest($params = array())
    {
        $url = $this->baseUri.'/api';

        if (count($params)) {
            $url .= '?'.http_build_query($params);
        }

        $entries = $this->fetch($url);
        $list = [];
        foreach ($entries as $data) {
            $list[] = new RecipeSearch($data);  }

        return $list;
    }
}

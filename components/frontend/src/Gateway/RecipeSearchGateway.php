<?php

namespace App\Gateway;

use App\Entity\RecipeSearch;

class RecipeSearchGateway extends Gateway
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

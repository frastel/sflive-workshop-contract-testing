<?php

namespace App\Repository;

use App\Entity\User;

class UserRepository extends Repository
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
    public function __construct($baseUri = 'http://user')
    {
        $this->baseUri = $baseUri;
    }

    public function findById($id)
    {
        $url = $this->baseUri.'/api/users/'.$id;

        $data = $this->fetch($url);
        if (!$data) {
            throw new \InvalidArgumentException('user not found');
        }

        return new User($data);
    }
}

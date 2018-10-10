<?php

namespace App\Entity;

class Recipe
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function serialize()
    {
        return $this->data;
    }

    private function get($key)
    {
        return isset($this->data[$key])? $this->data[$key] : null;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * @return int
     */
    public function getAuthorId()
    {
        return $this->get('authorId');
    }
}

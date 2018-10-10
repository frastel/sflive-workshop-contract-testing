<?php

namespace App\Entity;

class User
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
    public function getName()
    {
        return $this->get('name');
    }
}

<?php

namespace App\Entity;

use function Amp\Internal\formatStacktrace;

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

    private function get($key)
    {
        return isset($this->data[$key])? $this->data[$key] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getName();
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
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * @return string
     */
    public function getAbout()
    {
        return $this->get('about');
    }

    /**
     * @return string
     */
    public function getRegistered()
    {
        $datetime =$this->get('registeredAt');
        if ($datetime) {
            return $datetime;
        }

        $timestamp = $this->get('registered');

        return (new \DateTime())->setTimestamp($timestamp)->format('Y-m-d H:i:s');
    }
}

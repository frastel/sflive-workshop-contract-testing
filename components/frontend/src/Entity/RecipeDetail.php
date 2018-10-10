<?php

namespace App\Entity;

class RecipeDetail
{

    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $userData;

    public function __construct(array $data)
    {
        $this->data = $data['recipe'];
        $this->userData = $data['author'];
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
        return $this->getTitle();
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
     * @return string
     */
    public function getSubtitle()
    {
        return $this->get('subtitle');
    }

    /**
     * @return string
     */
    public function getRating()
    {
        return $this->get('rating');
    }

    /**
     * @return string
     */
    public function getInstructions()
    {
        return $this->get('instructions');
    }

    /**
     * @return \DateTime
     */
    public function getPublished()
    {
        return new \DateTime($this->get('published'));
    }

    /**
     * @return int
     */
    public function getCookingTime()
    {
        return $this->get('cookingTime');
    }

    /**
     * @return int
     */
    public function getRestingTime()
    {
        return $this->get('restingTime');
    }

    /**
     * @return int
     */
    public function getPreparationTime()
    {
        return $this->get('preparationTime');
    }

    /**
     * @return string
     */
    public function getDifficulty()
    {
        return $this->get('difficulty');
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        return new User($this->userData);
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->get('image');
    }
}

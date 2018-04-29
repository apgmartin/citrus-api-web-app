<?php

namespace Db\Route;

class Route
{
    public $id;
    public $route;
    public $attributes;
    public $description;

    /**
     * @return integer Id of route
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id Id of route
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string URI of route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route URI of route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return array Attribute Ids associated with route
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes Attribute Ids associated with route
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return string Description of route
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description Description of route
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
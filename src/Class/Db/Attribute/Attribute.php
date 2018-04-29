<?php

namespace Db\Attribute;

class Attribute
{
    public $id;
    public $name;
    public $description;

    /**
     * @return integer Id of attribute
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id Id of attribute
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string Name of attribute
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name Name of attribute
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string Description of attribute
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description Description of attribute
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}

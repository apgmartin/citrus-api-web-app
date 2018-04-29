<?php

namespace Db\Attribute;


class AttributeDaoImpl implements AttributeDao
{
    private $db;

    /**
     * AttributeDaoImpl constructor.
     * @param $db
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @return array Attributes associated with route
     */
    public function getAllAttributes()
    {
        $sql = "SELECT `id`, `name`, `description` FROM `attribute`";

        $attributes = $this->db->query($sql)->fetchAll(\PDO::FETCH_CLASS,Attribute::class);

        return $attributes;
    }

    /**
     * @param integer $id Id of attribute
     * @return Attribute|false Object representing attribute or false if not found
     */
    public function getAttribute($id)
    {
        $sql = "SELECT `id`, `name`, `description` FROM `attribute` WHERE `id` = ?";

        $preparedStatement = $this->db->prepare($sql);
        $preparedStatement->execute([$id]);

        return $preparedStatement->fetchObject(Attribute::class);
    }
}

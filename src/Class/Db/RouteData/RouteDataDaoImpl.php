<?php

namespace Db\RouteData;

use Db\Attribute\Attribute;
use Monolog\Logger;

class RouteDataDaoImpl implements RouteDataDao
{
    private $db;
    private $logger;

    /**
     * RouteDataDaoImpl constructor.
     * @param $db
     * @param $logger
     */
    public function __construct(\PDO $db, Logger $logger)
    {
        $this->db = $db;
        $this->logger = $logger;
    }

    public function getAttributesForRoot($routeId)
    {
        $sql = "SELECT a.`id`, a.`name`, a.`description` 
                  FROM `route_data` rd
                  LEFT JOIN `attribute` a
                       ON rd.attribute_id = a.id
                 WHERE rd.route_id = ?";

        $preparedStatement = $this->db->prepare($sql);
        $preparedStatement->execute([$routeId]);

        return $preparedStatement->fetchAll(\PDO::FETCH_CLASS, Attribute::class);
    }

    public function setAttributesForRoot($routeId, $attributeIds)
    {
        $this->db->beginTransaction();

        try {
            $removeSql = "DELETE FROM `route_data` WHERE `route_id` = ?";
            $removeStmt = $this->db->prepare($removeSql);
            $removeStmt->execute([$routeId]);

            $insertSql = "INSERT INTO `route_data` VALUES (?, ?)";
            $insertStatement = $this->db->prepare($insertSql);

            foreach ($attributeIds as $attributeId) {
                $insertStatement->execute([$routeId, $attributeId]);
            }

            $this->db->commit();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $this->db->rollBack();

            return false;
        }

        return true;
    }

    public function addAttributeToRoute($routeId, $attributeId)
    {
        if ($this->checkIfRouteHasAttribute($routeId, $attributeId)) {
            $this->logger->info("Route with id: " . $routeId . " already has attribute with id: " . $attributeId);
            return true;
        }

        $sql = "INSERT INTO `route_data` VALUES (?, ?)";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$routeId, $attributeId]);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return false;
        }

        return true;
    }

    public function checkIfRouteHasAttribute($routeId, $attributeId) {
        $sql = "SELECT 1 FROM `route_data` WHERE `route_id` = ? AND `attribute_id` = ?";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$routeId, $attributeId]);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return false;
        }

        return boolval($stmt->fetch());
    }

    public function removeAttributeFromRoute($routeId, $attributeId)
    {
        $sql = "DELETE FROM `route_data` WHERE `route_id` = ? AND `attribute_id` = ?";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$routeId, $attributeId]);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return false;
        }

        return true;
    }

}
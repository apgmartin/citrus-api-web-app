<?php

namespace Db\Route;

use Db\Attribute\Attribute;
use Db\RouteData\RouteDataDaoImpl;

class RouteDaoImpl implements RouteDao
{
    private $db;
    private $routeDataDaoImpl;

    /**
     * RouteDaoImpl constructor.
     * @param $db
     * @param $routeDataDaoImpl
     */
    public function __construct(\PDO $db, RouteDataDaoImpl $routeDataDaoImpl)
    {
        $this->db = $db;
        $this->routeDataDaoImpl = $routeDataDaoImpl;
    }

    /**
     * @return array Array of Route objects
     */
    public function getAllRoutes()
    {
        $sql = "SELECT `id`, `route`, `description` FROM `route`";

        $routes = $this->db->query($sql)->fetchAll(\PDO::FETCH_CLASS, Route::class);

        foreach($routes as $route) {
            $route->setAttributes($this->routeDataDaoImpl->getAttributesForRoot($route->getId()));
        }

        return $routes;
    }

    /**
     * @param integer $id Route Id
     * @return Route|false Object representing route or false if none found
     */
    public function getRoute($id)
    {
        $sql = "SELECT `id`, `route`, `description` FROM `route` WHERE `id` = ?";

        $preparedStatement = $this->db->prepare($sql);
        $preparedStatement->execute([$id]);

        $route = $preparedStatement->fetchObject(Route::class);

        if ($route) {
            $route->setAttributes($this->routeDataDaoImpl->getAttributesForRoot($id));
        }

        return $route;
    }

    /**
     * @param Route $route Object representing route to update
     */
    public function updateRoute(Route $route)
    {
        $sql = "UPDATE `route` SET `route` = ?, `description` = ? WHERE `id` = ?";

        $preparedStatement = $this->db->prepare($sql);
        $preparedStatement->execute([
            $route->getRoute(),
            $route->getDescription(),
            $route->getId()
        ]);
    }

    /**
     * @param Route $route Object representing route to update
     */
    public function deleteRoute(Route $route)
    {
        $sql = "DELETE FROM `route` WHERE `id` = ?";

        $preparedStatement = $this->db->prepare($sql);
        $preparedStatement->execute([$route->getId()]);
    }

}
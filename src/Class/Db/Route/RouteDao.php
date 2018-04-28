<?php

namespace Db\Route;


interface RouteDao
{
    public function getAllRoutes();
    public function getRoute($id);
    public function updateRoute(Route $Route);
    public function deleteRoute(Route $route);
}
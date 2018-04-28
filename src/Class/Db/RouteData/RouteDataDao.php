<?php

namespace Db\RouteData;


interface RouteDataDao
{
    public function getAttributesForRoot($routeId);
    public function setAttributesForRoot($routeId, $attributeIds);
    public function addAttributeToRoute($routeId, $attributeId);
    public function checkIfRouteHasAttribute($routeId, $attributeId);
    public function removeAttributeFromRoute($routeId, $attributeId);
}
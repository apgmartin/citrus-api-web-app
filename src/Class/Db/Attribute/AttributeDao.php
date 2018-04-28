<?php

namespace Db\Attribute;


interface AttributeDao
{
    public function getAllAttributes();
    public function getAttribute($id);
}
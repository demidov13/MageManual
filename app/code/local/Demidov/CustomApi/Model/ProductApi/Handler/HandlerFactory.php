<?php

class Demidov_CustomApi_Model_ProductApi_Handler_HandlerFactory
{
    public function create($className, $params)
    {
        return new $className($params);
    }
}
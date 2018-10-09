<?php

class Demidov_CustomApi_Model_Validator_Factory_ValidatorFactory
{
    public function create($className, $properties, $params)
    {
        return new $className($properties, $params);
    }
}
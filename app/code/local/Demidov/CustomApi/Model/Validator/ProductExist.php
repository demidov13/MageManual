<?php

class Demidov_CustomApi_Model_Validator_ProductExist
{
    protected $properties;
    protected $params;
    protected $errorMessages = [];
    protected $isValid = true;

    public function __construct($properties, $params)
    {
        $this->properties = $properties;
        $this->params = $params;
    }

    public function validate()
    {
        $product = Mage::getModel('catalog/product')->load($this->params['id']);
        if(!$product->getId()) {
            $this->addErrorMessage('product_not_found');
            $this->isValid = false;
        }
        return $this->isValid;
    }

    public function addErrorMessage($error)
    {
        $this->errorMessages[] = $error;
    }

    public function getErrorMessages()
    {
        return $this->errorMessages;
    }
}
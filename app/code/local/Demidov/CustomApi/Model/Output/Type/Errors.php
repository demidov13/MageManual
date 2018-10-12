<?php

class Demidov_CustomApi_Model_Output_Type_Errors implements Demidov_CustomApi_Model_Output_Type_TypeInterface
{
    protected $errors;
    protected $arrayResponse = [];

    public function __construct($errors)
    {
            $this->errors = $errors;
    }

    public function toArray()
    {
        if (is_array($this->errors)) {
            $errorString = Mage::getModel('CustomApi/Output_Type_Errors_Entity')
                ->getMessage($this->errors);
            Mage::getSingleton('CustomApi/ErrorLog')->logging($errorString);
            $this->arrayResponse = explode('.', $errorString);
        } elseif (is_string($this->errors)) {
            Mage::getSingleton('CustomApi/ErrorLog')->logging($this->errors);
            $this->arrayResponse[] = $this->errors;
        } else {
            throw new Demidov_CustomApi_Model_Exception('Error information was transmitted in an invalid format.');
        }

        return $this->arrayResponse;
    }
}
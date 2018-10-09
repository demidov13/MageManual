<?php

class Demidov_CustomApi_Model_Command_Validator_Result
{
    protected $errors = [];
    protected $fault = false;

    public function addError($error)
    {
        $this->errors = array_merge($this->errors, $error);
        $this->fault = true;
    }

    public function hasError()
    {
        if (!$this->fault) return false;

        $entityError = Mage::getModel('CustomApi/Command_Validator_Result_Error');
        $message = $entityError->checkErrors($this->errors);
        return $message;
    }
}
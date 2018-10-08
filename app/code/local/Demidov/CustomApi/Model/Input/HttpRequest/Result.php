<?php
/**
 * addError()
 * hasError()
 * isFault()
 * var format
 * Result должен вернуть информацию о том, json или xml у нас в body.
 */

class Demidov_CustomApi_Model_Input_HttpRequest_Result
{
    protected $errors = [];
    protected $format;
    protected $fault = false;

    public function addError($error)
    {
        $this->errors[] = $error;
        $this->fault = true;
    }

    public function hasError()
    {
        if (!$this->fault) return false;

        $entityError = Mage::getModel('CustomApi/Input_HttpRequest_Result_Error');
        $message = $entityError->checkErrors($this->errors);
        return $message;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

    public function getFormat()
    {
        return $this->format;
    }
}
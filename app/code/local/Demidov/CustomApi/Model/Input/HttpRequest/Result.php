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

    }

    public function isFault()
    {
        return $this->fault;
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
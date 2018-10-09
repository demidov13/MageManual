<?php

class Demidov_CustomApi_Model_Validator_ValueExist
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
        if ($this->properties['min_values']) {
            foreach ($this->params as $key => $value) {
                if (isset($this->properties['min_values'][$key]) && $this->properties['min_values'][$key] > $value) {
                    $this->addErrorMessage('min_values');
                    $this->isValid = false;
                }
            }
        }

        if ($this->properties['max_values']) {
            foreach ($this->params as $key => $value) {
                if (isset($this->properties['max_values'][$key]) && $this->properties['max_values'][$key] < $value) {
                    $this->addErrorMessage('max_values');
                    $this->isValid = false;
                }
            }
        }

        if ($this->properties['valid_values']) {
            foreach ($this->params as $key => $value) {
                if ($this->properties['valid_values'][$key] &&
                    !in_array($value, $this->properties['valid_values'][$key])) {
                    $this->addErrorMessage('invalid_values');
                    $this->isValid = false;
                }
            }
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
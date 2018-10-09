<?php

class Demidov_CustomApi_Model_Validator_FormatOfParam
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
        if ($this->properties['count_of_params'] != count($this->params)) {
            $this->addErrorMessage('count_of_params');
            $this->isValid = false;
        }

        foreach ($this->params as $key => $value) {

            if (!$this->properties['types'][$key]) {
                $this->addErrorMessage('param_not_exist');
                $this->isValid = false;
            }

            if ($this->properties['types'][$key] && is_array($value)) {
                foreach ($value as $item) {
                    if ($this->properties['types'][$key] != gettype($item)) {
                        $this->addErrorMessage('type_of_param');
                        $this->isValid = false;
                    }
                }
            }

            if (!is_array($value) && $this->properties['types'][$key] != gettype($value)) {
                $this->addErrorMessage('type_of_param');
                $this->isValid = false;
            }
        }

        foreach ($this->properties['types'] as $name => $type) {
            if (!$this->params[$name]) {
                $this->addErrorMessage('property_missing');
                $this->isValid = false;
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
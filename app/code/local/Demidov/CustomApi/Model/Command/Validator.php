<?php
/**
 * Этот валидатор запускает валидаторы из корневой папки Validator
 */

class Demidov_CustomApi_Model_Command_Validator
{
    protected $validators, $properties, $params;

    public function __construct($validators, $properties, $params)
    {
        $this->validators = $validators;
        $this->properties = $properties;
        $this->params = $params;
    }

    public function validate()
    {
        $result = Mage::getModel('CustomApi/Command_Validator_Result_ResultFactory')
            ->create('Demidov_CustomApi_Model_Command_Validator_Result');

        foreach ($this->validators as $validatorName) {
            $validator = Mage::getModel('CustomApi/Validator_Factory_ValidatorFactory')
                ->create($validatorName, $this->properties, $this->params);
            if (!$validator->validate()) {
                $result->addError($validator->getErrorMessages());
            }
        }
        return $result;
    }
}
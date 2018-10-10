<?php

class Demidov_CustomApi_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        try {
            $request = Mage::getModel('CustomApi/Input_HttpRequest_HttpRequestFactory')
                ->create('Demidov_CustomApi_Model_Input_HttpRequest');
            $httpValidator = Mage::getModel('CustomApi/Input_HttpRequestValidator_HttpRequestValidatorFactory')
                ->create('Demidov_CustomApi_Model_Input_HttpRequestValidator', $request);

            $httpResult = $httpValidator->validate();

            if ($message = $httpResult->hasError()) {
                // TODO: ErrorOutputFactory
                return var_dump($message);
            }

            $package = Mage::getModel('CustomApi/Input_HttpRequest_PackageFactory')
                ->create('Demidov_CustomApi_Model_Package', $request, $httpResult->getFormat());

            $auth = Mage::getModel('CustomApi/authentication');
            if (!$auth->check($package->getToken())) {
                // TODO: Output
                return var_dump($auth);
            }

            $set = Mage::getModel('CustomApi/Command_Set_SetFactory')
                ->create('Demidov_CustomApi_Model_Command_Set', $package->getVersion());

            $definition = $set->searchCommand($package->getCommand());

            $validator = Mage::getModel('CustomApi/Command_Validator_ValidatorFactory')
                ->create('Demidov_CustomApi_Model_Command_Validator', $definition, $package->getParams());
            $validationResult = $validator->validate();

            if ($message = $validationResult->hasError()) {
                // TODO: Output
                return var_dump($message);
            }

            $processor = Mage::getModel('CustomApi/Command_Processor_ProcessorFactory')
                ->create('Demidov_CustomApi_Model_Command_Processor', $definition->getHandler(), $package->getParams());

            $response = $processor->run();

            return var_dump($response);

        } catch (Exception $exception) {
            // TODO: Output
            return $this->getResponse()->setBody($exception->getMessage());
        }
    }

    public function dispatch($action)
    {
        try {
            parent::dispatch($action);

        } catch (Exception $exception) {
            return $this->getResponse()->setBody($exception->getMessage());
        }
    }
}
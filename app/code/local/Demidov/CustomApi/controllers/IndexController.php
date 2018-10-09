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

//            $params = $package->getParams();
//            foreach ($params as $key => $value) {
//                $keyArr[] = $key;
//                $valArr[] = $value;
//            }
//            $res = array_merge($keyArr, $valArr);
//            return var_dump($res);


//            $properties = $definition->getProperties();
//            $res = in_array('fixed', $properties['valid_values']['type_increase']);
//            return var_dump($res);

            $validator = Mage::getModel('CustomApi/Command_Validator_ValidatorFactory')
                ->create('Demidov_CustomApi_Model_Command_Validator', $definition, $package->getParams());
            $validationResult = $validator->validate();

            if ($message = $validationResult->hasError()) {
                // TODO: Output
                return var_dump($message);
            }

            return var_dump($validationResult);

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
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

            if ($httpResult->hasError()) {
                $typeInstance = Mage::getModel('CustomApi/Input_HttpRequest_Result_ErrorOutputFactory')
                    ->create('Demidov_CustomApi_Model_Output_Type_Errors', $httpResult);
                $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                    ->create('Demidov_CustomApi_Model_Output_Sender', $typeInstance, $httpResult->getFormat());
                ob_get_clean();
                return $this->getResponse()->setBody($sender->send());
            }

            $package = Mage::getModel('CustomApi/Input_HttpRequest_PackageFactory')
                ->create('Demidov_CustomApi_Model_Package', $request, $httpResult->getFormat());

            if (!Mage::getSingleton('CustomApi/authentication')->check($package->getToken())) {

                $typeInstance = Mage::getModel('CustomApi/Output_Type_Errors_ErrorsFactory')
                    ->create('Demidov_CustomApi_Model_Output_Type_Errors', array('auth'));

                $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                    ->create('Demidov_CustomApi_Model_Output_Sender', $typeInstance, $httpResult->getFormat());
                ob_get_clean();
                return $this->getResponse()->setBody($sender->send());
            }

            $set = Mage::getModel('CustomApi/Command_Set_SetFactory')
                ->create('Demidov_CustomApi_Model_Command_Set', $package->getVersion());

            if ($set instanceof Demidov_CustomApi_Model_Output_Type_TypeInterface) {
                $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                    ->create('Demidov_CustomApi_Model_Output_Sender', $set, $httpResult->getFormat());
                ob_get_clean();
                return $this->getResponse()->setBody($sender->send());
            }

            $definition = $set->searchCommand($package->getCommand());

            if ($definition instanceof Demidov_CustomApi_Model_Output_Type_TypeInterface) {
                $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                    ->create('Demidov_CustomApi_Model_Output_Sender', $definition, $httpResult->getFormat());
                ob_get_clean();
                return $this->getResponse()->setBody($sender->send());
            }

            $validator = Mage::getModel('CustomApi/Command_Validator_ValidatorFactory')
                ->create('Demidov_CustomApi_Model_Command_Validator', $definition, $package->getParams());
            $validationResult = $validator->validate();

            if ($validationResult->hasError()) {
                $typeInstance = Mage::getModel('CustomApi/Command_Validator_Result_ErrorOutputFactory')
                    ->create('Demidov_CustomApi_Model_Output_Type_Errors', $validationResult);
                $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                    ->create('Demidov_CustomApi_Model_Output_Sender', $typeInstance, $httpResult->getFormat());
                ob_get_clean();
                return $this->getResponse()->setBody($sender->send());
            }

            $processor = Mage::getModel('CustomApi/Command_Processor_ProcessorFactory')
                ->create('Demidov_CustomApi_Model_Command_Processor', $definition->getHandler(), $package->getParams());
            $response = $processor->run();

            $sender = Mage::getModel('CustomApi/Output_Sender_SenderFactory')
                ->create('Demidov_CustomApi_Model_Output_Sender', $response, $httpResult->getFormat());

            ob_get_clean();
            return $this->getResponse()->setBody($sender->send());

        } catch (Demidov_CustomApi_Model_Exception $e) {
            Mage::getSingleton('CustomApi/ErrorLog')->logging($e->getMessage());
            ob_get_clean();
            return $this->getResponse()->setBody("Internal Error To The application: " . $e->getMessage());
        }
    }

    public function dispatch($action)
    {
        try {
            parent::dispatch($action);

        } catch (Exception $exception) {
            Mage::getSingleton('CustomApi/ErrorLog')->logging($exception->getMessage());
            ob_get_clean();
            return $this->getResponse()->setBody($exception->getMessage());
        }
    }
}
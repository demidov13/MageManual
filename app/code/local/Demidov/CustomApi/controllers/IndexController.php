<?php

class Demidov_CustomApi_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        try {
            $request = Mage::getModel('CustomApi/Input_HttpRequest_HttpRequestFactory')
                ->create('Demidov_CustomApi_Model_Input_HttpRequest');
            $validator = Mage::getModel('CustomApi/Input_HttpRequestValidator_HttpRequestValidatorFactory')
                ->create('Demidov_CustomApi_Model_Input_HttpRequestValidator', $request);
            $httpResult = $validator->validate();
            return var_dump($httpResult);
            if ($httpResult->isFault()) {

            }

        } catch (Exception $exception) {
            ob_end_clean();
            return $exception->getMessage();
        }


//        return var_dump($res);

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
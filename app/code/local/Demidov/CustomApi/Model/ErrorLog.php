<?php

class Demidov_CustomApi_Model_ErrorLog extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('CustomApi/ErrorLog');
    }

    public function logging($errorMessage)
    {
        if (is_array($errorMessage)) {
            $errorMessage = implode('. ', $errorMessage);
        }

        $this->setErrorMessage($errorMessage)->setCreated(Mage::app()->getLocale()->date());
        $this->save();
    }
}
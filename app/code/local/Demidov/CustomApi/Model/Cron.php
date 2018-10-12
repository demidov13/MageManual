<?php

class Demidov_CustomApi_Model_Cron
{
    public function api_support_clear_log()
    {
        $logs = Mage::getModel('CustomApi/support')->getCollection();
        foreach ($logs as $log) {
            $log->delete();
        }
    }

    public function api_error_clear_log()
    {
        $logs = Mage::getModel('CustomApi/ErrorLog')->getCollection();
        foreach ($logs as $log) {
            $log->delete();
        }
    }
}
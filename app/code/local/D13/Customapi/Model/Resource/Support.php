<?php

class D13_Customapi_Model_Resource_Support extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('Customapi/support_log', 'support_log_id');
    }
}
<?php

class D13_Customapi_Model_Resource_Support_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('Customapi/Support');
    }
}
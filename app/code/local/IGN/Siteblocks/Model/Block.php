<?php
class IGN_Siteblocks_Model_Block extends Mage_Core_Model_Abstract
{
    public function __construct()
    {
        parent::__construct();
        // обращаемся к таблице в отсеке block, который расположен в отсеке модели siteblocks
        $this->_init('siteblocks/block');
    }
}
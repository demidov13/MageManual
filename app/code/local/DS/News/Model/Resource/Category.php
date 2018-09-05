<?php

class DS_News_Model_Resource_Category extends Mage_Core_Model_Resource_Db_Abstract
{

    public function _construct()
    {
        $this->_init('dsnews/table_categories', 'category_id');
    }

}
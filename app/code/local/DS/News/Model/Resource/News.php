<?php
class DS_News_Model_Resource_News extends Mage_Core_Model_Resource_Db_Abstract
{

    public function _construct()
    {
        $this->_init('dsnews/table_news', 'news_id');
    }

}
<?php
class IGN_Siteblocks_Test1Controller extends Mage_Core_Controller_Front_Action {

    public function firstrouteAction()
    {
        // Чтение конфигураций модуля, заданных в файле system.xml
        // getStoreConfigFlag возвращает true/false, а getStoreConfig возвращает значение конфигурации
        $enabled = Mage::getStoreConfig('siteblocks/settings/enabled');
        $count = Mage::getStoreConfig('siteblocks/settings/blocks_count');
        $text = Mage::getStoreConfig('siteblocks/settings/raw_text');
        // Mage::app()->getConfig()->saveConfig('siteblocks/settings/enabled','0');  - изменение конфигураций вручную

        var_dump($enabled);
        var_dump($count);
        var_dump($text);
        die('firstroute');
    }
}
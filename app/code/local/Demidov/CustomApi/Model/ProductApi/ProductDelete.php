<?php

class Demidov_CustomApi_Model_ProductApi_ProductDelete implements Demidov_CustomApi_Model_ProductApi_BaseInterface
{
    protected $params;
    protected $result = [];

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function process()
    {
        $id = $this->params['id'];
        $currentStoreId = Mage::app()->getStore()->getId();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        $product = Mage::getModel('catalog/product');
        $product->load($id);
        $product->delete();
        $this->result[$id] = 'Removed';

        Mage::app()->setCurrentStore($currentStoreId);
        return $this->result;
    }
}
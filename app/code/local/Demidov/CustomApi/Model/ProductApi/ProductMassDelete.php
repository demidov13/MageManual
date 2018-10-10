<?php

class Demidov_CustomApi_Model_ProductApi_ProductMassDelete implements Demidov_CustomApi_Model_ProductApi_BaseInterface
{
    protected $params;
    protected $result = [];

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function process()
    {
        $currentStoreId = Mage::app()->getStore()->getId();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        $ids = $this->params['ids'];
        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToFilter('entity_id', array('in' => $ids));

        $difference = count($ids) - $products->count();
        if ($difference > 0) {
            $this->result['Removed products'] = $products->count();
            $this->result['Not found'] = $difference;
        } else {
            $this->result['Removed products'] = $products->count();
        }

        foreach ($products as $product) {
            $product->delete();
        }

        Mage::app()->setCurrentStore($currentStoreId);
        return $this->result;
    }
}
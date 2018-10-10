<?php

class Demidov_CustomApi_Model_ProductApi_FixedPriceIncrease implements Demidov_CustomApi_Model_ProductApi_BaseInterface
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
        $collectionSimple = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToFilter('type_id', array('eq' => 'simple'))
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('price');

        if (!$collectionSimple->count()) {
            throw new Exception('Simple products not found');
        }

        foreach ($collectionSimple as $product) {
            $price = $product->getData('price');
            $price =  $price + $this->params['amount'];
            $product->setData('price', $price);
            $info['id'] = $product->getData('entity_id');
            $info['sku'] = $product->getData('sku');
            $info['name'] = $product->getData('name');
            $info['price'] = $product->getData('price');
            $this->result[] = $info;
        }

        $collectionSimple->save();
        Mage::app()->setCurrentStore($currentStoreId);
        return $this->result;
    }
}
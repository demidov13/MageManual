<?php

class D13_CustomApi_Block_Adminhtml_Main extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        $helper = Mage::helper('CustomApi');

        parent::__construct();
        $this->setId('customapi_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($helper->__('Custom Api'));
    }

    protected function _prepareLayout()
    {
        $helper = Mage::helper('CustomApi');

        $this->addTab('price_increase_section', array(
            'label' => $helper->__('Price Increase'),
            'title' => $helper->__('Price Increase'),
            'content' => $this->getLayout()->createBlock('dsnews/adminhtml_news_edit_tabs_general')->toHtml(),
        ));
        $this->addTab('product_delete_section', array(
            'label' => $helper->__('Remove Product'),
            'title' => $helper->__('Remove Product'),
            'content' => $this->getLayout()->createBlock('dsnews/adminhtml_news_edit_tabs_custom')->toHtml(),
        ));
        $this->addTab('support_section', array(
            'label' => $helper->__('Custom Fields'),
            'title' => $helper->__('Custom Fields'),
            'content' => $this->getLayout()->createBlock('dsnews/adminhtml_news_edit_tabs_custom')->toHtml(),
        ));
        return parent::_prepareLayout();
    }

}
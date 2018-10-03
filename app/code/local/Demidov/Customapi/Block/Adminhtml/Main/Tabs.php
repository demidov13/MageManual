<?php

class Demidov_Customapi_Block_Adminhtml_Main_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        $helper = Mage::helper('customapi');

        parent::__construct();
        $this->setId('customapi_tabs');
        $this->setTitle($helper->__('Custom API'));
    }

    protected function _prepareLayout()
    {
        $helper = Mage::helper('customapi');

        $this->addTab('api_v1', array(
            'label' => $helper->__('Custom Api v1'),
            'title' => $helper->__('Custom Api v1'),
            'content' => $this->getLayout()->createBlock('customapi/adminhtml_main_tabs_customApiV1')->toHtml(),
        ));
        $this->addTab('api_v2', array(
            'label' => $helper->__('Custom Api v2'),
            'title' => $helper->__('Custom Api v2'),
            'content' => $this->getLayout()->createBlock('customapi/adminhtml_main_tabs_customApiV2')->toHtml(),
        ));
        $this->addTab('support_section', array(
            'label' => $helper->__('Contact support'),
            'title' => $helper->__('Contact support'),
            'content' => $this->getLayout()->createBlock('customapi/adminhtml_main_tabs_contactForm')->toHtml(),
        ));
        return parent::_prepareLayout();
    }

}
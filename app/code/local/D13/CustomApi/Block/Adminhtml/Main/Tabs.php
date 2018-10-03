<?php

class D13_CustomApi_Block_Adminhtml_Main_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        $helper = Mage::helper('CustomApi');

        parent::__construct();
        $this->setId('customapi_tabs');
        $this->setTitle($helper->__('Custom Api'));
    }

    protected function _prepareLayout()
    {
        $helper = Mage::helper('CustomApi');

        $this->addTab('api_v1', array(
            'label' => $helper->__('Custom Api v1'),
            'title' => $helper->__('Custom Api v1'),
            'content' => $this->getLayout()->createBlock('CustomApi/adminhtml_main_tabs_customApiV1')->toHtml(),
        ));
        $this->addTab('api_v2', array(
            'label' => $helper->__('Custom Api v2'),
            'title' => $helper->__('Custom Api v2'),
            'content' => $this->getLayout()->createBlock('CustomApi/adminhtml_main_tabs_customApiV2')->toHtml(),
        ));
        $this->addTab('support_section', array(
            'label' => $helper->__('Contact support'),
            'title' => $helper->__('Contact support'),
            'content' => $this->getLayout()->createBlock('CustomApi/adminhtml_main_tabs_contactForm')->toHtml(),
        ));
        return parent::_prepareLayout();
    }

}
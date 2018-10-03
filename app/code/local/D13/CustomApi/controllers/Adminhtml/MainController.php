<?php

class D13_CustomApi_Adminhtml_MainController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('CustomApi');

        $this->_addLeft($this->getLayout()->createBlock('CustomApi/adminhtml_main_tabs'));
//        $this->_addContent($this->getLayout()->createBlock('CustomApi/adminhtml_main_tabs_'));

        $this->renderLayout();
    }
}
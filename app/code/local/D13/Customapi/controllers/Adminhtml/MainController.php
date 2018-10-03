<?php

class D13_Customapi_Adminhtml_MainController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('Customapi');

        $this->_addLeft($this->getLayout()->createBlock('Customapi/adminhtml_main_tabs'));
//        $this->_addContent($this->getLayout()->createBlock('Customapi/adminhtml_main_tabs_'));

        $this->renderLayout();
    }
}
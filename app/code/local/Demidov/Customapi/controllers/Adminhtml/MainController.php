<?php

class Demidov_Customapi_Adminhtml_MainController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('customapi');

        $this->_addLeft($this->getLayout()->createBlock('customapi/adminhtml_main_tabs'));
//        $this->_addContent($this->getLayout()->createBlock('Customapi/adminhtml_main_tabs_'));

        $this->renderLayout();
    }
}
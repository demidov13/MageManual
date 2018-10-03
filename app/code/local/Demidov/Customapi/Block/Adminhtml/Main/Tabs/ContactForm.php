<?php

class Demidov_Customapi_Block_Adminhtml_Main_Tabs_ContactForm extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('contact_form');
        $this->setTitle(Mage::helper('customapi')->__('Send a message in support'));
    }

    protected function _prepareForm()
    {
        $helper = Mage::helper('customapi');

        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('custom_api/adminhtml_support'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $fieldset = $form->addFieldset('base_fieldset',
            array(
                'legend'=>Mage::helper('customapi')->__('Mail'),
                'class' => 'fieldset-wide')
        );

        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name',
        ));

        $fieldset->addField('description', 'textarea', array(
            'label' => $helper->__('Description'),
            'required' => true,
            'name' => 'description',
        ));

        $this->setForm($form);

        return parent::_prepareForm();
    }

}
<?php

class Domino91_DeliveryPoint_Block_Adminhtml_Dpoint_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $form->addField('city', 'text',
            array(
                'label' => 'City',
                'class' => 'required-entry',
                'required' => true,
                'name' => 'city',
            ));
        $form->addField('street', 'text',
            array(
                'label' => 'Street',
                'class' => 'required-entry',
                'required' => true,
                'name' => 'street',
            ));

        if (Mage::registry('delivery_point_data')) {
            $form->setValues(Mage::registry('delivery_point_data')->getData());
        }

        return parent::_prepareForm();
    }
}
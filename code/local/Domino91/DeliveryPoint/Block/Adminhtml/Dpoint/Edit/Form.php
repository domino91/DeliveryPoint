<?php

class Domino91_DeliveryPoint_Block_Adminhtml_Dpoint_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $model = Mage::registry('delivery_point_data');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => 'Basic Information',
            'class' => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addField('city', 'text',
            array(
                'label' => 'City',
                'class' => 'required-entry',
                'required' => true,
                'name' => 'city',
            ));
        $fieldset->addField('street', 'text',
            array(
                'label' => 'Street',
                'class' => 'required-entry',
                'required' => true,
                'name' => 'street',
            ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
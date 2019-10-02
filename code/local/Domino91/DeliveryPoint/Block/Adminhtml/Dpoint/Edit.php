<?php

class Domino91_DeliveryPoint_Block_Adminhtml_Dpoint_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {

      //?  $this->_objectId = 'id';
        $this->_blockGroup = 'deliverypoint';
        $this->_controller = 'adminhtml_dpoint';
        parent::__construct();

        $this->_updateButton('save', 'label', $this->__('Save Baz'));
        $this->_updateButton('delete', 'label', $this->__('Delete Baz'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('') && Mage::registry('delivery_point_data')->getId() )
        {
            return 'Edit a delivery point';
        }
        else
        {
            return 'Add a delivery point';
        }
    }
}
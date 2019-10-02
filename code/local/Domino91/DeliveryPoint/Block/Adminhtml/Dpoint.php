<?php

class Domino91_DeliveryPoint_Block_Adminhtml_Dpoint extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'deliverypoint';
        $this->_controller = 'adminhtml_dpoint';
        $this->_headerText = $this->__('Delivery Point');

        parent::__construct();
    }
}
<?php

class Domino91_DeliveryPoint_Block_Adminhtml_Dpoint_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('dpoint_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('Information');
    }

    public function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => 'About the delivery point',
            'title' => 'About the delivery point',
            'content' => $this->getLayout()
                ->createBlock('deliverypoint/adminhtml_dpoint_edit_tab_form')
                ->toHtml()
        ));

        return parent::_beforeToHtml();
    }
}
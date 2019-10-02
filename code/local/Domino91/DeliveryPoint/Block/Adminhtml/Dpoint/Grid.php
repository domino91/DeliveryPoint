<?php

class Domino91_DeliveryPoint_Block_Adminhtml_Dpoint_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('id');
        $this->setId('deliverypoint_dpoint_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _getCollectionClass()
    {
        return 'deliverypoint/dpoint_collection';
    }

    protected function _prepareColumns()
    {

        $this->addColumn('id',
            array(
                'header' => $this->__('ID'),
                'align' => 'right',
                'width' => '50px',
                'index' => 'id'
            )
        );

        $this->addColumn('city',
            array(
                'header' => $this->__('City'),
                'index' => 'city'
            )
        );

        $this->addColumn('street',
            array(
                'header' => $this->__('Street'),
                'index' => 'street'
            )
        );
        return parent::_prepareColumns();
    }
    protected function _prepareMassaction(){
        $this->setMassactionIdField('dpoint_id');
        $this->getMassactionBlock()->setFormFieldName('dpoint');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'     => __('Delete'),
            'url'       => $this->getUrl('*/*/massDelete'),
            'confirm'   => __('Are you sure?')
        ));
        return $this;
    }
}
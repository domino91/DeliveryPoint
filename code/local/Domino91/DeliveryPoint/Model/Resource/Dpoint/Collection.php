<?php
class Domino91_DeliveryPoint_Model_Resource_Dpoint_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('deliverypoint/dpoint');
    }
}
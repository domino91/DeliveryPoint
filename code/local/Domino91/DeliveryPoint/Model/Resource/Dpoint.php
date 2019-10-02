<?php
class Domino91_DeliveryPoint_Model_Resource_Dpoint extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('deliverypoint/dpoint', 'id');
    }
}
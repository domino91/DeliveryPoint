<?php

class Domino91_DeliveryPoint_Model_Carrier extends Mage_Shipping_Model_Carrier_Abstract implements Mage_Shipping_Model_Carrier_Interface
{
    protected $_code = 'domino91_deliverypoint';

    public function collectRates(
        Mage_Shipping_Model_Rate_Request $request
    ) {
        /* @var $result Mage_Shipping_Model_Rate_Result */
        $result = Mage::getModel('shipping/rate_result');
        foreach ($this->_getDeliveryPointShippingRate() as $rate) {
            $result->append($rate);
        }

        return $result;
    }

    public function getAllowedMethods()
    {
        return array();
    }

    /**
     * @return Mage_Shipping_Model_Rate_Result_Method[]
     */
    protected function _getDeliveryPointShippingRate()
    {
        $shippingRateArray = array();
        $deliveryCollection = Mage::getModel('deliverypoint/dpoint')->getCollection();
        $deliveryCollection->getSelect()
            ->order('city ASC');
        foreach ($deliveryCollection as $deliver) {
            /* @var $rate Mage_Shipping_Model_Rate_Result_Method */
            $rate = Mage::getModel('shipping/rate_result_method');

            $rate->setCarrier($this->_code);
            $rate->setCarrierTitle($this->getConfigData('title'));

            $rate->setMethod($deliver->getId());
            $rate->setMethodTitle(sprintf('%s - %s', $deliver->getCity(), $deliver->getStreet()));

            $rate->setPrice($this->getConfigData('price'));
            $rate->setCost(0);
            $shippingRateArray[] = $rate;
        }

        return $shippingRateArray;
    }
}

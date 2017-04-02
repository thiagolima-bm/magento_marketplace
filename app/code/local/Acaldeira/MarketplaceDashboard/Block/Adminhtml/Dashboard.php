<?php
/**
 * Acaldeira_MarketplaceDashboard
 *
 * @category    Acaldeira
 * @package     Acaldeira_MarketplaceDashboard
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_MarketplaceDashboard_Block_Adminhtml_Dashboard extends Mage_Adminhtml_Block_Template
{

    /**
     * @return object
     */
    public function getOrdersCollection()
    {
        $collection = Mage::getModel('sales/order')->getCollection();
        $marketplaceStore = $this->getMarketplaceStore();
        Mage::getSingleton('acmarketplaceorder/order')->addMarketplaceStoreToCollection($collection, $marketplaceStore->getId());
        return $collection;
    }

    /**
     * @return Acaldeira_MarketplaceDashboard_Helper_Data|Mage_Core_Helper_Abstract
     */
    private function _getHelper()
    {
        return Mage::helper('acmarketplacedashboard');
    }

    /**
     * @return mixed
     */
    public function getNumOfOrders()
    {
        return $this->getOrdersCollection()->getSize();
    }

    /**
     * @return mixed
     */
    public function getSumSubTotalOfOrders()
    {
        $collection = $this->getOrdersCollection();
        $subTotal = 0;
        foreach ($collection as $order) {
            foreach ($order->getAllVisibleItems() as $itemCollection) {
                foreach ($itemCollection as $item) {
                    $subTotal += @$item['row_total'];
                }
            }
        }
        return $subTotal;
    }

    /**
     * @return Acaldeira_Marketplace_Model_Store
     */
    public function getMarketplaceStore()
    {
        return $this->_getHelper()->getMarketplaceStore();
    }
}
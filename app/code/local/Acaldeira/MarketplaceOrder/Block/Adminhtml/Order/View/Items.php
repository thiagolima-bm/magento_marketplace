<?php
/**
 * Acaldeira_MarketplaceOrder
 *
 * @category    Acaldeira
 * @package     Acaldeira_MarketplaceOrder
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_MarketplaceOrder_Block_Adminhtml_Order_View_Items extends Mage_Adminhtml_Block_Sales_Order_View_Items
{
    /**
     * Retrieve order items collection
     *
     * @return unknown
     */
    public function getItemsCollection()
    {
        $collection = parent::getItemsCollection();
        $storeId = Mage::app()->getStore()->getId();
        $marketPlaceStore = $this->_getHelper()->getMarketplaceStore();
        foreach ($collection as $item) {

            $attributeValue = Mage::getModel('catalog/product')
                ->getResource()
                ->getAttributeRawValue($item->getProductId(), $this->_getConfigHelper()->getMarketplaceStoreAttrName(), $storeId);

            if ($attributeValue != $marketPlaceStore->getId())
                $collection->removeItemByKey($item->getId());

        }
        return $collection;
    }

    /**
     * @return Acaldeira_MarketplaceOrder_Helper_Data
     */
    private function _getHelper()
    {
        return Mage::helper('acmarketplaceorder');
    }

    /**
     * @return Acaldeira_MarketplaceOrder_Helper_Config
     */
    private function _getConfigHelper()
    {
        return Mage::helper('acmarketplaceorder/config');
    }
}
<?php
/**
 * Acaldeira_MarketplaceOrder
 *
 * @category    Acaldeira
 * @package     Acaldeira_MarketplaceOrder
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_MarketplaceOrder_Model_Order extends Mage_Sales_Model_Order
{
    /**
     * @param $collection
     * @return $this
     */
    public function addMarketplaceStoreToCollection($collection, $marketplace_store_id = null)
    {
        Mage::getResourceSingleton('acmarketplaceorder/order')->setMarketplaceStoreToCollection($collection, $marketplace_store_id);
        return $this;
    }
}
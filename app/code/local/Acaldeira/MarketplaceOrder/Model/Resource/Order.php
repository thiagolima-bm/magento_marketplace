<?php
/**
 * Acaldeira_MarketplaceOrder
 *
 * @category    Acaldeira
 * @package     Acaldeira_MarketplaceOrder
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_MarketplaceOrder_Model_Resource_Order extends Mage_Sales_Model_Resource_Order
{
    /**
     * @param $collection
     * @param null $marketplace_store_id
     * @return $this
     */
    public function setMarketplaceStoreToCollection($collection, $marketplace_store_id = null)
    {
        $entityValuesVarchar = Mage::getSingleton("core/resource")->getTableName('catalog_product_entity_varchar');
        $marketplaceStoreAttrName = $this->_getConfigHelper()->getMarketplaceStoreAttrName();
        $entityValuesVarchar = Mage::getSingleton("core/resource")->getTableName('catalog_product_entity_varchar');
        $entityAtribute = Mage::getSingleton("core/resource")->getTableName('eav_attribute');
        $productType = Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE;

        $collection->getSelect()
            ->joinLeft( array('order_item' => 'sales_flat_order_item'), "order_item.order_id = main_table.entity_id AND order_item.product_type <> '{$productType}'", array('order_item.product_id'))
            ->joinLeft( array( 'mktplaceAttr' => $entityAtribute ), "mktplaceAttr.attribute_code = '{$marketplaceStoreAttrName}'", array('attribute_id') )
            ->joinLeft( array( 'productValVarchar' => $entityValuesVarchar ), "productValVarchar.attribute_id = mktplaceAttr.attribute_id AND productValVarchar.entity_id = order_item.product_id AND productValVarchar.value = '{$marketplace_store_id}'", array('marketplace_store_id' => 'value'))
            ->where('productValVarchar.value is not null')
            ->group('main_table.entity_id')

        ;
        return $this;
    }

    /**
     * @return Acaldeira_MarketplaceOrder_Helper_Config
     */
    private function _getConfigHelper()
    {
        return Mage::helper('acmarketplaceorder/config');
    }
}
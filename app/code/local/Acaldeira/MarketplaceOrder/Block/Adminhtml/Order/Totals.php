<?php
/**
 * Acaldeira_MarketplaceOrder
 *
 * @category    Acaldeira
 * @package     Acaldeira_MarketplaceOrder
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_MarketplaceOrder_Block_Adminhtml_Order_Totals extends Mage_Adminhtml_Block_Sales_Totals
{
    /**
     * Initialize order totals array
     *
     * @return Mage_Sales_Block_Order_Totals
     */
    protected function _initTotals()
    {
        $this->_totals = array();
        $this->_totals['subtotal'] = new Varien_Object(array(
            'code'      => 'subtotal',
            'value'     => $this->_getSubtotal(),
            'base_value'=> $this->_getSubtotal(),
            'label'     => $this->helper('sales')->__('Subtotal')
        ));

        return $this;
    }

    /**
     * @return int
     */
    private function _getSubTotal()
    {
        $subTotal = 0;
        $itemsBlock = Mage::getBlockSingleton('acmarketplaceorder/adminhtml_order_view_items');
        /* @var $itemsBlock Acaldeira_MarketplaceOrder_Block_Adminhtml_Order_View_Items */
        $collection = $itemsBlock->getItemsCollection();
        foreach ($collection as $item) {
            $subTotal += $item->getRowTotal();
        }
        return $subTotal;
    }
}
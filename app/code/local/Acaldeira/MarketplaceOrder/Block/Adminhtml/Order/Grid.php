<?php
/**
 * Acaldeira_MarketplaceOrder
 *
 * @category    Acaldeira
 * @package     Acaldeira_MarketplaceOrder
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_MarketplaceOrder_Block_Adminhtml_Order_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        //Todo: implement mass action to each marketplace store
        return $this;
    }

    /**
     * @return bool
     */
    public function getExportTypes()
    {
        //Todo: implement mass action to each marketplace store
        return false;
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $marketplaceStore = $this->_getHelper()->getMarketplaceStore();
        Mage::getSingleton('acmarketplaceorder/order')->addMarketplaceStoreToCollection($collection, $marketplaceStore->getId());
        $this->setCollection($collection);
        return Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
    }

    /**
     * @param $row
     * @return bool|string
     */
    public function getRowUrl($row)
    {
        //TODO: improve security
        if (Mage::getSingleton('admin/session')->isAllowed('admin/acmarketplace/orders')) {
            return $this->getUrl('*/marketplaceorder_order/view', array('order_id' => $row->getId()));
        }
        return false;
    }

    /**
     * @return Acaldeira_MarketplaceOrder_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('acmarketplaceorder');
    }
}
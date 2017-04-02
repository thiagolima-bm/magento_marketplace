<?php
/**
 * Acaldeira_MarketplaceOrder
 *
 * @category    Acaldeira
 * @package     Acaldeira_MarketplaceOrder
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_MarketplaceOrder_Block_Adminhtml_Order extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Acaldeira_MarketplaceOrder_Block_Adminhtml_Order constructor.
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_order';
        $this->_blockGroup = 'acmarketplaceorder';
        $this->_headerText = __('Order Manager');
        parent::__construct();
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        $this->setChild( 'grid',
            $this->getLayout()->createBlock( $this->_blockGroup.'/' . $this->_controller . '_grid',
                $this->_controller . '.grid')->setSaveParametersInSession(true) );
        return parent::_prepareLayout();
    }
}
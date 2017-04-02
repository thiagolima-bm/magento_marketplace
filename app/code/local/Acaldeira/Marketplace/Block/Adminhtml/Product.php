<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_Marketplace_Block_Adminhtml_Product extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Acaldeira_Marketplace_Block_Adminhtml_Product constructor.
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_product';
        $this->_blockGroup = 'acmarketplace';
        $this->_headerText = Mage::helper('acmarketplace')->__('Product Manager');
        $this->_addButtonLabel = Mage::helper('acmarketplace')->__('Add Product');
        parent::__construct();
    }
}
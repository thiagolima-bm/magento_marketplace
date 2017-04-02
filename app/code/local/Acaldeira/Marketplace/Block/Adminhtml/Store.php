<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_Marketplace_Block_Adminhtml_Store extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Acaldeira_Marketplace_Block_Adminhtml_Store constructor.
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_store';
        $this->_blockGroup = 'acmarketplace';
        $this->_headerText = __('Store Manager');
        $this->_addButtonLabel = __('Add Store');
        parent::__construct();
    }
}
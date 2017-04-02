<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_Marketplace_Block_Adminhtml_Store_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Acaldeira_Marketplace_Block_Adminhtml_Store_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'acmarketplace';
        $this->_controller = 'adminhtml_store';
        $this->_updateButton('save', 'label', __('Save Store'));
        $this->_updateButton('delete', 'label', __('Delete Store'));
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        if( Mage::registry('store_data') && Mage::registry('store_data')->getId() ) {
            return __("Edit Store '%s'", $this->htmlEscape(Mage::registry('store_data')->getStorename()));
        } else {
            return __('Add Store');
        }
    }
}
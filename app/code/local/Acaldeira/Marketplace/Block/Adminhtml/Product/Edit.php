<?php
 
class Acaldeira_Marketplace_Block_Adminhtml_Product_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'acmarketplace';
        $this->_controller = 'adminhtml_product';

    }
 
    public function getHeaderText()
    {
        if( Mage::registry('marketplace_product') && Mage::registry('marketplace_product')->getId() ) {
            return Mage::helper('acmarketplace')->__("Edit Product '%s'", $this->htmlEscape(Mage::registry('marketplace_product')->getName()));
        } else {
            return Mage::helper('acmarketplace')->__('Add Product');
        }
    }
}
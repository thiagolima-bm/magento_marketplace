<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_Marketplace_Block_Adminhtml_Product_Helper_Form_Gallery extends Mage_Adminhtml_Block_Catalog_Product_Helper_Form_Gallery
{
    /**
     * Prepares content block
     *
     * @return string
     */
    public function getContentHtml()
    {

        /* @var $content Mage_Adminhtml_Block_Catalog_Product_Helper_Form_Gallery_Content */
        $content = Mage::getSingleton('core/layout')
            ->createBlock('acmarketplace/adminhtml_product_helper_form_gallery_content');

        $content->setId($this->getHtmlId() . '_content')
            ->setElement($this);
        return $content->toHtml();
    }
}
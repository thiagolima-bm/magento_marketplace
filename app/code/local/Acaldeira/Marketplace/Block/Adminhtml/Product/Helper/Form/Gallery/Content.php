<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_Marketplace_Block_Adminhtml_Product_Helper_Form_Gallery_Content extends Mage_Adminhtml_Block_Catalog_Product_Helper_Form_Gallery_Content
{
    protected function _prepareLayout()
    {
        $this->setChild('uploader',
            $this->getLayout()->createBlock($this->_uploaderType)
        );

        $this->getUploader()->getUploaderConfig()
            ->setFileParameterName('image')
            ->setTarget(Mage::getModel('adminhtml/url')->addSessionParam()->getUrl('*/marketplace_catalog_product_gallery/upload'));

        $browseConfig = $this->getUploader()->getButtonConfig();
        $browseConfig
            ->setAttributes(array(
                'accept' => $browseConfig->getMimeTypesByExtensions('gif, png, jpeg, jpg')
            ));

        Mage::dispatchEvent('catalog_product_gallery_prepare_layout', array('block' => $this));

        return Mage_Adminhtml_Block_Widget::_prepareLayout();
    }
}
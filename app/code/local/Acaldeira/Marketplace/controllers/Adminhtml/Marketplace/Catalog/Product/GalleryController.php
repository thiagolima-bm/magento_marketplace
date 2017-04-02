<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
include_once "Mage/Adminhtml/controllers/Catalog/Product/GalleryController.php";
class Acaldeira_Marketplace_Adminhtml_Marketplace_Catalog_Product_GalleryController extends Mage_Adminhtml_Catalog_Product_GalleryController
{

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/acmarketplace/catalog');
    }
}

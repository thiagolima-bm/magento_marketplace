<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
include_once "Mage/Adminhtml/controllers/Catalog/ProductController.php";
class Acaldeira_Marketplace_Adminhtml_Marketplace_ProductController extends Mage_Adminhtml_Catalog_ProductController
{
    /**
     * List all products
     *
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Filtering
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('acmarketplace/adminhtml_product_grid')->toHtml()
        );
    }

    /**
     * Display product form
     *
     */
    public function newAction()
    {
        $this->_redirect('*/*/editProduct');
    }

    /**
     *
     */
    public function editProductAction()
    {
        $product = $this->_initProduct();
        $this->loadLayout();
        $this->_checkIfBelongsToVendor($product);
        $this->_setActiveMenu('acmarketplace/product');
        $this->renderLayout();
    }

    /**
     * Saves product
     *
     */
    public function saveProductAction()
    {
        $storeId        = $this->getRequest()->getParam('store');
        $redirectBack   = $this->getRequest()->getParam('back', false);
        $productId      = $this->getRequest()->getParam('id');
        $isEdit         = (int)($this->getRequest()->getParam('id') != null);
        $marketPlaceStore = $this->_getHelper()->getMarketplaceStore();

        $data = $this->getRequest()->getPost();
        if ($data) {
            $this->_filterStockData($data['product']['stock_data']);

            $product = $this->_initProductSave();
            $product->setData($this->_getConfigHelper()->getMarketplaceStoreAttrName(), $marketPlaceStore->getId());

            try {
                $product->save();
                $productId = $product->getId();

                if (isset($data['copy_to_stores'])) {
                    $this->_copyAttributesBetweenStores($data['copy_to_stores'], $product);
                }

                $this->_getSession()->addSuccess($this->__('The product has been saved.'));
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage())
                    ->setProductData($data);
                $redirectBack = true;
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            }
        }

        if ($redirectBack) {
            $this->_redirect('*/*/edit', array(
                'id'    => $productId,
                '_current'=>true
            ));
        } elseif($this->getRequest()->getParam('popup')) {
            $this->_redirect('*/*/created', array(
                '_current'   => true,
                'id'         => $productId,
                'edit'       => $isEdit
            ));
        } else {
            $this->_redirect('*/*/', array('store'=>$storeId));
        }
    }

    /**
     * Initialize product from request parameters
     *
     * @return Mage_Catalog_Model_Product
     */
    protected function _initProduct()
    {
        $this->_title($this->__('Catalog'))
            ->_title($this->__('Manage Products'));

        $productId  = (int) $this->getRequest()->getParam('id');
        $product    = Mage::getModel('catalog/product')
            ->setStoreId($this->getRequest()->getParam('store', 0));

        // Hack

        $this->getRequest()->setParam('set',4);
        $this->getRequest()->setParam('type','simple');
        if (!$productId) {
            if ($setId = (int) $this->getRequest()->getParam('set')) {
                $product->setAttributeSetId($setId);
            }

            if ($typeId = $this->getRequest()->getParam('type')) {
                $product->setTypeId($typeId);
            }
        }

        $product->setData('_edit_mode', true);
        if ($productId) {
            try {
                $product->load($productId);

            } catch (Exception $e) {
                $product->setTypeId(Mage_Catalog_Model_Product_Type::DEFAULT_TYPE);
                Mage::logException($e);
            }
        }

        $attributes = $this->getRequest()->getParam('attributes');
        if ($attributes && $product->isConfigurable() &&
            (!$productId || !$product->getTypeInstance()->getUsedProductAttributeIds())) {
            $product->getTypeInstance()->setUsedProductAttributeIds(
                explode(",", base64_decode(urldecode($attributes)))
            );
        }

        // Required attributes of simple product for configurable creation
        if ($this->getRequest()->getParam('popup')
            && $requiredAttributes = $this->getRequest()->getParam('required')) {
            $requiredAttributes = explode(",", $requiredAttributes);
            foreach ($product->getAttributes() as $attribute) {
                if (in_array($attribute->getId(), $requiredAttributes)) {
                    $attribute->setIsRequired(1);
                }
            }
        }

        if ($this->getRequest()->getParam('popup')
            && $this->getRequest()->getParam('product')
            && !is_array($this->getRequest()->getParam('product'))
            && $this->getRequest()->getParam('id', false) === false) {

            $configProduct = Mage::getModel('catalog/product')
                ->setStoreId(0)
                ->load($this->getRequest()->getParam('product'))
                ->setTypeId($this->getRequest()->getParam('type'));

            /* @var $configProduct Mage_Catalog_Model_Product */
            $data = array();
            foreach ($configProduct->getTypeInstance()->getEditableAttributes() as $attribute) {

                /* @var $attribute Mage_Catalog_Model_Resource_Eav_Attribute */
                if(!$attribute->getIsUnique()
                    && $attribute->getFrontend()->getInputType()!='gallery'
                    && $attribute->getAttributeCode() != 'required_options'
                    && $attribute->getAttributeCode() != 'has_options'
                    && $attribute->getAttributeCode() != $configProduct->getIdFieldName()) {
                    $data[$attribute->getAttributeCode()] = $configProduct->getData($attribute->getAttributeCode());
                }
            }

            $product->addData($data)
                ->setWebsiteIds($configProduct->getWebsiteIds());
        }

        Mage::register('product', $product);
        Mage::register('current_product', $product);
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));
        return $product;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/acmarketplace/catalog');
    }

    /**
     * @return Acaldeira_Marketplace_Helper_Config|Mage_Core_Helper_Abstract
     */
    protected function _getConfigHelper()
    {
        return Mage::helper('acmarketplace/config');
    }

    /**
     * @return Acaldeira_Marketplace_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('acmarketplace');
    }

    /**
     * @param $product
     */
    private function _checkIfBelongsToVendor($product)
    {
        if (!$product->getId())
            return;
        $marketplaceStore = $this->_getHelper()->getMarketplaceStore();
        if ($product->getData($this->_getConfigHelper()->getMarketplaceStoreAttrName()) !==
            $marketplaceStore->getId()
        ) {
            $this->_getSession()->addError(Mage::helper('catalog')->__('You cannot edit this product'));
            $this->_redirect('*/*/');
        }
    }
}
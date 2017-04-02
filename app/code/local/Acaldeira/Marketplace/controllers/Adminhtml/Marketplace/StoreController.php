<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_Marketplace_Adminhtml_Marketplace_StoreController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return Acaldeira_Marketplace_Model_Store|false|Mage_Core_Model_Abstract|void
     */
    private function _initObject()
    {
        $id    = $this->getRequest()->getParam('id');
        $model = Mage::getModel('acmarketplace/store');
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->_getSession()->addError(__('This store no longer exists.'));
                $this->_redirect('*/*/index');

                return;
            }
        }
        return $model;
    }

    /**
     * List all stores
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('acmarketplace/adminhtml_store'));
        $this->renderLayout();
    }

    /**
     * Display form
     */
    public function newAction()
    {
        $this->_redirect('*/*/edit');
    }

    /**
     * Display form
     */
    public function editAction()
    {
        $this->loadLayout();
        $model = $this->_initObject();
        Mage::register('store_data', $model);
        $this->_addContent($this->getLayout()->createBlock('acmarketplace/adminhtml_store_edit'))
            ->_addLeft($this->getLayout()->createBlock('acmarketplace/adminhtml_store_edit_tabs'));
        $this->renderLayout();
    }

    /**
     * Save object
     */
    public function saveAction()
    {

        if ( $this->getRequest()->getPost() ) {

            $postData = $this->getRequest()->getPost();

            try {

                $model = $this->_initObject();
                $data = new Varien_Object($postData);
                $model->addData($data->getData());
                $this->_getSession()->setFormData($model->getData());
                if (!$postData['user_id']) {
                    $adminUser = $this->_createAdminUser($postData);
                    $model->setUserId($adminUser->getId());
                }
                $model->save();

            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            } catch (Exception $e) {
                $this->_getSession()->addError(__('Unable to save the store.'));
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
                Mage::logException($e);
            }

            if ($redirectBack) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));

                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * @return Acaldeira_Marketplace_Helper_Config
     */
    private function _getConfigHelper()
    {
        return Mage::helper('acmarketplace/config');
    }

    /**
     * @param $postData
     * @return false|Mage_Admin_Model_User|Mage_Core_Model_Abstract
     */
    private function _createAdminUser($postData)
    {
        $userModel = Mage::getModel('admin/user');
        $userModel->setUsername($postData['username'])
            ->setFirstname($postData['name'])
            ->setLastname($postData['url_name'])
            ->setPassword($postData['password'])
            ->setEmail($postData['email'])
            ->setIsActive(true);

        $userModel->save();

        $rolesModel = Mage::getModel('admin/role')->getCollection();
        $rolesModel->addFieldToFilter('role_name', $this->_getConfigHelper()->getAclRoleName());
        $marketplaceRoleId = $rolesModel->getFirstItem()->getId();

        $userModel->setRoleIds(array($marketplaceRoleId))
            ->setRoleUserId($userModel->getUserId())
            ->saveRelations();
        return $userModel;
    }

    /**
     *
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('acmarketplace/adminhtml_store_grid')->toHtml()
        );
    }

}

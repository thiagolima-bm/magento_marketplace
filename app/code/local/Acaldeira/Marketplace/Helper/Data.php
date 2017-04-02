<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 XXX. (http://www.acaldeira.com.br)
 */ 
class Acaldeira_Marketplace_Helper_Data  extends Mage_Core_Helper_Abstract
{
    private $_marketplaceStore;
    /**
     * @return Acaldeira_Marketplace_Model_Store
     */
    public function getMarketplaceStore()
    {
        if (!$this->_marketplaceStore) {
            $user = Mage::getSingleton('admin/session')->getUser();
            $this->_marketplaceStore = Mage::getModel('acmarketplace/store')->load($user->getId(), 'user_id');
        }

        return $this->_marketplaceStore;
    }
}
<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */ 
class Acaldeira_Marketplace_Helper_Config  extends Mage_Core_Helper_Abstract
{
    /**
     * @return string
     */
    public function getAclRoleName()
    {
        return 'AC Marketplace';
    }

    /**
     * @return string
     */
    public function getAclResources()
    {
        return array(
            '__root__',
            'admin/acmarketplace',
            'admin/acmarketplace/store',
            'admin/acmarketplace/dashboard',
            'admin/acmarketplace/catalog',
            'admin/acmarketplace/orders'
        );
    }

    /**
     * @return string
     */
    public function getMarketplaceStoreAttrName()
    {
        return 'acmarketplace_store_id';
    }
}
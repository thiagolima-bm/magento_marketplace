<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_Marketplace_Model_Resource_Store extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('acmarketplace/store', 'entity_id');
    }
}
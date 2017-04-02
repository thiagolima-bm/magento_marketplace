<?php
/**
 * Acaldeira_Marketplace
 *
 * @method String getName()
 * @method String getEmail()
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_Marketplace_Model_Store extends Mage_Core_Model_Abstract
{
    /**
     * Model initialization
     */
    protected function _construct()
    {
        $this->_init('acmarketplace/store');
    }
}
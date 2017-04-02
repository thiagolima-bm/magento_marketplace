<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */


/* @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = Mage::getResourceModel('catalog/setup','catalog_setup');

$installer->startSetup();

$installer->addAttribute('catalog_product', 'acmarketplace_store_id', array(
    'type'              => 'varchar',
    'label'             => 'Marketplace Store Id',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => false,
    'required'          => false,
    'searchable'        => false,
    'is_configurable'   => false,
));

$installer->endSetup();

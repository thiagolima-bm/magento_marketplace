<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer->startSetup();
 
$installer->run("
DROP TABLE IF EXISTS `{$installer->getTable('acmarketplace/store')}`;
CREATE TABLE IF NOT EXISTS `{$installer->getTable('acmarketplace/store')}` (
    `entity_id`             int(11)       NOT NULL AUTO_INCREMENT,
    `user_id`               int(11)       NOT NULL,
    `name`                  varchar(200)  NOT NULL,
    `url_name`              varchar(20)   NOT NULL,
    `email`                 varchar(200)  NOT NULL,
    `postcode`              varchar(10)   NOT NULL, 
    `fee`                   float         DEFAULT NULL,
    `is_active`             int(1)        NOT NULL DEFAULT '0',
    `store_id`              int(1)        NOT NULL DEFAULT '0',
    `created_at`            datetime      DEFAULT CURRENT_TIMESTAMP,
    `updated_at`            datetime      NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`entity_id`),
    KEY `FK_MARKETPLACE_ADMIN_USER_ID` (`user_id`),
    CONSTRAINT `FK_MARKETPLACE_ADMIN_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `{$installer->getTable('admin/user')}` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
    )
");
$installer->endSetup();



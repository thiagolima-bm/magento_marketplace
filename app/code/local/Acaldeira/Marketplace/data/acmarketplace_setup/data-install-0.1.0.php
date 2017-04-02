<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */

$configHelper = Mage::helper('acmarketplace/config');

$roleName = $configHelper->getAclRoleName();

$resources  = $configHelper->getAclResources();

$role = Mage::getModel('admin/roles');

$role->setName($roleName)
    ->setPid('')
    ->setRoleType('G');

$role->save();

Mage::getModel('admin/rules')
    ->setRoleId($role->getId())
    ->setResources($resources)
    ->saveRel();
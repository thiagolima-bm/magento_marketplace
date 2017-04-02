<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_Marketplace_Block_Adminhtml_Store_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>$this->_getHelper()->__('General')));

        $fieldset->addField('name', 'text', array(
            'label'     => $this->_getHelper()->__('Company name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'name',
            'note' => $this->_getHelper()->__('e.g.: Super Powers Ltd'),
        ));

        $fieldset->addField('url_name', 'text', array(
            'label'     => $this->_getHelper()->__('Url Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'url_name',
            'note' => $this->_getHelper()->__('Name to be displayed at the frontend e.g.: www.mystore.com/store/[url_name]'),
        ));

        $fieldset->addField('email', 'text', array(
            'label'     => $this->_getHelper()->__('Email'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'email',
        ));

        $fieldset->addField('postcode', 'text', array(
            'label'     => $this->_getHelper()->__('Postcode'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'postcode',
            'note' => $this->_getHelper()->__('Used to estimate shipping'),
        ));
        $fieldset->addField('fee', 'text', array(
            'label'     => $this->_getHelper()->__('Fee'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'fee',
            'note' => $this->_getHelper()->__('Fee to be paid on sales e.g: 0.15 to 15%'),
        ));

        $adminUserId = Mage::registry('store_data')->getData('user_id');
        $adminUser = Mage::getModel('admin/user')->load($adminUserId);

        $readOnly = false;
        if ($adminUser->getId()) {
            $readOnly = true;
        }

        $fieldset->addField('username', 'text', array(
            'label'     => $this->_getHelper()->__('User Name'),
            'required'  => true,
            'class'     => 'validate-length',
            'name'      => 'username',
            'note'      => $this->_getHelper()->__('Username to access the admin'),
            'note'      => ($readOnly) ? 'To edit the user data, please go to: System > Permissions > Users' : '',
        ));

        if (!$readOnly) {
            $fieldset->addField('password', 'password', array(
                'label'     => $this->_getHelper()->__('Password'),
                'required'  => true,
                'name'      => 'password',
            ));
        }

        $fieldset->addField('user_id', 'hidden', array(
            'name'      => 'user_id',
        ));

        $fieldset->addField('is_active', 'select', array(
            'label'     => $this->_getHelper()->__('Is active'),
            'title'     => $this->_getHelper()->__('Is active'),
            'name'      => 'is_active',
            'options'   => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray()
        ));

        if ($formData = Mage::registry('store_data')) {
            $formData->setData('username', $adminUser->getUsername());
            $formData->setData('user_id', $adminUser->getId());
            $form->setValues($formData);
        }

        return parent::_prepareForm();
    }

    /**
     * @return Acaldeira_Marketplace_Helper_Data
     */
    private function _getHelper()
    {
        return Mage::helper('acmarketplace');
    }
}
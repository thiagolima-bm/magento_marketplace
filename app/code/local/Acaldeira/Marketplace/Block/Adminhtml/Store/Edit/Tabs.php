<?php
/**
 * Acaldeira_Marketplace
 *
 * @category    Acaldeira
 * @package     Acaldeira_Marketplace
 * @copyright   Copyright (c) 2017 Acaldeira. (http://www.acaldeira.com.br)
 */
class Acaldeira_Marketplace_Block_Adminhtml_Store_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Acaldeira_Marketplace_Block_Adminhtml_Store_Edit_Tabs constructor.
     * @param array $args
     */
    public function __construct(array $args)
    {
        parent::__construct($args);
        $this->setId('store_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Store'));
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => __('Store Info'),
            'title'     => __('Store Info'),
            'content'   => $this->getLayout()->createBlock('acmarketplace/adminhtml_store_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
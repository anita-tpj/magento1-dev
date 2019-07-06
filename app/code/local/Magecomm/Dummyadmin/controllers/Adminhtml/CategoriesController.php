<?php

class Magecomm_Dummyadmin_Adminhtml_CategoriesController extends Mage_Adminhtml_Controller_Action
{
  /*  protected function _initAction() {
        $this->loadLayout()
            ->_setActiveMenu( 'cms/dummyadmin')
            ->_addBreadcrumb (
                Mage::helper('adminhtml') -> __('Categories Manager'),
                Mage::helper('adminhtml') -> __('Category Manager')
            );
        return $this;
    }*/

    public function indexAction() {
        /*$this->_initAction()
            ->renderLayout();*/
        $this->loadLayout();
        $this->_setActiveMenu('cms/dummyadmin');
        $this->_addBreadcrumb (
            Mage::helper('adminhtml') -> __('Categories Manager'),
            Mage::helper('adminhtml') -> __('Category Manager')
        );
        $this->_addContent($this->getLayout()->createBlock('magecomm_dummyadmin/adminhtml_categories'));
        $this->renderLayout();
    }
}

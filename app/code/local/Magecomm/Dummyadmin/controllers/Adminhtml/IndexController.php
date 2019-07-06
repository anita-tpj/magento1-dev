<?php

class Magecomm_Dummyadmin_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {

 /*   public function preDispatch() {
        parent::preDispatch();

        if (!Mage::helper('magecomm_dummyadmin')->isEnabled(Mage::app()->getStore())) {
            $this->setFlag('', 'no-dispatch', true);
            $this->_redirect('noRoute');
        }
    }*/

    public function indexAction() {
        /*$this->loadLayout();
        $this->renderLayout();*/
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('core/template')->setTemplate('magecomm/dummyadmin/dummyadmin.phtml'));
        $this->renderLayout();
    }
}


<?php

class Magecomm_Dummyadmin_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        //Get current layout state
        $this->loadLayout();

        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template', //(core/template)
            'page',
            array('template' => 'magecomm/dummyadmin/page.phtml')
        );

        $this->getLayout()->getBlock('root')->setTemplate('page/1column.phtml');
        $this->getLayout()->getBlock('content')->append($block);
        $this->_initLayoutMessages('core/session');
        $this->renderLayout();
    }
}

<?php

class Magecomm_Dummyadmin_Block_Adminhtml_Categories extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct() {
        $this->_controller = 'adminhtml_categories';
        $this->_blockGroup = 'magecomm_dummyadmin';
        $this->_headerText = Mage::helper('magecomm_dummyadmin')->__('Ctegory Manager');
        $this->_addButonLabel = Mage::helper('magecomm_dummyadmin')->__('Add Category');
        parent::_construct();
    }

}
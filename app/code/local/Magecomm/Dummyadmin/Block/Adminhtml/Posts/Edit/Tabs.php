<?php
class Magecomm_Dummyadmin_Block_Adminhtml_Posts_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct() {
        parent::__construct();
        $this->setId('dummyposts_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('magecomm_dummyadmin')->__('General'));
    }

    protected function _beforeToHtml(){
        try {
            $this->addTab('form_dummyposts', array(
                'label' => Mage::helper('magecomm_dummyadmin')->__('General'),
                'title' => Mage::helper('magecomm_dummyadmin')->__('General'),
            ));
        } catch (Exception $e) {
        }
        return parent::_beforeToHtml();
    }

    public function getDummycategories(){
        return Mage::registry('current_dummyposts');
    }

}
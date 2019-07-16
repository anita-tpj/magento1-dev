<?php

class Magecomm_Dummyadmin_Block_Adminhtml_Posts extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct() {
        $this->_controller = 'adminhtml_posts';
        $this->_blockGroup = 'magecomm_dummyadmin';
        $this->_headerText = Mage::helper('magecomm_dummyadmin')->__('Dummy Posts Manager');
        $this->_addButtonLabel = Mage::helper('magecomm_dummyadmin')->__('Add Dummy Admin Post');
        parent::__construct();
    }

    public function getCreateUrl() {
        return $this->getUrl('*/*/new');
    }

    public function getPostImage($post)
    {
        $image = $post->getPost_image();
        if (isset($image)) {
            return Mage::getBaseUrl('media') . $image;
        } else {
            return false;
        }
    }
}
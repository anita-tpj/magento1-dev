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

    public function post_ViewAction() {
        $url_key = $this->getRequest()->getParam('url_key');

        if($url_key != null && $url_key != ''):
            $post = Mage::helper('magecomm_dummyadmin')->loadPostByUrlKey($url_key);
        else:
            $post = null;
            $cat = null;
        endif;

        if($post->getPost_url()):
            $block = $this->getLayout()->createBlock(
                'Mage_Core_Block_Template', //(core/template)
                'post',
                array('template' => 'magecomm/dummyadmin/post.phtml')
            );

            Mage::register('current_post', $post);
            $this->loadLayout();
            $this->getLayout()->getBlock('head')->setTitle($post->getPost_meta_title());
            //$this->getLayout()->getBlock('head')->setDescription(substr(strips_tags($post->getPost_short_content())));
            $this->getLayout()->getBlock('root')->setTemplate('page/1column.phtml');
            $this->getLayout()->getBlock('content')->append($block);
            $this->renderLayout();
        else:
            $this->_forward('noRoute');
        endif;
    }

    public function category_ViewAction() {
        $url_key = $this->getRequest()->getParam('url_key');

        if($url_key != null && $url_key != ''):
            $category = Mage::helper('magecomm_dummyadmin')->loadCatByUrlKey($url_key);
        else:
            $post = null;
            $cat = null;
        endif;

        if($category->getCategory_url()):
            $block = $this->getLayout()->createBlock(
                'Mage_Core_Block_Template', //(core/template)
                'post',
                array('template' => 'magecomm/dummyadmin/category.phtml')
            );

            Mage::register('current_category', $category);
            $this->loadLayout();
            $this->getLayout()->getBlock('head')->setTitle($category->getCategory_meta_title());
            //$this->getLayout()->getBlock('head')->setDescription(substr(strips_tags($post->getPost_short_content())));
            $this->getLayout()->getBlock('root')->setTemplate('page/1column.phtml');
            $this->getLayout()->getBlock('content')->append($block);
            $this->renderLayout();
        else:
            $this->_forward('noRoute');
        endif;
    }
}

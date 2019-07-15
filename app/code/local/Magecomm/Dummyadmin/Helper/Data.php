<?php

class Magecomm_Dummyadmin_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function isEnabled ($store=0) {

        return Mage::getStoreConfigFlag('dummyadmin/settings/enabled', $store);
    }

    public function getUrlKey() {

        return Mage::getStoreConfig('dummyadmin/settings/router');
    }

    public function getTitle() {

        return Mage::getStoreConfig('dummyadmin/settings/name');

    }

    public function getImage() {
        return Mage::getStoreConfig('dummyadmin/settings/image');
    }

    public function getMetaTitle() {
        return Mage::getStoreConfig('dummyadmin/settings/meta_title');
    }

    public function loadPostByUrlKey($url_key) {
        $post = Mage::getModel('magecomm_dummyadmin/posts')
            ->getCollection()
            ->addFieldToFilter('post_url', $url_key)
            ->getFirstItem()
            ;
        return $post;
    }

    public function loadCatByUrlKey($url_key) {
        $category = Mage::getModel('magecomm_dummyadmin/categories')
            ->getCollection()
            ->addFieldToFilter('category_url', $url_key)
            ->getFirstItem()
        ;
        return $category;
    }

}
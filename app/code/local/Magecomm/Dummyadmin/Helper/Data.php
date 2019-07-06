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

}
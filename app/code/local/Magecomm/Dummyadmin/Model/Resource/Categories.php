<?php

class Magecomm_Dummyadmin_Model_Resource_Categories extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('magecomm_dummyadmin/magecomm_dummyadmin_categories', 'category_id');
    }

}
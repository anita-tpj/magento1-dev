<?php

class Magecomm_Dummyadmin_Model_Resource_Posts extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('magecomm_dummyadmin/magecomm_dummyadmin_posts', 'post_id');
    }

}
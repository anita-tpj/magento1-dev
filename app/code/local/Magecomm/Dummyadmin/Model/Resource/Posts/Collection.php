<?php

class Magecomm_Dummyadmin_Model_Resource_Posts_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('magecomm_dummyadmin/posts');
    }

}
<?php

class Magecomm_Dummyadmin_Model_Recentposts extends Mage_Core_Model_Abstract {

    /**
     * @param $limit
     * @return Zend_Db_Select
     */
    public function _getRecentCollection($limit, $cat_id)
    {
        $recentPostCollectionByCategory = Mage::getModel('magecomm_dummyadmin/posts')->getCollection()
            /*->setOrder('date', Varien_Data_Collection::SORT_ORDER_DESC)*/
            ->addFieldToFilter('post_status', array('eq' => '1'))
            ->addFieldToFilter('category_id', $cat_id)
            ->setCurPage(1)
            ->setPageSize($limit)
        ;

        return $recentPostCollectionByCategory;
    }

}

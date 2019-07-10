<?php
class Magecomm_Dummyadmin_Block_Adminhtml_Posts_Renderer_Post extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row) {

        $image =  $row->getData($this->getColumn()->getIndex());

        if (isset($image)) {
            $value = '<img src="' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).$image . '" width="90" height="90" />';
        } else {
            return false;
        }

        return $value;
    }

}

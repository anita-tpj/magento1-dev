<?php

class Magecomm_Dummyadmin_Block_Adminhtml_Posts_Renderer_Categories extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());

        return Mage::getModel('magecomm_dummyadmin/categories')->load($value)->getCategory_name();

    }

}
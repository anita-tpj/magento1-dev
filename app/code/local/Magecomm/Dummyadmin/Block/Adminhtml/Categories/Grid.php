<?php

class Magecomm_Dummyadmin_Block_Adminhtml_Categories_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function _construct() {

        parent::_construct();

        $this->setId('grid_id');
        $this->setDefaultSort('category_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('magecomm_dummyadmin/categories')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();

    }

    protected function _prepareColumns() {

        try {
            $this->addColumn('category_id',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('ID'),
                    'width'  => '50px',
                    'type' => 'number',
                    'index'  => 'category_id'
                )
            );
            $this->addColumn('title',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('Name'),
                    'index'  => 'category_name'
                )
            );
            $this->addColumn('url',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('URL Key'),
                    'index'  => 'category_url'
                )
            );
            $this->addColumn('image',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('Default Image'),
                    'type'     => 'image',
                    'index'    => 'categroy_image',
                )
            );
        } catch (Exception $e) {
            Mage::logException($e);
        }

        $this->addExportType('*/*/exportCsv', $this->__('CSV'));

        $this->addExportType('*/*/exportExcel', $this->__('Excel XML'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row-> getId()));
    }

    protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('magecomm_dumyadmin')->getResource()->getIdFieldName();
        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');
        // $this->getMassactionBlock()->setUseSelectAll(false);
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('magecomm_dummyadmin')->__('Delete'),
            'url'   => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}

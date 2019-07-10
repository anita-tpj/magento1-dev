<?php

class Magecomm_Dummyadmin_Block_Adminhtml_Posts_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function _construct() {

        parent::_construct();

        $this->setId('grid_id');
        //$this->setDefaultSort('category_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
        //$this->setUseAjax(true);
    }

    protected function _prepareCollection() {

        $collection = Mage::getModel('magecomm_dummyadmin/posts')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();

    }

    protected function _prepareColumns() {

        try {
            $this->addColumn('post_id',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('ID'),
                    'width'  => '50px',
                    'type' => 'number',
                    'index'  => 'post_id'
                )
            );
            $this->addColumn('post_name',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('Name'),
                    'index'  => 'post_name'
                )
            );
            $this->addColumn('post_url',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('URL Key'),
                    'index'  => 'post_url'
                )
            );
            $this->addColumn('post_meta_title',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('Meta Title'),
                    'index'  => 'post_meta_title'
                )
            );
            $this->addColumn('category_id',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('Category'),
                    'index'    => 'category_id',
                    'options'  => $this->getCategoryNames(),
                    //'renderer' => 'Magecomm_Resourcecenter_Block_Posts_Renderer_Categories_Categories'
                )
            );
            $this->addColumn('post_content',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('Content'),
                    'index'  => 'post_content'
                )
            );
            $this->addColumn('post_short_content',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('Short Content'),
                    'index'  => 'post_short_content'
                )
            );
            $this->addColumn('post_image',
                array(
                    'header' => Mage::helper('magecomm_dummyadmin')->__('Image'),
                    'type'     => 'image',
                    'index'    => 'post_image',
                    'width'  => '100',
                    'filter'    => false,
                    'sortable'  => false,
                    //'renderer'  => 'Magecomm_Dummyadmin_Block_Adminhtml_Posts_Renderer_Post'
                )
            );
            $this->addColumn('post_active',
                array(
                    'header'=> $this->__('Enabled'),
                    'index' => 'post_active',
                    'width'  => '50',
                )
            );
        } catch (Exception $e) {
            Mage::logException($e);
        }

//                $this->addExportType('*/*/exportCsv', $this->__('CSV'));

//                $this->addExportType('*/*/exportExcel', $this->__('Excel XML'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row-> getId()));
    }

    protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('magecomm_dummyadmin/posts')->getResource()->getIdFieldName();
        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');
        // $this->getMassactionBlock()->setUseSelectAll(false);
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('magecomm_dummyadmin')->__('Delete'),
            'url'   => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }
}







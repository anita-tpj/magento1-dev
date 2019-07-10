<?php

class Magecomm_Dummyadmin_Block_Adminhtml_Posts_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _getModel(){
        return Mage::registry('current_dummypost');
    }

    protected function _getHelper(){
        return Mage::helper('magecomm_dummyadmin');
    }

    protected function _getModelTitle(){
        return 'DummyAdmin Posts';
    }

    protected function _prepareForm()
    {
        $model  = $this->_getModel();
        $modelTitle = $this->_getModelTitle();
        $form   = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save'),
            'method'    => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->_getHelper()->__("$modelTitle Information"),
            'class'     => 'fieldset-wide',
        ));

        if ($model && $model->getId()) {
            $modelPk = $model->getResource()->getIdFieldName();
            $fieldset->addField($modelPk, 'hidden', array(
                'name' => $modelPk,
            ));
        }

        $fieldset->addField('post_name', 'text', array(
            'name' => 'post_name',
            'label'     => $this->_getHelper()->__('Name'),
            'required'  => true
        ));

        $fieldset->addField('post_url', 'text', array(
            'name' => 'post_url',
            'label'     => $this->_getHelper()->__('URL Key'),
            'required'  => true
        ));

        $fieldset->addField('post_meta_title', 'text', array(
            'name' => 'post_name',
            'label'     => $this->_getHelper()->__('Meta title'),
            'required'  => true
        ));

        $fieldset->addField('post_content', 'text', array(
            'name' => 'post_content',
            'label'     => $this->_getHelper()->__('Content'),
            'required'  => true
        ));

        $fieldset->addField('post_short_content', 'text', array(
            'name' => 'post_short_content',
            'label'     => $this->_getHelper()->__('Short Content'),
            'required'  => true
        ));

        $fieldset->addField('post_image', 'image', array(
            'name' => 'post_image',
            'label'     => $this->_getHelper()->__('Image'),
            'required'  => true,
            'note'      => $this->_getHelper()->__('Image for post.')
        ));

        $fieldset->addField('post_status', 'select', array(
            'name' => 'post_status',
            'label'     => $this->_getHelper()->__('Status'),
            'required'  => true,
            'values' => array(
                1 => 'Enabled',
                2 => 'Disabled'
            )
        ));

//          // custom renderer (optional)
//          $renderer = $this->getLayout()->createBlock('Block implementing Varien_Data_Form_Element_Renderer_Interface');
//          $field->setRenderer($renderer);

//      // New Form type element (extends Varien_Data_Form_Element_Abstract)
//        $fieldset->addType('custom_element','MyCompany_MyModule_Block_Form_Element_Custom');  // you can use "custom_element" as the type now in ::addField([name], [HERE], ...)


        if($model){
            $form->setValues($model->getData());
        }
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}

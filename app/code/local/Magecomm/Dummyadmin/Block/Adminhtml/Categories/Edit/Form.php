<?php

class Magecomm_Dummyadmin_Block_Adminhtml_Categories_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _getModel(){
        return Mage::registry('current_dummycategory');
    }

    protected function _getHelper(){
        return Mage::helper('magecomm_dummyadmin');
    }

    protected function _getModelTitle(){
        return 'DummyAdmin Categories';
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

        $fieldset->addField('category_name', 'text', array(
            'name' => 'category_name',
            'label'     => $this->_getHelper()->__('Name'),
            'required'  => true
        ));

        $fieldset->addField('category_url', 'text', array(
            'name' => 'category_url',
            'label'     => $this->_getHelper()->__('URL Key'),
            'required'  => true
        ));

        $fieldset->addField('category_active', 'select', array(
            'name' => 'category_active',
            'label'     => $this->_getHelper()->__('Is active'),
            'required'  => true,
            'values' => array(
                1 => 'Yes',
                2 => 'No'
            )
        ));

        $fieldset->addField('category_image', 'image', array(
            'name' => 'category_image',
            'label'     => $this->_getHelper()->__('Image'),
            'required'  => true,
            'note'      => $this->_getHelper()->__('Image for category.')
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

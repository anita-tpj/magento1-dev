<?php

class Magecomm_Dummyadmin_Adminhtml_CategoriesController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction() {
        $this->loadLayout();
        $this->_setActiveMenu('cms/magecomm_dummyadmin/manage_categories');
        $this->_addContent($this->getLayout()->createBlock('magecomm_dummyadmin/adminhtml_categories'));
        $this->renderLayout();
    }

    protected function _isAllowed(){
        return true;
    }

    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select DummyAdmin Categories(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('magecomm_dummyadmin/categories')->load($id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('magecomm_dummyadmin')->__('An error occurred while mass deleting items. Please review log and try again.')
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('magecomm_dummyadmin/categories');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->_getSession()->addError(
                    Mage::helper('magecomm_dummyadmin')->__('This DummyAdmin Categories no longer exists.')
                );
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('current_dummycategory', $model);

        $this->loadLayout();
        // $this->_setActiveMenu('menu1/menu2');
        // $this->_addBreadcrumb($this->__('menu1'), $this->__('menu2'), $this->__('Edit menu2'));
        $this->_addContent($this->getLayout()->createBlock('magecomm_dummyadmin/adminhtml_categories_edit'))
            ->_addLeft($this->getLayout()->createBlock('magecomm_dummyadmin/adminhtml_categories_edit_tabs'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        if ($data = $this->getRequest()->getPost()) {

            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('magecomm_dummyadmin/categories');
            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    $this->_getSession()->addError(
                        Mage::helper('magecomm_dummyadmin')->__('This DummyAdmin Categories no longer exists.')
                    );
                    $this->_redirect('*/*/index');
                    return;
                }
            }

            $uploadHelper = Mage::helper('magecomm_dummyadmin/categoriesupload');
            $uploadKeys = ["image"];
            foreach ($uploadKeys as $uploadKey) {
                if (!empty($_FILES[$uploadKey]['name'])) {
                    try {
                        $uploader = new Varien_File_Uploader($uploadKey);
                        $uploader->setAllowRenameFiles(true);
                        $uploader->setFilesDispersion(false);
                        $path = $uploadHelper->getUploadStoragePath();
                        $destFile = $path . $_FILES[$uploadKey]['name'];
                        $filename = $uploader->getNewFileName($destFile);
                        $uploader->save($path, $filename);
                        $data[$uploadKey] = $uploadHelper->getUploadFolder() . '/' . $uploader->getUploadedFileName();
                    } catch (Exception $e) {
                        $this->_getSession()->addError($e->getMessage());
                    }
                } else {
                    if (isset($data[$uploadKey]['delete']) && $data[$uploadKey]['delete'] == 1) {
                        $data[$uploadKey] = '';
                        $uploadHelper->deleteUpload($model->getData($uploadKey));
                    } else {
                        unset($data[$uploadKey]);
                    }
                }
            }

            // save model
            try {
                $model->addData($data);
                $this->_getSession()->setFormData($data);
                $model->save();
                $this->_getSession()->setFormData(false);
                $this->_getSession()->addSuccess(
                    Mage::helper('magecomm_dummyadmin')->__('The DummyAdmin Categories has been saved.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper('magecomm_dummyadmin')->__('Unable to save the DummyAdmin Categories.'));
                $redirectBack = true;
                Mage::logException($e);
            }

            if ($redirectBack) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                // init model and delete
                $model = Mage::getModel('magecomm_dummyadmin/categories');
                $model->load($id);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('magecomm_dummyadmin')->__('Unable to find a DummyAdmin Categories to delete.'));
                }
                $model->delete();
                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('magecomm_dummyadmin')->__('The DummyAdmin Categories has been deleted.')
                );
                // go to grid
                $this->_redirect('*/*/index');
                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('magecomm_dummyadmin')->__('An error occurred while deleting DummyAdmin Categories data. Please review log and try again.')
                );
                Mage::logException($e);
            }
            // redirect to edit form
            $this->_redirect('*/*/edit', array('id' => $id));
            return;
        }
// display error message
        $this->_getSession()->addError(
            Mage::helper('magecomm_dummyadmin')->__('Unable to find a DummyAdmin Categories to delete.')
        );
// go to grid
        $this->_redirect('*/*/index');
    }

    public function tabAction() {
        $id = $this->getRequest()->getParam('id');
        $blockAdd = $this->getLayout()->createBlock('magecomm_dummyadmin/adminhtml_dummycategories_edit')->setId($id);
        $blockGrid = $this->getLayout()->createBlock('magecomm_dummyadmin/adminhtml_categories')->setId($id);
        $this->getResponse()->setBody($blockAdd->toHtml() . $blockGrid->toHtml());
    }
}

<?php
class Magecomm_Dummyadmin_Helper_Categoriesupload extends Mage_Core_Helper_Abstract
{
    const MEDIA_WYSIWYG_DIR = 'wysiwyg';
    const MEDIA_UPLOAD_DIR = 'dummyadmin';
    const UPLOAD_DIR = 'categories';

    public function getUploadStoragePath(){
        $pathDir = Mage::getBaseDir('media') . DS . self::MEDIA_WYSIWYG_DIR . DS . self::MEDIA_UPLOAD_DIR . DS . self::UPLOAD_DIR
            . DS;
        if (!is_dir($pathDir)) {
            mkdir($pathDir, 0755, true);
        }
        return $pathDir;
    }

    public function getFileUrl($file) {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $file->getFile();
    }

    public function getFilePath($file) {
        return $this->getUploadStoragePath($file->getCustomerId()) . $this->_getBaseFilename($file->getFile());
    }

    public function getUploadFolder(){
        return self::MEDIA_WYSIWYG_DIR . "/" . self::MEDIA_UPLOAD_DIR . "/" . self::UPLOAD_DIR;
    }

    public function deleteUpload($upload){
        unlink($this->getUploadStoragePath() . $this->_getBaseFilename($upload));
    }

    private function _getBaseFilename($upload){
        return basename($upload);
    }
}
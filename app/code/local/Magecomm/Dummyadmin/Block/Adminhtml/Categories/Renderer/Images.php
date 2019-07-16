<?php
class Magecomm_Dummyadmin_Block_Adminhtml_Categories_Renderer_Images extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row) {

        $MEDIA_WYSIWYG_DIR = 'wysiwyg';
        $MEDIA_UPLOAD_DIR = 'dummyadmin';
        $CAT_UPLOAD_DIR = 'categories';
        $UPLOAD_DIR = 'resized';

        $image = $row->getData($this->getColumn()->getIndex());

        if (isset($image)) {
            $imageUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $row->getData($this->getColumn()->getIndex());

            // create folder
            if(!file_exists("./media/wysiwyg/dummyadmin/categories/resized"))
                mkdir("./media/wysiwyg/dummyadmin/categories/resized",0777);

            // get image name
            $imageName = substr(strrchr($imageUrl,"/"),1);


            // resized image path (media/catalog/category/resized/IMAGE_NAME)
            $imageResized = Mage::getBaseDir('media').DS.$MEDIA_WYSIWYG_DIR.DS.$MEDIA_UPLOAD_DIR.DS.$CAT_UPLOAD_DIR.DS.$UPLOAD_DIR.DS.$imageName;

            // changing image url into direct path
            $dirImg = Mage::getBaseDir().str_replace("/",DS,strstr($imageUrl,'/media'));

            // if resized image doesn't exist, save the resized image to the resized directory
            if (!file_exists($imageResized)&&file_exists($dirImg)) :
                $imageObj = new Varien_Image($dirImg);
                $imageObj->constrainOnly(TRUE);
                $imageObj->keepAspectRatio(TRUE);
                $imageObj->keepFrame(FALSE);
                $imageObj->resize(90, 90);
                $imageObj->save($imageResized);
            endif;

            $newImageUrl = Mage::getBaseUrl('media').DS.$MEDIA_WYSIWYG_DIR.DS.$MEDIA_UPLOAD_DIR.DS.$CAT_UPLOAD_DIR.DS.$UPLOAD_DIR.DS.$imageName;
            $value = '<img src="' . $newImageUrl  . '" />';
        } else {
            return false;
        }

        return $value;
    }

}
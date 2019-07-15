<?php
class Magecomm_Dummyadmin_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{

    public function initControllerRouters($observer)
    {
        $front = $observer->getEvent()->getFront();
        $front->addRouter('dummyadmin', $this);
    }

    public function match(Zend_Controller_Request_Http $request)
    {
        if (!Mage::isInstalled()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }
        $router = Mage::helper('magecomm_dummyadmin')->getUrlKey();
        $identifier = trim($request->getPathInfo(), '/');

        if(!$router) {
            $router = 'dummyadmin';
        }

        if ($identifier == $router) {
            $request
                ->setModuleName('dummyadmin')
                ->setControllerName('index')
                ->setActionName('index');
            $request->setAlias(
                Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
                $identifier
            );
            return true;
        }
        $identifierExplode = explode('/', $identifier);

        if(!isset($identifierExplode[0]) || $identifierExplode[0] != $router) {
            return false;
        }

        if(isset($identifierExplode[1])) {
            $url_key = $identifierExplode[1];
            $post = Mage::helper('magecomm_dummyadmin')->loadPostByUrlKey($url_key);
            $category = Mage::helper('magecomm_dummyadmin')->loadCatByUrlKey($url_key);


            if ($post->getPost_url()) {
                $request
                    ->setModuleName('dummyadmin')
                    ->setControllerName('index')
                    ->setActionName('post_view')
                    ->setParam('url_key', $url_key);
                $request->setAlias(
                    Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
                    $identifier
                );

                return true;
            }

            if ($category->getCategory_url()) {
                $request
                    ->setModuleName('dummyadmin')
                    ->setControllerName('index')
                    ->setActionName('category_view')
                    ->setParam('url_key', $url_key);
                $request->setAlias(
                    Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
                    $identifier
                );

                return true;
            }
        }
        return false;
    }
}
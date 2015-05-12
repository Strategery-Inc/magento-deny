<?php

/**
 *
 * Strategery-Deny - Magento Extension
 *
 * @copyright Copyright (c) 2015 DwDesigner Inc. (http://www.dwdeveloper.com/)
 * @author Damian A. Pastorini - damian.pastorini@dwdeveloper.com
 *
 */

class Strategery_Deny_Model_Observer
{

    public function requireLogin($observer)
    {
        $session = Mage::getSingleton('core/session');
        $enabled = Mage::getStoreConfig('strategery_deny/general/enabled');
        if ($enabled && !$session->getAccessGranted()) {
            $controllerAction = $observer->getEvent()->getControllerAction();
            /* @var $controllerAction Mage_Core_Controller_Front_Action */
            $requestString = $controllerAction->getRequest()->getRequestString();
            $session->setBeforeAuthUrl($requestString);
            if($requestString != '/frontaccess/login/') {
                $controllerAction->getResponse()->setRedirect(Mage::getUrl('frontaccess/login'));
                $controllerAction->getResponse()->sendResponse();
                exit();
            }
        }
    }

}
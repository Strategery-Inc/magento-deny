<?php

/**
 *
 * Strategery-Deny - Magento Extension
 *
 * @copyright Copyright (c) 2015 Strategery Inc. (http://www.usestrategery.com/)
 * @author Damian A. Pastorini - damian.pastorini@dwdeveloper.com
 *
 */

class Strategery_Deny_LoginController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        if($this->getRequest()->isPost()) {
            $user = Mage::getStoreConfig('strategery_deny/general/user');
            $password = Mage::getStoreConfig('strategery_deny/general/password');
            $postData = $this->getRequest()->getPost();
            $session = Mage::getSingleton('core/session');
            if($user == $postData['user'] && $password == $postData['password']) {
                $session->setAccessGranted(true);
                return $this->_redirectUrl(Mage::getBaseUrl());
            } else {
                $errorMessage = Mage::helper('strategery_deny')->__('Login error.');
                $session->addError($errorMessage);
            }
        }
        $this->loadLayout()->renderLayout();
    }

}

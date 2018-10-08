<?php
class Demidov_CustomApi_Helper_Data extends Mage_Core_Helper_Abstract
{

//    public function isJson($string)
//    {
//        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
//    }
//
//    public function isXml($string)
//    {
//        libxml_use_internal_errors(true);
//        return simplexml_load_string($string) ? true : false;
//    }

    public function getMetaData()
    {
        $metaData = [];
        $metaData['browser'] = Mage::app()->getRequest()->getHeader('User-Agent');
        $metaData['host'] = Mage::app()->getRequest()->getHeader('host');

        $admin_user_session = Mage::getSingleton('admin/session');
        $adminUserId = $admin_user_session->getUser()->getUserId();
        $role_data = Mage::getModel('admin/user')->load($adminUserId)->getRole()->getData();
        $metaData['user_data'] = $role_data;

        $result = Mage::helper('core')->jsonEncode($metaData);

        return $result;
    }

    public function sendMail($name, $description)
    {
        $mailArray = Mage::getConfig()->getNode('global/customapi_mail_settings')->asArray();
        $toEmail = $mailArray['email_recipient'];
        $subject = 'To Custom API Support - From: '.$name;
        $headers = 'From: testwebstore@ukr.net' . "\r\n" .
            'Reply-To: testwebstore@ukr.net' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $res = mail($toEmail, $subject, $description, $headers);
        return $res;

        /*
        $mail = Mage::getModel('core/email')
            ->setToName('ToName')
            ->setToEmail($toEmail)
            ->setBody('Mail Text / Mail Content')
            ->setSubject($description)
            ->setFromEmail('testwebstore@ukr.net')
            ->setFromName($name)
            ->setType('text')
            ->setBodyHTML($description);  // your content or message
        try {
            $mail->send();
        }
        catch (Exception $e) {
            Mage::getSingleton('core/session')->addError('Unable to send.');
        }
        */

        /*
        $mail = new Zend_Mail('utf-8');
        $mail->setFrom('testwebstore@ukr.net', $name);
        $mail->addTo($toEmail, 'Vasya');
        $mail->setSubject('Custom API Support');
        $mail->setBodyText($description); // Or plain: $mail->setBodyText($text)

        try {
            $mail->send();
        }
        catch (Exception $e) {
            Mage::getSingleton('core/session')->addError('Unable to send.');
        }
        */
    }
}
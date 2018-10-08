<?php
/**
 * в него передается HttpRequest после валидации 
 * и он создает на основе этого объекта экземпляр объекта Package.php
 * Вытягивает getUri, парсит ее, получает данные в массив params:
 * version = 1, command = deleteProduct, json или xml в body переделывает в массив.
 */

class Demidov_CustomApi_Model_Input_HttpRequest_PackageFactory
{
    public function create($className, Demidov_CustomApi_Model_Input_HttpRequest $request, $format)
    {
        $arrUri = explode('/', $request->getUri());
        $version = $arrUri[1];
        $command = $arrUri[2] . ucfirst($arrUri[3]);
        $headers = $request->getHeaders();
        $token = $headers['token_bearer'];

        if ($format == 'json') {
            $params = Mage::helper('core')->jsonDecode($request->getBody());
        } else {
            $params = json_decode(json_encode(simplexml_load_string($request->getBody(),"SimpleXMLElement", LIBXML_NOCDATA)),true);
        }

        return new $className($version, $command, $params, $token);
    }
}
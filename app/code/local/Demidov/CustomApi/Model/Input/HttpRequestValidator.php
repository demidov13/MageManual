<?php
/**
 * Проверяет правильность uri запроса, наличие token в header, наличие версии, наличие команды, 
 * формат запроса post, наличие в body json или xml формата.
 * validate()
 * Когда валидатор видит, что (к примеру) запрос передан не через post, он создает экземпляр класса Result 
 * и вызывает у него метод addError().
 * Тот, в свою очередь, создает экземпляр класса Error, проверяет методом hasError(), если ли ошибка в списке,
 * если есть, берет ее и возвращает (Error отдает message строкой).
 * 
 * Проверки всех нюансов http проверяются сразу, формируя общий ответ.
 * 
 * Именно он засовывает Result в фабрику ErrorOutputFactory для получения ответа
 */

class Demidov_CustomApi_Model_Input_HttpRequestValidator
{
    protected $request;

    public function __construct(Demidov_CustomApi_Model_Input_HttpRequest $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        $result = Mage::getModel('CustomApi/Input_HttpRequest_Result_ResultFactory')
            ->create('Demidov_CustomApi_Model_Input_HttpRequest_Result');

        $arrUri = explode('/',trim($this->request->getUri(),'/'));
        if (!preg_match('/^v[0-9]$/', $arrUri[1])) {
            $result->addError('version');
        }
        if (!preg_match('/^[^\d]{1,30}$/', $arrUri[2]) || !preg_match('/^.{1,30}$/', $arrUri[3])) {
            $result->addError('command');
        }

        $headers = $this->request->getHeaders();
        if (!$headers['token']) {
            $result->addError('token');
        }

        if(!Mage::app()->getRequest()->isPost()) {
            $result->addError('post');
        }

        $body = $this->request->getBody();
            if (!$this->isJson($body, $result) && !$this->isXml($body, $result)) {
                $result->addError('format');
            }

            return $result;
    }

    public function isJson($string, Demidov_CustomApi_Model_Input_HttpRequest_Result $result)
    {
        if(is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE)) {
            $result->setFormat('json');
            return true;
        } else {
            return false;
        }
    }

    public function isXml($string, Demidov_CustomApi_Model_Input_HttpRequest_Result $result)
    {
        libxml_use_internal_errors(true);
        if(simplexml_load_string($string) !== false) {
            $result->setFormat('xml');
            return true;
        } else {
            return false;
        }
    }
}
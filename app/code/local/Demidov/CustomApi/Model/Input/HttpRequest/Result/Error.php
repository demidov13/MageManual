<?php

/**
 * объект, в котором хранится список ошибок
 */

class Demidov_CustomApi_Model_Input_HttpRequest_Result_Error
{
    protected $entities = [
        'version' => 'Wrong format version of the API',
        'command' => 'Wrong format of the API command',
        'token_bearer' => 'Token-bearer not found',
        'post' => 'HTTP request method is not POST',
        'format' => 'The data in the HTTP-request body should be in XML or JSON format'
    ];

    public function checkErrors($errors)
    {
        $message = '';
        foreach ($this->entities as $key => $value) {
            foreach ($errors as $error) {
                if ($key == $error) {
                    $message .= ' '.$value.'.';
                }
            }
        }
        return trim($message,' ');
    }
}
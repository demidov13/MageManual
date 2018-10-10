<?php

class Demidov_CustomApi_Model_Command_Processor
{
    protected $handlerName;
    protected $params;
    protected $result;

    public function __construct($handlerName, $params)
    {
        $this->handlerName = $handlerName;
        $this->params = $params;
    }

    public function run()
    {
        $handler = Mage::getModel('CustomApi/ProductApi_Handler_HandlerFactory')
            ->create($this->handlerName, $this->params);

        if ($handler instanceof Demidov_CustomApi_Model_ProductApi_BaseInterface) {
            $this->result = $handler->process();
        }

        return $this->result;
    }
}
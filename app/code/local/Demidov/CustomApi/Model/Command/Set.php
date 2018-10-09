<?php
/**
 * Набор команд, набор definition-ов.
 * 
 */

class Demidov_CustomApi_Model_Command_Set
{
    protected $version;

    public function __construct($version)
    {
        $this->version = $version;
    }

    public function searchCommand($command)
    {
        if (Mage::getConfig()->getNode("global/customapi_config/$this->version/$command")) {
            return Mage::getModel('CustomApi/Command_Definition_DefinitionFactory')
                ->create('Demidov_CustomApi_Model_Command_Definition', $this->version, $command);
        }
        throw new Exception('API command '.$command.' not found');
    }
}
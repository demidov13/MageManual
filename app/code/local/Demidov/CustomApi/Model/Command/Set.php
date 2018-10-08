<?php
/**
 * Набор команд, набор definition-ов.
 * 
 */

class Demidov_CustomApi_Model_Command_Set
{
    protected $version, $commands;

    public function __construct($version, $commands)
    {
        $this->version = $version;
        $this->commands = $commands;
    }

    public function searchCommand($command) {
        return $command;
    }
}
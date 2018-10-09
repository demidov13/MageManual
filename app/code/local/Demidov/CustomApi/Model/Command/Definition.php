<?php
/**
 * В фабрику этого класса попадают сырые данные о командах из конфига.
 * Это обертка над структурой информации о команде, хранящейся в конфиге.
 * getVersion()
 * getCommand()
 * getValidators()
 * getHandler()
 * getProperties()
 */

class Demidov_CustomApi_Model_Command_Definition
{
    protected $version, $command, $validators, $handler, $properties;

    public function __construct($version, $command, $validators, $handler, $properties)
    {
        $this->version = $version;
        $this->command = $command;
        $this->validators = $validators;
        $this->handler = $handler;
        $this->properties = $properties;
    }

    public function getVersion() {
        return $this->version;
    }

    public function getCommand() {
        return $this->command;
    }

    public function getValidators() {
        return $this->validators;
    }

    public function getHandler() {
        return $this->handler;
    }

    public function getProperties() {
        return $this->properties;
    }
}
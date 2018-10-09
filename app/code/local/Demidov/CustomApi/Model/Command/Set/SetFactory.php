<?php
/**
 * Фабрика сета идет в конфиги сама, использует маджентовские методы, чтоб взять оттуда данные,
 * находит нужную ноду, вынимает оттуда инфу, вычитывает каждую команду и использует
 * фабрику DefinitionFactory для того, чтоб создать объект Definition.
 * addDefinition() этот метод добавляет дефинишины в объект Set, формируя тем самым из сета набор
 * дефинишинов.
 */

class Demidov_CustomApi_Model_Command_Set_SetFactory
{
    public function create($className, $version)
    {
        if (Mage::getConfig()->getNode("global/customapi_config/$version")) {
            return new $className($version);
        }
        throw new Exception('API version '.$version.' not found');
    }
}
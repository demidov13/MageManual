<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($this->getTable('CustomApi/error_log'))
    ->addColumn('error_log_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ))
    ->addColumn('error_message', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ))
    ->addColumn('created', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
    ));

$installer->getConnection()->createTable($table);
$installer->endSetup();
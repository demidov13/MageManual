<?php
$installer = $this;
$installer->startSetup();

$installer->addEntityType('complexworld_eavblogpost', array(
    'entity_model'    => 'complexworld/eavblogpost',
    'table'           =>'complexworld/eavblogpost',
));

$installer->createEntityTables(
    $this->getTable('complexworld/eavblogpost')
);

$this->addAttribute('complexworld_eavblogpost', 'title', array(
    'type'              => 'varchar',
    'label'             => 'Title',
    'input'             => 'text',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => true,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));
$this->addAttribute('complexworld_eavblogpost', 'content', array(
    'type'              => 'text',
    'label'             => 'Content',
    'input'             => 'textarea',
));
$this->addAttribute('complexworld_eavblogpost', 'date', array(
    'type'              => 'datetime',
    'label'             => 'Post Date',
    'input'             => 'datetime',
    'required'          => false,
));

$installer->endSetup();

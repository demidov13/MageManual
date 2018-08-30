<?php
$installer = $this;
$installer->startSetup();
$installer->run("
  CREATE TABLE `{$installer->getTable('weblog/blogpost')}` (
    `blogpost_id` int(11) NOT NULL auto_increment,
    `title` text,
    `post` text,
    `date` datetime default NULL,
    `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
    PRIMARY KEY  (`blogpost_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  INSERT INTO `{$installer->getTable('weblog/blogpost')}` VALUES (1,'My New Title','This is a blog post', '2017-09-01 00:00:00','2017-09-02 23:10:00');
");
$installer->endSetup();
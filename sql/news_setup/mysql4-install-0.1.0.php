<?php

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `{$this->getTable('rave_news')}`;
CREATE TABLE `{$this->getTable('rave_news')}` (
  `id` int(11) unsigned NULL auto_increment,
  `category` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `start_date` int(10) unsigned NULL,
  `end_date` int(10) unsigned NULL,
  `time` varchar(255) NOT NULL DEFAULT '',
  `location` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(1500) NOT NULL DEFAULT '',
  `featured` int(1) NOT NULL default 0,
  `image` varchar(200) NULL,
  `video` varchar(500) NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created` int(11) unsigned NULL,
  `modified` int(11) unsigned NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();

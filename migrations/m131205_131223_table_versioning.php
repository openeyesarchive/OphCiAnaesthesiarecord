<?php

class m131205_131223_table_versioning extends CDbMigration
{
	public function up()
	{
		$this->execute("
CREATE TABLE `et_ophcianaesthesiarecord_airway_control_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `lma_size_id` int(10) unsigned NOT NULL,
  `ett_type_id` int(10) unsigned NOT NULL,
  `ett_size_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophcianaesthesiarecord_airway_control_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_airway_control_cui_fk` (`created_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_airway_control_ev_fk` (`event_id`),
  KEY `acv_et_ophcianaesthesiarecord_airway_control_size_fk` (`lma_size_id`),
  KEY `acv_et_ophcianaesthesiarecord_airway_control_ett_type_fk` (`ett_type_id`),
  KEY `acv_et_ophcianaesthesiarecord_airway_control_ett_size_fk` (`ett_size_id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_airway_control_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_airway_control_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_airway_control_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_airway_control_size_fk` FOREIGN KEY (`lma_size_id`) REFERENCES `ophcianaesthesiarecord_lma_size` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_airway_control_ett_type_fk` FOREIGN KEY (`ett_type_id`) REFERENCES `ophcianaesthesiarecord_ett_type` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_airway_control_ett_size_fk` FOREIGN KEY (`ett_size_id`) REFERENCES `ophcianaesthesiarecord_ett_size` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophcianaesthesiarecord_airway_control_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophcianaesthesiarecord_airway_control_version');

		$this->createIndex('et_ophcianaesthesiarecord_airway_control_aid_fk','et_ophcianaesthesiarecord_airway_control_version','id');
		$this->addForeignKey('et_ophcianaesthesiarecord_airway_control_aid_fk','et_ophcianaesthesiarecord_airway_control_version','id','et_ophcianaesthesiarecord_airway_control','id');

		$this->addColumn('et_ophcianaesthesiarecord_airway_control_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophcianaesthesiarecord_airway_control_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophcianaesthesiarecord_airway_control_version','version_id');
		$this->alterColumn('et_ophcianaesthesiarecord_airway_control_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophcianaesthesiarecord_general_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `equipment_checked` tinyint(1) unsigned NOT NULL,
  `anaesthetic_type_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophcianaesthesiarecord_general_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_general_cui_fk` (`created_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_general_ev_fk` (`event_id`),
  KEY `acv_et_ophcianaesthesiarecord_general_at_fk` (`anaesthetic_type_id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_general_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_general_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_general_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_general_at_fk` FOREIGN KEY (`anaesthetic_type_id`) REFERENCES `ophcianaesthesiarecord_anaesthetic_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophcianaesthesiarecord_general_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophcianaesthesiarecord_general_version');

		$this->createIndex('et_ophcianaesthesiarecord_general_aid_fk','et_ophcianaesthesiarecord_general_version','id');
		$this->addForeignKey('et_ophcianaesthesiarecord_general_aid_fk','et_ophcianaesthesiarecord_general_version','id','et_ophcianaesthesiarecord_general','id');

		$this->addColumn('et_ophcianaesthesiarecord_general_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophcianaesthesiarecord_general_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophcianaesthesiarecord_general_version','version_id');
		$this->alterColumn('et_ophcianaesthesiarecord_general_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophcianaesthesiarecord_iv_access_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `side_id` int(10) unsigned DEFAULT NULL,
  `site_id` int(10) unsigned DEFAULT NULL,
  `cannula_size_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophcianaesthesiarecord_anaesthetic_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_anaesthetic_cui_fk` (`created_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_anaesthetic_ev_fk` (`event_id`),
  KEY `acv_et_ophcianaesthesiarecord_anaesthetic_can_fk` (`cannula_size_id`),
  KEY `acv_et_ophcianaesthesiarecord_anaesthetic_sit_fk` (`site_id`),
  KEY `acv_et_ophcianaesthesiarecord_anaesthetic_sid_fk` (`side_id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_anaesthetic_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_anaesthetic_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_anaesthetic_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_anaesthetic_can_fk` FOREIGN KEY (`cannula_size_id`) REFERENCES `ophcianaesthesiarecord_iv_cannula_size` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_anaesthetic_sit_fk` FOREIGN KEY (`site_id`) REFERENCES `ophcianaesthesiarecord_site` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_anaesthetic_sid_fk` FOREIGN KEY (`side_id`) REFERENCES `ophcianaesthesiarecord_side` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophcianaesthesiarecord_iv_access_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophcianaesthesiarecord_iv_access_version');

		$this->createIndex('et_ophcianaesthesiarecord_iv_access_aid_fk','et_ophcianaesthesiarecord_iv_access_version','id');
		$this->addForeignKey('et_ophcianaesthesiarecord_iv_access_aid_fk','et_ophcianaesthesiarecord_iv_access_version','id','et_ophcianaesthesiarecord_iv_access','id');

		$this->addColumn('et_ophcianaesthesiarecord_iv_access_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophcianaesthesiarecord_iv_access_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophcianaesthesiarecord_iv_access_version','version_id');
		$this->alterColumn('et_ophcianaesthesiarecord_iv_access_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophcianaesthesiarecord_local_anaesthetic_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `la_type_id` int(10) unsigned NOT NULL,
  `la_method_id` int(10) unsigned NOT NULL,
  `la_size_id` int(10) unsigned NOT NULL,
  `la_length_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophcianaesthesiarecord_local_anaesthetic_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_local_anaesthetic_cui_fk` (`created_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_local_anaesthetic_ev_fk` (`event_id`),
  KEY `acv_et_ophcianaesthesiarecord_local_anaesthetic_lat_fk` (`la_type_id`),
  KEY `acv_et_ophcianaesthesiarecord_local_anaesthetic_lam_fk` (`la_method_id`),
  KEY `acv_et_ophcianaesthesiarecord_local_anaesthetic_lts_fk` (`la_size_id`),
  KEY `acv_et_ophcianaesthesiarecord_local_anaesthetic_lli_fk` (`la_length_id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_local_anaesthetic_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_local_anaesthetic_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_local_anaesthetic_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_local_anaesthetic_lat_fk` FOREIGN KEY (`la_type_id`) REFERENCES `ophcianaesthesiarecord_la_type` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_local_anaesthetic_lam_fk` FOREIGN KEY (`la_method_id`) REFERENCES `ophcianaesthesiarecord_la_method` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_local_anaesthetic_lts_fk` FOREIGN KEY (`la_size_id`) REFERENCES `ophcianaesthesiarecord_la_size` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_local_anaesthetic_lli_fk` FOREIGN KEY (`la_length_id`) REFERENCES `ophcianaesthesiarecord_la_length` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophcianaesthesiarecord_local_anaesthetic_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophcianaesthesiarecord_local_anaesthetic_version');

		$this->createIndex('et_ophcianaesthesiarecord_local_anaesthetic_aid_fk','et_ophcianaesthesiarecord_local_anaesthetic_version','id');
		$this->addForeignKey('et_ophcianaesthesiarecord_local_anaesthetic_aid_fk','et_ophcianaesthesiarecord_local_anaesthetic_version','id','et_ophcianaesthesiarecord_local_anaesthetic','id');

		$this->addColumn('et_ophcianaesthesiarecord_local_anaesthetic_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophcianaesthesiarecord_local_anaesthetic_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophcianaesthesiarecord_local_anaesthetic_version','version_id');
		$this->alterColumn('et_ophcianaesthesiarecord_local_anaesthetic_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophcianaesthesiarecord_postop_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `transfer_sao2` varchar(32) COLLATE utf8_bin NOT NULL,
  `transfer_hr` varchar(32) COLLATE utf8_bin NOT NULL,
  `transfer_bp` varchar(32) COLLATE utf8_bin NOT NULL,
  `transfer_rr` varchar(32) COLLATE utf8_bin NOT NULL,
  `transfer_temp` varchar(32) COLLATE utf8_bin NOT NULL,
  `comments` text COLLATE utf8_bin,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_et_ophcianaesthesiarecord_postop_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_postop_cui_fk` (`created_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_postop_ev_fk` (`event_id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_postop_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_postop_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_postop_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophcianaesthesiarecord_postop_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophcianaesthesiarecord_postop_version');

		$this->createIndex('et_ophcianaesthesiarecord_postop_aid_fk','et_ophcianaesthesiarecord_postop_version','id');
		$this->addForeignKey('et_ophcianaesthesiarecord_postop_aid_fk','et_ophcianaesthesiarecord_postop_version','id','et_ophcianaesthesiarecord_postop','id');

		$this->addColumn('et_ophcianaesthesiarecord_postop_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophcianaesthesiarecord_postop_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophcianaesthesiarecord_postop_version','version_id');
		$this->alterColumn('et_ophcianaesthesiarecord_postop_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophcianaesthesiarecord_readings_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `anaesthesia_start_time` time NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `anaesthesia_end_time` time NOT NULL,
  `surgery_start_time` time NOT NULL,
  `surgery_end_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `acv_et_ophcianaesthesiarecord_readings_lmui_fk` (`last_modified_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_readings_cui_fk` (`created_user_id`),
  KEY `acv_et_ophcianaesthesiarecord_readings_ev_fk` (`event_id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_readings_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_readings_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `acv_et_ophcianaesthesiarecord_readings_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophcianaesthesiarecord_readings_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophcianaesthesiarecord_readings_version');

		$this->createIndex('et_ophcianaesthesiarecord_readings_aid_fk','et_ophcianaesthesiarecord_readings_version','id');
		$this->addForeignKey('et_ophcianaesthesiarecord_readings_aid_fk','et_ophcianaesthesiarecord_readings_version','id','et_ophcianaesthesiarecord_readings','id');

		$this->addColumn('et_ophcianaesthesiarecord_readings_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophcianaesthesiarecord_readings_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophcianaesthesiarecord_readings_version','version_id');
		$this->alterColumn('et_ophcianaesthesiarecord_readings_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_anaesthetic_type_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(3) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_anaesthetic_type_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_anaesthetic_type_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_anaesthetic_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_anaesthetic_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_anaesthetic_type_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_anaesthetic_type_version');

		$this->createIndex('ophcianaesthesiarecord_anaesthetic_type_aid_fk','ophcianaesthesiarecord_anaesthetic_type_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_anaesthetic_type_aid_fk','ophcianaesthesiarecord_anaesthetic_type_version','id','ophcianaesthesiarecord_anaesthetic_type','id');

		$this->addColumn('ophcianaesthesiarecord_anaesthetic_type_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_anaesthetic_type_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_anaesthetic_type_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_anaesthetic_type_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_drug_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `display_order` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `unit` varchar(16) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_drug_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_drug_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_drug_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_drug_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_drug_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_drug_version');

		$this->createIndex('ophcianaesthesiarecord_drug_aid_fk','ophcianaesthesiarecord_drug_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_drug_aid_fk','ophcianaesthesiarecord_drug_version','id','ophcianaesthesiarecord_drug','id');

		$this->addColumn('ophcianaesthesiarecord_drug_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_drug_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_drug_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_drug_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_drug_dose_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `value` varchar(16) COLLATE utf8_bin NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `offset` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_drug_dose_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_drug_dose_cui_fk` (`created_user_id`),
  KEY `acv_ophcianaesthesiarecord_drug_dose_el_fk` (`element_id`),
  KEY `acv_ophcianaesthesiarecord_drug_dose_ii_fk` (`item_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_drug_dose_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_drug_dose_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcianaesthesiarecord_readings` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_drug_dose_ii_fk` FOREIGN KEY (`item_id`) REFERENCES `ophcianaesthesiarecord_drug` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_drug_dose_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_drug_dose_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_drug_dose_version');

		$this->createIndex('ophcianaesthesiarecord_drug_dose_aid_fk','ophcianaesthesiarecord_drug_dose_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_drug_dose_aid_fk','ophcianaesthesiarecord_drug_dose_version','id','ophcianaesthesiarecord_drug_dose','id');

		$this->addColumn('ophcianaesthesiarecord_drug_dose_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_drug_dose_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_drug_dose_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_drug_dose_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_ett_size_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(32) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_ett_size_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_ett_size_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_ett_size_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_ett_size_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_ett_size_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_ett_size_version');

		$this->createIndex('ophcianaesthesiarecord_ett_size_aid_fk','ophcianaesthesiarecord_ett_size_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_ett_size_aid_fk','ophcianaesthesiarecord_ett_size_version','id','ophcianaesthesiarecord_ett_size','id');

		$this->addColumn('ophcianaesthesiarecord_ett_size_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_ett_size_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_ett_size_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_ett_size_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_ett_type_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_ett_type_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_ett_type_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_ett_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_ett_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_ett_type_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_ett_type_version');

		$this->createIndex('ophcianaesthesiarecord_ett_type_aid_fk','ophcianaesthesiarecord_ett_type_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_ett_type_aid_fk','ophcianaesthesiarecord_ett_type_version','id','ophcianaesthesiarecord_ett_type','id');

		$this->addColumn('ophcianaesthesiarecord_ett_type_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_ett_type_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_ett_type_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_ett_type_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_gas_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `display_order` int(10) unsigned NOT NULL,
  `field_type_id` int(10) unsigned NOT NULL,
  `unit` varchar(16) COLLATE utf8_bin NOT NULL,
  `min` tinyint(1) unsigned DEFAULT NULL,
  `max` tinyint(1) unsigned DEFAULT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_gas_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_gas_cui_fk` (`created_user_id`),
  KEY `acv_ophcianaesthesiarecord_gas_lft_fk` (`field_type_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_gas_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_gas_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_gas_lft_fk` FOREIGN KEY (`field_type_id`) REFERENCES `ophcianaesthesiarecord_gas_field_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_gas_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_gas_version');

		$this->createIndex('ophcianaesthesiarecord_gas_aid_fk','ophcianaesthesiarecord_gas_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_gas_aid_fk','ophcianaesthesiarecord_gas_version','id','ophcianaesthesiarecord_gas','id');

		$this->addColumn('ophcianaesthesiarecord_gas_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_gas_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_gas_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_gas_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_gas_field_type_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `display_order` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_gas_ft_ft_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_gas_ft_ft_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_gas_ft_ft_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_gas_ft_ft_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_gas_field_type_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_gas_field_type_version');

		$this->createIndex('ophcianaesthesiarecord_gas_field_type_aid_fk','ophcianaesthesiarecord_gas_field_type_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_gas_field_type_aid_fk','ophcianaesthesiarecord_gas_field_type_version','id','ophcianaesthesiarecord_gas_field_type','id');

		$this->addColumn('ophcianaesthesiarecord_gas_field_type_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_gas_field_type_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_gas_field_type_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_gas_field_type_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_gas_level_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `value` varchar(64) COLLATE utf8_bin NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `offset` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_gas_level_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_gas_level_cui_fk` (`created_user_id`),
  KEY `acv_ophcianaesthesiarecord_gas_level_el_fk` (`element_id`),
  KEY `acv_ophcianaesthesiarecord_gas_level_gai_fk` (`item_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_gas_level_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_gas_level_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcianaesthesiarecord_readings` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_gas_level_gai_fk` FOREIGN KEY (`item_id`) REFERENCES `ophcianaesthesiarecord_gas` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_gas_level_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_gas_level_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_gas_level_version');

		$this->createIndex('ophcianaesthesiarecord_gas_level_aid_fk','ophcianaesthesiarecord_gas_level_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_gas_level_aid_fk','ophcianaesthesiarecord_gas_level_version','id','ophcianaesthesiarecord_gas_level','id');

		$this->addColumn('ophcianaesthesiarecord_gas_level_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_gas_level_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_gas_level_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_gas_level_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_iv_cannula_size_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(3) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_iv_cannula_size_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_iv_cannula_size_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_iv_cannula_size_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_iv_cannula_size_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_iv_cannula_size_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_iv_cannula_size_version');

		$this->createIndex('ophcianaesthesiarecord_iv_cannula_size_aid_fk','ophcianaesthesiarecord_iv_cannula_size_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_iv_cannula_size_aid_fk','ophcianaesthesiarecord_iv_cannula_size_version','id','ophcianaesthesiarecord_iv_cannula_size','id');

		$this->addColumn('ophcianaesthesiarecord_iv_cannula_size_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_iv_cannula_size_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_iv_cannula_size_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_iv_cannula_size_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_la_length_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(3) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_la_type_length_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_la_type_length_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_type_length_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_type_length_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_la_length_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_la_length_version');

		$this->createIndex('ophcianaesthesiarecord_la_length_aid_fk','ophcianaesthesiarecord_la_length_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_la_length_aid_fk','ophcianaesthesiarecord_la_length_version','id','ophcianaesthesiarecord_la_length','id');

		$this->addColumn('ophcianaesthesiarecord_la_length_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_la_length_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_la_length_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_la_length_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_la_method_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_la_method_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_la_method_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_method_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_method_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_la_method_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_la_method_version');

		$this->createIndex('ophcianaesthesiarecord_la_method_aid_fk','ophcianaesthesiarecord_la_method_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_la_method_aid_fk','ophcianaesthesiarecord_la_method_version','id','ophcianaesthesiarecord_la_method','id');

		$this->addColumn('ophcianaesthesiarecord_la_method_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_la_method_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_la_method_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_la_method_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_la_size_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(3) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_la_size_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_la_size_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_size_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_size_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_la_size_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_la_size_version');

		$this->createIndex('ophcianaesthesiarecord_la_size_aid_fk','ophcianaesthesiarecord_la_size_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_la_size_aid_fk','ophcianaesthesiarecord_la_size_version','id','ophcianaesthesiarecord_la_size','id');

		$this->addColumn('ophcianaesthesiarecord_la_size_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_la_size_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_la_size_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_la_size_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_la_type_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(3) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `default_method_id` int(10) unsigned DEFAULT NULL,
  `default_size_id` int(10) unsigned DEFAULT NULL,
  `default_length_id` int(10) unsigned DEFAULT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_la_type_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_la_type_cui_fk` (`created_user_id`),
  KEY `acv_ophcianaesthesiarecord_la_type_dmi_fk` (`default_method_id`),
  KEY `acv_ophcianaesthesiarecord_la_type_dsi_fk` (`default_size_id`),
  KEY `acv_ophcianaesthesiarecord_la_type_dli_fk` (`default_length_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_type_dmi_fk` FOREIGN KEY (`default_method_id`) REFERENCES `ophcianaesthesiarecord_la_method` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_type_dsi_fk` FOREIGN KEY (`default_size_id`) REFERENCES `ophcianaesthesiarecord_la_size` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_la_type_dli_fk` FOREIGN KEY (`default_length_id`) REFERENCES `ophcianaesthesiarecord_la_length` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_la_type_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_la_type_version');

		$this->createIndex('ophcianaesthesiarecord_la_type_aid_fk','ophcianaesthesiarecord_la_type_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_la_type_aid_fk','ophcianaesthesiarecord_la_type_version','id','ophcianaesthesiarecord_la_type','id');

		$this->addColumn('ophcianaesthesiarecord_la_type_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_la_type_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_la_type_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_la_type_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_lma_size_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(3) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_lma_size_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_lma_size_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_lma_size_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_lma_size_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_lma_size_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_lma_size_version');

		$this->createIndex('ophcianaesthesiarecord_lma_size_aid_fk','ophcianaesthesiarecord_lma_size_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_lma_size_aid_fk','ophcianaesthesiarecord_lma_size_version','id','ophcianaesthesiarecord_lma_size','id');

		$this->addColumn('ophcianaesthesiarecord_lma_size_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_lma_size_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_lma_size_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_lma_size_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_reading_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `value` varchar(16) COLLATE utf8_bin NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `offset` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_reading_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_reading_cui_fk` (`created_user_id`),
  KEY `acv_ophcianaesthesiarecord_reading_el_fk` (`element_id`),
  KEY `acv_ophcianaesthesiarecord_reading_ii_fk` (`item_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcianaesthesiarecord_readings` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_ii_fk` FOREIGN KEY (`item_id`) REFERENCES `ophcianaesthesiarecord_reading_type` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_reading_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_reading_version');

		$this->createIndex('ophcianaesthesiarecord_reading_aid_fk','ophcianaesthesiarecord_reading_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_reading_aid_fk','ophcianaesthesiarecord_reading_version','id','ophcianaesthesiarecord_reading','id');

		$this->addColumn('ophcianaesthesiarecord_reading_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_reading_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_reading_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_reading_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_reading_type_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `display_order` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `unit` varchar(32) COLLATE utf8_bin NOT NULL,
  `validation_regex` varchar(64) COLLATE utf8_bin NOT NULL,
  `validation_message` varchar(64) COLLATE utf8_bin NOT NULL,
  `field_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_reading_type_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_reading_type_cui_fk` (`created_user_id`),
  KEY `acv_ophcianaesthesiarecord_reading_type_fti_fk` (`field_type_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_type_fti_fk` FOREIGN KEY (`field_type_id`) REFERENCES `ophcianaesthesiarecord_reading_type_field_type` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_reading_type_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_reading_type_version');

		$this->createIndex('ophcianaesthesiarecord_reading_type_aid_fk','ophcianaesthesiarecord_reading_type_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_reading_type_aid_fk','ophcianaesthesiarecord_reading_type_version','id','ophcianaesthesiarecord_reading_type','id');

		$this->addColumn('ophcianaesthesiarecord_reading_type_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_reading_type_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_reading_type_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_reading_type_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_reading_type_field_type_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `display_order` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_reading_tft_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_reading_tft_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_tft_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_tft_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_reading_type_field_type_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_reading_type_field_type_version');

		$this->createIndex('ophcianaesthesiarecord_reading_type_field_type_aid_fk','ophcianaesthesiarecord_reading_type_field_type_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_reading_type_field_type_aid_fk','ophcianaesthesiarecord_reading_type_field_type_version','id','ophcianaesthesiarecord_reading_type_field_type','id');

		$this->addColumn('ophcianaesthesiarecord_reading_type_field_type_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_reading_type_field_type_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_reading_type_field_type_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_reading_type_field_type_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_reading_type_field_type_option_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reading_type_id` int(10) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `display_order` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_reading_tfto_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_reading_tfto_cui_fk` (`created_user_id`),
  KEY `acv_ophcianaesthesiarecord_reading_tfto_fti_fk` (`reading_type_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_tfto_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_tfto_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_reading_tfto_fti_fk` FOREIGN KEY (`reading_type_id`) REFERENCES `ophcianaesthesiarecord_reading_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_reading_type_field_type_option_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_reading_type_field_type_option_version');

		$this->createIndex('ophcianaesthesiarecord_reading_type_field_type_option_aid_fk','ophcianaesthesiarecord_reading_type_field_type_option_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_reading_type_field_type_option_aid_fk','ophcianaesthesiarecord_reading_type_field_type_option_version','id','ophcianaesthesiarecord_reading_type_field_type_option','id');

		$this->addColumn('ophcianaesthesiarecord_reading_type_field_type_option_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_reading_type_field_type_option_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_reading_type_field_type_option_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_reading_type_field_type_option_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_side_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(5) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_side_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_side_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_side_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_side_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_side_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_side_version');

		$this->createIndex('ophcianaesthesiarecord_side_aid_fk','ophcianaesthesiarecord_side_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_side_aid_fk','ophcianaesthesiarecord_side_version','id','ophcianaesthesiarecord_side','id');

		$this->addColumn('ophcianaesthesiarecord_side_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_side_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_side_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_side_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophcianaesthesiarecord_site_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(3) COLLATE utf8_bin NOT NULL,
  `display_order` tinyint(1) unsigned NOT NULL,
  `last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `acv_ophcianaesthesiarecord_site_lmui_fk` (`last_modified_user_id`),
  KEY `acv_ophcianaesthesiarecord_site_cui_fk` (`created_user_id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_site_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `acv_ophcianaesthesiarecord_site_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophcianaesthesiarecord_site_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophcianaesthesiarecord_site_version');

		$this->createIndex('ophcianaesthesiarecord_site_aid_fk','ophcianaesthesiarecord_site_version','id');
		$this->addForeignKey('ophcianaesthesiarecord_site_aid_fk','ophcianaesthesiarecord_site_version','id','ophcianaesthesiarecord_site','id');

		$this->addColumn('ophcianaesthesiarecord_site_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophcianaesthesiarecord_site_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophcianaesthesiarecord_site_version','version_id');
		$this->alterColumn('ophcianaesthesiarecord_site_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');
	}

	public function down()
	{
		$this->dropTable('et_ophcianaesthesiarecord_airway_control_version');
		$this->dropTable('et_ophcianaesthesiarecord_general_version');
		$this->dropTable('et_ophcianaesthesiarecord_iv_access_version');
		$this->dropTable('et_ophcianaesthesiarecord_local_anaesthetic_version');
		$this->dropTable('et_ophcianaesthesiarecord_postop_version');
		$this->dropTable('et_ophcianaesthesiarecord_readings_version');
		$this->dropTable('ophcianaesthesiarecord_anaesthetic_type_version');
		$this->dropTable('ophcianaesthesiarecord_drug_version');
		$this->dropTable('ophcianaesthesiarecord_drug_dose_version');
		$this->dropTable('ophcianaesthesiarecord_ett_size_version');
		$this->dropTable('ophcianaesthesiarecord_ett_type_version');
		$this->dropTable('ophcianaesthesiarecord_gas_version');
		$this->dropTable('ophcianaesthesiarecord_gas_field_type_version');
		$this->dropTable('ophcianaesthesiarecord_gas_level_version');
		$this->dropTable('ophcianaesthesiarecord_iv_cannula_size_version');
		$this->dropTable('ophcianaesthesiarecord_la_length_version');
		$this->dropTable('ophcianaesthesiarecord_la_method_version');
		$this->dropTable('ophcianaesthesiarecord_la_size_version');
		$this->dropTable('ophcianaesthesiarecord_la_type_version');
		$this->dropTable('ophcianaesthesiarecord_lma_size_version');
		$this->dropTable('ophcianaesthesiarecord_reading_version');
		$this->dropTable('ophcianaesthesiarecord_reading_type_version');
		$this->dropTable('ophcianaesthesiarecord_reading_type_field_type_version');
		$this->dropTable('ophcianaesthesiarecord_reading_type_field_type_option_version');
		$this->dropTable('ophcianaesthesiarecord_side_version');
		$this->dropTable('ophcianaesthesiarecord_site_version');
	}
}

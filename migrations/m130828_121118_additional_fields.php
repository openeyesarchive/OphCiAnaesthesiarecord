<?php

class m130828_121118_additional_fields extends OEMigration
{
	public function up()
	{
		$event_type = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphCiAnaesthesiarecord"))->queryRow();

		$this->update('element_type',array('display_order'=>40,'default'=>0),"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_Readings'");

		$this->insert('element_type',array('name' => 'General','class_name' => 'Element_OphCiAnaesthesiarecord_General', 'event_type_id' => $event_type['id'], 'display_order' => 10));
		$this->insert('element_type',array('name' => 'IV access','class_name' => 'Element_OphCiAnaesthesiarecord_IV_Access', 'event_type_id' => $event_type['id'], 'display_order' => 20, 'default' => 0));
		$this->insert('element_type',array('name' => 'Airway control','class_name' => 'Element_OphCiAnaesthesiarecord_Airway_Control', 'event_type_id' => $event_type['id'], 'display_order' => 30, 'default' => 0));
		$this->insert('element_type',array('name' => 'Local anaesthetic','class_name' => 'Element_OphCiAnaesthesiarecord_Local_Anaesthetic', 'event_type_id' => $event_type['id'], 'display_order' => 30, 'default' => 0));

		$this->createTable('ophcianaesthesiarecord_anaesthetic_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(3) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_anaesthetic_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_anaesthetic_type_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_anaesthetic_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_anaesthetic_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('et_ophcianaesthesiarecord_general', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'equipment_checked' => 'tinyint(1) unsigned NOT NULL',
				'anaesthetic_type_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcianaesthesiarecord_general_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcianaesthesiarecord_general_cui_fk` (`created_user_id`)',
				'KEY `et_ophcianaesthesiarecord_general_ev_fk` (`event_id`)',
				'KEY `et_ophcianaesthesiarecord_general_at_fk` (`anaesthetic_type_id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_general_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_general_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_general_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_general_at_fk` FOREIGN KEY (`anaesthetic_type_id`) REFERENCES `ophcianaesthesiarecord_anaesthetic_type` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_site', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(3) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_site_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_site_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_site_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_site_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_side', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(5) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_side_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_side_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_side_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_side_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_iv_cannula_size', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value' => 'varchar(3) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_iv_cannula_size_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_iv_cannula_size_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_iv_cannula_size_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_iv_cannula_size_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('et_ophcianaesthesiarecord_iv_access', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'side_id' => 'int(10) unsigned NULL',
				'site_id' => 'int(10) unsigned NULL',
				'cannula_size_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcianaesthesiarecord_anaesthetic_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcianaesthesiarecord_anaesthetic_cui_fk` (`created_user_id`)',
				'KEY `et_ophcianaesthesiarecord_anaesthetic_ev_fk` (`event_id`)',
				'KEY `et_ophcianaesthesiarecord_anaesthetic_can_fk` (`cannula_size_id`)',
				'KEY `et_ophcianaesthesiarecord_anaesthetic_sit_fk` (`site_id`)',
				'KEY `et_ophcianaesthesiarecord_anaesthetic_sid_fk` (`side_id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_anaesthetic_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_anaesthetic_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_anaesthetic_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_anaesthetic_can_fk` FOREIGN KEY (`cannula_size_id`) REFERENCES `ophcianaesthesiarecord_iv_cannula_size` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_anaesthetic_sit_fk` FOREIGN KEY (`site_id`) REFERENCES `ophcianaesthesiarecord_site` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_anaesthetic_sid_fk` FOREIGN KEY (`side_id`) REFERENCES `ophcianaesthesiarecord_side` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_lma_size', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value' => 'varchar(3) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_lma_size_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_lma_size_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_lma_size_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_lma_size_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_ett_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(32) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_ett_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_ett_type_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_ett_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_ett_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_ett_size', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value' => 'varchar(32) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_ett_size_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_ett_size_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_ett_size_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_ett_size_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('et_ophcianaesthesiarecord_airway_control', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'lma_size_id' => 'int(10) unsigned NOT NULL',
				'ett_type_id' => 'int(10) unsigned NOT NULL',
				'ett_size_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcianaesthesiarecord_airway_control_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcianaesthesiarecord_airway_control_cui_fk` (`created_user_id`)',
				'KEY `et_ophcianaesthesiarecord_airway_control_ev_fk` (`event_id`)',
				'KEY `et_ophcianaesthesiarecord_airway_control_size_fk` (`lma_size_id`)',
				'KEY `et_ophcianaesthesiarecord_airway_control_ett_type_fk` (`ett_type_id`)',
				'KEY `et_ophcianaesthesiarecord_airway_control_ett_size_fk` (`ett_size_id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_airway_control_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_airway_control_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_airway_control_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_airway_control_size_fk` FOREIGN KEY (`lma_size_id`) REFERENCES `ophcianaesthesiarecord_lma_size` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_airway_control_ett_type_fk` FOREIGN KEY (`ett_type_id`) REFERENCES `ophcianaesthesiarecord_ett_type` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_airway_control_ett_size_fk` FOREIGN KEY (`ett_size_id`) REFERENCES `ophcianaesthesiarecord_ett_size` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_la_method', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(32) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_la_method_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_la_method_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_method_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_method_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_la_size', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value' => 'varchar(3) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_la_size_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_la_size_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_size_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_size_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_la_length', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value' => 'varchar(3) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_la_type_length_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_la_type_length_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_length_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_length_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_la_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(3) NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'default_method_id' => 'int(10) unsigned NULL',
				'default_size_id' => 'int(10) unsigned NULL',
				'default_length_id' => 'int(10) unsigned NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_la_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_la_type_cui_fk` (`created_user_id`)',
				'KEY `ophcianaesthesiarecord_la_type_dmi_fk` (`default_method_id`)',
				'KEY `ophcianaesthesiarecord_la_type_dsi_fk` (`default_size_id`)',
				'KEY `ophcianaesthesiarecord_la_type_dli_fk` (`default_length_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_dmi_fk` FOREIGN KEY (`default_method_id`) REFERENCES `ophcianaesthesiarecord_la_method` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_dsi_fk` FOREIGN KEY (`default_size_id`) REFERENCES `ophcianaesthesiarecord_la_size` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_dli_fk` FOREIGN KEY (`default_length_id`) REFERENCES `ophcianaesthesiarecord_la_length` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('et_ophcianaesthesiarecord_local_anaesthetic', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'la_type_id' => 'int(10) unsigned NOT NULL',
				'la_method_id' => 'int(10) unsigned NOT NULL',
				'la_size_id' => 'int(10) unsigned NOT NULL',
				'la_length_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcianaesthesiarecord_local_anaesthetic_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcianaesthesiarecord_local_anaesthetic_cui_fk` (`created_user_id`)',
				'KEY `et_ophcianaesthesiarecord_local_anaesthetic_ev_fk` (`event_id`)',
				'KEY `et_ophcianaesthesiarecord_local_anaesthetic_lat_fk` (`la_type_id`)',
				'KEY `et_ophcianaesthesiarecord_local_anaesthetic_lam_fk` (`la_method_id`)',
				'KEY `et_ophcianaesthesiarecord_local_anaesthetic_lts_fk` (`la_size_id`)',
				'KEY `et_ophcianaesthesiarecord_local_anaesthetic_lli_fk` (`la_length_id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_lat_fk` FOREIGN KEY (`la_type_id`) REFERENCES `ophcianaesthesiarecord_la_type` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_lam_fk` FOREIGN KEY (`la_method_id`) REFERENCES `ophcianaesthesiarecord_la_method` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_lts_fk` FOREIGN KEY (`la_size_id`) REFERENCES `ophcianaesthesiarecord_la_size` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_lli_fk` FOREIGN KEY (`la_length_id`) REFERENCES `ophcianaesthesiarecord_la_length` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->initialiseData(dirname(__FILE__));
	}

	public function down()
	{
		$this->dropTable('et_ophcianaesthesiarecord_local_anaesthetic');
		$this->dropTable('et_ophcianaesthesiarecord_airway_control');
		$this->dropTable('et_ophcianaesthesiarecord_iv_access');
		$this->dropTable('et_ophcianaesthesiarecord_general');
		$this->dropTable('ophcianaesthesiarecord_la_type');
		$this->dropTable('ophcianaesthesiarecord_la_length');
		$this->dropTable('ophcianaesthesiarecord_la_size');
		$this->dropTable('ophcianaesthesiarecord_la_method');
		$this->dropTable('ophcianaesthesiarecord_ett_size');
		$this->dropTable('ophcianaesthesiarecord_ett_type');
		$this->dropTable('ophcianaesthesiarecord_lma_size');
		$this->dropTable('ophcianaesthesiarecord_iv_cannula_size');
		$this->dropTable('ophcianaesthesiarecord_side');
		$this->dropTable('ophcianaesthesiarecord_site');
		$this->dropTable('ophcianaesthesiarecord_anaesthetic_type');

		$event_type = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphCiAnaesthesiarecord"))->queryRow();

		$this->update('element_type',array('display_order'=>1,'default'=>1),"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_Readings'");

		$this->delete('element_type',"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_General'");
		$this->delete('element_type',"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_Anaesthetic'");
		$this->delete('element_type',"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_IV_Access'");
		$this->delete('element_type',"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_Airway_Control'");
		$this->delete('element_type',"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_Local_Anaesthetic'");
	}
}

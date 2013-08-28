<?php

class m130828_121118_additional_fields extends CDbMigration
{
	public function up()
	{
		$event_type = Yii::app()->db->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphCiAnaesthesiarecord"))->queryRow();

		$this->update('element_type',array('display_order'=>40),"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_Readings'");

		$this->createTable('ophcianaesthesiarecord_anaesthetic_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(3) COLLATE utf8_bin NOT NULL',
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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_anaesthetic_type',array('id'=>1,'name'=>'LA','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_anaesthetic_type',array('id'=>2,'name'=>'LAS','display_order'=>2));
		$this->insert('ophcianaesthesiarecord_anaesthetic_type',array('id'=>3,'name'=>'GA','display_order'=>3));

		$this->dropColumn('et_ophcianaesthesiarecord_readings','start_time');

		$this->insert('element_type',array('name' => 'General','class_name' => 'Element_OphCiAnaesthesiarecord_General', 'event_type_id' => $event_type['id'], 'display_order' => 10));

		$this->createTable('et_ophcianaesthesiarecord_general', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'equipment_checked' => 'tinyint(1) unsigned NOT NULL',
				'start_time' => 'time NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcianaesthesiarecord_general_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcianaesthesiarecord_general_cui_fk` (`created_user_id`)',
				'KEY `et_ophcianaesthesiarecord_general_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_general_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_general_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_general_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophcianaesthesiarecord_site', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(3) COLLATE utf8_bin NOT NULL',
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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_site',array('id'=>1,'name'=>'DH','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_site',array('id'=>2,'name'=>'ACF','display_order'=>2));

		$this->createTable('ophcianaesthesiarecord_side', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(3) COLLATE utf8_bin NOT NULL',
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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_side',array('id'=>1,'name'=>'Right','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_side',array('id'=>2,'name'=>'Left','display_order'=>2));

		$this->createTable('ophcianaesthesiarecord_iv_cannula_size', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(3) COLLATE utf8_bin NOT NULL',
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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_iv_cannula_size',array('id'=>1,'name'=>'20'));
		$this->insert('ophcianaesthesiarecord_iv_cannula_size',array('id'=>2,'name'=>'22'));
		$this->insert('ophcianaesthesiarecord_iv_cannula_size',array('id'=>3,'name'=>'24'));

		$this->insert('element_type',array('name' => 'IV access','class_name' => 'Element_OphCiAnaesthesiarecord_IV_Access', 'event_type_id' => $event_type['id'], 'display_order' => 20));

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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophcianaesthesiarecord_lma_size', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value' => 'varchar(3) COLLATE utf8_bin NOT NULL',
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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_lma_size',array('id'=>1,'value'=>'1','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_lma_size',array('id'=>2,'value'=>'1.5','display_order'=>2));
		$this->insert('ophcianaesthesiarecord_lma_size',array('id'=>3,'value'=>'2','display_order'=>3));
		$this->insert('ophcianaesthesiarecord_lma_size',array('id'=>4,'value'=>'2.5','display_order'=>4));
		$this->insert('ophcianaesthesiarecord_lma_size',array('id'=>5,'value'=>'3','display_order'=>5));
		$this->insert('ophcianaesthesiarecord_lma_size',array('id'=>6,'value'=>'4','display_order'=>6));
		$this->insert('ophcianaesthesiarecord_lma_size',array('id'=>7,'value'=>'5','display_order'=>7));

		$this->createTable('ophcianaesthesiarecord_ett_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(3) COLLATE utf8_bin NOT NULL',
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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_ett_type',array('id'=>1,'name'=>'Cuffed','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_ett_type',array('id'=>2,'name'=>'Uncuffed','display_order'=>2));

		$this->createTable('ophcianaesthesiarecord_ett_size', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value' => 'varchar(3) COLLATE utf8_bin NOT NULL',
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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>1,'value'=>'3.0','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>2,'value'=>'3.5','display_order'=>2));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>3,'value'=>'4.0','display_order'=>3));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>4,'value'=>'4.5','display_order'=>4));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>5,'value'=>'5.0','display_order'=>5));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>6,'value'=>'5.5','display_order'=>6));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>7,'value'=>'6.0','display_order'=>7));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>8,'value'=>'6.5','display_order'=>8));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>9,'value'=>'7.0','display_order'=>9));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>10,'value'=>'7.5','display_order'=>10));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>11,'value'=>'8.0','display_order'=>11));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>12,'value'=>'8.5','display_order'=>12));
		$this->insert('ophcianaesthesiarecord_ett_size',array('id'=>13,'value'=>'9.0','display_order'=>13));

		$this->insert('element_type',array('name' => 'Airway control','class_name' => 'Element_OphCiAnaesthesiarecord_Airway_Control', 'event_type_id' => $event_type['id'], 'display_order' => 30));

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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophcianaesthesiarecord_la_method', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(3) COLLATE utf8_bin NOT NULL',
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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_la_method',array('id'=>1,'name'=>'Cannula','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_la_method',array('id'=>2,'name'=>'Needle','display_order'=>2));

		$this->createTable('ophcianaesthesiarecord_la_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(3) COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'default_method_id' => 'int(10) unsigned NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_la_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_la_type_cui_fk` (`created_user_id`)',
				'KEY `ophcianaesthesiarecord_la_type_dmi_fk` (`default_method_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_dmi_fk` FOREIGN KEY (`default_method_id`) REFERENCES `ophcianaesthesiarecord_la_method` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_la_type',array('id'=>1,'name'=>'ST','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_la_type',array('id'=>2,'name'=>'PB','display_order'=>2));
		$this->insert('ophcianaesthesiarecord_la_type',array('id'=>3,'name'=>'RB','display_order'=>3));

		$this->createTable('ophcianaesthesiarecord_la_type_size', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'la_type_id' => 'int(10) unsigned NOT NULL',
				'value' => 'varchar(3) COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'default' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_la_type_size_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_la_type_size_cui_fk` (`created_user_id`)',
				'KEY `ophcianaesthesiarecord_la_type_size_lti_fk` (`la_type_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_size_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_size_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_la_type_size_lti_fk` FOREIGN KEY (`la_type_id`) REFERENCES `ophcianaesthesiarecord_la_type` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_la_type_size',array('id'=>1,'la_type_id'=>1,'value'=>'19','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_la_type_size',array('id'=>2,'la_type_id'=>2,'value'=>'23','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_la_type_size',array('id'=>3,'la_type_id'=>2,'value'=>'25','display_order'=>2,'default'=>1));
		$this->insert('ophcianaesthesiarecord_la_type_size',array('id'=>4,'la_type_id'=>3,'value'=>'25','display_order'=>1));

		$this->createTable('ophcianaesthesiarecord_la_length', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'value' => 'varchar(3) COLLATE utf8_bin NOT NULL',
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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcianaesthesiarecord_la_length',array('id'=>1,'value'=>'1.25"','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_la_length',array('id'=>2,'value'=>'1.5"','display_order'=>2));

		$this->insert('element_type',array('name' => 'Local anaesthetic','class_name' => 'Element_OphCiAnaesthesiarecord_Local_Anaesthetic', 'event_type_id' => $event_type['id'], 'display_order' => 30));

		$this->createTable('et_ophcianaesthesiarecord_local_anaesthetic', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'la_type_id' => 'int(10) unsigned NOT NULL',
				'la_method_id' => 'int(10) unsigned NOT NULL',
				'la_type_size_id' => 'int(10) unsigned NOT NULL',
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
				'KEY `et_ophcianaesthesiarecord_local_anaesthetic_lts_fk` (`la_type_size_id`)',
				'KEY `et_ophcianaesthesiarecord_local_anaesthetic_lli_fk` (`la_length_id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_lat_fk` FOREIGN KEY (`la_type_id`) REFERENCES `ophcianaesthesiarecord_la_type` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_lam_fk` FOREIGN KEY (`la_method_id`) REFERENCES `ophcianaesthesiarecord_la_method` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_lts_fk` FOREIGN KEY (`la_type_size_id`) REFERENCES `ophcianaesthesiarecord_la_type_size` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_local_anaesthetic_lli_fk` FOREIGN KEY (`la_length_id`) REFERENCES `ophcianaesthesiarecord_la_length` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		$this->dropTable('et_ophcianaesthesiarecord_local_anaesthetic');
		$this->dropTable('ophcianaesthesiarecord_la_length');
		$this->dropTable('ophcianaesthesiarecord_la_type_size');
		$this->dropTable('ophcianaesthesiarecord_la_type');
		$this->dropTable('ophcianaesthesiarecord_la_method');
		$this->dropTable('et_ophcianaesthesiarecord_airway_control');
		$this->dropTable('ophcianaesthesiarecord_ett_size');
		$this->dropTable('ophcianaesthesiarecord_ett_type');
		$this->dropTable('ophcianaesthesiarecord_lma_size');
		$this->dropTable('et_ophcianaesthesiarecord_iv_access');
		$this->dropTable('ophcianaesthesiarecord_iv_cannula_size');
		$this->dropTable('ophcianaesthesiarecord_side');
		$this->dropTable('ophcianaesthesiarecord_site');
		$this->dropTable('et_ophcianaesthesiarecord_general');
		$this->dropTable('ophcianaesthesiarecord_anaesthetic_type');

		$this->addColumn('et_ophcianaesthesiarecord_readings','start_time','time NOT NULL');

		$event_type = Yii::app()->db->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphCiAnaesthesiarecord"))->queryRow();

		$this->update('element_type',array('display_order'=>1),"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_Readings'");
		$this->delete('element_type',"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_General'");
		$this->delete('element_type',"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_Anaesthetic'");
	}
}

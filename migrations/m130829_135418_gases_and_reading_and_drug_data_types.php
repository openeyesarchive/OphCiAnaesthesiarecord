<?php

class m130829_135418_gases_and_reading_and_drug_data_types extends OEMigration
{
	public function up()
	{
		$this->createTable('ophcianaesthesiarecord_gas_field_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(32) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_gas_ft_ft_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_gas_ft_ft_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_gas_ft_ft_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_gas_ft_ft_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_gas', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'field_type_id' => 'int(10) unsigned NOT NULL',
				'unit' => 'varchar(16) NOT NULL',
				'min' => 'tinyint(1) unsigned NULL',
				'max' => 'tinyint(1) unsigned NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_gas_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_gas_cui_fk` (`created_user_id`)',
				'KEY `ophcianaesthesiarecord_gas_lft_fk` (`field_type_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_gas_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_gas_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_gas_lft_fk` FOREIGN KEY (`field_type_id`) REFERENCES `ophcianaesthesiarecord_gas_field_type` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_gas_level', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'item_id' => 'int(10) unsigned NOT NULL',
				'record_time' => 'time NOT NULL',
				'value' => 'varchar(64) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_gas_level_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_gas_level_cui_fk` (`created_user_id`)',
				'KEY `ophcianaesthesiarecord_gas_level_el_fk` (`element_id`)',
				'KEY `ophcianaesthesiarecord_gas_level_gai_fk` (`item_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_gas_level_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_gas_level_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_gas_level_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcianaesthesiarecord_readings` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_gas_level_gai_fk` FOREIGN KEY (`item_id`) REFERENCES `ophcianaesthesiarecord_gas` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_reading_type_field_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_reading_tft_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_reading_tft_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_tft_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_tft_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophcianaesthesiarecord_reading_type_field_type_option', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'reading_type_id' => 'int(10) unsigned NOT NULL',
				'name' => 'varchar(64) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_reading_tfto_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_reading_tfto_cui_fk` (`created_user_id`)',
				'KEY `ophcianaesthesiarecord_reading_tfto_fti_fk` (`reading_type_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_tfto_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_tfto_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_tfto_fti_fk` FOREIGN KEY (`reading_type_id`) REFERENCES `ophcianaesthesiarecord_reading_type` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->addColumn('ophcianaesthesiarecord_drug','unit','varchar(16) NOT NULL');
		$this->addColumn('ophcianaesthesiarecord_reading_type','unit','varchar(32) NOT NULL');
		$this->addColumn('ophcianaesthesiarecord_reading_type','validation_regex','varchar(64) NOT NULL');
		$this->addColumn('ophcianaesthesiarecord_reading_type','validation_message','varchar(64) NOT NULL');
		$this->addColumn('ophcianaesthesiarecord_reading_type','field_type_id','int(10) unsigned NOT NULL');

		$this->delete('ophcianaesthesiarecord_drug');
		$this->delete('ophcianaesthesiarecord_reading_type_field_type');
		$this->delete('ophcianaesthesiarecord_reading_type_field_type_option');
		$this->delete('ophcianaesthesiarecord_reading_type');

		$this->dropForeignKey('ophcianaesthesiarecord_drug_dose_rt_fk','ophcianaesthesiarecord_drug_dose');
		$this->dropIndex('ophcianaesthesiarecord_drug_dose_rt_fk','ophcianaesthesiarecord_drug_dose');
		$this->renameColumn('ophcianaesthesiarecord_drug_dose','drug_id','item_id');
		$this->createIndex('ophcianaesthesiarecord_drug_dose_ii_fk','ophcianaesthesiarecord_drug_dose','item_id');
		$this->addForeignKey('ophcianaesthesiarecord_drug_dose_ii_fk','ophcianaesthesiarecord_drug_dose','item_id','ophcianaesthesiarecord_drug','id');

		$this->renameColumn('ophcianaesthesiarecord_drug_dose','dose_time','record_time');
		$this->renameColumn('ophcianaesthesiarecord_drug_dose','dose','value');

		$this->dropForeignKey('ophcianaesthesiarecord_reading_rt_fk','ophcianaesthesiarecord_reading');
		$this->dropIndex('ophcianaesthesiarecord_reading_rt_fk','ophcianaesthesiarecord_reading');
		$this->renameColumn('ophcianaesthesiarecord_reading','reading_type_id','item_id');
		$this->createIndex('ophcianaesthesiarecord_reading_ii_fk','ophcianaesthesiarecord_reading','item_id');
		$this->addForeignKey('ophcianaesthesiarecord_reading_ii_fk','ophcianaesthesiarecord_reading','item_id','ophcianaesthesiarecord_reading_type','id');

		$this->renameColumn('ophcianaesthesiarecord_reading','reading_time','record_time');

		$this->addForeignKey('ophcianaesthesiarecord_reading_type_fti_fk','ophcianaesthesiarecord_reading_type','field_type_id','ophcianaesthesiarecord_reading_type_field_type','id');

		$this->initialiseData(dirname(__FILE__));
	}

	public function down()
	{
		$this->dropForeignKey('ophcianaesthesiarecord_drug_dose_ii_fk','ophcianaesthesiarecord_drug_dose');
		$this->dropIndex('ophcianaesthesiarecord_drug_dose_ii_fk','ophcianaesthesiarecord_drug_dose');
		$this->renameColumn('ophcianaesthesiarecord_drug_dose','item_id','drug_id');
		$this->createIndex('ophcianaesthesiarecord_drug_dose_rt_fk','ophcianaesthesiarecord_drug_dose','drug_id');
		$this->addForeignKey('ophcianaesthesiarecord_drug_dose_rt_fk','ophcianaesthesiarecord_drug_dose','drug_id','ophcianaesthesiarecord_drug','id');

		$this->renameColumn('ophcianaesthesiarecord_drug_dose','record_time','dose_time');
		$this->renameColumn('ophcianaesthesiarecord_drug_dose','value','dose');

		$this->renameColumn('ophcianaesthesiarecord_reading','record_time','reading_time');

		$this->dropForeignKey('ophcianaesthesiarecord_reading_ii_fk','ophcianaesthesiarecord_reading');
		$this->dropIndex('ophcianaesthesiarecord_reading_ii_fk','ophcianaesthesiarecord_reading');
		$this->renameColumn('ophcianaesthesiarecord_reading','item_id','reading_type_id');
		$this->createIndex('ophcianaesthesiarecord_reading_rt_fk','ophcianaesthesiarecord_reading','reading_type_id');
		$this->addForeignKey('ophcianaesthesiarecord_reading_rt_fk','ophcianaesthesiarecord_reading','reading_type_id','ophcianaesthesiarecord_reading_type','id');

		$this->dropForeignKey('ophcianaesthesiarecord_reading_type_fti_fk','ophcianaesthesiarecord_reading_type');
		$this->dropIndex('ophcianaesthesiarecord_reading_type_fti_fk','ophcianaesthesiarecord_reading_type');
		$this->dropColumn('ophcianaesthesiarecord_reading_type','field_type_id');
		$this->dropColumn('ophcianaesthesiarecord_reading_type','validation_message');
		$this->dropColumn('ophcianaesthesiarecord_reading_type','validation_regex');
		$this->dropColumn('ophcianaesthesiarecord_reading_type','unit');

		$this->dropColumn('ophcianaesthesiarecord_drug','unit');

		$this->dropTable('ophcianaesthesiarecord_reading_type_field_type_option');
		$this->dropTable('ophcianaesthesiarecord_reading_type_field_type');
		$this->dropTable('ophcianaesthesiarecord_gas_level');
		$this->dropTable('ophcianaesthesiarecord_gas');
		$this->dropTable('ophcianaesthesiarecord_gas_field_type');
	}
}

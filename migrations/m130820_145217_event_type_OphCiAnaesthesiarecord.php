<?php 
class m130820_145217_event_type_OphCiAnaesthesiarecord extends OEMigration
{
	public function up()
	{
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphCiAnaesthesiarecord'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Clinical events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphCiAnaesthesiarecord', 'name' => 'Anaesthesia record','event_group_id' => $group['id']));
		}

		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphCiAnaesthesiarecord'))->queryRow();

		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Readings',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Readings','class_name' => 'Element_OphCiAnaesthesiarecord_Readings', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Readings'))->queryRow();

		$this->createTable('et_ophcianaesthesiarecord_readings', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'start_time' => 'time NOT NULL',
				'comments' => 'text COLLATE utf8_bin DEFAULT \'\'', // Comments
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcianaesthesiarecord_readings_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcianaesthesiarecord_readings_cui_fk` (`created_user_id`)',
				'KEY `et_ophcianaesthesiarecord_readings_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_readings_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_readings_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_readings_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophcianaesthesiarecord_reading_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_reading_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_reading_type_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophcianaesthesiarecord_reading', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'reading_type_id' => 'int(10) unsigned NOT NULL',
				'reading_time' => 'time NOT NULL',
				'value' => 'varchar(16) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_reading_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_reading_cui_fk` (`created_user_id`)',
				'KEY `ophcianaesthesiarecord_reading_rt_fk` (`reading_type_id`)',
				'KEY `ophcianaesthesiarecord_reading_el_fk` (`element_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_rt_fk` FOREIGN KEY (`reading_type_id`) REFERENCES `ophcianaesthesiarecord_reading_type` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_reading_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcianaesthesiarecord_readings` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophcianaesthesiarecord_drug', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_drug_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_drug_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_drug_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_drug_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophcianaesthesiarecord_drug_dose', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'drug_id' => 'int(10) unsigned NOT NULL',
				'dose_time' => 'time NOT NULL',
				'dose' => 'varchar(16) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcianaesthesiarecord_drug_dose_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcianaesthesiarecord_drug_dose_cui_fk` (`created_user_id`)',
				'KEY `ophcianaesthesiarecord_drug_dose_rt_fk` (`drug_id`)',
				'KEY `ophcianaesthesiarecord_drug_dose_el_fk` (`element_id`)',
				'CONSTRAINT `ophcianaesthesiarecord_drug_dose_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_drug_dose_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_drug_dose_rt_fk` FOREIGN KEY (`drug_id`) REFERENCES `ophcianaesthesiarecord_drug` (`id`)',
				'CONSTRAINT `ophcianaesthesiarecord_drug_dose_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcianaesthesiarecord_readings` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->initialiseData(dirname(__FILE__));
	}

	public function down()
	{
		$this->dropTable('ophcianaesthesiarecord_drug_dose');
		$this->dropTable('ophcianaesthesiarecord_drug');
		$this->dropTable('ophcianaesthesiarecord_reading');
		$this->dropTable('ophcianaesthesiarecord_reading_type');
		$this->dropTable('et_ophcianaesthesiarecord_readings');

		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphCiAnaesthesiarecord'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		$this->delete('element_type', 'event_type_id='.$event_type['id']);
		$this->delete('event_type', 'id='.$event_type['id']);
	}
}

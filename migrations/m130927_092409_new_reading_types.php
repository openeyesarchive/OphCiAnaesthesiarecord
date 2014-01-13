<?php

class m130927_092409_new_reading_types extends CDbMigration
{
	public function up()
	{
		$integer = Yii::app()->db->createCommand()->select("*")->from("ophcianaesthesiarecord_reading_type_field_type")->where("name = :name",array(":name"=>"Integer"))->queryRow();

		$this->insert('ophcianaesthesiarecord_reading_type',array('name'=>'PNS','display_order'=>8,'unit'=>'','field_type_id'=>$integer['id']));

		$select = Yii::app()->db->createCommand()->select("*")->from("ophcianaesthesiarecord_reading_type_field_type")->where("name = :name",array(":name"=>"Select"))->queryRow();

		$this->insert('ophcianaesthesiarecord_reading_type',array('name'=>'Position','display_order'=>9,'unit'=>'','field_type_id'=>$select['id']));

		$rt = Yii::app()->db->createCommand()->select("*")->from("ophcianaesthesiarecord_reading_type")->where("name = :name",array(":name"=>"Position"))->queryRow();

		$this->insert('ophcianaesthesiarecord_reading_type_field_type_option',array('reading_type_id'=>$rt['id'],'name'=>'Superior','display_order'=>1));
		$this->insert('ophcianaesthesiarecord_reading_type_field_type_option',array('reading_type_id'=>$rt['id'],'name'=>'Temporal','display_order'=>2));
		$this->insert('ophcianaesthesiarecord_reading_type_field_type_option',array('reading_type_id'=>$rt['id'],'name'=>'Inferior','display_order'=>3));
		$this->insert('ophcianaesthesiarecord_reading_type_field_type_option',array('reading_type_id'=>$rt['id'],'name'=>'Nasal','display_order'=>4));

		$this->renameColumn('et_ophcianaesthesiarecord_readings','start_time','anaesthesia_start_time');
		$this->addColumn('et_ophcianaesthesiarecord_readings','anaesthesia_end_time','time NOT NULL');
		$this->addColumn('et_ophcianaesthesiarecord_readings','surgery_start_time','time NOT NULL');
		$this->addColumn('et_ophcianaesthesiarecord_readings','surgery_end_time','time NOT NULL');

		$event_type = Yii::app()->db->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name"=>"OphCiAnaesthesiarecord"))->queryRow();

		$this->insert('element_type',array('name'=>'Post-op','class_name'=>'Element_OphCiAnaesthesiarecord_PostOp','event_type_id'=>$event_type['id'],'display_order'=>50,'default'=>1));

		$this->dropColumn('et_ophcianaesthesiarecord_readings','comments');

		$this->createTable('et_ophcianaesthesiarecord_postop', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'transfer_sao2' => 'varchar(32) NOT NULL',
				'transfer_hr' => 'varchar(32) NOT NULL',
				'transfer_bp' => 'varchar(32) NOT NULL',
				'transfer_rr' => 'varchar(32) NOT NULL',
				'transfer_temp' => 'varchar(32) NOT NULL',
				'comments' => 'text DEFAULT \'\'',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcianaesthesiarecord_postop_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcianaesthesiarecord_postop_cui_fk` (`created_user_id`)',
				'KEY `et_ophcianaesthesiarecord_postop_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_postop_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_postop_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcianaesthesiarecord_postop_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
	}

	public function down()
	{
		$this->dropTable('et_ophcianaesthesiarecord_postop');

		$this->addColumn('et_ophcianaesthesiarecord_readings','comments','text');

		$event_type = Yii::app()->db->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name"=>"OphCiAnaesthesiarecord"))->queryRow();

		$this->delete('element_type',"event_type_id = {$event_type['id']} and class_name = 'Element_OphCiAnaesthesiarecord_PostOp'");

		$this->dropColumn('et_ophcianaesthesiarecord_readings','surgery_end_time');
		$this->dropColumn('et_ophcianaesthesiarecord_readings','surgery_start_time');
		$this->dropColumn('et_ophcianaesthesiarecord_readings','anaesthesia_end_time');
		$this->renameColumn('et_ophcianaesthesiarecord_readings','anaesthesia_start_time','start_time');

		if ($rt = Yii::app()->db->createCommand()->select("*")->from("ophcianaesthesiarecord_reading_type")->where("name = :name",array(":name"=>"Position"))->queryRow()) {
			$this->delete('ophcianaesthesiarecord_reading_type_field_type_option',"reading_type_id = {$rt['id']}");
		}

		$this->delete('ophcianaesthesiarecord_reading_type',"name = 'PNS'");
		$this->delete('ophcianaesthesiarecord_reading_type',"name = 'Position'");
	}
}

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

		$this->addColumn('et_ophcianaesthesiarecord_readings','transfer_sao2','varchar(32) COLLATE utf8_bin NOT NULL');
		$this->addColumn('et_ophcianaesthesiarecord_readings','transfer_hr','varchar(32) COLLATE utf8_bin NOT NULL');
		$this->addColumn('et_ophcianaesthesiarecord_readings','transfer_bp','varchar(32) COLLATE utf8_bin NOT NULL');
		$this->addColumn('et_ophcianaesthesiarecord_readings','transfer_rr','varchar(32) COLLATE utf8_bin NOT NULL');
		$this->addColumn('et_ophcianaesthesiarecord_readings','transfer_temp','varchar(32) COLLATE utf8_bin NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('et_ophcianaesthesiarecord_readings','transfer_temp');
		$this->dropColumn('et_ophcianaesthesiarecord_readings','transfer_rr');
		$this->dropColumn('et_ophcianaesthesiarecord_readings','transfer_bp');
		$this->dropColumn('et_ophcianaesthesiarecord_readings','transfer_hr');
		$this->dropColumn('et_ophcianaesthesiarecord_readings','transfer_sao2');

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

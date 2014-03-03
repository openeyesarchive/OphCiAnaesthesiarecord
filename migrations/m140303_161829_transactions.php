<?php

class m140303_161829_transactions extends CDbMigration
{
	public $tables = array('et_ophcianaesthesiarecord_airway_control','et_ophcianaesthesiarecord_general','et_ophcianaesthesiarecord_iv_access','et_ophcianaesthesiarecord_local_anaesthetic','et_ophcianaesthesiarecord_postop','et_ophcianaesthesiarecord_readings','ophcianaesthesiarecord_anaesthetic_type','ophcianaesthesiarecord_drug_dose','ophcianaesthesiarecord_drug','ophcianaesthesiarecord_ett_size','ophcianaesthesiarecord_ett_type','ophcianaesthesiarecord_gas_field_type','ophcianaesthesiarecord_gas_level','ophcianaesthesiarecord_gas','ophcianaesthesiarecord_iv_cannula_size','ophcianaesthesiarecord_la_length','ophcianaesthesiarecord_la_method','ophcianaesthesiarecord_la_size','ophcianaesthesiarecord_la_type','ophcianaesthesiarecord_lma_size','ophcianaesthesiarecord_reading_type_field_type_option','ophcianaesthesiarecord_reading_type_field_type','ophcianaesthesiarecord_reading_type','ophcianaesthesiarecord_reading','ophcianaesthesiarecord_side','ophcianaesthesiarecord_site');

	public function up()
	{
		foreach ($this->tables as $table) {
			$this->addColumn($table,'hash','varchar(40) not null');
			$this->addColumn($table,'transaction_id','int(10) unsigned null');
			$this->createIndex($table.'_tid',$table,'transaction_id');
			$this->addForeignKey($table.'_tid',$table,'transaction_id','transaction','id');

			$this->addColumn($table.'_version','hash','varchar(40) not null');
			$this->addColumn($table.'_version','transaction_id','int(10) unsigned null');
			$this->addColumn($table.'_version','deleted_transaction_id','int(10) unsigned null');
			$this->createIndex($table.'_vtid',$table.'_version','transaction_id');
			$this->addForeignKey($table.'_vtid',$table.'_version','transaction_id','transaction','id');
			$this->createIndex($table.'_dtid',$table.'_version','deleted_transaction_id');
			$this->addForeignKey($table.'_dtid',$table.'_version','deleted_transaction_id','transaction','id');
		}
	}

	public function down()
	{
		foreach ($this->tables as $table) {
			$this->dropColumn($table,'hash');
			$this->dropForeignKey($table.'_tid',$table);
			$this->dropIndex($table.'_tid',$table);
			$this->dropColumn($table,'transaction_id');

			$this->dropColumn($table.'_version','hash');
			$this->dropForeignKey($table.'_vtid',$table.'_version');
			$this->dropIndex($table.'_vtid',$table.'_version');
			$this->dropColumn($table.'_version','transaction_id');
			$this->dropForeignKey($table.'_dtid',$table.'_version');
			$this->dropIndex($table.'_dtid',$table.'_version');
			$this->dropColumn($table.'_version','deleted_transaction_id');
		}
	}
}

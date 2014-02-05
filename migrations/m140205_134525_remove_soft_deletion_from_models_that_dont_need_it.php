<?php

class m140205_134525_remove_soft_deletion_from_models_that_dont_need_it extends CDbMigration
{
	public $tables = array(
		'et_ophcianaesthesiarecord_airway_control',
		'et_ophcianaesthesiarecord_general',
		'et_ophcianaesthesiarecord_iv_access',
		'et_ophcianaesthesiarecord_local_anaesthetic',
		'et_ophcianaesthesiarecord_postop',
		'et_ophcianaesthesiarecord_readings',
		'ophcianaesthesiarecord_drug_dose',
		'ophcianaesthesiarecord_gas_level',
		'ophcianaesthesiarecord_reading',
	);

	public function up()
	{
		foreach ($this->tables as $table) {
			$this->dropColumn($table,'deleted');
			$this->dropColumn($table.'_version','deleted');

			$this->dropForeignKey("{$table}_aid_fk",$table."_version");
		}
	}

	public function down()
	{
		foreach ($this->tables as $table) {
			$this->addColumn($table,'deleted','tinyint(1) unsigned not null');
			$this->addColumn($table."_version",'deleted','tinyint(1) unsigned not null');

			$this->addForeignKey("{$table}_aid_fk",$table."_version","id",$table,"id");
		}
	}
}

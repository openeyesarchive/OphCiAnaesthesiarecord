<?php

class m131206_150631_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophcianaesthesiarecord_airway_control','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_airway_control_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_general','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_general_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_iv_access','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_iv_access_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_local_anaesthetic','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_local_anaesthetic_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_postop','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_postop_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_readings','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcianaesthesiarecord_readings_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophcianaesthesiarecord_airway_control','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_airway_control_version','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_general','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_general_version','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_iv_access','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_iv_access_version','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_local_anaesthetic','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_local_anaesthetic_version','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_postop','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_postop_version','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_readings','deleted');
		$this->dropColumn('et_ophcianaesthesiarecord_readings_version','deleted');
	}
}

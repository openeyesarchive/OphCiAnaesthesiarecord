<?php

class m130903_062027_readings_element_changes extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ophcianaesthesiarecord_gas_level','offset','tinyint(1) unsigned NOT NULL');
		$this->dropColumn('ophcianaesthesiarecord_gas_level','record_time');
		$this->dropColumn('ophcianaesthesiarecord_gas_level','display_order');

		$this->addColumn('ophcianaesthesiarecord_drug_dose','offset','tinyint(1) unsigned NOT NULL');
		$this->dropColumn('ophcianaesthesiarecord_drug_dose','record_time');
		$this->dropColumn('ophcianaesthesiarecord_drug_dose','display_order');

		$this->addColumn('ophcianaesthesiarecord_reading','offset','tinyint(1) unsigned NOT NULL');
		$this->dropColumn('ophcianaesthesiarecord_reading','record_time');
		$this->dropColumn('ophcianaesthesiarecord_reading','display_order');
	}

	public function down()
	{
		$this->dropColumn('ophcianaesthesiarecord_gas_level','offset','tinyint(1) unsigned NOT NULL');
		$this->addColumn('ophcianaesthesiarecord_gas_level','record_time','time NOT NULL');
		$this->addColumn('ophcianaesthesiarecord_gas_level','display_order','int(10) unsigned NOT NULL');

		$this->dropColumn('ophcianaesthesiarecord_drug_dose','offset','tinyint(1) unsigned NOT NULL');
		$this->addColumn('ophcianaesthesiarecord_drug_dose','record_time','time NOT NULL');
		$this->addColumn('ophcianaesthesiarecord_drug_dose','display_order','int(10) unsigned NOT NULL');

		$this->dropColumn('ophcianaesthesiarecord_reading','offset','tinyint(1) unsigned NOT NULL');
		$this->addColumn('ophcianaesthesiarecord_reading','record_time','time NOT NULL');
		$this->addColumn('ophcianaesthesiarecord_reading','display_order','int(10) unsigned NOT NULL');
	}
}

<?php

class m131210_144515_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ophcianaesthesiarecord_anaesthetic_type','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_anaesthetic_type_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_drug','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_drug_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_drug_dose','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_drug_dose_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_ett_size','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_ett_size_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_ett_type','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_ett_type_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_gas','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_gas_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_gas_field_type','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_gas_field_type_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_gas_level','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_gas_level_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_iv_cannula_size','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_iv_cannula_size_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_la_length','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_la_length_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_la_method','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_la_method_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_la_size','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_la_size_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_la_type','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_la_type_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_lma_size','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_lma_size_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_reading','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_reading_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_reading_type','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_reading_type_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_reading_type_field_type','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_reading_type_field_type_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_reading_type_field_type_option','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_reading_type_field_type_option_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_side','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_side_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_site','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophcianaesthesiarecord_site_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophcianaesthesiarecord_anaesthetic_type','deleted');
		$this->dropColumn('ophcianaesthesiarecord_anaesthetic_type_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_drug','deleted');
		$this->dropColumn('ophcianaesthesiarecord_drug_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_drug_dose','deleted');
		$this->dropColumn('ophcianaesthesiarecord_drug_dose_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_ett_size','deleted');
		$this->dropColumn('ophcianaesthesiarecord_ett_size_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_ett_type','deleted');
		$this->dropColumn('ophcianaesthesiarecord_ett_type_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_gas','deleted');
		$this->dropColumn('ophcianaesthesiarecord_gas_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_gas_field_type','deleted');
		$this->dropColumn('ophcianaesthesiarecord_gas_field_type_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_gas_level','deleted');
		$this->dropColumn('ophcianaesthesiarecord_gas_level_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_iv_cannula_size','deleted');
		$this->dropColumn('ophcianaesthesiarecord_iv_cannula_size_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_la_length','deleted');
		$this->dropColumn('ophcianaesthesiarecord_la_length_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_la_method','deleted');
		$this->dropColumn('ophcianaesthesiarecord_la_method_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_la_size','deleted');
		$this->dropColumn('ophcianaesthesiarecord_la_size_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_la_type','deleted');
		$this->dropColumn('ophcianaesthesiarecord_la_type_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_lma_size','deleted');
		$this->dropColumn('ophcianaesthesiarecord_lma_size_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_reading','deleted');
		$this->dropColumn('ophcianaesthesiarecord_reading_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_reading_type','deleted');
		$this->dropColumn('ophcianaesthesiarecord_reading_type_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_reading_type_field_type','deleted');
		$this->dropColumn('ophcianaesthesiarecord_reading_type_field_type_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_reading_type_field_type_option','deleted');
		$this->dropColumn('ophcianaesthesiarecord_reading_type_field_type_option_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_side','deleted');
		$this->dropColumn('ophcianaesthesiarecord_side_version','deleted');
		$this->dropColumn('ophcianaesthesiarecord_site','deleted');
		$this->dropColumn('ophcianaesthesiarecord_site_version','deleted');
	}
}

<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>

<div class="reading_row">
	<span class="time">
		<?php echo CHtml::textField("record_time_".$item->display_order,substr($item->record_time,0,5),array('size'=>6))?>
	</span>
	<span class="data_type">
		<?php echo CHtml::dropDownList("data_type_".$item->display_order,strtolower(preg_replace('/^OphCiAnaesthesiarecord_/','',get_class($item))),array('reading' => 'Reading','drug_dose' => 'Drug','gas_level' => 'Gas'))?>
	</span>
	<span class="reading_type"<?php if (get_class($item) != 'OphCiAnaesthesiarecord_Reading') {?> style="display: none;"<?php }?>>
		<?php echo CHtml::dropDownList("reading_type_".$item->display_order,(get_class($item) == 'OphCiAnaesthesiarecord_Reading' ? $item->item_id : ''),CHtml::listData(OphCiAnaesthesiarecord_Reading_Type::model()->findAll(array('order'=>'display_order')),'id','name'),array('empty'=>'- Reading type -','options'=>OphCiAnaesthesiarecord_Reading_Type::model()->getUnitAttributes()))?>
		<label>Reading:</label>
	</span>
	<span class="drug"<?php if (get_class($item) != 'OphCiAnaesthesiarecord_Drug_Dose') {?> style="display: none;"<?php }?>>
		<?php echo CHtml::dropDownList("drug_".$item->display_order,(get_class($item) == 'OphCiAnaesthesiarecord_Drug_Dose' ? $item->item_id : ''),CHtml::listData(OphCiAnaesthesiarecord_Drug::model()->findAll(array('order'=>'display_order')),'id','name'),array('empty'=>'- Drug -','options'=>OphCiAnaesthesiarecord_Drug::model()->getUnitAttributes()))?>
		<label>Dose:</label>
	</span>
	<span class="gas"<?php if (get_class($item) != 'OphCiAnaesthesiarecord_Gas_Level') {?> style="display: none;"<?php }?>>
		<?php echo CHtml::dropDownList("gas_".$item->display_order,(get_class($item) == 'OphCiAnaesthesiarecord_Gas_Level' ? $item->item_id : ''),CHtml::listData(OphCiAnaesthesiarecord_Gas::model()->findAll(array('order'=>'display_order')),'id','name'),array('empty'=>'- Gas -','options'=>OphCiAnaesthesiarecord_Gas::model()->getUnitAttributes()))?>
		<label>Level:</label>
	</span>
	<span class="value">
		<?php if ($item->item && isset($item->item->fieldType) && $item->item->fieldType && $item->item->fieldType->name == 'Select') {?>
			<?php echo CHtml::dropDownList("reading_value_".$item->display_order,$item->value,CHtml::listData(OphCiAnaesthesiarecord_Reading_Type_Field_Type_Option::model()->findAll(array('order'=>'display_order','condition'=>'reading_type_id=:reading_type_id','params'=>array(':reading_type_id'=>$item->item_id))),'name','name'))?>
		<?php }else{?>
			<?php echo CHtml::textField("reading_value_".$item->display_order,$item->value,array('size'=>10))?>
		<?php }?>
		<span class="unit" id="unit_<?php echo $item->display_order?>"><?php echo $item->item ? $item->item->unit : ''?></span>
	</span>
	<span class="remove">
		<a href="#" class="remove_item">remove</a>
	</span>
</div>

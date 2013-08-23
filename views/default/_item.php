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
		<?php echo CHtml::textField("reading_time_".$item->display_order,(get_class($item) == 'OphCiAnaesthesiarecord_Reading' ? substr($item->reading_time,0,5) : substr($item->dose_time,0,5)),array('size'=>6))?>
	</span>
	<span class="data_type">
		<?php echo CHtml::dropDownList("data_type_".$item->display_order,(get_class($item) == 'OphCiAnaesthesiarecord_Reading' ? 'reading' : 'drug'),array('reading' => 'Reading','drug' => 'Drug'))?>
	</span>
	<span class="reading_type"<?php if (get_class($item) == 'OphCiAnaesthesiarecord_Drug_Dose') {?> style="display: none;"<?php }?>>
		<?php echo CHtml::dropDownList("reading_type_".$item->display_order,(get_class($item) == 'OphCiAnaesthesiarecord_Reading' ? $item->reading_type_id : ''),CHtml::listData(OphCiAnaesthesiarecord_Reading_Type::model()->findAll(array('order'=>'display_order')),'id','name'),array('empty'=>'- Reading type -'))?>
		<label>Reading:</label>
	</span>
	<span class="drug"<?php if (get_class($item) == 'OphCiAnaesthesiarecord_Reading') {?> style="display: none;"<?php }?>>
		<?php echo CHtml::dropDownList("drug_".$item->display_order,(get_class($item) == 'OphCiAnaesthesiarecord_Drug' ? $item->drug_id : ''),CHtml::listData(OphCiAnaesthesiarecord_Drug::model()->findAll(array('order'=>'display_order')),'id','name'),array('empty'=>'- Drug -'))?>
		<label>Dose:</label>
	</span>
	<span class="value">
		<?php echo CHtml::textField("reading_value_".$item->display_order,(get_class($item) == 'OphCiAnaesthesiarecord_Reading' ? $item->value : $item->dose),array('size'=>15))?>
	</span>
	<span class="remove">
		<a href="#" class="remove_item">remove</a>
	</span>
</div>

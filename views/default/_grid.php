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

<table class="anaesthesia_grid">
	<tr class="times">
		<?php foreach ($element->getTimeIntervals() as $i => $time) {?>
			<td align="right" style="background: #<?php echo ($mode == 'edit' ? 'dae6f1' : 'fff')?>">
				<span<?php if ($i==0) {?> style="margin-right: -122px"<?php }?>><?php echo $time?></span>
			</td>
		<?php }?>
	</tr>
	<?php foreach (OphCiAnaesthesiarecord_Gas::model()->activeOrPk($element->gasValues)->findAll(array('order'=>'display_order')) as $gas) {
		$lastColour = '#fff';?>
		<tr>
			<th data-attr-min="<?php echo $gas->min?>" data-attr-max="<?php echo $gas->max?>"><?php echo $gas->name?><?php if ($gas->unit) {?> (<?php echo $gas->unit?>)<?php }?></th>
			<?php for ($i=0;$i<$element->intervals;$i++) {
				$value = '';
				if (($gasValue = $this->getGasItem($element,$gas,$i)) && strlen($gasValue['level']) >0) {
					$lastColour = $gasValue['colour'];
					$value = $gasValue['level'];
					?>
					<td style="background: <?php echo $gasValue['colour']?>">
				<?php }else if (!isset($lastColour)) {?>
					<td style="background: #fff">
				<?php }else{?>
					<td style="background: <?php echo $lastColour?>">
				<?php }?>
					<?php if ($mode == 'edit') {?>
						<?php echo CHtml::textField('gas_level_'.$gas->id.'_'.$i,$value,array('size'=>6,'class'=>'gas_level'))?>
					<?php }else{?>
						<?php echo $value?>
					<?php }?>
				</td>
			<?php }?>
		</tr>
	<?php }?>
	<?php foreach (OphCiAnaesthesiarecord_Drug::model()->activeOrPk($element->drugValues)->findAll(array('order'=>'display_order')) as $drug) {?>
		<tr>
			<th><?php echo $drug->name?><?php if ($drug->unit) {?> (<?php echo $drug->unit?>)<?php }?></th>
			<?php for ($i=0;$i<$element->intervals;$i++) {?>
				<td style="background: #fff">
					<?php if ($mode == 'edit') {?>
						<?php echo CHtml::textField('drug_'.$drug->id.'_'.$i,$this->getDrugItem($element,$drug,$i),array('size'=>6))?>
					<?php }else{?>
						<?php echo $this->getDrugItem($element,$drug,$i)?></td>
					<?php }?>
				</td>
			<?php }?>
		</tr>
	<?php }?>
	<?php foreach (OphCiAnaesthesiarecord_Reading_Type::model()->activeOrPk($element->readingTypeValues)->findAll(array('order'=>'display_order')) as $reading_type) {?>
		<tr>
			<th><?php echo $reading_type->name?><?php if ($reading_type->unit) {?> (<?php echo $reading_type->unit?>)<?php }?></th>
			<?php for ($i=0;$i<$element->intervals;$i++) {?>
				<td style="background: #fff">
					<?php if ($mode == 'edit') {?>
						<?php if ($reading_type->fieldType && $reading_type->fieldType->name == 'Select') {?>
							<?php echo CHtml::dropDownList("reading_".$reading_type->id.'_'.$i,$this->getReadingItem($element,$reading_type,$i),CHtml::listData(OphCiAnaesthesiarecord_Reading_Type_Field_Type_Option::model()->notDeletedOrPk($this->getReadingItem($element,$reading_type,$i))->findAll(array('order'=>'display_order','condition'=>'reading_type_id=:reading_type_id','params'=>array(':reading_type_id'=>$reading_type->id))),'name','name'),array('empty'=>''))?>
						<?php }else{?>
							<?php echo CHtml::textField('reading_'.$reading_type->id.'_'.$i,$this->getReadingItem($element,$reading_type,$i),array('size'=>6))?>
						<?php }?>
					<?php }else{?>
						<?php echo $this->getReadingItem($element,$reading_type,$i)?></td>
					<?php }?>
				</td>
			<?php }?>
		</tr>
	<?php }?>
</table>
<?php /*if ($mode == 'view') {?>
	<div class="eyedraw_grid">
		<div class="grid_numbers">
			<?php for ($i=220;$i>=0;$i-=10) {?>
				<div<?php if ($i==220) {?> style="margin-top: 0"<?php }?>><?php echo $i?></div>
			<?php }?>
		</div>
		<?php
		$this->widget('application.modules.eyedraw.OEEyeDrawWidget', array(
			'doodleToolBarArray' => array(
			),
			'onReadyCommandArray' => array(
				array('addDoodle',array('RecordGrid')),
				array('deselectDoodles', array()),
			),
			'idSuffix' => 'Grid',
			'mode' => 'edit',
			'width' => 605,
			'height' => 500,
			'model' => $element,
			'attribute' => 'eyedraw',
			'toolbar' => false,
		))?>
	</div>
<?php }*/?>

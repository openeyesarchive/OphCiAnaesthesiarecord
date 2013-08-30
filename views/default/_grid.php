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
		<?php foreach ($element->getTimeIntervals() as $time) {?>
			<td align="right">
				<span><?php echo $time?></span>
			</td>
		<?php }?>
	</tr>
	<?php foreach (OphCiAnaesthesiarecord_Gas::model()->findAll(array('order'=>'display_order')) as $gas) {?>
		<tr>
			<th><?php echo $gas->name?></th>
			<?php for ($i=0;$i<$element->intervals;$i++) {
				$gasValue = $element->getGasItem($gas->id,$i);
				if ($gasValue) {
					$lastColour = $gasValue['colour'];
					?>
					<td style="background: #<?php echo $gasValue['colour']?>"><?php echo $gasValue['level']?></td>
				<?php }else{?>
					<td style="background: #<?php echo $lastColour?>"></td>
				<?php }?>
			<?php }?>
		</tr>
	<?php }?>
	<?php foreach (OphCiAnaesthesiarecord_Drug::model()->findAll(array('order'=>'display_order')) as $drug) {?>
		<tr>
			<th><?php echo $drug->name?></th>
			<?php for ($i=0;$i<$element->intervals;$i++) {?>
				<td><?php echo $element->getDrugItem($drug->id,$i)?></td>
			<?php }?>
		</tr>
	<?php }?>
	<?php foreach (OphCiAnaesthesiarecord_Reading_Type::model()->findAll(array('order'=>'display_order')) as $reading_type) {?>
		<tr>
			<th><?php echo $reading_type->name?></th>
			<?php for ($i=0;$i<$element->intervals;$i++) {?>
				<td><?php echo $element->getReadingItem($reading_type->id,$i)?></td>
			<?php }?>
		</tr>
	<?php }?>
</table>

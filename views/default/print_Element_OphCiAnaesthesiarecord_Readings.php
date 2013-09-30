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

<h4 class="elementTypeName"><?php echo $element->elementType->name?></h4>

<style type="text/css">
	td { vertical-align: middle; }
</style>

<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td colspan="2" style="background: #fff">
				<?php echo $this->renderPartial('_grid',array('element'=>$element,'mode'=>'view'))?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php echo CHtml::encode($element->getAttributeLabel('anaesthesia_start_time'))?>:
				<span class="big"><?php echo CHtml::encode(substr($element->anaesthesia_start_time,0,5))?></span>
				&nbsp;&nbsp;&nbsp;
				<?php echo CHtml::encode($element->getAttributeLabel('anaesthesia_end_time'))?>:
				<span class="big"><?php echo CHtml::encode(substr($element->anaesthesia_end_time,0,5))?></span>
				&nbsp;&nbsp;&nbsp;
				<?php echo CHtml::encode($element->getAttributeLabel('surgery_start_time'))?>:
				<span class="big"><?php echo CHtml::encode(substr($element->surgery_start_time,0,5))?></span>
				&nbsp;&nbsp;&nbsp;
				<?php echo CHtml::encode($element->getAttributeLabel('surgery_end_time'))?>:
				<span class="big"><?php echo CHtml::encode(substr($element->surgery_end_time,0,5))?></span>
			</td>
		</tr>
	</tbody>
</table>

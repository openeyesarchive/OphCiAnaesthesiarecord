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

<div class="element <?php echo $element->elementType->class_name?>"
	data-element-type-id="<?php echo $element->elementType->id?>"
	data-element-type-class="<?php echo $element->elementType->class_name?>"
	data-element-type-name="<?php echo $element->elementType->name?>"
	data-element-display-order="<?php echo $element->elementType->display_order?>"<?php if (@$ondemand) {?> style="display: none"<?php }?>>
	<h4 class="elementTypeName"><?php echo $element->elementType->name; ?></h4>

	<div id="div_Element_OphCiAnaesthesiarecord_Readings" class="eventDetail">
		<div class="label">Data items:</div>
		<div class="data">
			<div id="items">
				<?php echo $this->renderPartial('_grid',array('element'=>$element,'mode'=>'edit'))?>
			</div>
		</div>
	</div>

	<div id="div_Element_OphCiAnaesthesiarecord_Readings_anaesthesia_start_time" class="eventDetail">
		<div class="label"><?php echo $element->getAttributeLabel('anaesthesia_start_time')?>:</div>
		<div class="data">
			<?php echo $form->textField($element,'anaesthesia_start_time',array('size'=>6,'nowrapper'=>true))?>
			<div class="OphCiAnaesthesiarecord_extra_label">
				<?php echo $element->getAttributeLabel('anaesthesia_end_time')?>:
			</div>
			<?php echo $form->textField($element,'anaesthesia_end_time',array('size'=>6,'nowrapper'=>true))?>
			<div class="OphCiAnaesthesiarecord_extra_label">
				<?php echo $element->getAttributeLabel('surgery_start_time')?>:
			</div>
			<?php echo $form->textField($element,'surgery_start_time',array('size'=>6,'nowrapper'=>true))?>
			<div class="OphCiAnaesthesiarecord_extra_label">
				<?php echo $element->getAttributeLabel('surgery_end_time')?>:
			</div>
			<?php echo $form->textField($element,'surgery_end_time',array('size'=>6,'nowrapper'=>true))?>
		</div>
	</div>
</div>

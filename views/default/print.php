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
<style type="text/css">
	td { font-size: 18px; }
.reading_row { margin-bottom: 10px; }
.reading_row .data_type select { width: 12em; }
.reading_row .reading_type select { width: 12em; }
.reading_row span { margin-left: 10px; }
.reading_row label { display: inline-block; width: 4em; }

.anaesthesia_grid { background: #fff; }
.anaesthesia_grid th { border: 1px solid #000; width: 102px; color: #000 !important; background-color: #ccc; padding: 2px 10px 2px 10px !important; text-align: left; font-size: 11px; vertical-align: middle; }
.anaesthesia_grid td { border: 1px solid #000; width: 4.2em; height: 1em; text-align: center; padding: 2px 10px 2px 10px !important; vertical-align: middle; }
.anaesthesia_grid input { background: #fff; border: none; }

.anaesthesia_grid tr.times td { border: none; font-size: 11px; }
.anaesthesia_grid tr.times span { margin-right: -69px; }

span.unit { margin-left: 0; }

#ed_canvas_edit_Grid { margin-left: 0.5em; }

.eyedraw_grid { margin-top: 2em; }
.grid_numbers { float: left; }
.grid_numbers div { margin-left: 7.5em; margin-top: 0.51em; }

.OphCiAnaesthesiarecord_extra_label { margin-left: 1em; display: inline-block; font-size: 15px; }

</style>

<div>
	<table cellspacing="0" width="1000">
		<tbody>
			<tr>
				<td align="left" width="20%"><?php echo CHtml::image(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('OphMiPatienteducation.assets')).'/img/logo1.jpg'); ?></td>
				<td align="left" width="45%"><h1 style="margin-top:40px;">Anaesthesia record</h1></td>
				<td align="left" width="30%" style="border: 1px solid gray;">
					<p style="padding:3px; margin-left:10px; margin-bottom:0px;">ORBIS# <?php echo $this->patient->hos_num?></p>
					<p style="padding:3px; margin-left:10px; margin-bottom:0px;">Program:</p>
					<p style="padding:3px; margin-left:10px; margin-bottom:0px;">Last Name: <?php echo $this->patient->last_name?></p>
					<p style="padding:3px; margin-left:10px; margin-bottom:0px;">First Name: <?php echo $this->patient->first_name?></p>
					<p style="padding:3px; margin-left:10px; margin-bottom:0px;">Date of Birth: <?php echo $this->patient->NHSDate('dob')?></p>
					<p style="padding:3px; margin-left:10px; margin-bottom:0px;">Procedure Date:</p>
					<p style="padding:3px; margin-left:10px; margin-bottom:0px;">Surgeon:</p>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<?php $this->renderDefaultElements($this->action->id); ?>

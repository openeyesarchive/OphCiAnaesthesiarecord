
/* Module-specific javascript can be placed here */

$(document).ready(function() {
	handleButton($('#et_save'),function() {
	});
	
	handleButton($('#et_cancel'),function(e) {
		if (m = window.location.href.match(/\/update\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/update/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
		}
		e.preventDefault();
	});

	handleButton($('#et_deleteevent'));

	handleButton($('#et_canceldelete'),function(e) {
		if (m = window.location.href.match(/\/delete\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/delete/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
		}
		e.preventDefault();
	});

	$('select.populate_textarea').unbind('change').change(function() {
		if ($(this).val() != '') {
			var cLass = $(this).parent().parent().parent().attr('class').match(/Element.*/);
			var el = $('#'+cLass+'_'+$(this).attr('id'));
			var currentText = el.text();
			var newText = $(this).children('option:selected').text();

			if (currentText.length == 0) {
				el.text(ucfirst(newText));
			} else {
				el.text(currentText+', '+newText);
			}
		}
	});

	$('#add_item').live('click',function(e) {
		e.preventDefault();

		var n = 1;

		$('input[name^="record_time_"]').map(function() {
			var id = parseInt($(this).attr('name').match(/[0-9]+/));
			if (id >= n) {
				n = id+1;
			}
		});

		$.ajax({
			'type': 'GET',
			'url': baseUrl+'/OphCiAnaesthesiarecord/default/addItem?n='+n,
			'success': function(html) {
				$('#items').append(html);
			}
		});
	});

	$('select[name^="data_type_"]').live('change',function(e) {
		var n = $(this).attr('name').match(/[0-9]+/);

		switch ($(this).val()) {
			case 'drug_dose':
				$('select[name="reading_type_'+n+'"]').parent().hide();
				$('select[name="drug_'+n+'"]').parent().show();
				$('select[name="gas_'+n+'"]').parent().hide();
				break;
			case 'reading':
				$('select[name="reading_type_'+n+'"]').parent().show();
				$('select[name="drug_'+n+'"]').parent().hide();
				$('select[name="gas_'+n+'"]').parent().hide();
				break;
			case 'gas_level':
				$('select[name="reading_type_'+n+'"]').parent().hide();
				$('select[name="drug_'+n+'"]').parent().hide();
				$('select[name="gas_'+n+'"]').parent().show();
				break;
		}

		$('#unit_'+n).text('');
	});

	$('select[name^="reading_type_"]').live('change',function(e) {
		var n = $(this).attr('name').match(/[0-9]+/);
		if ($(this).val() == '') {
			$('#unit_'+n).text('');
		} else {
			$('#unit_'+n).text($(this).children('option:selected').attr('data-attr-unit'));
		}

		var val = $(this).val();

		$.ajax({
			'type': 'GET',
			'url': baseUrl+'/OphCiAnaesthesiarecord/default/getReadingFieldHTML?reading_type_id='+val+'&n='+n,
			'success': function(html) {
				$('#reading_value_'+n).replaceWith(html);
			}
		});
	});

	$('select[name^="drug_"]').live('change',function(e) {
		var n = $(this).attr('id').match(/[0-9]+/);
		if ($(this).val() == '') {
			$('#unit_'+n).text('');
		} else {
			$('#unit_'+n).text($(this).children('option:selected').attr('data-attr-unit'));
		}
	});

	$('select[name^="gas_"]').live('change',function(e) {
		var n = $(this).attr('id').match(/[0-9]+/);
		if ($(this).val() == '') {
			$('#unit_'+n).text('');
		} else {
			$('#unit_'+n).text($(this).children('option:selected').attr('data-attr-unit'));
		}
	});

	$('.remove_item').live('click',function(e) {
		e.preventDefault();

		$(this).parent().parent().remove();
	});

	$('input[type="checkbox"][name="Element_OphCiAnaesthesiarecord_General[equipment_checked]"]').click(function(e) {
		$('#div_Element_OphCiAnaesthesiarecord_General_start_time').slideToggle(100);
		$('#Element_OphCiAnaesthesiarecord_General_anaesthetic_type_id').slideToggle(100);

		if ($(this).is(':checked')) {
			$.ajax({
				'type': 'GET',
				'url': baseUrl+'/OphCiAnaesthesiarecord/default/loadElementByClassName?class_name=Element_OphCiAnaesthesiarecord_Readings',
				'success': function(html) {
					$('div.Element_OphCiAnaesthesiarecord_General').after(html);
					$('div.Element_OphCiAnaesthesiarecord_Readings').slideToggle(100);
				}
			});
		} else {
			$('div.Element_OphCiAnaesthesiarecord_Readings').slideToggle(100,function() {
				$('div.Element_OphCiAnaesthesiarecord_Readings').remove();
			});
			$('div.Element_OphCiAnaesthesiarecord_Local_Anaesthetic').slideToggle(100,function() {
				$('div.Element_OphCiAnaesthesiarecord_Local_Anaesthetic').remove();
			});
			$('div.Element_OphCiAnaesthesiarecord_IV_Access').slideToggle(100,function() {
				$('div.Element_OphCiAnaesthesiarecord_IV_Access').remove();
			});
			$('div.Element_OphCiAnaesthesiarecord_Airway_Control').slideToggle(100,function() {
				$('div.Element_OphCiAnaesthesiarecord_Airway_Control').remove();
			});
			$('input[name="Element_OphCiAnaesthesiarecord_General[anaesthetic_type_id]"]:checked').removeAttr('checked');
		}
	});

	$('input[name="Element_OphCiAnaesthesiarecord_General[anaesthetic_type_id]"]').click(function(e) {
		switch ($(this).next('label').text()) {
			case 'LA':
			case 'LAS':
				$('div.Element_OphCiAnaesthesiarecord_Airway_Control').slideToggle(100,function() {
					$('div.Element_OphCiAnaesthesiarecord_Airway_Control').remove();
				});
				$('div.Element_OphCiAnaesthesiarecord_IV_Access').slideToggle(100,function() {
					$('div.Element_OphCiAnaesthesiarecord_IV_Access').remove();
				});

				if ($('div.Element_OphCiAnaesthesiarecord_Local_Anaesthetic').length <1) {
					$.ajax({
						'type': 'GET',
						'url': baseUrl+'/OphCiAnaesthesiarecord/default/loadElementByClassName?class_name=Element_OphCiAnaesthesiarecord_Local_Anaesthetic',
						'success': function(html) {
							$('div.Element_OphCiAnaesthesiarecord_Readings').before(html);
							$('div.Element_OphCiAnaesthesiarecord_Local_Anaesthetic').slideToggle(100);
						}
					});
				}
				break;
			case 'GA':
				$('div.Element_OphCiAnaesthesiarecord_Local_Anaesthetic').slideToggle(100,function() {
					$('div.Element_OphCiAnaesthesiarecord_Local_Anaesthetic').remove();
				});

				if ($('div.Element_OphCiAnaesthesiarecord_IV_Access').length <1) {
					$.ajax({
						'type': 'GET',
						'url': baseUrl+'/OphCiAnaesthesiarecord/default/loadElementByClassName?class_name=Element_OphCiAnaesthesiarecord_Airway_Control',
						'success': function(html) {
							$('div.Element_OphCiAnaesthesiarecord_Readings').before(html);
							$('div.Element_OphCiAnaesthesiarecord_Airway_Control').slideToggle(100);

							$.ajax({
								'type': 'GET',
								'url': baseUrl+'/OphCiAnaesthesiarecord/default/loadElementByClassName?class_name=Element_OphCiAnaesthesiarecord_IV_Access',
								'success': function(html) {
									$('div.Element_OphCiAnaesthesiarecord_Airway_Control').before(html);
									$('div.Element_OphCiAnaesthesiarecord_IV_Access').slideToggle(100);
								}
							});
						}
					});
				}
		}
	});

	$('input[name="Element_OphCiAnaesthesiarecord_Local_Anaesthetic[la_type_id]"]').live('click',function(e) {
		$('input[name="Element_OphCiAnaesthesiarecord_Local_Anaesthetic[la_method_id]"][value="'+OphCiAnaesthesiarecord_la_defaults[$(this).next('label').text()]['default_method_id']+'"]').attr('checked','checked');
		$('input[name="Element_OphCiAnaesthesiarecord_Local_Anaesthetic[la_size_id]"][value="'+OphCiAnaesthesiarecord_la_defaults[$(this).next('label').text()]['default_size_id']+'"]').attr('checked','checked');
		$('input[name="Element_OphCiAnaesthesiarecord_Local_Anaesthetic[la_length_id]"][value="'+OphCiAnaesthesiarecord_la_defaults[$(this).next('label').text()]['default_length_id']+'"]').attr('checked','checked');
	});

	$('#add_all_readings').live('click',function(e) {
		e.preventDefault();

		var n = 1;

		$('input[name^="record_time_"]').map(function() {
			var id = parseInt($(this).attr('name').match(/[0-9]+/));
			if (id >= n) {
				n = id+1;
			}
		});

		$.ajax({
			'type': 'GET',
			'url': baseUrl+'/OphCiAnaesthesiarecord/default/addAllReadings?n='+n,
			'success': function(html) {
				$('#items').append(html);
			}
		});
	});

	$('#add_all_gases').live('click',function(e) {
		e.preventDefault();

		var n = 1;

		$('input[name^="record_time_"]').map(function() {
			var id = parseInt($(this).attr('name').match(/[0-9]+/));
			if (id >= n) {
				n = id+1;
			}
		});

		$.ajax({
			'type': 'GET',
			'url': baseUrl+'/OphCiAnaesthesiarecord/default/addAllGases?n='+n,
			'success': function(html) {
				$('#items').append(html);
			}
		});
	});
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}

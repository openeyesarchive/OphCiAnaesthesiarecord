<?php

class DefaultController extends BaseEventTypeController
{
	public function actionCreate()
	{
		$this->setLADefaults();

		parent::actionCreate();
	}

	public function actionUpdate($id)
	{
		$this->setLADefaults();

		parent::actionUpdate($id);
	}

	public function setLADefaults()
	{
		$this->jsVars['OphCiAnaesthesiarecord_la_defaults'] = array();

		foreach (OphCiAnaesthesiarecord_LA_Type::model()->findAll() as $type) {
			$this->jsVars['OphCiAnaesthesiarecord_la_defaults'][$type->name] = array( 
				'default_method_id' => $type->default_method_id,
				'default_size_id' => $type->default_size_id,
				'default_length_id' => $type->default_length_id,
			);
		}
	}

	public function actionView($id)
	{
		parent::actionView($id);
	}

	public function actionPrint($id)
	{
		parent::actionPrint($id);
	}

	public function actionAddItem()
	{
		$reading = new OphCiAnaesthesiarecord_Reading;
		$reading->display_order = @$_GET['n'];
		$reading->record_time = date('H:i');

		$this->renderPartial('_item',array('item'=>$reading));
	}

	public function actionAddAllReadings()
	{
		foreach (OphCiAnaesthesiarecord_Reading_Type::model()->findAll(array('order'=>'display_order')) as $i => $type) {
			$reading = new OphCiAnaesthesiarecord_Reading;
			$reading->item_id = $type->id;
			$reading->display_order = (int)@$_GET['n'] + $i;
			$reading->record_time = date('H:i');

			$this->renderPartial('_item',array('item'=>$reading));
		}
	}

	public function actionAddAllGases()
	{
		foreach (OphCiAnaesthesiarecord_Gas::model()->findAll(array('order'=>'display_order')) as $i => $type) {
			$gas_level = new OphCiAnaesthesiarecord_Gas_Level;
			$gas_level->item_id = $type->id;
			$gas_level->display_order = (int)@$_GET['n'] + $i;
			$gas_level->record_time = date('H:i');

			$this->renderPartial('_item',array('item'=>$gas_level));
		}
	}

	public function getItems($element) {
		$items = array();

		if (!empty($_POST)) {
			$i = 1;

			foreach ($_POST as $key => $value) {
				if (preg_match('/^record_time_([0-9]+)$/',$key,$m)) {
					switch ($_POST['data_type_'.$m[1]]) {
						case 'reading':
							$item = new OphCiAnaesthesiarecord_Reading;
							$item->item_id = $_POST['reading_type_'.$m[1]];
							break;
						case 'drug_dose':
							$item = new OphCiAnaesthesiarecord_Drug_Dose;
							$item->item_id = $_POST['drug_'.$m[1]];
							break;
						case 'gas_level':
							$item = new OphCiAnaesthesiarecord_Gas_Level;
							$item->item_id = $_POST['gas_'.$m[1]];
							break;
					}

					$item->record_time = $_POST['record_time_'.$m[1]];
					$item->value = $_POST['reading_value_'.$m[1]];
					$item->display_order = $i++;

					$items[] = $item;
				}
			}
		} else if ($element->id) {
			$items = $element->items;
		}

		return $items;
	}

	/*
	 * Validate element related models
	 */
	protected function validatePOSTElements($elements)
	{
		$errors = parent::validatePOSTElements($elements);

		foreach ($elements as $element) {
			if ($element->getElementType()->class_name == 'Element_OphCiAnaesthesiarecord_Readings') {
				foreach ($this->getItems(null) as $item) {
					if (!$item->validate()) {
						switch (get_class($item)) {
							case 'OphCiAnaesthesiarecord_Reading':
								$typeName = 'Reading'; break;
							case 'OphCiAnaesthesiarecord_Drug_Dose':
								$typeName = 'Drug dose'; break;
							case 'OphCiAnaesthesiarecord_Gas_Level':
								$typeName = 'Gas level'; break;
						}
						foreach ($item->getErrors() as $errormsgs) {
							foreach ($errormsgs as $error) {
								if ($item->item) {
									$errors[$typeName][] = "{$item->item->name}: $error";
								} else {
									$errors[$typeName][] = $error;
								}
							}
						}
					}
				}
			}
		}

		return $errors;
	}

	/*
	 * Process related items on event creation
	 */
	public function createElements($elements, $data, $firm, $patientId, $userId, $eventTypeId)
	{
		if ($id = parent::createElements($elements, $data, $firm, $patientId, $userId, $eventTypeId)) {
			$this->storePOSTManyToMany($elements);
		}

		return $id;
	}

	/*
	 * Process related items on event update
	 */
	public function updateElements($elements, $data, $event)
	{
		if (parent::updateElements($elements, $data, $event)) {
			// update has been successful, now need to deal with many to many changes
			$this->storePOSTManyToMany($elements);
		}
		return true;
	}

	/**
	 * (non-PHPdoc)
	 * @see BaseEventTypeController::setPOSTManyToMany()
	 */
	protected function setPOSTManyToMany($element)
	{
		if (get_class($element) == 'Element_OphCiAnaesthesiarecord_Readings') {
			$drugs = array();
			$readings = array();

			foreach ($this->getItems($element) as $item) {
				if (get_class($item) == 'OphCiAnaesthesiarecord_Reading') {
					$readings[] = $item;
				} else {
					$drugs[] = $item;
				}
			}

			$element->drugs = $drugs;
			$element->readings = $readings;
		}
	}

	/*
	 * Store related items
	 */
	protected function storePOSTManyToMany($elements)
	{
		foreach ($elements as $element) {
			if (get_class($element) == 'Element_OphCiAnaesthesiarecord_Readings') {
				$item_ids = array();
				foreach ($this->getItems(null) as $item) {
					$item->element_id = $element->id;

					if (!$item->save()) {
						throw new Exception("Unable to save related item: ".print_r($item->getErrors(),true));
					}

					if (!isset($item_ids[get_class($item)])) {
						$item_ids[get_class($item)] = array();
					}

					$item_ids[get_class($item)][] = $item->id;
				}

				foreach ($item_ids as $class => $ids) {
					$criteria = new CDbCriteria;
					$criteria->addCondition('element_id = :element_id');
					$criteria->addNotInCondition('id',$ids);
					$criteria->params[':element_id'] = $element->id;

					foreach ($class::model()->findAll($criteria) as $item) {
						if (!$item->delete()) {
							throw new Exception("Unable to delete $class: ".print_r($item->getErrors(),true));
						}
					}
				}
			}
		}
	}

	public function actionGetReadingFieldHTML()
	{
		if (!$type = OphCiAnaesthesiarecord_Reading_Type::model()->findByPk(@$_GET['reading_type_id'])) {
			throw new Exception("Reading type not found: ".@$_GET['reading_type_id']);
		}

		$n = @$_GET['n'];

		switch ($type->fieldType->name) {
			case 'Select':
				echo CHtml::dropDownList('reading_value_'.$n,'',CHtml::listData(OphCiAnaesthesiarecord_Reading_Type_Field_Type_Option::model()->findAll(array('order'=>'display_order','condition'=>'reading_type_id=:reading_type_id','params'=>array(':reading_type_id'=>$type->id))),'name','name'));
				break;
			default:
				echo CHtml::textField("reading_value_".$n,'',array('size'=>10));
		}
	}
}

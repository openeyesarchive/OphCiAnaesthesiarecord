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

	public function getItems($element) {
		$items = array();

		if (!empty($_POST)) {
			foreach ($_POST as $key => $value) {
				if (is_string($value) && strlen($value) >0) {
					if (preg_match('/^gas_level_([0-9]+)_([0-9]+)$/',$key,$m)) {
						$item = new OphCiAnaesthesiarecord_Gas_Level;
					} elseif (preg_match('/^drug_([0-9]+)_([0-9]+)$/',$key,$m)) {
						$item = new OphCiAnaesthesiarecord_Drug_Dose;
					} elseif (preg_match('/^reading_([0-9]+)_([0-9]+)$/',$key,$m)) {
						$item = new OphCiAnaesthesiarecord_Reading;
					}

					if (isset($item)) {
						$item->item_id = $m[1];
						$item->offset = $m[2];
						$item->value = $value;

						$items[] = $item;

						unset($item);
					}
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

	public function getGasItem($element, $gas, $offset)
	{
		if (!empty($_POST)) {
			$value = @$_POST['gas_level_'.$gas->id.'_'.$offset];

			return array(
				'colour' => $gas->getColourForValue($value),
				'level' => $value,
			);
		} else if ($element->id && $gas_level = OphCiAnaesthesiarecord_Gas_Level::model()->find('element_id=? and item_id=? and offset=?',array($element->id,$gas->id,$offset))) {
			$value = $gas_level->value;

			return array(
				'colour' => $gas->getColourForValue($value),
				'level' => $value,
			);
		}
	}

	public function getDrugItem($element, $drug, $offset)
	{
		if (!empty($_POST)) {
			return @$_POST['drug_'.$drug->id.'_'.$offset];
		}

		if ($element->id && $dose = OphCiAnaesthesiarecord_Drug_Dose::model()->find('element_id=? and item_id=? and offset=?',array($element->id,$drug->id,$offset))) {
			return $dose->value;
		}
	}

	public function getReadingItem($element, $reading_type, $offset)
	{
		if (!empty($_POST)) {
			return @$_POST['reading_'.$reading_type->id.'_'.$offset];
		}

		if ($element->id && $reading = OphCiAnaesthesiarecord_Reading::model()->find('element_id=? and item_id=? and offset=?',array($element->id,$reading_type->id,$offset))) {
			return $reading->value;
		}
	}
}

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

/**
 * This is the model class for table "et_ophcianaesthesiarecord_readings".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $start_time
 * @property string $comments
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property OphCiAnaesthesiarecord_Drug_Dose $drugs
 * @property OphCiAnaesthesiarecord_Reading $readings
 */

class Element_OphCiAnaesthesiarecord_Readings extends BaseEventTypeElement
{
	public $intervals = 8;

	/**
	 * Returns the static model of the specified AR class.
	 * @return the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'et_ophcianaesthesiarecord_readings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, start_time, comments', 'safe'),
			array('start_time, comments', 'required'),
			array('readings', 'OneOf', 'drugs', 'readings'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, start_time, comments', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
			'drugs' => array(self::HAS_MANY, 'OphCiAnaesthesiarecord_Drug_Dose', 'element_id', 'order' => 'display_order'),
			'readings' => array(self::HAS_MANY, 'OphCiAnaesthesiarecord_Reading', 'element_id', 'order' => 'display_order'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'comments' => 'Comments',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('comments', $this->comments);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	public function setDefaultOptions()
	{
		$ts = time();

		while (date('i',$ts) != '00' && date('i',$ts) != '30') {
			$ts -= 60;
		}

		$this->start_time = date('H:i',$ts);
	}

	public function getItems() {
		$items = array();

		foreach (OphCiAnaesthesiarecord_Gas_Level::model()->findAll(array('condition'=>'element_id=?','params'=>array($this->id),'order'=>'display_order')) as $level) {
			$items[$level->display_order] = $level;
		}

		foreach (OphCiAnaesthesiarecord_Reading::model()->findAll(array('condition'=>'element_id=?','params'=>array($this->id),'order'=>'display_order')) as $reading) {
			$items[$reading->display_order] = $reading;
		}

		foreach (OphCiAnaesthesiarecord_Drug_Dose::model()->findAll(array('condition'=>'element_id=?','params'=>array($this->id),'order'=>'display_order')) as $dose) {
			$items[$dose->display_order] = $dose;
		}

		ksort($items);

		return $items;
	}

	public function OneOf($attribute, $params)
	{
		$valid = false;

		foreach ($params as $param) {
			if ($this->$param) {
				$valid = true;
				break;
			}
		}

		if ($valid === false) {
			$this->addError($attribute, 'You must enter at least one drug or reading');
		}
	}

	public function getStartTimeTS()
	{
		preg_match('/^([0-9]+)\:([0-9]+)/',$this->start_time,$m);

		return mktime($m[1],$m[2],0,1,1,2012);
	}

	public function getTimeIntervals()
	{
		$times = array();

		for ($i=0; $i<=$this->intervals; $i++) {
			$times[] = date('H:i',($this->startTimeTS + ($i * 15 * 60)));
		}

		return $times;
	}
}
?>

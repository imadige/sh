<?php

/**
 * This is the model class for table "messagesanswer".
 *
 * The followings are the available columns in table 'messagesanswer':
 * @property integer $messagesanswerID
 * @property integer $messagesID
 * @property string $dateAdd
 * @property string $text
 * @property integer $employeesID
 */
class Messagesanswer extends CActiveRecord
{
	public $name;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messagesanswer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('messagesID, dateAdd, text, employeesID', 'required'),
			array('messagesID, employeesID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('messagesanswerID, messagesID, dateAdd, text, employeesID', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'messagesanswerID' => 'Messagesanswer',
			'messagesID' => 'Messages',
			'dateAdd' => 'Date Add',
			'text' => 'Text',
			'employeesID' => 'Employees',
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

		$criteria=new CDbCriteria;

		$criteria->compare('messagesanswerID',$this->messagesanswerID);
		$criteria->compare('messagesID',$this->messagesID);
		$criteria->compare('dateAdd',$this->dateAdd,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('employeesID',$this->employeesID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
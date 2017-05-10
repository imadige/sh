<?php

/**
 * This is the model class for table "messagesread".
 *
 * The followings are the available columns in table 'messagesread':
 * @property integer $messagesreadID
 * @property integer $messagesID
 * @property integer $employeesID
 * @property integer $readd
 */
class Messagesread extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Messagesread the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messagesread';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('messagesID, employeesID, readd', 'required'),
			array('messagesID, employeesID, readd', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('messagesreadID, messagesID, employeesID, readd', 'safe', 'on'=>'search'),
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
			'messagesreadID' => 'Messagesread',
			'messagesID' => 'Messages',
			'employeesID' => 'Employees',
			'readd' => 'Readd',
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

		$criteria->compare('messagesreadID',$this->messagesreadID);
		$criteria->compare('messagesID',$this->messagesID);
		$criteria->compare('employeesID',$this->employeesID);
		$criteria->compare('readd',$this->readd);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
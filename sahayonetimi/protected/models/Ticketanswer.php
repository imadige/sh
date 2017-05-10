<?php

/**
 * This is the model class for table "ticketanswer".
 *
 * The followings are the available columns in table 'ticketanswer':
 * @property integer $ticketanswerID
 * @property integer $ticketID
 * @property integer $employeesID
 * @property string $dateAdd
 * @property string $text
 */
class Ticketanswer extends CActiveRecord
{
	public $_maxSize;
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
		return 'ticketanswer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$this->_maxSize = 1024 * 2000;
		return array(
			array('ticketID, employeesID, dateAdd, text', 'required'),
			array('ticketID, employeesID', 'numerical', 'integerOnly'=>true),
			
			array('images1', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024))),'allowEmpty' => true),

			array('images2', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024))),'allowEmpty' => true),

			array('images3', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024))),'allowEmpty' => true),

			array('images4', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024))),'allowEmpty' => true),
			array('ticketanswerID, ticketID, employeesID, dateAdd, text', 'safe', 'on'=>'search'),
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
			'ticketanswerID' => 'Ticketanswer',
			'ticketID' => 'Ticket',
			'employeesID' => 'Employees',
			'dateAdd' => 'Date Add',
			'text' => Yii::t('trans','Mesaj'),
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

		$criteria->compare('ticketanswerID',$this->ticketanswerID);
		$criteria->compare('ticketID',$this->ticketID);
		$criteria->compare('employeesID',$this->employeesID);
		$criteria->compare('dateAdd',$this->dateAdd,true);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
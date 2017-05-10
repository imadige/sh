<?php

/**
 * This is the model class for table "salesmoneyreceived".
 *
 * The followings are the available columns in table 'salesmoneyreceived':
 * @property integer $salesmoneyreceivedID
 * @property integer $salescompleteID
 * @property double $receivedPrice
 * @property integer $receivedCur
 */
class Salesmoneyreceived extends CActiveRecord
{
	public $received1;
	public $received2;
	public $receivedCur;
	
	public $account;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'salesmoneyreceived';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('salescompleteID, receivedPrice, receivedCur,unpayment,dateAdd,deleted', 'required'),
			array('salescompleteID, receivedCur,unpayment,deleted,deletedEmployeesID', 'numerical', 'integerOnly'=>true),
			array('receivedPrice', 'numerical'),
			array('received1,received2,account,deletedDateAdd,deletedEmployeesID','safe'),
			array('salesmoneyreceivedID, salescompleteID, receivedPrice, receivedCur,unpayment,dateAdd,deletedDateAdd', 'safe', 'on'=>'search'),
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
			'salesmoneyreceivedID' => 'Salesmoneyreceived',
			'salescompleteID' => 'Salescomplete',
			'receivedPrice' => Yii::t('trans','Ödenen Tutar'),
			'receivedCur' => Yii::t('trans','Ödenen Tutar Kuru'),
			'dateAdd'=>Yii::t('trans','Tarih'),

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

		$criteria->compare('salesmoneyreceivedID',$this->salesmoneyreceivedID);
		$criteria->compare('salescompleteID',$this->salescompleteID);
		$criteria->compare('receivedPrice',$this->receivedPrice);
		$criteria->compare('receivedCur',$this->receivedCur);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
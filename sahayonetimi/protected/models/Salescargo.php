<?php

/**
 * This is the model class for table "salescargo".
 *
 * The followings are the available columns in table 'salescargo':
 * @property integer $salescargoID
 * @property string $name
 * @property integer $payment
 * @property string $follownumber
 * @property integer $deleted
 * @property string $dateAdd
 * @property double $charge
 * @property integer $chargeCur
 * @property integer $type
 * @property integer $salescompleteID
 * @property integer $companyID
 * @property integer $worldID
 */
class Salescargo extends CActiveRecord
{
	public $charge1;
	public $charge2;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'salescargo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('deleted, dateAdd, type, salescompleteID, companyID, worldID', 'required'),
			array('payment, deleted, chargeCur, type, salescompleteID, companyID, worldID', 'numerical', 'integerOnly'=>true),
			array('charge,charge1,charge2', 'numerical'),
			array('name', 'length', 'max'=>45),
			array('follownumber', 'length', 'max'=>255),
			array('charge1,charge2','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('salescargoID, name, payment, follownumber, deleted, dateAdd, charge, chargeCur, type, salescompleteID, companyID, worldID', 'safe', 'on'=>'search'),
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
			'salescargoID' => 'Salescargo',
			'name' => Yii::t('trans','İsim'),
			'payment' => Yii::t('trans','Ücret tipi'),
			'follownumber' => Yii::t('trans','Takip Numarası'),
			'deleted' => 'Deleted',
			'dateAdd' => 'Date Add',
			'charge' => Yii::t('trans','Gönderim Ücreti'),
			'chargeCur' => Yii::t('trans','Kur'),
			'type' => Yii::t('trans','Gönderim tipi'),
			'salescompleteID' => 'Salescomplete',
			'companyID' => 'Company',
			'worldID' => 'World',
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

		$criteria->compare('salescargoID',$this->salescargoID);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('payment',$this->payment);
		$criteria->compare('follownumber',$this->follownumber,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('dateAdd',$this->dateAdd,true);
		$criteria->compare('charge',$this->charge);
		$criteria->compare('chargeCur',$this->chargeCur);
		$criteria->compare('type',$this->type);
		$criteria->compare('salescompleteID',$this->salescompleteID);
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('worldID',$this->worldID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
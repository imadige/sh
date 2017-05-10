<?php

/**
 * This is the model class for table "salesreturn".
 *
 * The followings are the available columns in table 'salesreturn':
 * @property integer $salesreturnID
 * @property integer $salesdetailID
 * @property integer $productsID
 * @property integer $salescompleteID
 * @property integer $number

 * @property double $salesreturnPrice
 * @property integer $salesreturnCur
 * @property integer $employeesID
 * @property string $text
 * @property string $dateAdd
 * @property integer $productbottomsID
 * @property integer $worldID
 * @property integer $companyID
 */
class Salesreturn extends CActiveRecord
{
	public $name;
	
	public $bkar;
	public $salesCur;
	public $salesPrice;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'salesreturn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('salesdetailID, productsID, salescompleteID, number, salesreturnPrice, salesreturnCur, employeesID, dateAdd, productbottomsID, worldID, companyID,text,deleted', 'required'),
			array('salesdetailID, productsID, salescompleteID, number, salesreturnCur, employeesID, productbottomsID, worldID, companyID,deleted,deletedEmployeesID', 'numerical', 'integerOnly'=>true),
			array('salesreturnPrice', 'numerical'),
			array('text,deletedDateAdd,deletedEmployeesID', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('salesreturnID, salesdetailID, productsID, salescompleteID, number, salesreturnPrice, salesreturnCur, employeesID, text, dateAdd, productbottomsID, worldID, companyID', 'safe', 'on'=>'search'),
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
			'salesreturnID' => 'Salesreturn',
			'salesdetailID' => Yii::t('trans','Ürün'),
			'productsID' => 'Products',
			'salescompleteID' => 'Salescomplete',
			'number' => Yii::t('trans','Adet'),
			
			'salesreturnPrice' => 'Salesreturn Price',
			'salesreturnCur' => 'Salesreturn Cur',
			'employeesID' => 'Employees',
			'text' => Yii::t('trans','Açıklama'),
		
			'dateAdd' => Yii::t('trans','Tarih'),
			'productbottomsID' => 'Productbottoms',
			'worldID' => 'World',
			'companyID' => 'Company',
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

		$criteria->compare('salesreturnID',$this->salesreturnID);
		$criteria->compare('salesdetailID',$this->salesdetailID);
		$criteria->compare('productsID',$this->productsID);
		$criteria->compare('salescompleteID',$this->salescompleteID);
		$criteria->compare('number',$this->number);
	
		$criteria->compare('salesreturnPrice',$this->salesreturnPrice);
		$criteria->compare('salesreturnCur',$this->salesreturnCur);
		$criteria->compare('employeesID',$this->employeesID);
		$criteria->compare('text',$this->text,true);
		
		$criteria->compare('dateAdd',$this->dateAdd,true);
		$criteria->compare('productbottomsID',$this->productbottomsID);
		$criteria->compare('worldID',$this->worldID);
		$criteria->compare('companyID',$this->companyID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
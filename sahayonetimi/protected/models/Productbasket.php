<?php

/**
 * This is the model class for table "productbasket".
 *
 * The followings are the available columns in table 'productbasket':
 * @property integer $productbasketID
 * @property integer $productsID
 * @property integer $productbottomsID
 * @property integer $number
 * @property integer $employeesID
 * @property integer $companyID
 * @property integer $worldID
 * @property double $salesPrice
 * @property integer $salesCur
 */
class Productbasket extends CActiveRecord
{
	public $name;
	public $salePrice;
	public $reducedPrice;
	public $saleCur;
	public $reduceCur;
	public $tax;
	public $dealerPrice;
	public $dealerCur;
	
	
	public $purchasePrice;
	public $purchaseCur;
	public $deleted;
	public $text;
	public $productgroupsID;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'productbasket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productsID, productbottomsID, number, employeesID, companyID, worldID, salesPrice, salesCur,dateAdd,unitPrice,unitCur,purchasePrice,purchaseCur', 'required'),
			array('productsID, productbottomsID, number, employeesID, companyID, worldID, salesCur', 'numerical', 'integerOnly'=>true),
			array('salesPrice', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productbasketID, productsID, productbottomsID, number, employeesID, companyID, worldID, salesPrice, salesCur,dateAdd,unitPrice,unitCur,purchasePrice,purchaseCur', 'safe', 'on'=>'search'),
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
			'productbasketID' => 'Productbasket',
			'productsID' => 'Products',
			'productbottomsID' => 'Productbottoms',
			'number' => 'Number',
			'employeesID' => 'Employees',
			'companyID' => 'Company',
			'worldID' => 'World',
			'salesPrice' => 'Sales Price',
			'salesCur' => 'Sales Cur',
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

		$criteria->compare('productbasketID',$this->productbasketID);
		$criteria->compare('productsID',$this->productsID);
		$criteria->compare('productbottomsID',$this->productbottomsID);
		$criteria->compare('number',$this->number);
		$criteria->compare('employeesID',$this->employeesID);
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('worldID',$this->worldID);
		$criteria->compare('salesPrice',$this->salesPrice);
		$criteria->compare('salesCur',$this->salesCur);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
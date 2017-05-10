<?php

/**
 * This is the model class for table "salesdetail".
 *
 * The followings are the available columns in table 'salesdetail':
 * @property integer $salesdetailID
 * @property integer $productsID
 * @property integer $productbottomsID
 * @property integer $number
 * @property double $salesPrice
 * @property integer $salesCur
 * @property integer $salescompleteID
 */
class Salesdetail extends CActiveRecord
{
	public $name;
	public $reducedPrice;
	public $reduceCur;
	
	public $dealerPrice;
	public $dealerCur;
	
	public $salePrice;
	public $saleCur;
	public $tax;
	
	public $pgname;
	public $numbers;

	public $salesEs;
	public $dateAdd;

	public $customerdealerID;
	public $cdtype;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'salesdetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productsID, productbottomsID, number, salesPrice, salesCur, salescompleteID,unitPrice,unitCur,purchasePrice,purchaseCur,deleted', 'required'),
			array('productsID, productbottomsID, number, salesCur, salescompleteID,deleted', 'numerical', 'integerOnly'=>true),
			array('salesPrice', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('salesdetailID, productsID, productbottomsID, number, salesPrice, salesCur, salescompleteID,unitPrice,unitCur,purchasePrice,purchaseCur,deleted', 'safe', 'on'=>'search'),
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
			'salesdetailID' => 'Salesdetail',
			'productsID' => 'Products',
			'productbottomsID' => 'Productbottoms',
			'number' => 'Number',
			'salesPrice' => 'Sales Price',
			'salesCur' => 'Sales Cur',
			'salescompleteID' => 'Salescomplete',
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

		$criteria->compare('salesdetailID',$this->salesdetailID);
		$criteria->compare('productsID',$this->productsID);
		$criteria->compare('productbottomsID',$this->productbottomsID);
		$criteria->compare('number',$this->number);
		$criteria->compare('salesPrice',$this->salesPrice);
		$criteria->compare('salesCur',$this->salesCur);
		$criteria->compare('salescompleteID',$this->salescompleteID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
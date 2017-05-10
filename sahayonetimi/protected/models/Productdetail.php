<?php

/**
 * This is the model class for table "productdetail".
 *
 * The followings are the available columns in table 'productdetail':
 * @property integer $productdetailID
 * @property integer $productsID
 * @property string $text
 * @property double $purchasePrice
 * @property integer $purchaseCur
 * @property double $salePrice
 * @property integer $saleCur
 * @property double $reducedPrice
 * @property integer $reduceCur
 * @property double $dealerPrice
 * @property integer $dealerCur
 * @property string $dateAdd
 * @property integer $deleted
 * @property integer $worldID
 */
class Productdetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Productdetail the static model class
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
		return 'productdetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productsID, text, purchasePrice, purchaseCur, salePrice, saleCur, dateAdd, deleted, worldID', 'required'),
			array('productsID, purchaseCur, saleCur, reduceCur, dealerCur, deleted, worldID', 'numerical', 'integerOnly'=>true),
			array('purchasePrice, salePrice, reducedPrice, dealerPrice', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productdetailID, productsID, text, purchasePrice, purchaseCur, salePrice, saleCur, reducedPrice, reduceCur, dealerPrice, dealerCur, dateAdd, deleted, worldID', 'safe', 'on'=>'search'),
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
			'productdetailID' => 'Productdetail',
			'productsID' => 'Products',
			'text' => 'Text',
			'purchasePrice' => 'Purchase Price',
			'purchaseCur' => 'Purchase Cur',
			'salePrice' => 'Sale Price',
			'saleCur' => 'Sale Cur',
			'reducedPrice' => 'Reduced Price',
			'reduceCur' => 'Reduce Cur',
			'dealerPrice' => 'Dealer Price',
			'dealerCur' => 'Dealer Cur',
			'dateAdd' => 'Date Add',
			'deleted' => 'Deleted',
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

		$criteria->compare('productdetailID',$this->productdetailID);
		$criteria->compare('productsID',$this->productsID);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('purchasePrice',$this->purchasePrice);
		$criteria->compare('purchaseCur',$this->purchaseCur);
		$criteria->compare('salePrice',$this->salePrice);
		$criteria->compare('saleCur',$this->saleCur);
		$criteria->compare('reducedPrice',$this->reducedPrice);
		$criteria->compare('reduceCur',$this->reduceCur);
		$criteria->compare('dealerPrice',$this->dealerPrice);
		$criteria->compare('dealerCur',$this->dealerCur);
		$criteria->compare('dateAdd',$this->dateAdd,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('worldID',$this->worldID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
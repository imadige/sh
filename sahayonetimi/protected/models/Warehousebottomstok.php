<?php

/**
 * This is the model class for table "warehousebottomstok".
 *
 * The followings are the available columns in table 'warehousebottomstok':
 * @property integer $warehousebottomstokID
 * @property integer $warehouseID
 * @property integer $productbottomsID
 * @property integer $stok
 */
class Warehousebottomstok extends CActiveRecord
{
	
	public $wname;
	public $stok;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'warehousebottomstok';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('warehouseID, productbottomsID, stok,productsID, companyID,worldID', 'required'),
			array('warehouseID, productbottomsID, stok,productsID, companyID,worldID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('warehousebottomstokID, warehouseID, productbottomsID, stok, productsID, companyID,worldID,cargo', 'safe', 'on'=>'search'),
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
			'warehousebottomstokID' => 'Warehousebottomstok',
			'warehouseID' => 'Warehouse',
			'productbottomsID' => 'Productbottoms',
			'stok' => 'Stok',
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

		$criteria->compare('warehousebottomstokID',$this->warehousebottomstokID);
		$criteria->compare('warehouseID',$this->warehouseID);
		$criteria->compare('productbottomsID',$this->productbottomsID);
		$criteria->compare('stok',$this->stok);
		$criteria->compare('productsID',$this->productsID);
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('worldID',$this->worldID);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
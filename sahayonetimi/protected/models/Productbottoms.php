<?php

/**
 * This is the model class for table "productbottoms".
 *
 * The followings are the available columns in table 'productbottoms':
 * @property integer $productbottomsID
 * @property integer $productsID
 * @property integer $productsType
 * @property string $bottomvalue
 * @property integer $stok
 * @property integer $worldID
 * @property integer $companyID
 */
class Productbottoms extends CActiveRecord
{
	
	public $bottomvalue2a;
	public $bottomvalue2b;
	
	public $productsType;
	
	public $bottombirim2;
	public $bottombirim5;
	public $bottombirim6;
	
	public $name;
	
	public $warehouseID;
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
		return 'productbottoms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productsID,  stok, worldID, companyID,warehouseID', 'required'),
			array('productsID,  stok, worldID, companyID,warehouseID', 'numerical', 'integerOnly'=>true),
			array('bottomvalue1,bottomvalue2,bottomvalue3,bottomvalue4,bottomvalue5,bottomvalue6,bottomvalue7', 'length', 'max'=>45),
			array('bottomvalue1,bottomvalue2,bottomvalue3,bottomvalue4,bottomvalue5,bottomvalue6,bottomvalue7,bottombirim2,bottombirim5,bottombirim6','safe'),
			array('productbottomsID, productsID, bottomvalue1, bottomvalue2,bottomvalue3, bottomvalue4, bottomvalue5,bottomvalue6, bottomvalue7, stok, worldID, companyID,warehouseID', 'safe', 'on'=>'search'),
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

	public function attributeLabels()
	{
		return array(
			'productbottomsID' => 'ID',
			'productsID' =>  Yii::t('trans','ÜrünID'),
			'bottomvalue1' =>  Yii::t('trans','Değer'),
			'stok' =>  Yii::t('trans','Stok Adedi'),
			'worldID' =>  Yii::t('trans','Uygulama'),
			'companyID' =>  Yii::t('trans','Şirket'),
			'color' =>  Yii::t('trans','Renk'),
			'enboy' =>  Yii::t('trans','En ve Boy'),
			'beden' =>  Yii::t('trans','Beden'),
			'numara' =>  Yii::t('trans','Numara'),
			'agirlik' =>  Yii::t('trans','Ağırlık'),
			'hacim' =>  Yii::t('trans','Hacim'),
			'derinlik' =>  Yii::t('trans','Derinlik'),
			'productsType' =>  Yii::t('trans','Alt ürün sınıfı'),
			'warehouseID'=>Yii::t('trans','Depo'),
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

		$criteria->compare('productbottomsID',$this->productbottomsID);
		$criteria->compare('productsID',$this->productsID);
		$criteria->compare('bottomvalue',$this->bottomvalue,true);
		$criteria->compare('worldID',$this->worldID);
		$criteria->compare('companyID',$this->companyID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
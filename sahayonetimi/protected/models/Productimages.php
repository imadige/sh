<?php

/**
 * This is the model class for table "productimages".
 *
 * The followings are the available columns in table 'productimages':
 * @property integer $productimagesID
 * @property integer $productID
 * @property string $images
 * @property integer $mainimages
 * @property integer $worldID
 * @property integer $companyID
 */
class Productimages extends CActiveRecord
{
	
	/******imagecrop*********/
	public $cropID;
	public $cropX;
	public $cropY;
	public $cropW;
	public $cropH;
	public $logoTamam;
	public $logoLogo;
	/*********imagecrop*******/
	
	private $_maxSize;
		
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'productimages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$this->_maxSize = 1024 * 1500;

		return array(
			array('productID, mainimages, worldID, companyID', 'required'),
			array('productID, mainimages, worldID, companyID', 'numerical', 'integerOnly'=>true),
			array('images', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024)))),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productimagesID, productID, images, mainimages, worldID, companyID', 'safe', 'on'=>'search'),
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
			'productimagesID' => 'ID',
			'productID' => Yii::t('trans','Ürün'),
			'images' => Yii::t('trans','Resim'),
			'mainimages' => Yii::t('trans','Kapak Resmi'),
			'worldID' => Yii::t('trans','Uygulama'),
			'companyID' => Yii::t('trans','Şirket'),
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

		$criteria->compare('productimagesID',$this->productimagesID);
		$criteria->compare('productID',$this->productID);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('mainimages',$this->mainimages);
		$criteria->compare('worldID',$this->worldID);
		$criteria->compare('companyID',$this->companyID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
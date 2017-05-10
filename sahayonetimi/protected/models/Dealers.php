<?php

/**
 * This is the model class for table "dealers".
 *
 * The followings are the available columns in table 'dealers':
 * @property integer $dealersID
 * @property string $name
 * @property string $title
 * @property string $phone
 * @property string $cphone
 * @property string $fax
 * @property string $email
 * @property string $adres
 * @property integer $deleted
 * @property string $dateAdd
 * @property integer $companyID
 * @property string $worldID
 * @property string $country
 * @property integer $city
 * @property string $county
 */
class Dealers extends CActiveRecord
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

	public $_maxSize;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dealers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$this->_maxSize = 1024 * 2000;
		return array(
			array('name, title, email, adres, deleted, dateAdd, companyID, worldID, country, city,phone,addEmployeesID', 'required'),
			array('deleted, companyID, city,addEmployeesID,taxno', 'numerical', 'integerOnly'=>true),
			array('name, title', 'length', 'max'=>100),
			array('phone, cphone, fax, worldID, county', 'length', 'max'=>45),
			array('email', 'length', 'max'=>75),
			array('email','email'),
			array('email','unique'),
			array('taxno,taxoffice', 'length', 'max'=>45),
			array('taxno,taxnotype,taxoffice','safe'),
			array('logo', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024))),'allowEmpty' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dealersID, name, title, phone, cphone, fax, email, adres, deleted, dateAdd, companyID, worldID, country, city, county,addEmployeesID', 'safe', 'on'=>'search'),
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
			'Country'=>array( self::BELONGS_TO, 'Country', 'country' ),
			'City'=>array( self::BELONGS_TO, 'City', 'city' ),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dealersID' => 'ID',
			'name' => Yii::t('trans','Adı'),
			'title' => Yii::t('trans','Unvanı'),
			'phone' => Yii::t('trans','Telefon'),
			'cphone' => Yii::t('trans','Cep Telefon'),
			'fax' => Yii::t('trans','Fax'),
			'email' => Yii::t('trans','E-Posta'),
			'adres' => Yii::t('trans','Adres'),
			'deleted' => Yii::t('trans','Silindi'),
			'dateAdd' => Yii::t('trans','Ekleme Tarihi'),
			'companyID' => Yii::t('trans','Şirket'),
			'worldID' => Yii::t('trans','Uygulama'),
			'country' => Yii::t('trans','Ülke'),
			'city' => Yii::t('trans','İl'),
			'county' => Yii::t('trans','İlçe'),
			'addEmployeesID' => Yii::t('trans','Ekleyen Kullanıcı'),
			'Logo'=>Yii::t('trans','Logo'),
			'taxno'=>Yii::t('trans','Vergi Numarası'),
			'taxoffice'=>Yii::t('trans','Vergi Dairesi'),
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
		$criteria->alias = 'i';
		$criteria->join= 'LEFT JOIN city c ON (c.cityID=i.city) LEFT JOIN country co ON (co.Code=i.country)';
		
		if($this->dealersID!="")
			$criteria->compare('i.dealersID',$this->dealersID-$this->getParams("dealerplus"));
		$criteria->compare('i.name',$this->name,true);
		$criteria->compare('i.title',$this->title,true);
		$criteria->compare('i.phone',$this->phone,true);
		$criteria->compare('i.cphone',$this->cphone,true);
		$criteria->compare('i.fax',$this->fax,true);
		$criteria->compare('i.email',$this->email,true);
		$criteria->compare('i.adres',$this->adres,true);
		$criteria->compare('i.deleted',$this->deleted);
		$criteria->compare('i.dateAdd >',$this->dateAdd);
		$criteria->compare('i.companyID',$this->companyID);
		$criteria->compare('i.worldID',$this->worldID,true);
		$criteria->compare('co.name',$this->country,true);
		$criteria->compare('c.name',$this->city,true);
		$criteria->compare('i.county',$this->county,true);
		$criteria->compare('i.addEmployeesID',$this->addEmployeesID);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
                'pageSize' => 15,
            ),
			
		));
	}
	
	public function getParams($param){
		$params = new Params;
		return $params->get($param);
	}
	
	public function getParams_($param,$id){
		$params = new Params;
		$array=$params->get($param);
		return $array[$id];
	}
}
<?php

/**
 * This is the model class for table "customers".
 *
 * The followings are the available columns in table 'customers':
 * @property integer $customerID
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $cphone
 * @property integer $country
 * @property integer $city
 * @property string $county
 * @property string $adress

 * @property integer $deleted
 * @property string $dateAdd
 * @property integer $opportunity
 * @property integer $addEmployeesID
 * @property integer $worldID
 * @property integer $companyID
 */
class Customers extends CActiveRecord
{
	
	public $country2;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customers the static model class
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
		return 'customers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		
		return array(
			array('name, country, city, adress, deleted, dateAdd, opportunity, addEmployeesID, worldID, companyID,cgID,phone', 'required'),
			array('city, deleted, opportunity, addEmployeesID, worldID, companyID,cgID,taxnotype', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>150),
			array('taxno,taxoffice', 'length', 'max'=>45),
			array('email, county', 'length', 'max'=>75),
			array('phone, cphone,fax', 'length', 'max'=>45),
			array('email','email'),
			array('taxno,taxnotype,taxoffice,country2','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customerID, name, email, phone, cphone, country, city, county, adress, deleted, dateAdd, opportunity, addEmployeesID, worldID, companyID,cgID,fax,country2', 'safe', 'on'=>'search'),
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
			'customerID' => 'ID',
			'name' => Yii::t('trans','Unvanı'),
			'email' => Yii::t('trans','E-Posta'),
			'phone' => Yii::t('trans','Telefon'),
			'cphone' => Yii::t('trans','Cep Telefon'),
			'country' => Yii::t('trans','Ülke'),
			'city' => Yii::t('trans','İl'),
			'county' => Yii::t('trans','İlçe'),
			'adress' => Yii::t('trans','Adres'),
		
			'deleted' => Yii::t('trans','Silindi'),
			'dateAdd' => Yii::t('trans','Eklenme Tarihi'),
			'opportunity' => Yii::t('trans','Fırsat'),
			'addEmployeesID' => Yii::t('trans','Ekleyen Kullanıcı'),
			'worldID' => Yii::t('trans','Uygulama'),
			'companyID' => Yii::t('trans','Şirket'),
			'cgID'=>Yii::t('trans','Müşteri Grubu'),
			'fax'=>Yii::t('trans','Fax'),
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
		$criteria->join= 'LEFT JOIN city c ON (c.cityID=i.city) LEFT JOIN country co ON (co.code=i.country)';
		
		if($this->customerID!="")
			$criteria->compare('i.customerID',$this->customerID-$this->getParams("dealercustomerplus"));
		$criteria->compare('i.name',$this->name,true);
		$criteria->compare('i.email',$this->email,true);
		$criteria->compare('i.phone',$this->phone,true);
		$criteria->compare('i.cphone',$this->cphone,true);
		$criteria->compare('i.fax',$this->cphone,true);
		$criteria->compare('i.county',$this->county);
		$criteria->compare('c.name',$this->city,true);
		$criteria->compare('co.name',$this->country,true);
		$criteria->compare('co.code',$this->country2);
		$criteria->compare('i.adress',$this->adress,true);
	
		$criteria->compare('i.deleted',$this->deleted);
		$criteria->compare('i.dateAdd >',$this->dateAdd);
		$criteria->compare('i.opportunity',$this->opportunity);
		$criteria->compare('i.addEmployeesID',$this->addEmployeesID);
		$criteria->compare('i.worldID',$this->worldID);
		$criteria->compare('i.companyID',$this->companyID);
		$criteria->compare('i.cgID',$this->cgID);

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
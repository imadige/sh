<?php

/**
 * This is the model class for table "companies".
 *
 * The followings are the available columns in table 'companies':
 * @property integer $companyID
 * @property string $name
 * @property string $adress
 * @property string $phone
 * @property string $email
 * @property string $country
 * @property integer $city
 * @property string $cityother
 * @property integer $deleted
 * @property string $dateAdd
 */
class Companies extends CActiveRecord
{
	public $cityothervalid;
	public $password;
	public $repassword;
	public $nameSurname;
	public $contract;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'companies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, city, email, country, deleted, dateAdd, password, repassword, nameSurname', 'required'),
			array('city, deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>150),
			array('phone', 'length', 'max'=>25),
			array('email', 'length', 'max'=>75),
			array('country', 'length', 'max'=>5),
			array('cityother', 'length', 'max'=>35),
			array('adress,cityothervalid,nameSurname,password,repassword,contract','safe'),
			array('email','email'),
			array('email','email_kontrol'),
            array('password, repassword', 'length', 'min'=>6),
            array('password', 'compare', 'compareAttribute'=>'repassword'),
			array('contract','contract_kontrol'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('companyID, name, adress, phone, email, country, city, cityother, deleted, dateAdd', 'safe', 'on'=>'search'),
		);
	}
	
	public function email_kontrol($attribute,$params)
	{
		$modelEmployees=Employees::model()->count("email=:email",array(":email"=>$this->email));
		
		if($modelEmployees>0)
			$this->addError('email', Yii::t('trans','E-Posta daha önce alınmış.'));
			
	}

	public function contract_kontrol($attribute,$params)
	{
		if($this->contract==0)
			$this->addError('contract', Yii::t('trans','Lütfen sözleşmeyi okuyunuz.'));
				
	
		
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('adress',$this->adress,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city);
		$criteria->compare('cityother',$this->cityother,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('dateAdd',$this->dateAdd,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
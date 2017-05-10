<?php

/**
 * This is the model class for table "employees".
 *
 * The followings are the available columns in table 'employees':
 * @property integer $employeesID
 * @property string $name
 * @property integer $erights
 * @property string $email
 * @property string $password
 * @property string $title
 * @property integer $companyID
 * @property string $avatar
 * @property integer $deleted
 * @property string $dateAdd
 */
class Employees extends CActiveRecord
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
	
	public $passwordchange;
	public $password1;
	public $password2;
	public $oldpassword;

	public $update2;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$this->_maxSize = 1024 * 2000;
		
		return array(
			array('name, erights, email, password, title, companyID, deleted, dateAdd,status,admins', 'required'),
			array('erights, companyID, deleted,status,admins', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>75),
			array('password', 'length', 'max'=>60),
			array('title', 'length', 'max'=>30),
			array('email','email'),
			array('password1,password2,oldpassword','safe'),
			array('password2','password_kontrol'),
			array('oldpassword','password_kontrol2'),
			array('email','email_kontrol'),
			array('avatar', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024))),'allowEmpty' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employeesID, name, erights, email, password, title, companyID,admins, avatar, deleted, dateAdd,status', 'safe', 'on'=>'search'),
		);
	}

	public function email_kontrol($attribute,$params)
	{
		if($this->update2!=true){
			$modelEmployees=Employees::model()->find('email=:email',array(':email'=>$this->email));
			if(count($modelEmployees)>0)
				$this->addError('email', Yii::t('trans','Bu E-Posta daha önce kullanılmış.'));
		}else{
			$modelEmployees=Employees::model()->findByPk(Yii::app()->user->getState("ID"));
			if($this->email!=$this->email){
				$modelEmployees=Employees::model()->find('email=:email',array(':email'=>$this->email));
				if(count($modelEmployees)>0)
					$this->addError('email', Yii::t('trans','Bu E-Posta daha önce kullanılmış.'));
			}
		}
	}
	
	
	public function password_kontrol($attribute,$params)
	{
		if($this->passwordchange==true){
			if(strlen($this->password1)<6)
				$this->addError('password1', Yii::t('trans','Parola 6 karekterden küçük olamaz.'));
			
			elseif($this->password1!=$this->password2)
				$this->addError('password2', Yii::t('trans','Parolalar birbirleriyle eşleşmiyor.'));
		}
	}
	
	public function password_kontrol2($attribute,$params)
	{
		if($this->passwordchange==true){
			 $modelEmployees=Employees::model()->findByPk(Yii::app()->user->getState("ID"));
			 if(empty($this->oldpassword))
			 	$this->addError('oldpassword', Yii::t('trans','Eski Parolanızı boş bırakamazsınız.'));
			 elseif(md5(sha1(md5(base64_encode(md5(sha1(md5($this->oldpassword)))))))!=$modelEmployees->password)
			 	$this->addError('oldpassword', Yii::t('trans','Eski Parolanız hatalı.'));
		}
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
			'employeesID' => 'ID',
			'name' => Yii::t('trans','Adı Soyadı'),
			'erights' => Yii::t('trans','Yetki'),
			'email' => Yii::t('trans','E-Posta'),
			'password' => Yii::t('trans','Parola'),
			'title' => Yii::t('trans','Ünvanı'),
			'companyID' => Yii::t('trans','Şirket'),
			'avatar' => Yii::t('trans','Fotoğraf'),
			'deleted' => Yii::t('trans','Silindi'),
			'dateAdd' => Yii::t('trans','Eklenme Tarihi'),
			'status'=>Yii::t('trans','Durumu'),
			'oldpassword'=>Yii::t('trans','Eski Parola'),
			'password1'=>Yii::t('trans','Parola'),
			'password2'=>Yii::t('trans','Parola Tekrar'),

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
		if($this->employeesID!="")
			$criteria->compare('employeesID',$this->employeesID-$this->getParams("defultemployeesplus"));
			
		$criteria->compare('name',$this->name,true);
		$criteria->compare('erights',$this->erights);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('dateAdd',$this->dateAdd,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('admins',$this->admins);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
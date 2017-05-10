<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property integer $ticketID
 * @property string $text
 * @property string $images1
 * @property string $images2
 * @property string $images3
 * @property string $images4
 * @property integer $language

 * @property integer $okundu
 * @property integer $cevap
 * @property integer $employeesID
 * @property integer $companyID
 */
class Ticket extends CActiveRecord
{
	public $_maxSize;
	public $name;
	public $employees;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$this->_maxSize = 1024 * 2000;
		return array(
			array('text, language, cevap, employeesID, companyID,type,dateAdd,updateDate', 'required'),
			array('language,  cevap, employeesID, companyID,type', 'numerical', 'integerOnly'=>true),
			array('images1, images2, images3, images4', 'length', 'max'=>45),
			array('dateAdd,employees', 'safe'),

			array('images1', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024))),'allowEmpty' => true),

			array('images2', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024))),'allowEmpty' => true),

			array('images3', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024))),'allowEmpty' => true),

			array('images4', 'file','types'=>'png, jpg, gif, jpeg, PNG, JPG, JPEG, GIF', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024))),'allowEmpty' => true),

			array('ticketID, text,language,  cevap, employeesID, companyID,type,dateAdd,,employees', 'safe', 'on'=>'search'),
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
			'Employees'=>array( self::BELONGS_TO, 'Employees', 'employeesID' ),
		);
	}



	public function attributeLabels()
	{
		return array(
			'ticketID' => 'Ticket',
			'text' => Yii::t('trans','Mesaj'),
			'images1' => '1. Resim',
			'images2' => '2. Resim',
			'images3' => '3. Resim',
			'images4' => '4. Resim',
			'language' => Yii::t('trans','Dil'),
			
			'okundu' => Yii::t('trans','Okundu'),
			'cevap' => Yii::t('trans','Cevap Verildi?'),
			'employeesID' => Yii::t('trans','Kullanıcı ID'),
			'employees' => Yii::t('trans','Kullanıcı'),
			'companyID' => Yii::t('trans','Şirket ID'),
			'company' => Yii::t('trans','Şirket'),
			'type'=> Yii::t('trans','Ticket Tipi'),
			'dateAdd'=>Yii::t('trans','Tarih'),
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
		$criteria->join= 'LEFT JOIN employees e ON (e.employeesID=i.employeesID)';
		$criteria->compare('e.name',$this->employees,true);
		
		if($this->ticketID!="")
			$criteria->compare('i.ticketID',$this->ticketID-$this->getParams("ticketplus"));
		$criteria->compare('i.text',$this->text,true);
		$criteria->compare('i.type',$this->images1);
		$criteria->compare('i.language',$this->language);
		$criteria->compare('i.cevap',$this->cevap);
		$criteria->compare('i.employeesID',$this->employeesID);
		$criteria->compare('i.companyID',$this->companyID);
		$criteria->compare('i.dateAdd>',$this->dateAdd);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
                'pageSize' => 25,
            ),
            'sort'=>array(
            	'defaultOrder'=>'updateDate DESC',
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
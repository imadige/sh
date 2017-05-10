<?php

/**
 * This is the model class for table "appointments".
 *
 * The followings are the available columns in table 'appointments':
 * @property integer $appointmentsID
 * @property integer $customerdealersID
 * @property string $appointmentDate
 * @property string $not
 * @property string $dateAdd
 * @property integer $deleted
 * @property integer $worldID
 */
class Appointments extends CActiveRecord
{
	public $customerdealer;
	public $customer;
	public $dealer;
	
	public $customerdealerID;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'appointments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customerdealersID, appointmentDate, not, dateAdd, deleted, worldID,companyID,cdtype', 'required'),
			array('customerdealersID, deleted, worldID,companyID,cdtype', 'numerical', 'integerOnly'=>true),
			array('customer','safe'),
			array('appointmentsID, customerdealer, appointmentDate, not, dateAdd, deleted, worldID,companyID,customerdealerID', 'safe', 'on'=>'search'),
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
			'Customers'=>array( self::BELONGS_TO, 'Customers', 'customerdealersID' ),
			'Dealers'=>array( self::BELONGS_TO, 'Dealers', 'customerdealersID' ),
		
		);
	}
	
	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'appointmentsID' => 'ID',
			'customerdealerID' => Yii::t('trans','Müşteri ve Bayi ID'),
			'customerdealer' => Yii::t('trans','Müşteri veya Bayi'),
			'appointmentDate' => Yii::t('trans','Randevu Tarihi'),
			'not' => Yii::t('trans','Not'),
			'dateAdd' => Yii::t('trans','Müşteri'),
			'deleted' => Yii::t('trans','Silindi'),
			'worldID' => Yii::t('trans','Uygulama'),
			'dealer'=>Yii::t('trans','Bayi'),
			'customer'=>Yii::t('trans','Müşteri'),
			
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
		if($this->cdtype==1){
			$criteria->join= 'LEFT JOIN customers c ON (c.customerID=i.customerdealersID)';
			$criteria->compare('c.name',$this->customerdealer,true);
			if($this->customerdealerID!="")
				$criteria->compare('c.customerID',$this->customerdealerID-$this->getParams("dealercustomerplus"));
			
		}elseif($this->cdtype==2){
			$criteria->join= 'LEFT JOIN dealers d ON (d.dealersID=i.customerdealersID)';
			$criteria->compare('d.name',$this->customerdealer,true);
			if($this->customerdealerID!="")
				$criteria->compare('d.dealersID',$this->customerdealerID-$this->getParams("dealerplus"));
			
		}
		if($this->appointmentsID!="")
			$criteria->compare('i.appointmentsID',$this->appointmentsID-$this->getParams("appointmentsplus"));
		$criteria->compare('i.appointmentDate>',$this->appointmentDate);
		$criteria->compare('i.not',$this->not,true);
		$criteria->compare('i.dateAdd',$this->dateAdd,true);
		$criteria->compare('i.deleted',$this->deleted);
		$criteria->compare('i.worldID',$this->worldID);
		$criteria->compare('i.companyID',$this->companyID);
		$criteria->compare('i.cdtype',$this->cdtype);

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
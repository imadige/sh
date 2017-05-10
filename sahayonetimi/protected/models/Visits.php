<?php

/**
 * This is the model class for table "visits".
 *
 * The followings are the available columns in table 'visits':
 * @property integer $visitsID
 * @property string $visitDate
 * @property integer $appointmentsID
 * @property integer $visitType
 * @property string $explanation
 * @property integer $status
 * @property integer $customerdealerID
 * @property integer $worldID
 * @property integer $companyID
 * @property integer $deleted
 * @property integer $employeesID
 * @property integer $cdtype
 */
class Visits extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Visits the static model class
	 */
	public $customerdealer;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'visits';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('visitDate, visitType, status, customerdealerID, worldID, companyID, deleted, employeesID, cdtype', 'required'),
			array('appointmentsID, visitType, status, customerdealerID, worldID, companyID, deleted, employeesID, cdtype', 'numerical', 'integerOnly'=>true),
			array('explanation', 'safe'),
			array('appointmentsID','control'),
			// Please remove those attributes that should not be searched.
			array('visitsID, visitDate, appointmentsID, visitType, explanation, status, customerdealerID, worldID, companyID, deleted, employeesID, cdtype,customerdealer', 'safe', 'on'=>'search'),
		);
	}

	
	public function control($attribute,$params)
	{
		if($this->appointmentsID!=""){
			$modelAppointments=Appointments::model()->count("appointmentsID=:appointmentsID AND companyID=:companyID AND worldID=:worldID",array(":appointmentsID"=>$this->appointmentsID,":companyID"=>yii::app()->user->getState('companyID'),":worldID"=>yii::app()->user->getState('worldID')));
			
			if($modelAppointments<1)
				$this->addError('appointmentsID', Yii::t('trans','Randevu ID bulunamadı.'));
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
			'Customers'=>array( self::BELONGS_TO, 'Customers', 'customerdealerID' ),
			'Dealers'=>array( self::BELONGS_TO, 'Dealers', 'customerdealerID' ),
			'Employees'=>array( self::BELONGS_TO, 'Employees', 'employeesID' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'visitsID' => 'ID',
			'visitDate' => Yii::t('trans','Ziyaret Tarihi'),
			'appointmentsID' => Yii::t('trans','Randevu ID'),
			'visitType' => Yii::t('trans','Ziyaret Tipi'),
			'explanation' => Yii::t('trans','Açıklama'),
			'status' => Yii::t('trans','Ziyaret Durumu'),
			'customerdealerID' => Yii::t('trans','Müşteri veya Bayi ID'),
			'customerdealer' => Yii::t('trans','Müşteri veya Bayi'),
			'worldID' => 'World',
			'companyID' => 'Company',
			'deleted' => 'Deleted',
			'employeesID' =>  Yii::t('trans','Ziyareti Yapan Kullanıcı'),
			'cdtype' => 'Cdtype',
			'sales' =>  Yii::t('trans','Satış'),
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
			$criteria->join= 'LEFT JOIN customers c ON (c.customerID=i.customerdealerID) LEFT JOIN employees e ON (e.employeesID=i.employeesID)';
			$criteria->compare('c.name',$this->customerdealer,true);
			if($this->customerdealerID!="")
				$criteria->compare('c.customerID',$this->customerdealerID-$this->getParams("dealercustomerplus"));
			
		}elseif($this->cdtype==2){
			$criteria->join= 'LEFT JOIN dealers d ON (d.dealersID=i.customerdealerID) LEFT JOIN employees e ON (e.employeesID=i.employeesID)';
			$criteria->compare('d.name',$this->customerdealer,true);
			if($this->customerdealerID!="")
				$criteria->compare('d.dealersID',$this->customerdealerID-$this->getParams("dealerplus"));
			
		}
		
		if($this->visitsID!="")
			$criteria->compare('i.visitsID',$this->visitsID-$this->getParams("visitsplus"));
		$criteria->compare('i.visitDate >',$this->visitDate);
		$criteria->compare('i.appointmentsID',$this->appointmentsID);
		$criteria->compare('i.visitType',$this->visitType);
		$criteria->compare('i.explanation',$this->explanation,true);
		$criteria->compare('i.status',$this->status);
		$criteria->compare('i.worldID',$this->worldID);
		$criteria->compare('i.companyID',$this->companyID);
		$criteria->compare('i.deleted',$this->deleted);
		$criteria->compare('e.name',$this->employeesID,true);
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
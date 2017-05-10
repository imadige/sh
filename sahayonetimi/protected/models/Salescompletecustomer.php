<?php

/**
 * This is the model class for table "salescompletecustomer".
 *
 * The followings are the available columns in table 'salescompletecustomer':
 * @property integer $salescompleteID
 * @property integer $customerdealerID
 * @property integer $companyID
 * @property integer $worldID
 * @property integer $employeesID
 * @property integer $salesdetailID
 */
class Salescompletecustomer extends CActiveRecord
{
	public $customer;
	

	public $received1;
	public $received2;
	public $receivedCur;
	
	
	public $dealerID;
	public $customerID;
	public $employeesName;
	
	public $Warehouse;
	
	public $warehouseID;
	
	
	public $name;
	public $taxno;
	public $taxnotype;
	public $taxoffice;
	public $phone;
	public $cphone;
	public $adress;
	public $email;
	public $country;
	public $city;
	public $fax;
	
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'salescompletecustomer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customerdealerID, companyID, worldID, employeesID, cdtype,salesStatus,salesEs,salesEsDate,dateAdd', 'required'),
			array('customerdealerID, companyID, worldID, employeesID,cdtype,salesStatus,salesEs,visitsID', 'numerical', 'integerOnly'=>true),
			array('receivedCur,received1,received2,customer,dealerID,Warehouse,customerID,employeesName','safe'),
			array('salescompleteID, customerdealerID, companyID, worldID, employeesID,cdtype,salesStatus,salesEs,salesEsDate,dateAdd,dealerID,Warehouse,customerID,employeesName,visitsID', 'safe', 'on'=>'search'),
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
			'Customers'=>array( self::BELONGS_TO, 'Customers', 'customerdealerID' ),
			'Dealers'=>array( self::BELONGS_TO, 'Dealers', 'customerdealerID' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'salescompleteID' => Yii::t('trans','Filo'),
			'customerdealerID' => Yii::t('trans','Müşteri'),
			'dealerID' => Yii::t('trans','Bayi'),
			'companyID' => Yii::t('trans','Şirket'),
			'worldID' => Yii::t('trans','Uygulama'),
			'employeesID' => Yii::t('trans','Satışı Gerçekleştiren Kullanıcı ID'),
			'salesStatus'=>Yii::t('trans','Satış Durumu'),
			'salesEs'=>Yii::t('trans','Filo Konumu'),
			'salesEsDate'=>Yii::t('trans','Satış Konum Tarihi'),
			'receivedPrice'=>Yii::t('trans','Tahsis Edilen Ücret'),
			'dateAdd'=>Yii::t('trans','Satış Tarihi'),
			'adress'=>Yii::t('trans','Adres'),
			'email' => Yii::t('trans','E-Posta'),
			'phone' => Yii::t('trans','Telefon'),
			'cphone' => Yii::t('trans','Cep Telefon'),
			'country' => Yii::t('trans','Ülke'),
			'city' => Yii::t('trans','İl'),
			'county' => Yii::t('trans','İlçe'),
			'customerID'=>Yii::t('trans','Müşteri'),
			'sdealerID'=>Yii::t('trans','Bayi ID'),
			'scustomerID'=>Yii::t('trans','Müşteri ID'),
			'employeesName'=>Yii::t('trans','Satışı Gerçekleştiren Kullanıcı İsmi'),
			'visits'=>Yii::t('trans','Ziyaret'),
			'visitsType'=>Yii::t('trans','Ziyaret Tipi'),
			'visitsID'=>Yii::t('trans','Ziyaret ID'),
			'taxno'=>Yii::t('trans','Vergi Numarası'),
			'taxoffice'=>Yii::t('trans','Vergi Dairesi'),
			'follownumber'=>Yii::t('trans','Kargo Takip No'),
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
			$criteria->compare('c.name',$this->customerID,true);
			$criteria->compare('e.name',$this->employeesName,true);
		}elseif($this->cdtype==2){
			$criteria->join= 'LEFT JOIN dealers d ON (d.dealersID=i.customerdealerID) LEFT JOIN employees e ON (e.employeesID=i.employeesID)';
			$criteria->compare('d.name',$this->dealerID,true);
			$criteria->compare('e.name',$this->employeesName,true);
		}
		if($this->salescompleteID!="")
			$criteria->compare('i.salescompleteID',$this->salescompleteID-$this->getParams("defultfiloplus"));
		
		if($this->Warehouse==true){
			$criteria->condition="i.salesEs=1 OR i.salesEs=2";
			
		}
		
		if($this->warehouseID!=""){
			$criteria->join= 'INNER JOIN salesdetail s ON (s.salescompleteID=i.salescompleteID) INNER JOIN warehouseadjustment w ON (w.salesdetailID=s.salesdetailID) AND warehouseID='.$this->warehouseID;
			
		}
		$criteria->compare('i.customerdealerID',$this->customerdealerID);	
		$criteria->compare('i.companyID',$this->companyID);
		$criteria->compare('i.worldID',$this->worldID);
		$criteria->compare('i.employeesID',$this->employeesID);
		$criteria->compare('i.cdtype',$this->cdtype);
		$criteria->compare('i.salesStatus',$this->salesStatus);
		$criteria->compare('i.salesEs',$this->salesEs);
		$criteria->compare('i.salesEsDate >',$this->salesEsDate);
		$criteria->compare('i.dateAdd >',$this->dateAdd);
		$criteria->compare('i.visitsID',$this->visitsID);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
                'pageSize' => 50,
            ),
			'sort' => array(
				'defaultOrder' => 'i.salesEs ASC, i.dateAdd DESC',
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
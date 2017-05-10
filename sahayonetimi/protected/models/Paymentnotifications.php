<?php

/**
 * This is the model class for table "paymentnotifications".
 *
 * The followings are the available columns in table 'paymentnotifications':
 * @property integer $paymentnotificationsID
 * @property string $text
 * @property integer $worldID
 * @property integer $companyID
 * @property integer $employeesID
 * @property integer $readtext
 * @property integer $customerdealerID
 * @property integer $cdtype
 */
class Paymentnotifications extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Paymentnotifications the static model class
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
		return 'paymentnotifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text, worldID, companyID, employeesID,  customerdealerID, cdtype,customerdealerName,paymentStatus', 'required'),
			array('worldID, companyID, employeesID, customerdealerID, cdtype,paymentStatus', 'numerical', 'integerOnly'=>true),
			array('customerdealerName', 'length', 'max'=>100),
			array('paymentnotificationsID, text, worldID, companyID, employeesID, customerdealerID, cdtype,customerdealerName,paymentStatus,dateAdd,unpayment', 'safe', 'on'=>'search'),
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
			'paymentnotificationsID' => 'ID',
			'text' => Yii::t('trans','Açıklama'),
			'worldID' => Yii::t('trans','Uygulama'),
			'companyID' => Yii::t('trans','Şirket'),
			'employeesID' => Yii::t('trans','Ekleyen Kullanıcı'),
			'customerdealerID' => Yii::t('trans','Müşteri veya Bayi ID'),
			'cdtype' => Yii::t('trans','Müşteri?, Bayi?'),
			'dateAdd'=>Yii::t('trans','Eklenme Tarihi'),
			'customerdealerName' => Yii::t('trans','Unvanı'),
			'paymentStatus'=>Yii::t('trans','Ödeme Durumu'),
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
		
		if($this->paymentnotificationsID!="")
			$criteria->compare('paymentnotificationsID',$this->paymentnotificationsID-$this->getParams("paymentplus"));
		$criteria->compare('text',$this->text,true);
		$criteria->compare('worldID',$this->worldID);
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('employeesID',$this->employeesID);
		$criteria->compare('customerdealerID',$this->customerdealerID);
		$criteria->compare('cdtype',$this->cdtype);
		$criteria->compare('dateAdd >',$this->dateAdd);
		$criteria->compare('customerdealerName',$this->customerdealerName,true);
		$criteria->compare('paymentStatus',$this->paymentStatus);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
                'pageSize' => 30,
            ),
			'sort' => array(
					'defaultOrder' => 'dateAdd desc',
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
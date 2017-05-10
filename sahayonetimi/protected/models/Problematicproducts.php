<?php

/**
 * This is the model class for table "problematicproducts".
 *
 * The followings are the available columns in table 'problematicproducts':
 * @property integer $problematicproductsID
 * @property integer $productsID
 * @property string $text
 * @property integer $problematicStatus
 * @property integer $customerdealerID
 * @property integer $deleted
 * @property integer $worldID
 * @property integer $companyID
 * @property string $employeesText
 */
class Problematicproducts extends CActiveRecord
{
	public $productsName;
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
		return 'problematicproducts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productsID, text, problematicStatus, deleted, worldID, companyID,cdtype,dateAdd', 'required'),
			array('productsID, problematicStatus, customerdealerID, deleted, worldID, companyID,cdtype', 'numerical', 'integerOnly'=>true),
			array('employeesText,productsName,customerdealer', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('problematicproductsID, productsID, text, problematicStatus, customerdealerID, deleted, worldID, companyID, employeesText,productsName,cdtype', 'safe', 'on'=>'search'),
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
			'Products'=>array( self::BELONGS_TO, 'Products', 'productsID' ),
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
			'problematicproductsID' => 'ID',
			'productsID' => Yii::t('trans','Ürün'),
			'productsName' => Yii::t('trans','Ürün Adı'),
			'text' => Yii::t('trans','Açıklama'),
			'problematicStatus' => Yii::t('trans','Durumu'),
			'customerdealer' => Yii::t('trans','Müşteri veya Bayi'),
			'customerdealerID' => Yii::t('trans','Müşteri veya Bayi'),
			'deleted' => Yii::t('trans','Silindi'),
			'worldID' => Yii::t('trans','Uygulama'),
			'companyID' => Yii::t('trans','Şirket'),
			'employeesText' => Yii::t('trans','Servis Açıklaması'),
			'deleted' => Yii::t('trans','Silindi'),
			'deleAdd' => Yii::t('trans','Eklenme Tarihi'),
			'barcode'=> Yii::t('trans','Barkod'),
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
			$criteria->join= 'LEFT JOIN products p ON (p.productsID=i.productsID) LEFT JOIN customers c ON (c.customerID=i.customerdealerID)';
				$criteria->compare('c.name',$this->customerdealerID,true);
		}elseif($this->cdtype==2){
			$criteria->join= 'LEFT JOIN products p ON (p.productsID=i.productsID) LEFT JOIN dealers d ON (d.dealersID=i.customerdealerID)';
			$criteria->compare('d.name',$this->customerdealerID,true);
		}
		
		if($this->problematicproductsID!=""){
			$ids=$this->problematicproductsID;
			if(strtolower(substr($ids,0,2))=="s-"){
				$ids=substr($ids,2,strlen($ids));
			}
			
			$criteria->compare('i.problematicproductsID',$ids-$this->getParams("problematicplus"));
		}
		$criteria->compare('p.name',$this->productsID);
		$criteria->compare('i.text',$this->text,true);
		$criteria->compare('i.problematicStatus',$this->problematicStatus);
	
		$criteria->compare('i.deleted',$this->deleted);
		$criteria->compare('i.worldID',$this->worldID);
		$criteria->compare('i.companyID',$this->companyID);
		$criteria->compare('i.employeesText',$this->employeesText,true);
		$criteria->compare('i.cdtype',$this->cdtype);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
                'pageSize' => 15,
            ),
			'sort' => array(
            	'defaultOrder' => 'problematicproductsID desc',
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
<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $productsID
 * @property string $name
 * @property string $text
 * @property double $purchasePrice
 * @property double $salePrice
 * @property double $tax
 * @property string $brand
 * @property string $model

 * @property integer $worldID
 */
class Products extends CActiveRecord
{
	
	public $tax;
	public $pgname;
	
	public $alis1;
	public $alis2;
	
	public $satis1;
	public $satis2;
	
	public $reduce1;
	public $reduce2;
	
	
	public $dealer1;
	public $dealer2;

	
	public $productsGroupName;
	public $productGroupsOtoSelect;
	
	public $images;
	
	public $dealersreduction;
	
	
	public $nameorder;
	public $modelorder;
	public $brandorder;
	public $saleorder;
	
	
	public $hsale;
	
	public $purchasePrice;
	public $reducedPrice;
	public $salePrice;
	public $dealerPrice;
	public $purchaseCur;
	public $reduceCur;
	public $saleCur;
	public $dealerCur;
	public $deleted;
	public $text;
	public $dateAdd;
	public $productgroupsID;
	public $worldID;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		
		return array(
			array('name, text, brand, model, productgroupsID,satis1, satis2,alis1,alis2,saleCur,purchaseCur', 'required'),
			array('worldID, deleted,purchaseCur,saleCur,reduceCur,dealerCur', 'numerical', 'integerOnly'=>true),
			array('name,brand, model', 'length', 'max'=>255),
			array('nameorder,saleorder,brandorder,modelorder,alis1, alis2, satis1, satis2,productgroupsID,reducedPrice,reduce1, reduce2,dealerPrice,dealer1,dealer2,hsale,saleCur,purchaseCur','safe'),
			
			
			array('productsID, name, text, purchasePrice, salePrice, tax, brand, model, worldID,productgroupsID,dateAdd,deleted,reducedPrice,dealerPrice,hsale', 'safe', 'on'=>'search'),
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
			'Productgroups'=>array( self::BELONGS_TO, 'Productgroups', 'productgroupsID' ),
			'Productdetail'=>array( self::HAS_ONE, 'Productdetail', 'productsID' ),
		);
	}

	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productsID' =>  Yii::t('trans','Ürün ID'),
			'name' => Yii::t('trans','Ürün Adı'),
			'text' => Yii::t('trans','Teknik Özellikleri'),
			'purchasePrice' => Yii::t('trans','Alış Fiyatı'),
			'salePrice' => Yii::t('trans','Satış Fiyatı (KDV Hariç)'),
			'dealerPrice'=>Yii::t('trans','Bayi Fiyatı (KDV Hariç)'),
			'brand' => Yii::t('trans','Marka'),
			'model' => Yii::t('trans','Model'),
			'worldID' => Yii::t('trans','Uygulama'),
			'productgroupsID'=>Yii::t('trans','Ürün Grubu'),
			'reducedPrice'=>Yii::t('trans','İndirimli Fiyatı (KDV Hariç)'),
			'purchaseCur'=>Yii::t('trans','Alış Fiyatı Para Birimi'),
			'saleCur'=>Yii::t('trans','Satış Fiyatı Para Birimi'),
			'reduceCur'=>Yii::t('trans','İndirimli Fiyatı Para Birimi'),
			'hsale' => Yii::t('trans','Satış Fiyatı (KDV Hariç)'),
			'alis1'=>Yii::t('trans','Alış Fiyatı (KDV Hariç)'),
			'satis1'=>Yii::t('trans','Satış Fiyatı (KDV Hariç)'),
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
		$criteria->join= 'LEFT JOIN productdetail pd ON (i.productsID=pd.productsID) LEFT JOIN productgroups p ON (i.productgroupsID=p.productgroupsID)';
		
		if($this->productsID!="")
			$criteria->compare('i.productsID',$this->productsID-$this->getParams("defultproductplus"));
		$criteria->compare('i.name',$this->name,true);
		$criteria->compare('pd.text',$this->text,true);
		$criteria->compare('pd.purchasePrice',$this->purchasePrice);
		$criteria->compare('pd.salePrice',$this->salePrice);
		$criteria->compare('pd.reducedPrice',$this->reducedPrice);
		$criteria->compare('pd.dealerPrice',$this->dealerPrice);
		
		$criteria->compare('i.brand',$this->brand,true);
		$criteria->compare('i.model',$this->model,true);
		$criteria->compare('pd.worldID',$this->worldID);
		
		$criteria->compare('pd.dateAdd >',$this->dateAdd);
		$criteria->compare('pd.deleted',$this->deleted);
		
		if($this->productgroupsID!=""){
			$txt=$this->getProductgroups2($this->productgroupsID);
			$criteria->addcondition('i.productgroupsID IN('.substr($txt,0,strlen($txt)-1).')');
		}
		
		if($this->hsale!=""){
		
			$criteria->addcondition('i.salePrice >='.$this->hsale.' or i.reducedPrice >='.$this->hsale.' or i.dealerPrice >='.$this->hsale);
		
		}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
                'pageSize' => 15,
            ),
			'sort' => array(
            	'defaultOrder' => 'productsID desc',
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
	
	public function getProductgroups2($id){
		 $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1 and productgroupsID=:productgroupsID",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID"),':productgroupsID'=>$id),
             'order'=>'name asc',
             ));
			 $list ="";
			foreach($modelCustomergroups as $key=>$value){
				
				$list.=$value->productgroupsID.",";
				$list=$this->katListele2($value->productgroupsID,$list);
			}
			
			return $list;
	}
	
	private function katListele2($katid, &$list)
	{
		
		 $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1 AND pgID=:pgID",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID"),':pgID'=>$katid),
             'order'=>'name asc',
             ));
		foreach($modelCustomergroups as $key=>$value){
			
			
			$list.=$value->productgroupsID.",";
			$list=$this->katListele2($value->productgroupsID,$list);
		}
		
		return $list;
	}
}
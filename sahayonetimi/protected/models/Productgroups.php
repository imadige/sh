<?php

/**
 * This is the model class for table "productgroups".
 *
 * The followings are the available columns in table 'productgroups':
 * @property integer $productgroupsID
 * @property string $name
 * @property integer $companyID
 * @property integer $worldID
 * @property integer $pgID
 */
class Productgroups extends CActiveRecord
{
	public $tx1;
	public $tx2;
	
	
	public $updates;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'productgroups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, worldID, deleted, tax', 'required'),
			array('companyID, worldID, pgID, deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('tx1,tx2','safe'),
			array('name','name_control'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productgroupsID, name, companyID, worldID, pgID, deleted', 'safe', 'on'=>'search'),
		);
	}
	
	
	public function name_control($attribute,$params)
	{
		if($this->updates!=true){
			$modelProductgroups=Productgroups::model()->count("name=:name AND companyID=:companyID AND worldID=:worldID",array(":name"=>$this->name,":companyID"=>yii::app()->user->getState('companyID'),":worldID"=>yii::app()->user->getState('worldID')));
			
			if($modelProductgroups>0)
				$this->addError('name', Yii::t('trans','Grup ismi daha önce kullanılmış.'));
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
			'productgroupsID' => 'ID',
			'name' => Yii::t('trans','Grup Adı'),
			'companyID' => Yii::t('trans','Şirket'),
			'worldID' => Yii::t('trans','Uygulama'),
			'pgID' => Yii::t('trans','Bağlı Grub'),
			'deleted'=> Yii::t('trans','Silindi'),
			'tax' => Yii::t('trans','KDV (%)'),
		
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

		$criteria->compare('productgroupsID',$this->productgroupsID);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('worldID',$this->worldID);
		$criteria->compare('pgID',$this->pgID);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('tax',$this->tax);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
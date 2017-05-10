<?php

/**
 * This is the model class for table "customergroups".
 *
 * The followings are the available columns in table 'customergroups':
 * @property integer $customerGroupsID
 * @property string $name
 * @property integer $companyID
 * @property integer $deleted
 */
class Customergroups extends CActiveRecord
{
	public $cgID;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customergroups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, companyID, deleted,worldID', 'required'),
			array('companyID, deleted,worldID', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customerGroupsID, name, companyID, deleted,worldID', 'safe', 'on'=>'search'),
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
			'customerGroupsID' => 'ID',
			'name' => Yii::t('trans','Grup İsmi'),
			'companyID' => Yii::t('trans','Şirket'),
			'deleted' => Yii::t('trans','Silindi'),
			
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

		$criteria->compare('customerGroupsID',$this->customerGroupsID);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('worldID',$this->worldID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
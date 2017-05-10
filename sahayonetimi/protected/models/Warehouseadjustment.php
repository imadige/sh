<?php

/**
 * This is the model class for table "warehouseadjustment".
 *
 * The followings are the available columns in table 'warehouseadjustment':
 * @property integer $warehouseadjustmentID
 * @property integer $salesdetailID
 * @property integer $warehouseID
 * @property integer $companyID
 * @property integer $worldID
 * @property integer $number
 */
class Warehouseadjustment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Warehouseadjustment the static model class
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
		return 'warehouseadjustment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('salesdetailID, warehouseID, companyID, worldID, number,salescompleteID', 'required'),
			array('salesdetailID, warehouseID, companyID, worldID, number,salescompleteID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('warehouseadjustmentID, salesdetailID, warehouseID, companyID, worldID, number,salescompleteID', 'safe', 'on'=>'search'),
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
			'warehouseadjustmentID' => 'Warehouseadjustment',
			'salesdetailID' => 'Salesdetail',
			'warehouseID' => 'Warehouse',
			'companyID' => 'Company',
			'worldID' => 'World',
			'number' => 'Number',
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

		$criteria->compare('warehouseadjustmentID',$this->warehouseadjustmentID);
		$criteria->compare('salesdetailID',$this->salesdetailID);
		$criteria->compare('warehouseID',$this->warehouseID);
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('worldID',$this->worldID);
		$criteria->compare('number',$this->number);
		$criteria->compare('salescompleteID',$this->salescompleteID);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
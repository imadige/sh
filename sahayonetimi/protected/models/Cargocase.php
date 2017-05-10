<?php

/**
 * This is the model class for table "cargocase".
 *
 * The followings are the available columns in table 'cargocase':
 * @property integer $cargocaseID
 * @property integer $warehouseID
 * @property integer $salescompleteID
 * @property integer $companyID
 * @property integer $worldID
 * @property integer $type
 */
class Cargocase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cargocase the static model class
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
		return 'cargocase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('warehouseID, salescompleteID, companyID, worldID, type', 'required'),
			array('warehouseID, salescompleteID, companyID, worldID, type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cargocaseID, warehouseID, salescompleteID, companyID, worldID, type', 'safe', 'on'=>'search'),
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
			'cargocaseID' => 'Cargocase',
			'warehouseID' => 'Warehouse',
			'salescompleteID' => 'Salescomplete',
			'companyID' => 'Company',
			'worldID' => 'World',
			'type' => 'Type',
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

		$criteria->compare('cargocaseID',$this->cargocaseID);
		$criteria->compare('warehouseID',$this->warehouseID);
		$criteria->compare('salescompleteID',$this->salescompleteID);
		$criteria->compare('companyID',$this->companyID);
		$criteria->compare('worldID',$this->worldID);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
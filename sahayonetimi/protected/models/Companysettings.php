<?php

/**
 * This is the model class for table "companysettings".
 *
 * The followings are the available columns in table 'companysettings':
 * @property integer $companysettingsID
 * @property string $logo
 * @property integer $cur
 * @property integer $companyID
 */
class Companysettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Companysettings the static model class
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
		return 'companysettings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cur, companyID', 'required'),
			array('cur, companyID', 'numerical', 'integerOnly'=>true),
			array('logo', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('companysettingsID, logo, cur, companyID', 'safe', 'on'=>'search'),
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
			'companysettingsID' => 'Companysettings',
			'logo' => 'Logo',
			'cur' => 'Cur',
			'companyID' => 'Company',
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

		$criteria->compare('companysettingsID',$this->companysettingsID);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('cur',$this->cur);
		$criteria->compare('companyID',$this->companyID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
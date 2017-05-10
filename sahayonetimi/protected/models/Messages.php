<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $messagesID
 * @property string $text
 * @property integer $employeesID
 * @property string $dateAdd
 */
class Messages extends CActiveRecord
{
	public $employees;
	public $whomID;
	public $whomTextField;
	public $name;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text, employeesID, dateAdd,companyID,whomID,updateDate', 'required'),
			array('employeesID,companyID', 'numerical', 'integerOnly'=>true),
			array('employees,whomID,whomi','safe'),
			array('messagesID,companyID, text, employeesID, dateAdd,employees,updateDate', 'safe', 'on'=>'search'),
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
			'Employees'=>array( self::BELONGS_TO, 'Employees', 'employeesID' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'messagesID' => 'ID',
			'text' =>Yii::t('trans','Mesaj'),
			'employeesID' => Yii::t('trans','Kullanıcı ID'),
			'employees' => Yii::t('trans','Kullanıcı'),
			'dateAdd' => Yii::t('trans','Tarih'),
			'companyID'=> Yii::t('trans','Şirket'),
			'whomTextField'=>Yii::t('trans','Kime'),
			'whomID'=>Yii::t('trans','Kime'),
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
		$criteria->join= 'LEFT JOIN employees e ON (e.employeesID=i.employeesID) inner JOIN messagesusers m ON (m.messagesID=i.messagesID)';
		$criteria->compare('e.name',$this->employees,true);

		if($this->messagesID!="")
			$criteria->compare('i.messagesID',$this->messagesID-$this->getParams("messagesplus"));
		$criteria->compare('i.text',$this->text,true);
		$criteria->compare('i.employeesID',$this->employeesID);
		$criteria->compare('i.dateAdd',$this->dateAdd,true);
		$criteria->compare('i.companyID',$this->companyID);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
                'pageSize' => 25,
            ),
            'sort'=>array(
            	'defaultOrder'=>'updateDate DESC',
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
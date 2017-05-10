<?php

/**
 * This is the model class for table "mailserver".
 *
 * The followings are the available columns in table 'mailserver':
 * @property integer $idmailserver
 * @property string $mailserver
 * @property string $mailuser
 * @property string $mailparola
 */
class Mailserver extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mailserver the static model class
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
		return 'mailserver';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idmailserver', 'required'),
			array('idmailserver', 'numerical', 'integerOnly'=>true),
			array('mailserver, mailuser, mailparola', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idmailserver, mailserver, mailuser, mailparola', 'safe', 'on'=>'search'),
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
			'idmailserver' => 'Idmailserver',
			'mailserver' => 'Mailserver',
			'mailuser' => 'Mailuser',
			'mailparola' => 'Mailparola',
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

		$criteria->compare('idmailserver',$this->idmailserver);
		$criteria->compare('mailserver',$this->mailserver,true);
		$criteria->compare('mailuser',$this->mailuser,true);
		$criteria->compare('mailparola',$this->mailparola,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
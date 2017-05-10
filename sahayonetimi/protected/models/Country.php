<?php

/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property string $code
 * @property string $name
 * @property string $currencyCode
 * @property string $fipsCode
 * @property string $isoNumeric
 * @property string $north
 * @property string $south
 * @property string $east
 * @property string $west
 * @property string $capital
 * @property string $continentName
 * @property string $continent
 * @property string $areaInSqKm
 * @property string $languages
 * @property string $isoAlpha3
 * @property integer $geonameId
 * @property string $phoneCode
 */
class Country extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
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
		return 'country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('geonameId', 'numerical', 'integerOnly'=>true),
			array('code, fipsCode, continent', 'length', 'max'=>2),
			array('name', 'length', 'max'=>45),
			array('currencyCode, isoAlpha3', 'length', 'max'=>3),
			array('isoNumeric', 'length', 'max'=>4),
			array('north, south, east, west, capital', 'length', 'max'=>30),
			array('continentName, phoneCode', 'length', 'max'=>15),
			array('areaInSqKm', 'length', 'max'=>20),
			array('languages', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('code, name, currencyCode, fipsCode, isoNumeric, north, south, east, west, capital, continentName, continent, areaInSqKm, languages, isoAlpha3, geonameId, phoneCode', 'safe', 'on'=>'search'),
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
			'code' => 'code',
			'name' => 'name',
			'currencyCode' => 'Currency Code',
			'fipsCode' => 'Fips Code',
			'isoNumeric' => 'Iso Numeric',
			'north' => 'North',
			'south' => 'South',
			'east' => 'East',
			'west' => 'West',
			'capital' => 'Capital',
			'continentName' => 'Continent Name',
			'continent' => 'Continent',
			'areaInSqKm' => 'Area In Sq Km',
			'languages' => 'Languages',
			'isoAlpha3' => 'Iso Alpha3',
			'geonameId' => 'Geoname',
			'phoneCode' => 'Phone Code',
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

		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('currencyCode',$this->currencyCode,true);
		$criteria->compare('fipsCode',$this->fipsCode,true);
		$criteria->compare('isoNumeric',$this->isoNumeric,true);
		$criteria->compare('north',$this->north,true);
		$criteria->compare('south',$this->south,true);
		$criteria->compare('east',$this->east,true);
		$criteria->compare('west',$this->west,true);
		$criteria->compare('capital',$this->capital,true);
		$criteria->compare('continentName',$this->continentName,true);
		$criteria->compare('continent',$this->continent,true);
		$criteria->compare('areaInSqKm',$this->areaInSqKm,true);
		$criteria->compare('languages',$this->languages,true);
		$criteria->compare('isoAlpha3',$this->isoAlpha3,true);
		$criteria->compare('geonameId',$this->geonameId);
		$criteria->compare('phoneCode',$this->phoneCode,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
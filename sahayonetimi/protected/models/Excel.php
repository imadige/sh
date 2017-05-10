<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class Excel extends CFormModel
{
	public $excel;
	private $_maxSize;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		$this->_maxSize = 1024 * 500;
		return array(
			// name, email, subject and body are required
			
			// email has to be a valid email address
			array('excel', 'file','types'=>'xls, XLS,xlsx,XLSX', 'maxSize' => $this->_maxSize,
                'tooLarge' => Yii::t('trans', 'Dosya çok büyük, en fazla {size} Kb olabilir',array('{size}'=> (int) ($this->_maxSize / 1024)))),
			// verifyCode needs to be entered correctly
			
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
	}
}
<?PHP
$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true,'closeText'=>'&times;'), // success, info, warning, error or danger
			
        ),
    )); 
	
$this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'link',
	 'type'=>'primary',
	 'size' => 'large',
	 'url'=>Yii::app()->createUrl('site'),
	  'htmlOptions'=>array('style'=>'margin-right:50px'),
	'label'=>Yii::t('trans','Anasayfaya Dön'),
	)); 

?>
<?php
/* @var $this PaymentnotificationsController */
/* @var $model Paymentnotifications */
/* @var $form bootstrap.widgets.TbActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div class="filterGroup">
	<div class="row">
		<?php echo $form->label($model,'paymentnotificationsID'); ?>
		<?php echo $form->textField($model,'paymentnotificationsID'); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'cdtype'); ?>
		<?php 
		$array=array(""=>"");
		foreach(PaymentnotificationsController::getParams("cdtype") as $key=>$value)
			$array[$key]=$value;
		echo $form->dropDownList($model,'cdtype',$array); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'dateAdd'); ?>
		<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'Paymentnotifications[dateAdd]',
			'options'=>array(
				'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
				'showOn'=>'button', // 'focus', 'button', 'both'
				'buttonText'=>Yii::t('trans','Takvimden Tarih Seçiniz'),
				'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
				'buttonImageOnly'=>true,
				'dateFormat'=>'dd-mm-yy',
			),
			'htmlOptions'=>array(
				'style'=>'width:136px;vertical-align:top'
			),
		));
		?>
	</div>
 </div>
 
 <div class="filterGroup">   
   	<div class="row">
		<?php echo $form->label($model,'customerdealerID'); ?>
		<?php echo $form->textField($model,'customerdealerID'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'customerdealerName'); ?>
		<?php echo $form->textField($model,'customerdealerName'); ?>
	</div>
 </div>
	<div class="row buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Filitrele'),
        	)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
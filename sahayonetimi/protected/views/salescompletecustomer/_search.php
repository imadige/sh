<?php
/* @var $this SalescompletecustomerController */
/* @var $model Salescompletecustomer */
/* @var $form bootstrap.widgets.TbActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<div class="filterGroup">
	<div class="row">
		<?php echo $form->label($model,'salescompleteID'); ?>
		<?php echo $form->textField($model,'salescompleteID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customerID'); ?>
		<?php echo $form->textField($model,'customerID'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'scustomerID'); ?>
		<?php echo $form->textField($model,'customerdealerID'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'employeesName'); ?>
		<?php echo $form->textField($model,'employeesName'); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'employeesID'); ?>
		<?php echo $form->textField($model,'employeesID'); ?>
	</div>

</div>
	
<div class="filterGroup">
	<div class="row">
		<?php echo $form->label($model,'salesStatus'); ?>
		<?php echo $form->textField($model,'salesStatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'salesEs'); ?>
		<?php echo $form->textField($model,'salesEs'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'salesEsDate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'Salescompletecustomer[salesEsDate]',
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
		)); ?>
	</div>
</div>

	<div class="row buttons clear">
		 <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Filitrele'),
        	)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
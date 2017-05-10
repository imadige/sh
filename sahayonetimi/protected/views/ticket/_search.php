<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ticketID'); ?>
		<?php echo $form->textField($model,'ticketID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'images1'); ?>
		<?php echo $form->textField($model,'images1',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'images2'); ?>
		<?php echo $form->textField($model,'images2',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'images3'); ?>
		<?php echo $form->textField($model,'images3',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'images4'); ?>
		<?php echo $form->textField($model,'images4',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'language'); ?>
		<?php echo $form->textField($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'translateText'); ?>
		<?php echo $form->textArea($model,'translateText',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'okundu'); ?>
		<?php echo $form->textField($model,'okundu'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cevap'); ?>
		<?php echo $form->textField($model,'cevap'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
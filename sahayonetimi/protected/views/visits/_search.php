<?php
/* @var $this VisitsController */
/* @var $model Visits */
/* @var $form bootstrap.widgets.TbActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<div class="filterGroup">
	<div class="row">
		<?php echo $form->label($model,'visitsID'); ?>
		<?php echo $form->textField($model,'visitsID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visitDate'); ?>
		<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'Visits[visitDate]',
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

	<div class="row">
		<?php echo $form->label($model,'appointmentsID'); ?>
		<?php echo $form->textField($model,'appointmentsID'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'employeesID'); ?>
		<?php echo $form->textField($model,'employeesID'); ?>
	</div>
</div>
<div class="filterGroup">
	<div class="row">
		<?php echo $form->label($model,'visitType'); ?>
		<?php echo $form->textField($model,'visitType'); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customerdealerID'); ?>
		<?php echo $form->textField($model,'customerdealerID'); ?>
	</div>
    <div class="row">
		<?php echo $form->label($model,'customerdealer'); ?>
		<?php echo $form->textField($model,'customerdealer'); ?>
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
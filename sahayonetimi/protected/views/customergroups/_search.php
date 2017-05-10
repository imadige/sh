<?php
/* @var $this CustomergroupsController */
/* @var $model Customergroups */
/* @var $form bootstrap.widgets.TbActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'customerGroupsID'); ?>
		<?php echo $form->textField($model,'customerGroupsID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
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
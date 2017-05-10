
<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div class="filterGroup" style="width:300px">
	<div class="row">
		<?php echo $form->label($model,'appointmentsID'); ?>
		<?php echo $form->textField($model,'appointmentsID',array('style'=>'width:136px')); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'appointmentDate'); ?>
		<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'Appointments[appointmentDate]',
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
		<?php echo $form->label($model,'customerdealer'); ?>
		<?php echo $form->textField($model,'customerdealer'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'customerdealerID'); ?>
		<?php echo $form->textField($model,'customerdealerID'); ?>
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
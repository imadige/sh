<style type="text/css">
input[type=text]{
	width:220px;
	height:25px;
	background:#CCE9F2;
	padding-left:10px;
}
input[type=password]{
	width:220px;
	height:25px;
	background:#CCE9F2;
	padding-left:10px;
}
select{
	width:238px;
	height:35px;
	background:#CCE9F2;
	padding-top:5px;
}
textarea{
	background:#CCE9F2;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'appointments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customerdealer'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'customerdealer',
			'options' => array(
                'showAnim' => 'fold',
                //remove if you dont need to store the id, like i do...
                'select' => 'js:function(event, ui){ 
				
				$("#Appointments_customerdealersID").val(ui.item.id);
				$("#Appointments_cdtype").val(ui.item.cdtype);
				}'
            ),

			'source'=>$this->createUrl('visits/getcustomerdealer'),
			'htmlOptions'=>array(
				'size'=>'50'
			),
		)); ?>
			 
            
            <span class="help_"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
                <div class="text"><?=Yii::t('trans','<b>Otamatik Tamamlama</b><br>Müşteri ismini yazın ve listeden müşterinizi seçin. İşlemi otomatik tamamlayın.')?> 		</div>
            </span>
		<?php echo $form->hiddenField($model,'customerdealersID'); ?>
        <?php echo $form->hiddenField($model,'cdtype'); ?>
		<?php echo $form->error($model,'customerdealersID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'appointmentDate'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
   		 $this->widget('CJuiDateTimePicker',array(
        'model'=>$model,
        'attribute'=>'appointmentDate', //attribute name
                'mode'=>'datetime', //use "time","date" or "datetime" (default)
				'options'=>array(
				'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
				'showOn'=>'button', // 'focus', 'button', 'both'
				'buttonText'=>Yii::t('trans','Takvimden Tarih Seçiniz'),
				'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
				'buttonImageOnly'=>true,
			),
			));
		?>
		<?php echo $form->error($model,'appointmentDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'not'); ?>
		<?php echo $form->textArea($model,'not',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'not'); ?>
	</div>

	

	<div class="row buttons">
		  <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>$model->isNewRecord ? Yii::t('trans','Ekle') : Yii::t('trans','Kaydet'),
        	)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
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
	'id'=>'visits-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	<?php echo $form->errorSummary($model); ?>
<div class="searcGroup">

	<div class="row">
		<?php echo $form->labelEx($model,'customerdealer'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'customerdealer',
			'options' => array(
                'showAnim' => 'fold',
                //remove if you dont need to store the id, like i do...
                'select' => 'js:function(event, ui){ 
				
				$("#Visits_customerdealerID").val(ui.item.id);
				$("#Visits_cdtype").val(ui.item.cdtype);
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
        <?php echo $form->hiddenField($model,'customerdealerID'); ?>
        <?php echo $form->hiddenField($model,'cdtype'); ?>
		<?php echo $form->error($model,'customerdealerID'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'visitType'); ?>
		<?php
			$array=array(""=>"");
			foreach(VisitsController::getParams("visitType") as $key=>$value)
				$array[$key]=$value;
				
		 echo $form->dropDownList($model,'visitType',$array); ?>
		<?php echo $form->error($model,'visitType'); ?>
	</div>
    
</div>

<div class="searcGroup">
	

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php 
			$array=array(""=>"");
			foreach(VisitsController::getParams("visitStatus") as $key=>$value)
				$array[$key]=$value;
				
		 echo $form->dropDownList($model,'status',$array); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
    
    <div class="row randevu" style="display:none;">
		<?php echo $form->labelEx($model,'appointmentsID'); ?>
		<?php echo $form->textField($model,'appointmentsID'); ?>
		<?php echo $form->error($model,'appointmentsID'); ?>
	</div>

</div>


	<div class="row clear">
		<?php echo $form->labelEx($model,'explanation'); ?>
		<?php echo $form->textArea($model,'explanation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'explanation'); ?>
	</div>

	    
	<div class="row buttons clear">
		 <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'large',
            'label'=>$model->isNewRecord ? Yii::t('trans','Ekle') : Yii::t('trans','Kaydet'),
        	)); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript">
$('#Visits_visitType').change(function(){
	if($(this).val()==3)
		$('.randevu').fadeIn();
	else
		$('.randevu').fadeOut();
	
});

<?PHP if($model->visitType==3):?>
	$('.randevu').show();
<?PHP endif;?>

<?PHP if(isset($_GET["appointmentsID"])):?>
	$('.randevu').show();
	$('#Visits_visitType').val(3);
<?PHP endif;?>
</script>
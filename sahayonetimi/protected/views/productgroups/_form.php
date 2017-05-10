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

<?php

	$pgIDs=$model->pgID;

 $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'productgroups-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
    <?php echo $form->labelEx($model,'pgID'); ?>
    <?php echo $form->dropDownList($model,'pgID',ProductgroupsController::getProductgroups_()); ?>
    <?php echo $form->error($model,'pgID'); ?>
    </div>
  
  
    <div class="row">
		<?php echo $form->labelEx($model,'tax'); ?>
		<?php echo $form->textField($model,'tx1',array('style'=>'width:80px;text-align:right','onkeypress'=>'return isNumber(event)')); ?> , 
        <?php echo $form->textField($model,'tx2',array('style'=>'width:30px','maxlength'=>2,'onkeypress'=>'return isNumber(event)')); ?> 
		<?php echo $form->error($model,'tax'); ?>
	</div>
    
  
	<div class="row buttons">
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

function isNumber(evt)  
{  
  var charCode = (evt.which) ? evt.which : event.keyCode  
  if (charCode > 31 && (charCode < 48 || charCode > 57))  
   return false;  
  return true; 
   
}  

$('#Productgroups_pgID').change(function(){
	
		var dataString = 'id='+ $(this).val();
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("productgroups/gettax")?>", 
			 data: dataString,
			 success: function(data)
			 {
				
				 if(data.tax!=""){
					 var tax=data.tax;
					 var spttax=tax.split(".");
					 
					 $('#Productgroups_tx1').val(spttax[0]);
					 if(typeof spttax[1] === 'undefined')
					 	$('#Productgroups_tx2').val("00");
					 else
					 	$('#Productgroups_tx2').val(spttax[1]);
				 }
			 }
			 
			});
			
});
</script>
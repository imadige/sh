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
.input-append .add-on, .input-prepend .add-on{
	height:25px;
	margin-top:3px;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'dealers-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	<?php echo $form->errorSummary($model); ?>

<div class="searcGroup">
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php
		$criteria=new CDbCriteria();
		$criteria->select="code, name";
		$criteria->condition="code!='TR'";
		$modelCountry= Country::model()->findAll($criteria);
		$country = array('TR'=>'Türkiye');
		foreach($modelCountry as $key => $value){
			$country[$value->code]=$value->name;
		}
		
		 echo $form->dropDownList($model,'country',$country); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->dropDownList($model,'city',array())?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'county'); ?>
		<?php echo $form->textField($model,'county',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'county'); ?>
	</div>
</div>

<div class="searcGroup">
	<div class="row">
		 <?php echo $form->textFieldRow($model, 'email', array('prepend'=>'@','style'=>'width:195px;')); ?>
		
	</div>



    
    <div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cphone'); ?>
		<?php echo $form->textField($model,'cphone',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'cphone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'taxno'); ?>
		<?php echo $form->dropDownList($model,'taxnotype',DealersController::getParams("taxnoType"),array('style'=>'width:109px')); ?> <?php echo $form->textField($model,'taxno',array('maxlength'=>45,'style'=>'width:109px')); ?>
		<?php echo $form->error($model,'taxno'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'taxoffice'); ?>
		<?php echo $form->textField($model,'taxoffice',array('maxlength'=>45)); ?>
		<?php echo $form->error($model,'taxoffice'); ?>
	</div>
    

</div>

	<div class="row clear">
		<?php echo $form->labelEx($model,'adres'); ?>
		<?php echo $form->textArea($model,'adres',array('style'=>'width:350px;height:100px;')); ?>
		<?php echo $form->error($model,'adres'); ?>
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


$('#Dealers_country').change(function(){
	getcity()
});

<?PHP if($city!=""){?>
var kontrol=false;
<?PHP }else{?>
var kontrol=true;
<?PHP }?>

function getcity(){
	$('#Dealers_city').empty();
	
	$('#Dealers_city').append('<option><?=Yii::t('trans','Yükleniyor')?></option>');
	$.post('<?= Yii::app()->createUrl("site/getcity")?>',{code:$('#Dealers_country').val()},function(data){
		$('#Dealers_city').empty();
		$('#Dealers_city').append('<option></option>');
		data= data.split(',');
		for(var i in data)
		{
			vData=data[i].split(':');
			$('#Dealers_city').append('<option value="'+vData[1]+'">'+vData[0]+'</option>');
		}
		$('#Dealers_city').append('<option value="0"><?=Yii::t('trans','Diğer')?></option>');
		
		if(kontrol==false){
			$('#Dealers_city').find('option').each(function(index, element) {
				
				if($(this).attr('value')==<?PHP if($city!=""){ echo $city;}else{ echo 0;}?>){
					$(this).attr('selected','selected');
				}
			});
			
			kontrol=true;
		}
		
	});
}
getcity();

$('#Dealers_city').change(function(){
	if($(this).val() == "0"){
		$('#cityDiger').fadeIn();
		$('#Dealers_cityothervalid').val("1");
	}else{
		$('#cityDiger').fadeOut();
		$('#Dealers_cityothervalid').val("");
		$('#Dealers_cityother').val("");
	}
});

<?PHP if(Yii::app()->user->getState("country")!="" && $model->country==""):?>
$(document).ready(function(e) {
    $("#Dealers_country option[value='<?=Yii::app()->user->getState("country")?>']").attr("selected", true);
	getcity();
});
<?PHP endif?>



</script>
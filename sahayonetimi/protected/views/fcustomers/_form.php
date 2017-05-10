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
	'id'=>'customers-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	<?php echo $form->errorSummary($model); ?>

<div class="searcGroup">
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>150)); ?>
		<?php echo $form->error($model,'name'); ?>
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
		<?php echo $form->textField($model,'county',array('maxlength'=>75)); ?>
		<?php echo $form->error($model,'county'); ?>
	</div>
    
   
	<div class="row clear">
    
       
		<?php echo $form->labelEx($model,'cgID'); ?>
    
		<?php
		
		 $array=array(''=>'');
		 
		 $modelCustomergroups=Customergroups::model()->findAll("deleted=1");
		 
		 foreach($modelCustomergroups as $key=>$value)
		 	$array[$value->customerGroupsID]=$value->name;
		 echo $form->dropDownList($model,'cgID',$array); 
		 
		 ?>
		<?php echo $form->error($model,'cgID'); ?>
        <div style="margin-bottom:5px;">
			 <?=Yii::t('trans','Yeni grup oluşturmak için {tiklayiniz}',array('{tiklayiniz}'=>'<a href="'.Yii::app()->createUrl("customergroups/admin").'">'.Yii::t('trans','tıklayınız.').'</a>'))?>
            
            <span class="help_"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
                <div class="text"><?=Yii::t('trans','Müşterilerinizi gruplayın örnek: Elektronikci, Bilgisayarcı, Beyazeşyacı, ... vs. Aramalarda yardımcı olur. Aynı zamanda <b>Detaylı raporlardırmak</b> için önemlidir.')?> 		</div>
            </span>
        </div> 
	</div>
    
  
</div>

<div class="searcGroup">

	<div class="row">
		
		 <?php echo $form->textFieldRow($model, 'email', array('prepend'=>'@','style'=>'width:195px;')); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('maxlength'=>45)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cphone'); ?>
		<?php echo $form->textField($model,'cphone',array('maxlength'=>45)); ?>
		<?php echo $form->error($model,'cphone'); ?>
	</div>
    
   
	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('maxlength'=>45)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'taxno'); ?>
		<?php echo $form->dropDownList($model,'taxnotype',FcustomersController::getParams("taxnoType"),array('style'=>'width:109px')); ?> <?php echo $form->textField($model,'taxno',array('maxlength'=>45,'style'=>'width:109px')); ?>
		<?php echo $form->error($model,'taxno'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'taxoffice'); ?>
		<?php echo $form->textField($model,'taxoffice',array('maxlength'=>45)); ?>
		<?php echo $form->error($model,'taxoffice'); ?>
	</div>
    

</div>
	
    

	<div class="row clear">
		<?php echo $form->labelEx($model,'adress'); ?>
		<?php echo $form->textArea($model,'adress',array('style'=>'width:350px;height:100px;')); ?>
		<?php echo $form->error($model,'adress'); ?>
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


$('#Customers_country').change(function(){
	getcity()
});

<?PHP if($city!=""){?>
var kontrol=false;
<?PHP }else{?>
var kontrol=true;
<?PHP }?>

function getcity(){
	$('#Customers_city').empty();
	
	$('#Customers_city').append('<option><?=Yii::t('trans','Yükleniyor')?></option>');
	$.post('<?= Yii::app()->createUrl("site/getcity")?>',{code:$('#Customers_country').val()},function(data){
		$('#Customers_city').empty();
		$('#Customers_city').append('<option></option>');
		data= data.split(',');
		for(var i in data)
		{
			vData=data[i].split(':');
			$('#Customers_city').append('<option value="'+vData[1]+'">'+vData[0]+'</option>');
		}
		$('#Customers_city').append('<option value="0"><?=Yii::t('trans','Diğer')?></option>');
		
		if(kontrol==false){
			$('#Customers_city').find('option').each(function(index, element) {
				
				if($(this).attr('value')==<?PHP if($city!=""){ echo $city;}else{ echo 0;}?>){
					$(this).attr('selected','selected');
				}
			});
			
			kontrol=true;
		}
		
	});
}
getcity();

$('#Customers_city').change(function(){
	if($(this).val() == "0"){
		$('#cityDiger').fadeIn();
		$('#Customers_cityothervalid').val("1");
	}else{
		$('#cityDiger').fadeOut();
		$('#Customers_cityothervalid').val("");
		$('#Customers_cityother').val("");
	}
});

<?PHP if(Yii::app()->user->getState("country")!="" && $model->country==""):?>
$(document).ready(function(e) {
    $("#Customers_country option[value='<?=Yii::app()->user->getState("country")?>']").attr("selected", true);
	getcity();
});
<?PHP endif?>



</script>
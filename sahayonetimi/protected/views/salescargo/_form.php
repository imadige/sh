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

.form{
	background-color:#E8F0EE;
	padding:20px 20px 20px 20px;
	margin-top:10px;
	border-radius:5px;
}
.groupSelect{
	cursor:pointer;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'salescargo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	<?php echo $form->errorSummary($model); ?>
    
<div class="searcGroup">
	<div class="row">
		<?php 
		if($model->type==0)
			echo Yii::t('trans','Sevkiyat/Sevkiyat Yapan İsmi');
		elseif($model->type==1)
			echo Yii::t('trans','Kargo İsmi');
		elseif($model->type==2)
			echo Yii::t('trans','Kurye İsmi');
		?>
        <br />
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    
	<?PHP if($model->type==1):?>
	<div class="row">
		<?php echo $form->labelEx($model,'follownumber'); ?>
		<?php echo $form->textField($model,'follownumber',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'follownumber'); ?>
	</div>
	<?PHP endif;?>
	
</div>
<div class="searcGroup">
	
    
	<?PHP if($model->type==1 || $model->type==2):?>
    
    <div class="row">
		<?php echo $form->labelEx($model,'payment'); ?>
		<?PHP echo $form->dropDownList($model,'payment',SalescargoController::getParams("cargopaymenttype"));   ?>
		<?php echo $form->error($model,'payment'); ?>
	</div>
    
	<div class="row price"  <?PHP if($model->payment==0){?>style="display:none"<?PHP }?>>
		<?php echo $form->labelEx($model,'charge'); ?>
		<?php echo $form->textField($model,'charge1',array('style'=>'width:50px','onkeypress'=>'return isNumber(event)')); ?> , <?php echo $form->textField($model,'charge2',array('style'=>'width:20px','onkeypress'=>'return isNumber(event)','maxlength'=>2)); ?>
        <?PHP echo $form->dropDownList($model,'chargeCur',SalescargoController::getParams("currency"),array('style'=>'width:70px'));   ?>
		<?php echo $form->error($model,'charge'); ?>
	</div>
	<?PHP endif;?>
</div>
	
	<div class="row buttons clear">
		  <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Kaydet'),
			 'buttonType' => 'link',
			 'url'=>"javascript:;",
			 'htmlOptions'=>array('onclick'=>'javascript:cargoadda()'),
        	)); ?>
	</div>
    
	<div class="row sonuc clear">
    
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">

<?PHP if($model->payment==0){?>
	var cargocharge=false;
<?PHP }else{?>
	var cargocharge=true;
<?PHP }?>
$('#Salescargo_payment').change(function(){
	if($(this).val()==1){
		cargocharge=true;
		$('.price').fadeIn();
	}else{
		cargocharge=false;
		$('.price').fadeOut();
	}
	
});
var kontrol=true;
function cargoadda(){
	
	if(cargocharge==true){
	
		if($('#Salescargo_charge1').val()==""){
			$('#Salescargo_charge1').css("border","1px solid #F00");
			kontrol=false;
		}else{
			$('#Salescargo_charge1').css("border","");
			kontrol=true;
		}
			
		if($('#Salescargo_charge2').val()==""){
			$('#Salescargo_charge2').css("border","1px solid #F00");
			kontrol=false;
		}else{
			$('#Salescargo_charge2').css("border","");
			kontrol=true;
		}
		
	}
	
	if($('#Salescargo_name').val()==""){
		kontrol=false;
		
		$('#Salescargo_name').css("border","1px solid #F00");
	}else{
		$('#Salescargo_name').css('border','');
		kontrol=true;
	}
	
	if(kontrol==false){
		alert("<?=Yii::t('trans','Lütfen hataları düzeltin.')?>");
	}else{
	
			var dataString = 'cargoname='+ $('#Salescargo_name').val();
			
			if(typeof $('#Salescargo_payment').val()!="undefined")
				dataString+='&cargopaymenttype='+$('#Salescargo_payment').val();
			
			if($('#Salescargo_charge1').val()!="" && typeof $('#Salescargo_charge1').val()!="undefined"){
				
				dataString+='&charge1='+$('#Salescargo_charge1').val();
				dataString+='&charge2='+$('#Salescargo_charge2').val();
				dataString+='&chargecur='+$('#Salescargo_chargeCur').val();
			}
			if($('#Salescargo_follownumber').val()!=""  && typeof $('#Salescargo_follownumber').val()!="undefined"){
				
				dataString+='&cargofallownumber='+$('#Salescargo_follownumber').val();
			}
				
			dataString+='&id=<?=$model->salescargoID?>';
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("salescargo/update2")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				
				 if(data.sonuc==1){
					$('.sonuc').html('<font color="#00CC00"><?=Yii::t('trans','Kaydedildi.')?></font>');
					
					$('#a'+data.salescargoID).children('td:eq(1)').html(data.name);
					$('#a'+data.salescargoID).children('td:eq(2)').html(data.follownumber);
					$('#a'+data.salescargoID).children('td:eq(3)').html(paymenttype[data.payment]);
					$('#a'+data.salescargoID).children('td:eq(4)').html(data.charge);
				 }else
				 	$('.sonuc').html('<font color="#F00"><?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?></font>');

			 },error: function (xhr, ajaxOptions, thrownError) {
				 	$('.sonuc').html('<font color="#F00"><?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?></font>');

			 }
			 
			});
	}

}

var paymenttype = new Array();
<?PHP foreach(SalescargoController::getParams("cargopaymenttype") as $key=>$value):?>
	paymenttype[<?=$key?>]="<?=$value?>";
<?PHP endforeach?>



function isNumber(evt)  
{  
  var charCode = (evt.which) ? evt.which : event.keyCode  
  if (charCode > 31 && (charCode < 48 || charCode > 57))  
   return false;  
  return true; 
   
}  

</script>
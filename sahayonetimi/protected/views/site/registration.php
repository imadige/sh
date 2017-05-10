<style type="text/css">

input[type='text'] {
	height:18px;
	width:200px;
}
input[type='password'] {
	height:18px;
	width:200px;
}
.label{
	font-size:18px;
}
select{
	height:30px;
	width:207px;
}
.row{
	margin-bottom:15px !important;
}
</style>

 <?PHP if($saveOk==true){
	header( "refresh:5;url=".Yii::app()->createUrl("site/panel"));
 }?>
 
 <div class="topshadow">
    	<img src="<?=Yii::app()->baseUrl?>/images/topshadow.png" />
    </div>
   
    
    <div class="leftshadow">
    	<img src="<?=Yii::app()->baseUrl?>/images/leftshadow.png" />
    </div>

<div class="wrapper" style="height:700px;">
	<div class="blocked"></div>
    	<div class="title"><?=Yii::t('trans','<b>Hesap</b> Oluşturun.')?></div>
        
       <div class="form register">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'companies-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="grupBox">
	<div class="row">
		<span class="label"><?=Yii::t('trans','Şirket Adı')?></span>
        <div class="clear"></div>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<span class="label"><?=Yii::t('trans','Ad Soyad')?></span>
        <div class="clear"></div>
		<?php echo $form->textField($model,'nameSurname'); ?>
		<?php echo $form->error($model,'nameSurname'); ?>
	</div>
    
    <div class="row">
		<span class="label"><?=Yii::t('trans','Ülke')?></span>
        <div class="clear"></div>
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
		<span class="label"><?=Yii::t('trans','Şehir')?></span>
        <div class="clear"></div>
		<?php echo $form->dropDownList($model,'city',array())?>
		<?php echo $form->error($model,'city'); ?>
        <?php echo $form->hiddenField($model,'cityothervalid'); ?>
	</div>
</div>

<div class="grupBox">

	<div class="row">
		<span class="label"><?=Yii::t('trans','E-Posta')?></span>
        <div class="clear"></div>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
    
    <div class="row">
		<span class="label"><?=Yii::t('trans','Parola')?></span>
        <div class="clear"></div>
        
			<?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
      
	</div>
    
     <div class="row">
		<span class="label"><?=Yii::t('trans','Parola Tekrar')?></span>
        <div class="clear"></div>
        
			<?php echo $form->passwordField($model,'repassword'); ?>
            <?php echo $form->error($model,'repassword'); ?>
       <div class="clear"></div>
       
	 </div>
    
	<div class="row" style="display:none;" id="cityDiger">
		<span class="label"><?=Yii::t('trans','Şehir Diğer')?></span>
        <div class="clear"></div>
		<?php echo $form->textField($model,'cityother'); ?>
		<?php echo $form->error($model,'cityother'); ?>
	</div>

</div>
	
	

	<div class="clear"></div>
    <div class="contract">
    Bu web sitesini ziyaret etmeniz ve bu site vasıtasıyla sunduğumuz hizmetlerden yararlanmanız sırasında size ve talep ettiğiniz hizmetlere ilişkin olarak elde ettiğimiz bilgilerin ne şekilde kullanılacağı ve korunacağı işbu "Gizlilik Politikası"nda belirtilen şartlara tabidir. Bu web sitesini ziyaret etmekle ve bu site vasıtasıyla sunduğumuz hizmetlerden yararlanmayı talep etmekle işbu "Gizlilik Politikası"nda belirtilen şartları kabul etmektesiniz.
    </div>
    <div class="contractcheck">
    <?= $form->checkBox($model,"contract",array('value'=>'1'))?> <?=Yii::t('trans','Sözleşmeyi okudum ve kabul ediyorum.')?>
    <?php echo $form->error($model,'contract'); ?>
    </div>
    
	<div class="row buttons clear" style="margin-top:20px;">
		<?php echo CHtml::submitButton(Yii::t('trans','Tamam'),array('class'=>'registerbutton')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
        
      
</div>
    
	<div class="rightshadow">
    	<img src="<?=Yii::app()->baseUrl?>/images/rightshadow.png" />
    </div>
    
    <div class="rightwrapper">
         <div class="form">
        	<div class="succes"></div>
            <div class="login" style="display:none;">
			 <?PHP $this->renderPartial("login")?>
            </div>
        </div><!-- form -->
    </div>
    
    <div class="bottomshadow clear">
    	<img src="<?=Yii::app()->baseUrl?>/images/bottomshadow.png" />
    </div>
	
    <div class="clear"></div>
    
    
<script type="text/javascript">
$('#Companies_country').change(function(){
	getcity()
});

<?PHP if($city!=""){?>
var kontrol=false;
<?PHP }else{?>
var kontrol=true;
<?PHP }?>

function getcity(){
	$('#Companies_city').empty();
	
	$('#Companies_city').append('<option><?=Yii::t('trans','Yükleniyor')?></option>');
	$.post('<?= Yii::app()->createUrl("site/getcity")?>',{code:$('#Companies_country').val()},function(data){
		$('#Companies_city').empty();
		$('#Companies_city').append('<option></option>');
		data= data.split(',');
		for(var i in data)
		{
			vData=data[i].split(':');
			$('#Companies_city').append('<option value="'+vData[1]+'">'+vData[0]+'</option>');
		}
		$('#Companies_city').append('<option value="0"><?=Yii::t('trans','Diğer')?></option>');
		
		if(kontrol==false){
			$('#Companies_city').find('option').each(function(index, element) {
				
				if($(this).attr('value')==<?PHP if($city!=""){ echo $city;}else{ echo 0;}?>){
					$(this).attr('selected','selected');
				}
			});
			
			kontrol=true;
		}
		
	});
}
getcity();

$('#Companies_city').change(function(){
	if($(this).val() == "0"){
		$('#cityDiger').fadeIn();
		$('#Companies_cityothervalid').val("1");
	}else{
		$('#cityDiger').fadeOut();
		$('#Companies_cityothervalid').val("");
		$('#Companies_cityother').val("");
	}
});
<?PHP if($cityothervalid!=""):?>
$('#cityDiger').fadeIn();
<?PHP endif?>
	
<?PHP if($saveOk==true):?>
	blocked()
<?PHP endif;?>
function blocked(){
	block=setInterval(function() {
			
			blockAktifle();
			clearInterval(block);
	}, 200);
}

function blockAktifle(){
	 $('.blocked').animate({
		height: 700,
		}, 1000, function() {
		$('.succes').html("<?=$message?>");
		 $('html, body').animate({ scrollTop: 0 },  300);
	});
}




</script>
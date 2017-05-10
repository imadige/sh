<?php
/* @var $this DealersController */
/* @var $model Dealers */
/* @var $form bootstrap.widgets.TbActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<div class="filterGroup">
	<div class="row">
		<?php echo $form->label($model,'dealersID'); ?>
		<?php echo $form->textField($model,'dealersID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cphone'); ?>
		<?php echo $form->textField($model,'cphone',array('maxlength'=>45)); ?>
	</div>

	  <div class="row">
		<?php echo $form->label($model,'deleted'); ?>
		<?php $array=array(''=>'');
		foreach(DealersController::getParams("deleted") as $key=>$value)
			$array[$key]=$value;
		echo $form->dropDownList($model,'deleted',$array,array('style'=>'width:142px')); ?>
      	</div>

</div>

<div class="filterGroup">
	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('maxlength'=>75)); ?>
	</div>
	


	<div class="row">
		<?php echo $form->label($model,'country'); ?>
		<?php $criteria=new CDbCriteria();
		$criteria->select="code, name";
		$criteria->condition="code!='TR'";
		$modelCountry= Country::model()->findAll($criteria);
		$country = array(''=>'','TR'=>'Türkiye');
		foreach($modelCountry as $key => $value){
			$country[$value->code]=$value->name;
		}
		
		echo $form->dropDownList($model,'country',$country); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->dropDownList($model,'city',array())?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'county'); ?>
		<?php echo $form->textField($model,'county',array('maxlength'=>45)); ?>
	</div>
    
    
	<div class="row">
		<?php echo $form->label($model,'dateAdd'); ?>
		<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'Dealers[dateAdd]',
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



<script type="text/javascript">


$('#Dealers_country').change(function(){
	getcity()
});


var kontrol=true;


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



</script>
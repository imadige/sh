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
	'id'=>'ticket-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>


	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row left">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php 
		$array=array(""=>"");

		foreach(TicketController::getParams("language") as $key=>$value)
			$array[$key]=$value;

		echo $form->dropDownList($model,'language',$array,array('style'=>'width:100px')); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row left" style="margin-left:20px;">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php 
		$array=array(""=>"");

		foreach(TicketController::getParams("ticketType") as $key=>$value)
			$array[$key]=$value;

		echo $form->dropDownList($model,'type',$array,array('style'=>'width:150px')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div style="width:550px">
	<div class="row clear">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('style'=>'width:500px;height:150px;')); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	 <div class="row left">
	 	<?php echo $form->labelEx($model,'images1'); ?>	
        <?php echo $form->FileField($model,'images1',array('size'=>40)); ?>
        <?php echo $form->error($model,'images1'); ?>
      
         <?php echo $form->hiddenField($model,'images1'); ?>
    </div>

	<div class="row right">
		<?php echo $form->labelEx($model,'images2'); ?>	
        <?php echo $form->FileField($model,'images2',array('size'=>40)); ?>
        <?php echo $form->error($model,'images2'); ?>
      
         <?php echo $form->hiddenField($model,'images2'); ?>
    </div>

	<div class="row clear left">
		<?php echo $form->labelEx($model,'images3'); ?>	
        <?php echo $form->FileField($model,'images3',array('size'=>40)); ?>
        <?php echo $form->error($model,'images3'); ?>
      
         <?php echo $form->hiddenField($model,'images3'); ?>
    </div>

	<div class="row right">
		<?php echo $form->labelEx($model,'images4'); ?>	
        <?php echo $form->FileField($model,'images4',array('size'=>40)); ?>
        <?php echo $form->error($model,'images4'); ?>
      
         <?php echo $form->hiddenField($model,'images4'); ?>
    </div>
    <div class="clear"></div>
</div>


	<div class="row buttons clear">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'large',
			 'buttonType' => 'link',
            'label'=>Yii::t('trans','Gönder'),
            'htmlOptions'=>array('onClick'=>"gonder()"),
	 		'url'=>"javascript:;",
        	)); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>

function gonder(){
	var kontrol=true;
	if($('#Ticket_text').val()==""){
		kontrol=false;
		$('#Ticket_text').css("border","1px solid #F00");
	}else
		$('#Ticket_text').css("border","");

	if($('#Ticket_language').val()==""){
		kontrol=false;
		$('#Ticket_language').css("border","1px solid #F00");
	}else
		$('#Ticket_language').css("border","");

	if($('#Ticket_type').val()==""){
		kontrol=false;
		$('#Ticket_type').css("border","1px solid #F00");
	}else
		$('#Ticket_type').css("border","");

	if(kontrol==true)
		$('#ticket-form').submit();
	else
		alert("<?=Yii::t('trans','Lütfen eksik bilgileri doldurunuz.')?>");
}

</script>
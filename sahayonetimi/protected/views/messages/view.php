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
<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	Yii::t('trans','Mesaj')=>array('admin'),
	$model->messagesID+MessagesController::getParams("messagesplus"),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);


?>

<h1><?=Yii::t('trans','Mesaj')?> #<?php echo $model->messagesID+MessagesController::getParams("messagesplus")?></h1>

<div class="ticket">
	
	
	<div class="item clearfix" style="background-color:#efefef;">
		<span class="left b"><?=$model->name?></span> 
		<span class="right b">
			<?php
			$date=new DateTime($model->dateAdd);
			echo $date->format("d-m-Y H:i");
			?>
		</span>
		<div class="clear h"></div>
		<?=$model->text?>
		
	</div>		
</div>



<div class="ticket" style="margin:30px 0px 0px 20px">
	
	<?PHP foreach($modelAnswer as $key2=>$value2):?>
	<div class="item clearfix">
		<span class="left b"><?=$value2->name?></span> 
		<span class="right b">
			<?php
			$date=new DateTime($value2->dateAdd);
			echo $date->format("d-m-Y H:i");
			?>
		</span>
		<div class="clear h"></div>
		<?=$value2->text?>
		
		
		<div class="clear"></div>
	</div>	
	<?PHP endforeach;?>	
</div>

<div class="form" style="margin:30px 0px 0px 20px">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'ticket-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>


	

	<div class="row clear">
		<?php echo $form->labelEx($model2,'text'); ?>
		<?php echo $form->textArea($model2,'text',array('style'=>'width:500px;height:150px;')); ?>
		<?php echo $form->error($model2,'text'); ?>
	</div>



	<div class="row buttons clear">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'large',
			 
            'label'=>Yii::t('trans','Gönder'),
            
        	)); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
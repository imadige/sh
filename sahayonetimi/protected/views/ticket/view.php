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
	'Ticket'=>array('admin'),
	$model->ticketID+TicketController::getParams("ticketplus"),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
$colorbox->addInstance('.colorbox', array('frame'=>true,'width'=>'80%', 'height'=>'93%'));

?>

<h1>Ticket #<?php echo $model->ticketID+TicketController::getParams("ticketplus"); ?></h1>

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
		<div class="clear h"></div>
		<?PHP 
		$images=array();
		if($model->images1!="")
			$images[$model->images1]=$model->images1;

		if($model->images2!="")
			$images[$model->images2]=$model->images2;

		if($model->images3!="")
			$images[$model->images3]=$model->images3;

		if($model->images4!="")
			$images[$model->images4]=$model->images4;

		if(count($images)>0):

		?>
		<div class="ekler"><?=Yii::t('trans','Ekler')?>:</div>

		<?PHP endif;
		foreach($images as $key=>$value):
		?>

		<div class="image">
			<a class="colorbox" href="<?=Yii::app()->baseUrl;?>/resimler/ticket/<?=$model->ticketID."/".$value?>">
			<img src="<?=Yii::app()->baseUrl;?>/resimler/ticket/<?=$model->ticketID."/_".$value?>" />
			</a>
		</div>
		<?PHP endforeach;?>
		<div class="clear"></div>
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
		
		<div class="clear h"></div>
		<?PHP 
		$images=array();
		if($value2->images1!="")
			$images[$value2->images1]=$value2->images1;

		if($value2->images2!="")
			$images[$value2->images2]=$value2->images2;

		if($value2->images3!="")
			$images[$value2->images3]=$value2->images3;

		if($value2->images4!="")
			$images[$value2->images4]=$value2->images4;

		if(count($images)>0):

		?>
		<div class="ekler"><?=Yii::t('trans','Ekler')?>:</div>

		<?PHP endif;
		foreach($images as $key=>$value):
		?>

		<div class="image">
			<a class="colorbox" href="<?=Yii::app()->baseUrl;?>/resimler/ticket/<?=$value2->ticketID."/".$value?>">
			<img src="<?=Yii::app()->baseUrl;?>/resimler/ticket/<?=$value2->ticketID."/_".$value?>" />
			</a>
		</div>
		<?PHP endforeach;?>
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


	
<div style="width:550px">
	<div class="row clear">
		<?php echo $form->labelEx($model2,'text'); ?>
		<?php echo $form->textArea($model2,'text',array('style'=>'width:500px;height:150px;')); ?>
		<?php echo $form->error($model2,'text'); ?>
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
			 
            'label'=>Yii::t('trans','Gönder'),
            
        	)); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
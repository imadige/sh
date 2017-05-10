<?php
/* @var $this ProblematicproductsController */
/* @var $model Problematicproducts */
/* @var $form bootstrap.widgets.TbActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


<div class="filterGroup">
	<div class="row">
		<?php echo $form->label($model,'problematicproductsID'); ?>
		<?php echo $form->textField($model,'problematicproductsID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'productsID'); ?>
		<?php echo $form->textField($model,'productsID'); ?>
	</div>

	
</div>

<div class="filterGroup">
	<div class="row">
		<?php  echo $form->label($model,'problematicStatus'); ?>
		<?php 
		
		$array=array(""=>"");
		foreach(ProblematicproductsController::getParams("problematicStatus") as $key=>$value)
			$array[$key]=$value;
		
		
		echo $form->dropDownList($model,'problematicStatus',$array); ?>
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
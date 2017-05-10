<?php
/* @var $this PaymentnotificationsController */
/* @var $model Paymentnotifications */

$this->breadcrumbs=array(
	Yii::t('trans','Ödeme Bildirimi'),
);

?>

<h1><?=Yii::t('trans','Ödeme Bildirimi')?> #<?php echo $model->paymentnotificationsID+PaymentnotificationsController::getParams("paymentplus") ?></h1>
<br /><br />
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'type'=>'raw', 
			'name'=>'paymentnotificationsID',
			'value'=>$model->paymentnotificationsID+PaymentnotificationsController::getParams("paymentplus"),
			
		),
		'text',
		array(
			'type'=>'raw', 
			'name'=>'employeesID',
			'value'=>PaymentnotificationsController::getEmployeesName($model->employeesID),
			
		),
		
		array(
			'type'=>'raw', 
			'name'=>'customerdealerID',
			'value'=>$model->customerdealerID+PaymentnotificationsController::getParams("dealercustomerplus"),
			
		),
		array(
			'type'=>'raw', 
			'name'=>'cdtype',
			'value'=>PaymentnotificationsController::getParams_("cdtype",$model->cdtype),
			
		),
		array(
			'type'=>'raw', 
			'name'=>'paymentStatus',
			'value'=>PaymentnotificationsController::getParams_("paymentStatus",$model->paymentStatus),
			
		),
	),
)); ?>


<div class="paymentnotificationsUpdate clearfix">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'appointments-form',
	'enableAjaxValidation'=>false,
)); ?>
	
    
    <div class="item">
    	<?php echo $form->labelEx($model,'paymentStatus'); ?>
        <?php echo $form->dropDownList($model,'paymentStatus',PaymentnotificationsController::getParams("paymentStatus")); ?>
    </div>
    
    <div class="button">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Kaydet'),
        	)); ?>
    </div>
<?php $this->endWidget(); ?>
</div>
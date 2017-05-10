<?php
/* @var $this PaymentnotificationsController */
/* @var $data Paymentnotifications */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentnotificationsID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->paymentnotificationsID), array('view', 'id'=>$data->paymentnotificationsID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worldID')); ?>:</b>
	<?php echo CHtml::encode($data->worldID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyID')); ?>:</b>
	<?php echo CHtml::encode($data->companyID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeesID')); ?>:</b>
	<?php echo CHtml::encode($data->employeesID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('readtext')); ?>:</b>
	<?php echo CHtml::encode($data->readtext); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerdealerID')); ?>:</b>
	<?php echo CHtml::encode($data->customerdealerID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cdtype')); ?>:</b>
	<?php echo CHtml::encode($data->cdtype); ?>
	<br />

	*/ ?>

</div>
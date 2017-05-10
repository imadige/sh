<?php
/* @var $this AppointmentsController */
/* @var $data Appointments */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('appointmentsID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->appointmentsID), array('view', 'id'=>$data->appointmentsID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerID')); ?>:</b>
	<?php echo CHtml::encode($data->customerID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appointmentDate')); ?>:</b>
	<?php echo CHtml::encode($data->appointmentDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('not')); ?>:</b>
	<?php echo CHtml::encode($data->not); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateAdd')); ?>:</b>
	<?php echo CHtml::encode($data->dateAdd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worldID')); ?>:</b>
	<?php echo CHtml::encode($data->worldID); ?>
	<br />


</div>
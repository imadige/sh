<?php
/* @var $this VisitsController */
/* @var $data Visits */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('visitsID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->visitsID), array('view', 'id'=>$data->visitsID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visitDate')); ?>:</b>
	<?php echo CHtml::encode($data->visitDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appointmentsID')); ?>:</b>
	<?php echo CHtml::encode($data->appointmentsID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visitType')); ?>:</b>
	<?php echo CHtml::encode($data->visitType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('explanation')); ?>:</b>
	<?php echo CHtml::encode($data->explanation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerdealerID')); ?>:</b>
	<?php echo CHtml::encode($data->customerdealerID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('worldID')); ?>:</b>
	<?php echo CHtml::encode($data->worldID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyID')); ?>:</b>
	<?php echo CHtml::encode($data->companyID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeesID')); ?>:</b>
	<?php echo CHtml::encode($data->employeesID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cdtype')); ?>:</b>
	<?php echo CHtml::encode($data->cdtype); ?>
	<br />

	*/ ?>

</div>
<?php
/* @var $this CustomersController */
/* @var $data Customers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->customerID), array('view', 'id'=>$data->customerID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cphone')); ?>:</b>
	<?php echo CHtml::encode($data->cphone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('county')); ?>:</b>
	<?php echo CHtml::encode($data->county); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adress')); ?>:</b>
	<?php echo CHtml::encode($data->adress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('webadress')); ?>:</b>
	<?php echo CHtml::encode($data->webadress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateAdd')); ?>:</b>
	<?php echo CHtml::encode($data->dateAdd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('opportunity')); ?>:</b>
	<?php echo CHtml::encode($data->opportunity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addEmployeesID')); ?>:</b>
	<?php echo CHtml::encode($data->addEmployeesID); ?>
	<br />

	*/ ?>

</div>
<?php
/* @var $this DealersController */
/* @var $data Dealers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('dealersID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dealersID), array('view', 'id'=>$data->dealersID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cphone')); ?>:</b>
	<?php echo CHtml::encode($data->cphone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('adres')); ?>:</b>
	<?php echo CHtml::encode($data->adres); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateAdd')); ?>:</b>
	<?php echo CHtml::encode($data->dateAdd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyID')); ?>:</b>
	<?php echo CHtml::encode($data->companyID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worldID')); ?>:</b>
	<?php echo CHtml::encode($data->worldID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('county')); ?>:</b>
	<?php echo CHtml::encode($data->county); ?>
	<br />

	*/ ?>

</div>
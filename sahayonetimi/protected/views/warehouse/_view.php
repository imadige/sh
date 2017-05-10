<?php
/* @var $this WarehouseController */
/* @var $data Warehouse */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('warehouseID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->warehouseID), array('view', 'id'=>$data->warehouseID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyID')); ?>:</b>
	<?php echo CHtml::encode($data->companyID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worldID')); ?>:</b>
	<?php echo CHtml::encode($data->worldID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />


</div>
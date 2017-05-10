<?php
/* @var $this ProductgroupsController */
/* @var $data Productgroups */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('productgroupsID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->productgroupsID), array('view', 'id'=>$data->productgroupsID)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('pgID')); ?>:</b>
	<?php echo CHtml::encode($data->pgID); ?>
	<br />


</div>
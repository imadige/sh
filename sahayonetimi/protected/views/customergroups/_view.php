<?php
/* @var $this CustomergroupsController */
/* @var $data Customergroups */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerGroupsID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->customerGroupsID), array('view', 'id'=>$data->customerGroupsID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyID')); ?>:</b>
	<?php echo CHtml::encode($data->companyID); ?>
	<br />


</div>
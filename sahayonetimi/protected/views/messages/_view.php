<?php
/* @var $this MessagesController */
/* @var $data Messages */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('messagesID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->messagesID), array('view', 'id'=>$data->messagesID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeesID')); ?>:</b>
	<?php echo CHtml::encode($data->employeesID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateAdd')); ?>:</b>
	<?php echo CHtml::encode($data->dateAdd); ?>
	<br />


</div>
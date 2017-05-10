<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('problematicproductsID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->problematicproductsID),array('view','id'=>$data->problematicproductsID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productsID')); ?>:</b>
	<?php echo CHtml::encode($data->productsID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('problematicStatus')); ?>:</b>
	<?php echo CHtml::encode($data->problematicStatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerdealerID')); ?>:</b>
	<?php echo CHtml::encode($data->customerdealerID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worldID')); ?>:</b>
	<?php echo CHtml::encode($data->worldID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('companyID')); ?>:</b>
	<?php echo CHtml::encode($data->companyID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeesText')); ?>:</b>
	<?php echo CHtml::encode($data->employeesText); ?>
	<br />

	*/ ?>

</div>
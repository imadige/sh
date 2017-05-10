<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('productsID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->productsID), array('view', 'id'=>$data->productsID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seriNumber')); ?>:</b>
	<?php echo CHtml::encode($data->seriNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchasePrice')); ?>:</b>
	<?php echo CHtml::encode($data->purchasePrice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salePrice')); ?>:</b>
	<?php echo CHtml::encode($data->salePrice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax')); ?>:</b>
	<?php echo CHtml::encode($data->tax); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('brand')); ?>:</b>
	<?php echo CHtml::encode($data->brand); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyID')); ?>:</b>
	<?php echo CHtml::encode($data->companyID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worldID')); ?>:</b>
	<?php echo CHtml::encode($data->worldID); ?>
	<br />

	*/ ?>

</div>
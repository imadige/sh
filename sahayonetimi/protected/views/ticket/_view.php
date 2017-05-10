<?php
/* @var $this TicketController */
/* @var $data Ticket */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticketID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ticketID), array('view', 'id'=>$data->ticketID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('images1')); ?>:</b>
	<?php echo CHtml::encode($data->images1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('images2')); ?>:</b>
	<?php echo CHtml::encode($data->images2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('images3')); ?>:</b>
	<?php echo CHtml::encode($data->images3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('images4')); ?>:</b>
	<?php echo CHtml::encode($data->images4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('translateText')); ?>:</b>
	<?php echo CHtml::encode($data->translateText); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('okundu')); ?>:</b>
	<?php echo CHtml::encode($data->okundu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cevap')); ?>:</b>
	<?php echo CHtml::encode($data->cevap); ?>
	<br />

	*/ ?>

</div>
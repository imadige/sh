<?php
/* @var $this PaymentnotificationsController */
/* @var $model Paymentnotifications */

$this->breadcrumbs=array(
	Yii::t('trans','Ödeme Bildirimi Ekle'),
);


?>

<h1><?=Yii::t('trans','Ödeme Bildirimi Ekle')?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
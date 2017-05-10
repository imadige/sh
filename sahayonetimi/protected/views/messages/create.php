<?php
/* @var $this DealersController */
/* @var $model Dealers */

$this->breadcrumbs=array(
	Yii::t('trans','Mesajlar')=>array('admin'),
	Yii::t('trans','Yeni Mesaj'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Ticket - Yeni Ticket')?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
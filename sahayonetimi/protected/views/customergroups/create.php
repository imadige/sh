<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	Yii::t('trans','Müşteri Grublar')=>array('index'),
	Yii::t('trans','Yeni Müşteri Grub'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Müşteri Grublar - Yeni Müşteri Grub Oluştur')?></h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
)); ?>
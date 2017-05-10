<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	Yii::t('trans','Müşteriler')=>array('index'),
	Yii::t('trans','Yeni Müşteri'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Müşteriler - Yeni Müşteri Oluştur')?></h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'city'=>$city,
)); ?>
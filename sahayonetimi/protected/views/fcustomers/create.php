<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	Yii::t('trans','Fırsatlar')=>array('index'),
	Yii::t('trans','Yeni Müşteri'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Fırsatlar - Yeni Fırsat Oluştur')?></h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'city'=>$city,
)); ?>
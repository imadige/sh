<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	Yii::t('trans','Servis')=>array('index'),
	Yii::t('trans','Yeni Sorunlu Ürün'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Servis - Yeni Sorunlu Ürün Oluştur')?></h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	
)); ?>
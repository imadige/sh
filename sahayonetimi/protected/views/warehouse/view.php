<?php
/* @var $this WarehouseController */
/* @var $model Warehouse */

$this->breadcrumbs=array(
	Yii::t('trans','Depo')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('trans','Depo Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Güncelle'), 'url'=>array('update', 'id'=>$model->warehouseID)),
	array('label'=>Yii::t('trans','Sil'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->warehouseID),'confirm'=>Yii::t('trans','Depoyu silmek istediğinize eminmisiniz?'))),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Depo')?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		
	),
)); ?>

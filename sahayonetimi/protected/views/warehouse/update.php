<?php
/* @var $this WarehouseController */
/* @var $model Warehouse */

$this->breadcrumbs=array(
	Yii::t('trans','Depo')=>array('index'),
	$model->name=>array('view','id'=>$model->warehouseID),
	Yii::t('trans','Depo Güncelle'),
);



$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Görüntüle'), 'url'=>array('view', 'id'=>$model->warehouseID)),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Depo - Güncelle')?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
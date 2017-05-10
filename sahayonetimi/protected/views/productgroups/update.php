<?php
/* @var $this ProductgroupsController */
/* @var $model Productgroups */

$this->breadcrumbs=array(
	Yii::t('trans','Ürün Grubları')=>array('index'),
	$model->name=>array('view','id'=>$model->productgroupsID),
	Yii::t('trans','Güncelle'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('index')),
);
?>

<h1><?=Yii::t('trans','Ürün Grubları - Grub Düzenle')?></h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
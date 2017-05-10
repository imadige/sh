<?php
/* @var $this ProductgroupsController */
/* @var $model Productgroups */

$this->breadcrumbs=array(
	Yii::t('trans','Ürün Grubları')=>array('index'),
	Yii::t('trans','Yeni Grub Oluştur'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('index')),
);
?>

<h1><?=Yii::t('trans','Ürün Grubları - Yeni Grub Oluştur')?></h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
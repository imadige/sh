<?php
/* @var $this VisitsController */
/* @var $model Visits */

$this->breadcrumbs=array(
	Yii::t('trans','Ziyaret')=>array('index'),
	Yii::t('trans','Yeni Ziyaret'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Ziyaretler - Yeni Ziyaret Oluştur')?></h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
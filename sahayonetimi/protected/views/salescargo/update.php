<?php
/* @var $this SalescargoController */
/* @var $model Salescargo */

$this->breadcrumbs=array(
	'Salescargos'=>array('index'),
	$model->name=>array('view','id'=>$model->salescargoID),
	'Update',
);


?>

<h1><?=Yii::t('trans','Gönderim Düzenle')?> #<?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
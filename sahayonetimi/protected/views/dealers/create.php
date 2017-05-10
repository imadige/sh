<?php
/* @var $this DealersController */
/* @var $model Dealers */

$this->breadcrumbs=array(
	Yii::t('trans','Bayiler')=>array('index'),
	Yii::t('trans','Yeni Bayi'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Bayiler - Yeni Bayi Oluştur')?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model,'city'=>$city)); ?>
<?php
/* @var $this AppointmentsController */
/* @var $model Appointments */

$this->breadcrumbs=array(
	Yii::t('trans','Randevular')=>array('index'),
	Yii::t('trans','Yeni Randevu'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Randevular - Yeni Randevu Oluştur')?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
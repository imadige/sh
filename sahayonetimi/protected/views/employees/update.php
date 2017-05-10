<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	Yii::t('trans','Kullanıcılar')=>array('index'),
	Yii::t('trans','Yönet'),
);

$this->menu=array(
	
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Görüntüle'), 'url'=>array('view', 'id'=>$model->employeesID)),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
	
	array('label'=>Yii::t('trans','Kullanıcıya Uygulama Atama'), 'url'=>array('worldemployees')),
);
?>

<h1><?=Yii::t('trans','Kullanıcılar')?> #<?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
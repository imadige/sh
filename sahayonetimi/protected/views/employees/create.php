<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	Yii::t('trans','Kullanıcılar')=>array('index'),
	Yii::t('trans','Yeni Kullanıcı'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
	
	array('label'=>Yii::t('trans','Kullanıcıya Uygulama Atama'), 'url'=>array('worldemployees')),
);
?>

<h1><?=Yii::t('trans','Kullanıcılar - Yeni Kullanıcı Oluştur')?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
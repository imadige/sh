<?php
/* @var $this CustomergroupsController */
/* @var $model Customergroups */

$this->breadcrumbs=array(
	Yii::t('trans','Müşteri Grublar')=>array('index'),
	$model->name=>array('view','id'=>$model->customerGroupsID),
	Yii::t('trans','Güncelle'),
);

$this->menu=array(

	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Görüntüle'), 'url'=>array('view', 'id'=>$model->customerGroupsID)),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),

);
?>

<h1><?=Yii::t('trans','Müşteri - Grub - Güncelle')?> #<?php echo $model->customerGroupsID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
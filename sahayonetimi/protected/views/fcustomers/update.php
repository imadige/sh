<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	Yii::t('trans','Fırsatlar')=>array('index'),
	$model->name=>array('view','id'=>$model->customerID),
	Yii::t('trans','Güncelle'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Görüntüle'), 'url'=>array('view', 'id'=>$model->customerID)),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Fırsatlar - Güncelle')?> #<?php echo $model->customerID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'city'=>$city)); ?>
<?php
/* @var $this DealersController */
/* @var $model Dealers */

$this->breadcrumbs=array(
	Yii::t('trans','Bayiler')=>array('index'),
	$model->name=>array('view','id'=>$model->dealersID),
	Yii::t('trans','Güncelle'),
);

$this->menu=array(
	
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Görüntüle'), 'url'=>array('view', 'id'=>$model->dealersID)),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Bayiler - Güncelle')?> #<?php echo $model->dealersID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'city'=>$city,)); ?>
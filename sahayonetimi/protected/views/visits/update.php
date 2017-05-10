<?php
/* @var $this VisitsController */
/* @var $model Visits */

$this->breadcrumbs=array(
	Yii::t('trans','Ziyaretler')=>array($model->cdtype==1?'customersadmin':'dealersadmin'),
	Yii::t('trans','Güncelle'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Görüntüle'), 'url'=>array('view', 'id'=>$model->visitsID)),
	array('label'=>Yii::t('trans','Sil'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->visitsID),'confirm'=>Yii::t('trans','Müşteriyi silmek istediğinize eminmisiniz?'))),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array($model->cdtype==1?'customersadmin':'dealersadmin')),
);


?>
<h1><?=Yii::t('trans','Ziyaretler - Güncelle')?> - <?php echo VisitsController::getParams("visitsplus")+$model->visitsID; ?></h1>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
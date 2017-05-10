<?php
/* @var $this CustomergroupsController */
/* @var $model Customergroups */

$this->breadcrumbs=array(
	Yii::t('trans','Müşteri Grublar')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Güncelle'), 'url'=>array('update', 'id'=>$model->customerGroupsID)),
	array('label'=>Yii::t('trans','Sil'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->customerGroupsID),'confirm'=>Yii::t('trans','Müşteriyi silmek istediğinize eminmisiniz?'))),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Müşteri Grub')?> #<?php echo $model->customerGroupsID; ?></h1>
<br /><br />
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'customerGroupsID',
		'name',
		'companyID',
	),
)); ?>

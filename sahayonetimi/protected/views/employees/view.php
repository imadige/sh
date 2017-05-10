<?php
/* @var $this DealersController */
/* @var $model Dealers */

$this->breadcrumbs=array(
	Yii::t('trans','Kullanıcılar')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Güncelle'), 'url'=>array('update', 'id'=>$model->employeesID)),
	array('label'=>Yii::t('trans','Sil'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->employeesID),'confirm'=>Yii::t('trans','Bayiyi silmek istediğinize eminmisiniz?'))),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
	
	array('label'=>Yii::t('trans','Kullanıcıya Uygulama Atama'), 'url'=>array('worldemployees')),
);
?>

<h1><?=Yii::t('trans','Kullanıcı')?> #<?php echo $model->name; ?></h1>
<br /><br />

<div class="left" style="width:130px;"><?=EmployeesController::getEmployeesLogo120($model->avatar,$model->employeesID)?></div>
<div class="logoSettings">
	<div class="item"><a href="<?=Yii::app()->createUrl("employees/addlogo",array("id"=>$model->employeesID))?>"><img src="<?=Yii::app()->baseUrl?>/images/settings.png"  /> <?=Yii::t('trans','Resim Ekle/Değiştir')?></a></div>
    <div class="item"><a href="<?=Yii::app()->createUrl("employees/deletelogo",array("id"=>$model->employeesID))?>"><img src="<?=Yii::app()->baseUrl?>/images/delete.png" /> <?=Yii::t('trans','Resmi Sil')?></a></div>
</div>
<div class="clear"></div>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'title',
		'email',
		
		array(
			'type'=>'raw', 
			'name'=>'erights',
			'value'=>EmployeesController::getParams_("erights",$model->erights),
		),
	),
)); ?>

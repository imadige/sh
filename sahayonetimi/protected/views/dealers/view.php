<?php
/* @var $this DealersController */
/* @var $model Dealers */

$this->breadcrumbs=array(
	Yii::t('trans','Bayiler')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Güncelle'), 'url'=>array('update', 'id'=>$model->dealersID)),
	array('label'=>Yii::t('trans','Sil'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->dealersID),'confirm'=>Yii::t('trans','Bayiyi silmek istediğinize eminmisiniz?'))),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Bayi')?> #<?php echo $model->name; ?></h1>
<br /><br />

<div class="left" style="width:130px;"><?=DealersController::getDealerLogo120($model->logo,$model->dealersID)?></div>
<div class="logoSettings">
	<div class="item"><a href="<?=Yii::app()->createUrl("dealers/addlogo",array("id"=>$model->dealersID))?>"><img src="<?=Yii::app()->baseUrl?>/images/settings.png"  /> <?=Yii::t('trans','Logo Ekle/Değiştir')?></a></div>
    <div class="item"><a href="<?=Yii::app()->createUrl("dealers/deletelogo",array("id"=>$model->dealersID))?>"><img src="<?=Yii::app()->baseUrl?>/images/delete.png" /> <?=Yii::t('trans','Logo Sil')?></a></div>
</div>
<div class="clear"></div>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'type'=>'raw', 
			'name'=>'dealersID',
			'value'=>$model->dealersID+DealersController::getParams("dealerplus"),
		),
		'name',
		'title',
		'email',
		'phone',
		'cphone',
		'fax',
		
		array(
			'type'=>'raw', 
			'name'=>'country',
			'value'=>DealersController::getCountry($model->country),
		),
		array(
			'type'=>'raw', 
			'name'=>'city',
			'value'=>DealersController::getCity($model->city),
		),
		'county',
		'adres',
		array(
			'type'=>'raw', 
			'name'=>'taxno',
			'value'=>DealersController::getParams_("taxnoType",$model->taxnotype)." : ".$model->taxno,
		),
		'taxoffice',
		array(
			'type'=>'raw', 
			'name'=>'dateAdd',
			'value'=>DealersController::getDateTimeFormat($model->dateAdd),
		),
		array(
			'type'=>'raw', 
			'name'=>'addEmployeesID',
			'value'=>DealersController::getEmployeesName($model->addEmployeesID),
		),

	),
)); ?>

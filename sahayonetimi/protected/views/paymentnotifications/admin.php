<style type="text/css">
.span-19{
	width:95%;
}
</style>

<?php
/* @var $this PaymentnotificationsController */
/* @var $model Paymentnotifications */

$this->breadcrumbs=array(
	Yii::t('trans','Ödeme Bildirimleri'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#paymentnotifications-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('trans','Ödeme Bildirimleri - Yönet')?></h1>

<p style="margin-top:30px;">
<?=Yii::t('trans','İsteğe bağlı olarak bir karşılaştırma operatörü (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) karşılaştırma yapılmalıdır. Arama değerlerini nasıl belirlemek istersen, herbirinin başına girebilirsin.')?>
</p>

<div style="margin:20px 0px 20px 0px"><?php echo CHtml::link(Yii::t('trans','Detaylı Arama'),'#',array('class'=>'search-button')); ?></div>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'paymentnotifications-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'type'=>'raw', 
			'name'=>'paymentnotificationsID',
			'value'=>'$data->paymentnotificationsID+PaymentnotificationsController::getParams("paymentplus")',
			'headerHtmlOptions'=>array('width'=>'100px',),
		
		),
		array(
			'type'=>'raw', 
			'name'=>'cdtype',
			'value'=>'PaymentnotificationsController::getParams_("cdtype",$data->cdtype)',
			'headerHtmlOptions'=>array('width'=>'160px',),
		
		),
		array(
			'type'=>'raw', 
			'name'=>'customerdealerID',
			'value'=>'$data->customerdealerID+PaymentnotificationsController::getParams("dealercustomerplus")',
			'headerHtmlOptions'=>array('width'=>'160px',),
		
		),
		
		'customerdealerName',
		array(
			'type'=>'raw', 
			'name'=>'dateAdd',
			'value'=>'PaymentnotificationsController::getDateTimeFormat($data->dateAdd)',
			'headerHtmlOptions'=>array('width'=>'160px',),
		
		),
		
		
		/*
		
		'cdtype',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'headerHtmlOptions'=>array('width'=>'70px',),
		),
	),
)); ?>

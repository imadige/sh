<?php
/* @var $this AppointmentsController */
/* @var $model Appointments */

$this->breadcrumbs=array(
	Yii::t('trans','Randevular')=>array('index'),
	Yii::t('trans','Yönet'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#appointments-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('trans','Randevular - Yönet')?></h1>

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
	'id'=>'appointments-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'type'=>'raw', 
			'name'=>'appointmentsID',
			'value'=>'$data->appointmentsID+AppointmentsController::getParams("appointmentsplus")',
			'headerHtmlOptions'=>array('width'=>'100px',),
		
		),
		
		array(
			'type'=>'raw', 
			'name'=>'customerdealer',
			'value'=>'$data->Customers->name',
			'headerHtmlOptions'=>array('width'=>'250px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			
		),
		
		array(
			'type'=>'raw', 
			'name'=>'appointmentDate',
			'value'=>'AppointmentsController::getDateTimeFormat($data->appointmentDate)',
			'headerHtmlOptions'=>array('width'=>'100px',),
		
		),
		
		/*
		'worldID',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{visit}{view}{update}{delete}',
			'headerHtmlOptions'=>array('width'=>'100px',),
			
			'buttons'=>array
  			(
				'visit' => array
					(
						'label'=>Yii::t('trans','Ziyaret Ekle'),
						'imageUrl'=>Yii::app()->baseUrl.'/images/visits.png',  
						'url'=>'Yii::app()->createUrl("visits/create",array("appointmentsID"=>$data->appointmentsID+AppointmentsController::getParams("appointmentsplus"),"customerdealersID"=>$data->customerdealersID+AppointmentsController::getParams("dealercustomerplus"),"cdtype"=>$data->cdtype))',  
					)
			),
		),
	),
)); ?>

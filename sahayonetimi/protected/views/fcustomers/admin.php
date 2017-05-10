<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	Yii::t('trans','Fırsatlar')=>array('index'),
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
	$('#customers-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('trans','Fırsatlar - Yönet')?></h1>

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
	'id'=>'customers-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		array(
			'type'=>'raw', 
			'name'=>'customerID',
			'value'=>'$data->customerID+FcustomersController::getParams("dealercustomerplus")',
			'headerHtmlOptions'=>array('width'=>'100px',),
		
		),
		'name',
		array(
			'type'=>'raw', 
			'name'=>'cgID',
			'value'=>'FcustomersController::getCg($data->cgID)',
			'filter'=>FcustomersController::getCgList(),
			'headerHtmlOptions'=>array('width'=>'150px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'addEmployeesID',
			'value'=>'FcustomersController::getEmployeesName($data->addEmployeesID)',
		),
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{randevu}{view}{update}{delete}',
			'headerHtmlOptions'=>array('width'=>'120px',),
			'buttons'=>array
				(
					
					'randevu' => array
					(
						'label'=>Yii::t('trans','Randevu Ekle'),     //Text label of the button.
						'imageUrl'=>Yii::app()->baseUrl.'/images/schedule.png',  //Image URL of the button.
					
						'url'=>'Yii::app()->createUrl("appointments/create2", array("id"=>$data->customerID,"cdtype"=>1))', 
					),
					
				)
		),
	),
)); ?>

<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	Yii::t('trans','Kullanıcılar')=>array('index'),
	Yii::t('trans','Kullanıcıya Uygulama Atama'),
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
	$('#employees-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('trans','Kullanıcılar - Kullanıcıya Uygulama Atama')?></h1>


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


<div style="text-align:center">
	<div style="width:600px">

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'employees-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'type'=>'raw', 
			'name'=>'avatar',
			'value'=>'EmployeesController::getEmployeesLogo30($data->avatar,$data->employeesID)',
			'filter'=>'',
			'headerHtmlOptions'=>array('width'=>'10px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'employeesID',
			'value'=>'$data->employeesID+EmployeesController::getParams("defultemployeesplus")',
			'headerHtmlOptions'=>array('width'=>'100px',),
		
		),
		array(
			'type'=>'raw', 
			'name'=>'name',
			'value'=>'$data->name',
			'headerHtmlOptions'=>array('width'=>'500px',),
		
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{worldemployees}',
			'headerHtmlOptions'=>array('width'=>'120px',),
			'buttons'=>array
				(
					
					
					'worldemployees' => array
					(
						'label'=>Yii::t('trans','Uygulama Yetkilendirme'),     //Text label of the button.
						'imageUrl'=>Yii::app()->baseUrl.'/images/group.png',  //Image URL of the button.
					
						'url'=>'Yii::app()->createUrl("employees/worldemployeesedit", array("id"=>$data->employeesID))', 
					),
					
				)
		),

	),
)); ?>
	</div>
</div>
<?php
/* @var $this CustomergroupsController */
/* @var $model Customergroups */

$this->breadcrumbs=array(
	Yii::t('trans','Müşteri Grublar')=>array('index'),
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
	$('#customergroups-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('trans','Müşteri Grublar - Yönet')?></h1>

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
	'id'=>'customergroups-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'type'=>'raw', 
			'name'=>'customerGroupsID',
			'value'=>'$data->customerGroupsID',
			'headerHtmlOptions'=>array('width'=>'50px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'name',
			'value'=>'$data->name',
			'headerHtmlOptions'=>array('width'=>'150px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

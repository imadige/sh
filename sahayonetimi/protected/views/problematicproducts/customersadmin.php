<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	Yii::t('trans','Servis')=>array('admin'),
	Yii::t('trans','Sorunlu Ürünler - Müşterilere Göre'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Genele Göre'), 'url'=>array('admin')),
	array('label'=>Yii::t('trans','Bayilere Göre'), 'url'=>array('dealersadmin')),
	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#problematicproducts-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('trans','Servis - Sorunlu Ürünler - Müşterilere Göre')?></h1>

<p style="margin-top:30px;">
<?=Yii::t('trans','İsteğe bağlı olarak bir karşılaştırma operatörü (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) karşılaştırma yapılmalıdır. Arama değerlerini nasıl belirlemek istersen, herbirinin başına girebilirsin.')?>
</p>

<div style="margin:20px 0px 20px 0px"><?php echo CHtml::link(Yii::t('trans','Detaylı Arama'),'#',array('class'=>'search-button')); ?></div>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchcdtype',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'problematicproducts-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'type'=>'raw', 
			'name'=>'problematicproductsID',
			'value'=>'"S-".($data->problematicproductsID+ProblematicproductsController::getParams("problematicplus"))',
			'headerHtmlOptions'=>array('width'=>'130px',),
		
		),
		
		array(
			'type'=>'raw', 
			'name'=>'productsID',
			'value'=>'$data->Products->name',
			'headerHtmlOptions'=>array('width'=>'250px',),
		
		),
		
		array(
			'type'=>'raw', 
			'name'=>'customerdealerID',
			'value'=>'$data->Customers->name',
			'headerHtmlOptions'=>array('width'=>'250px',),
		
		),
		
		array(
			'type'=>'raw', 
			'name'=>'problematicStatus',
			'value'=>'ProblematicproductsController::getParams_("problematicStatus",$data->problematicStatus)',
			'headerHtmlOptions'=>array('width'=>'100px',),
			'filter'=>ProblematicproductsController::getParams("problematicStatus"),
		
		),
		array(
			'class'=>'CButtonColumn',
			'headerHtmlOptions'=>array('width'=>'120px',),
		),
	),
)); ?>

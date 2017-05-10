<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	Yii::t('trans','Ürün')=>array('index'),
	Yii::t('trans','Yönet'),
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#products-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<style type="text/css">

.span-19{
	width:95%;
}
</style>

<h1><?=Yii::t('trans','Ürünler - Yönet')?></h1>

<p style="margin-top:30px;">
<?=Yii::t('trans','İsteğe bağlı olarak bir karşılaştırma operatörü (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) karşılaştırma yapılmalıdır. Arama değerlerini nasıl belirlemek istersen, herbirinin başına girebilirsin.')?><br />
<b><?=Yii::t('trans','Örnek ürün satış fiyatında >450 yazarak 450 ücretinden küçük ürünleri bulur.')?></b>
</p>

<div style="margin:20px 0px 20px 0px"><?php echo CHtml::link(Yii::t('trans','Detaylı Arama'),'#',array('class'=>'search-button')); ?></div>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 

$dataGroup=array();	

foreach(ProductsController::getProductgroups3() as $key=>$value)
	$dataGroup[$key]=$value;	
	
function getReducePrice($price, $cur){
	if($price!="")
		return '<font color="#009900" style="font-weight:700">'.number_format($price,2)." ".@ProductsController::getParams_("currency",$cur).'</font>';
}
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'products-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		array(
			'type'=>'raw', 
			'name'=>'productsID',
			'value'=>'($data->productsID+ProductsController::getParams("defultproductplus"))',
			'headerHtmlOptions'=>array('width'=>'110px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'name',
			'value'=>'$data->name',
			'headerHtmlOptions'=>array('width'=>'170px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'brand',
			'value'=>'$data->brand',
			'headerHtmlOptions'=>array('width'=>'120px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		
		array(
			'type'=>'raw', 
			'name'=>'model',
			'value'=>'$data->model',
			'headerHtmlOptions'=>array('width'=>'80px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		
		array(
			'type'=>'raw', 
			'name'=>'productgroupsID',
			'value'=>'$data->Productgroups->name',
			'filter'=>$dataGroup,
			'headerHtmlOptions'=>array('width'=>'140px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'purchasePrice',
			'value'=>'number_format($data->Productdetail->purchasePrice,2)." ".@ProductsController::getParams_("currency",$data->Productdetail->purchaseCur)',
			'headerHtmlOptions'=>array('width'=>'80px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'salePrice',
			'value'=>'number_format($data->Productdetail->salePrice,2)." ".@ProductsController::getParams_("currency",$data->Productdetail->saleCur)',
			'headerHtmlOptions'=>array('width'=>'80px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'reducedPrice',
			'value'=>'getReducePrice($data->Productdetail->reducedPrice,$data->Productdetail->reduceCur)',
			'headerHtmlOptions'=>array('width'=>'80px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		
		
		/*
		
		'brand',
		
		'companyID',
		'worldID',
		*/
		array(
			'class'=>'CButtonColumn',
			'headerHtmlOptions'=>array('width'=>'150px',),
		),
	),
)); ?>

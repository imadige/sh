<div id="cboxOverlaya" style="display: block; opacity: 0.9; cursor: pointer;display:none;"></div>
    <div id="colorboxa" class="" style="padding-bottom: 42px; padding-right: 42px; display: block; position: fixed; width: 1037px; height: 576px; top: 10px; left: 135px;z-index:10000;display:none;">
        <div id="cboxWrappers" style="height: 618px; width: 1079px;display:none;">
        <div style="">
        <div id="cboxTopLeft" style="float: left;"></div>
        <div id="cboxTopCenter" style="float: left; width: 1037px;"></div>
        <div id="cboxTopRight" style="float: left;"></div>
        </div>
        <div style="clear: left;">
        <div id="cboxMiddleLeft" style="float: left; height: 576px;"></div>
        <div id="cboxContent" style="float: left; width: 1037px; height: 576px;">
        <div id="cboxLoadedContents" style="display: block; width: 1037px; overflow: auto; height: 548px;"><?=Yii::t('trans','Bekleyiniz...')?></div>
        <div id="cboxLoadingOverlay" class="" style="height: 576px; display: none;"></div>
        <div id="cboxLoadingGraphic" class="" style="height: 576px; display: none;"></div>
        <div id="cboxTitle" class="" style="display: block;"></div>
        <div id="cboxCurrent" class="" style="display: none;"></div>
        <div id="cboxNext" class="" style="display: none;"></div>
        <div id="cboxPrevious" class="" style="display: none;"></div>
        <div id="cboxSlideshow" class="" style="display: none;"></div>
        <div id="cboxClose" class="" style="" onclick="clboxxlose()">close</div>
        </div>
        <div id="cboxMiddleRight" style="float: left; height: 576px;"></div>
        </div>
        <div style="clear: left;">
        
        <div id="cboxBottomLeft" style="float: left;"></div>
        <div id="cboxBottomCenter" style="float: left; width: 1037px;"></div>
        <div id="cboxBottomRight" style="float: left;"></div>
        </div>
    </div>
    <div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div>
</div>


<?php
/* @var $this ProductsController */
/* @var $model Products */

if(Yii::app()->user->getState("salesType")=="customer"){
	$this->breadcrumbs=array(
	
		Yii::t('trans','Hızlı Müşteri ürün satış'),
	);
}else{
	$this->breadcrumbs=array(
	
		Yii::t('trans','Hızlı Bayi ürün satış'),
	);
}
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
$colorbox->addInstance('.colorbox', array('frame'=>true,'width'=>'80%', 'height'=>'93%'));


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
<?PHP

if(Yii::app()->user->getState("salesType")=="customer"){
	?>
    
    <h1><?=Yii::t('trans','Hızlı Satış - Müşteri')?></h1>
    <?PHP
}else{
	?>
    <h1><?=Yii::t('trans','Hızlı Satış - Bayi')?></h1>
    <?PHP
}
?>



<div style="margin:20px 0px 20px 0px"><?php echo CHtml::link(Yii::t('trans','Detaylı Arama'),'#',array('class'=>'search-button')); ?></div>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 

$dataGroup=array();	


	
	

$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'products-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		array(
			'type'=>'raw', 
			'name'=>'productsID',
			'value'=>'($data->productsID+SalesController::getParams("defultproductplus"))',
			'headerHtmlOptions'=>array('width'=>'110px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'name',
			'value'=>'$data->name',
			'headerHtmlOptions'=>array('width'=>'180px',),
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
			'filter'=>SalesController::getProductgroups_(3),
			'headerHtmlOptions'=>array('width'=>'140px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
	
		array(
			'type'=>'raw', 
			'name'=>'hsale',
			'value'=>'@SalesController::getFastSalePrice($data->productsID)',
			'headerHtmlOptions'=>array('width'=>'170px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		
		array(
			'class'=>'CButtonColumn',
			'headerHtmlOptions'=>array('width'=>'100px',),
			
			'template'=>'{view}{sepet}',
			'buttons'=>array
  			(
				'sepet' => array
					(
						'label'=>Yii::t('trans','Sepet'),
						'imageUrl'=>Yii::app()->baseUrl.'/images/shop_cart.png',  
						'url'=>'"javascript:;"',	
							'click'=>'function(){clbox(this);}',    
					)
			),
		),
	),
)); ?>

<script type="text/javascript">
function clbox(element){
	

	$('#cboxWrappers').show();
	$('#colorboxa').show();
	var ids=$(element).parent().prev().children(".ids").html();
	
	$.post("<?=Yii::app()->createUrl("sales/basket")?>/"+ids,function(data){
		$('#cboxLoadedContents').html(data);
	});
}

function clboxxlose(){
	
	$('#cboxWrappers').hide();
	$('#colorboxa').hide();
	$('#cboxLoadedContents').html("<?=Yii::t('trans','Bekleyiniz...')?>");
}  
</script> 
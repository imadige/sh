<?php
/* @var $this SalescompletecustomerController */
/* @var $model Salescompletecustomer */

$this->breadcrumbs=array(
	Yii::t('trans','Depo Ayarlanması - Müşteri Satışlar'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#salescompletecustomer-grid').yiiGridView('update', {
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
<h1><?=Yii::t('trans','Depo Ayarlanması - Müşteri Satışlar')?></h1>


<table style="margin-top:20px;">
    <tr style="border-bottom:1px dashed #999999;">
    <td colspan="4" style="font-size:16px;"><?=Yii::t('trans','Satış Konumu')?></td>
    </tr>
	
    <tr>
        
        <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/circle_orange.png" /></td>
        <td width="250"><?=Yii::t('trans','Ödeme onaylanmış.')?></td>
        
        <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/circle_mor.png" /></td>
       	 <td width="250"><?=Yii::t('trans','Ürün depo ayarlanmış.')?></td>
    </tr>
   
  
  
</table>




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
	'id'=>'salescompletecustomer-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'type'=>'raw', 
			'name'=>'salescompleteID',
			'value'=>'$data->salescompleteID+Salescompletecustomer::getParams("defultfiloplus")',
			'headerHtmlOptions'=>array('width'=>'170px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'salesEs',
			'value'=>'SalescompletecustomerController::getsalesEsWarehous($data->salesEs,$data->salescompleteID)',
			'headerHtmlOptions'=>array('width'=>'100px',),
			'filter'=>SalescompletecustomerController::getParams("salesEs"),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		
		array(
			'type'=>'raw', 
			'name'=>'customerID',
			'value'=>'$data->Customers->name',
			'headerHtmlOptions'=>array('width'=>'250px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			
		),
		
		array(
			'type'=>'raw', 
			'name'=>'salesEsDate',
			'value'=>'SalescompletecustomerController::getDateTimeFormat($data->salesEsDate)',
			'headerHtmlOptions'=>array('width'=>'140px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			
		),
		
		
		array(
			'class'=>'CButtonColumn',
			
			'template'=>'{depo}',
			'headerHtmlOptions'=>array('width'=>'70px',),
			'buttons'=>array
				(
					
					'depo' => array
					(
						'label'=>Yii::t('trans','Depo Ayarı'),     //Text label of the button.
						'imageUrl'=>Yii::app()->baseUrl.'/images/network_sans_edit.png',  //Image URL of the button.
					
						'url'=>'Yii::app()->createUrl("salescompletecustomer/warehouseadjustment", array("id"=>$data->salescompleteID))', 
					),
					
				)
		),
	),
)); 

?>
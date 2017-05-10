<?php
/* @var $this SalescompletecustomerController */
/* @var $model Salescompletecustomer */

$this->breadcrumbs=array(
	Yii::t('trans','Satış Takip ve Fatura - Müşteri Satışlar'),
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
<h1><?=Yii::t('trans','Satış Takip ve Fatura - Müşteri Satışlar')?></h1>


<table style="margin-top:20px;">
    <tr style="border-bottom:1px dashed #999999;">
    <td colspan="4" style="font-size:16px;"><?=Yii::t('trans','Satış Konumu')?></td>
    </tr>
	<tr>
        <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/circle_gri.png" /></td>
        <td width="250"><?=Yii::t('trans','Konumlandırılmamış.')?></td>
        
        <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/circle_green.png" /></td>
        <td width="250"><?=Yii::t('trans','Filo kargoya verilmiş.')?></td>
    </tr>
    <tr>
        <td><img src="<?=Yii::app()->baseUrl?>/images/circle_red.png" /></td>
        <td><?=Yii::t('trans','Henüz ödeme yapılmamış.')?></td>
        
         <td><img src="<?=Yii::app()->baseUrl?>/images/circle_orange.png" /></td>
        <td><?=Yii::t('trans','Ödeme onaylanmış.')?></td>
    </tr>
    <tr>
        <td><img src="<?=Yii::app()->baseUrl?>/images/circle_yellow.png" /></td>
        <td><?=Yii::t('trans','Filo hazırlanma aşamasıdır.')?></td>
        
         <td><img src="<?=Yii::app()->baseUrl?>/images/circle_mor.png" /></td>
       	 <td><?=Yii::t('trans','Ürün depo ayarlanmış.')?></td>
        
    </tr>
   
  
  
</table>

<table style="margin-top:20px;">
    <tr style="border-bottom:1px dashed #999999;">
    <td colspan="4" style="font-size:16px;"><?=Yii::t('trans','Satış Durumu')?></td>
    </tr>
	<tr>
        <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/square_0.png" /></td>
        <td width="250"><?=Yii::t('trans','Ödeme Bekliyor.')?></td>
        
        <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/square_1.png" /></td>
        <td width="250"><?=Yii::t('trans','Ödeme Daha Sonra Gerçekletirilecek')?></td>
    </tr>
    <tr>
        <td><img src="<?=Yii::app()->baseUrl?>/images/square_2.png" /></td>
        <td><?=Yii::t('trans','Ödeme Kısmi Yapıldı.')?></td>
        
        <td><img src="<?=Yii::app()->baseUrl?>/images/square_3.png" /></td>
        <td><?=Yii::t('trans','Ödeme Yapıldı.')?></td>
    </tr>
    
     <tr>
        <td><img src="<?=Yii::app()->baseUrl?>/images/square_4.png" /></td>
        <td><?=Yii::t('trans','Ret')?></td>
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
			'value'=>'$data->salescompleteID+SalescompletecustomerController::getParams("defultfiloplus")',
			'headerHtmlOptions'=>array('width'=>'170px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'salesEs',
			'value'=>'SalescompletecustomerController::getsalesEs($data->salesEs,$data->salescompleteID)',
			'headerHtmlOptions'=>array('width'=>'180px',),
			'filter'=>SalescompletecustomerController::getParams("salesEs"),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		
		array(
			'type'=>'raw', 
			'name'=>'salesStatus',
			'value'=>'SalescompletecustomerController::getsalesStatus($data->salesStatus)',
			'headerHtmlOptions'=>array('width'=>'70px',),
			'filter'=>SalescompletecustomerController::getParams("salesStatus"),
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
			'template'=>'{view}',
			'headerHtmlOptions'=>array('width'=>'100px',),
		),
	),
)); 

?>




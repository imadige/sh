<?php
/* @var $this VisitsController */
/* @var $model Visits */

$this->breadcrumbs=array(
	Yii::t('trans','Ziyaretler'),
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
	$('#visits-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('trans','Ziyaret - Yönet')?></h1>

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

<?php

function getDateTimeFormat($visitDate,$customerdealerID,$cdtype,$visitsID){
	return VisitsController::getDateTimeFormat($visitDate).'<span class="ids" style="display:none">'.$customerdealerID.':'.$cdtype.':'.$visitsID.'</span>';
}

 $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'visits-grid',
		'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	
		array(
			'type'=>'raw', 
			'name'=>'visitsID',
			'value'=>'$data->visitsID+VisitsController::getParams("visitsplus")',
			'headerHtmlOptions'=>array('width'=>'100px',),
		
		),
		
		array(
			'type'=>'raw', 
			'name'=>'customerdealer',
			'value'=>'$data->Dealers->name',
			'headerHtmlOptions'=>array('width'=>'250px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			
		),
		
		array(
			'type'=>'raw', 
			'name'=>'employeesID',
			'value'=>'$data->Employees->name',
			'headerHtmlOptions'=>array('width'=>'250px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			
		),
		
		
		
		array(
			'type'=>'raw', 
			'name'=>'visitType',
			'value'=>'VisitsController::getParams_("visitType",$data->visitType)',
			'headerHtmlOptions'=>array('width'=>'250px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			'filter'=>VisitsController::getParams("visitType"),
		),
	
		array(
			'type'=>'raw', 
			'name'=>'status',
			'value'=>'VisitsController::getParams_("visitStatus",$data->status)',
			'headerHtmlOptions'=>array('width'=>'250px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			'filter'=>VisitsController::getParams("visitStatus"),
			
		),
		array(
			'type'=>'raw', 
			'name'=>'visitDate',
			'value'=>'getDateTimeFormat($data->visitDate,$data->customerdealerID,$data->cdtype,$data->visitsID)',
			'headerHtmlOptions'=>array('width'=>'250px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
			
		),
	
	
		array(
			'class'=>'CButtonColumn',
			'headerHtmlOptions'=>array('width'=>'270px',),
			'template'=>'{sale}{view}{update}{delete}',
			
			'buttons'=>array
  			(
				'sale' => array
					(
						'label'=>Yii::t('trans','Satış'),
						'imageUrl'=>Yii::app()->baseUrl.'/images/sale.png',  
						'url'=>'"javascript:;"',	
							'click'=>'function(){clx(this);}',   
					)
			),
		),
	),
)); ?>


<script type="text/javascript">
function clx(element){
	var ids=$(element).parent().prev().children(".ids").html();
	var ids2=ids.split(":")
	
	var dataString = 'id='+ ids2[0]+'&cdtype='+ids2[1]+'&visitsID='+ids2[2];
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("visits/setvisit")?>", 
			 data: dataString,
			 success: function(data)
			 {
				
				if(data.sonuc==1){
					$('.visitcontent').slideDown(function(){
						if(ids2[1]==1){
							window.location="<?=Yii::app()->createUrl("sales/customer")?>";
						}else if(ids2[1]==2){
							window.location="<?=Yii::app()->createUrl("sales/dealer")?>";
						}
					});
					$('.textVisitCx').html(data.name);
				}
			 }
			 
			});
}
</script>

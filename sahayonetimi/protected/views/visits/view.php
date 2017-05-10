<?php
/* @var $this VisitsController */
/* @var $model Visits */

$this->breadcrumbs=array(
	Yii::t('trans','Ziyaretler')=>array($model->cdtype==1?'customersadmin':'dealersadmin'),
	 VisitsController::getCustomerdealer($model->customerdealerID,$model->cdtype),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Güncelle'), 'url'=>array('update', 'id'=>$model->visitsID)),
	array('label'=>Yii::t('trans','Sil'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->visitsID),'confirm'=>Yii::t('trans','Müşteriyi silmek istediğinize eminmisiniz?'))),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array($model->cdtype==1?'customersadmin':'dealersadmin')),
);

?>

<h1><?=Yii::t('trans','Ziyaret')?> #<?php echo VisitsController::getCustomerdealer($model->customerdealerID,$model->cdtype); ?></h1>
<br /><br /><?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	
		array(
			'type'=>'raw', 
			'name'=>'visitsID',
			'value'=>VisitsController::getParams("visitsplus")+$model->visitsID,
		),
		array(
			'type'=>'raw', 
			'name'=>'visitDate',
			'value'=>VisitsController::getDateTimeFormat($model->visitDate),
		),
		array(
			'type'=>'raw', 
			'name'=>'appointmentsID',
			'value'=>VisitsController::getParams("appointmentsplus")+$model->appointmentsID,
		),
		
		array(
			'type'=>'raw', 
			'name'=>'visitType',
			'value'=>VisitsController::getParams_("visitType",$model->visitType),
		),
	
		
		
		array(
			'type'=>'raw', 
			'name'=>'status',
			'value'=>VisitsController::getParams_("visitStatus",$model->status),
		),
		array(
			'type'=>'raw', 
			'name'=>'cdtype',
			'value'=>VisitsController::getParams_("cdtype",$model->cdtype),
		),
		array(
			'type'=>'raw', 
			'name'=>'customerdealerID',
			'value'=>VisitsController::getCustomerDealer($model->customerdealerID,$model->cdtype),
		),
		array(
			'type'=>'raw', 
			'name'=>'employeesID',
			'value'=>VisitsController::getEmployeesName($model->employeesID),
		),
		'explanation',
		array(
			'type'=>'raw', 
			'name'=>'sales',
			'value'=>'<a href="javascript:;" onclick="javascript:clx();" ><img src="'.Yii::app()->baseUrl.'/images/sale.png." /> '.Yii::t('trans','Satış Yap').'</a>',
		),
	),
)); ?>


<script type="text/javascript">
function clx(){
	
	
	var dataString = 'id=<?=$model->customerdealerID?>&cdtype=<?=$model->cdtype?>&visitsID=<?=$model->cdtype?>';
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("visits/setvisit")?>", 
			 data: dataString,
			 success: function(data)
			 {
				
				if(data.sonuc==1){
					$('.visitcontent').slideDown(function(){
						<?PHP if($model->cdtype==1){?>
							window.location="<?=Yii::app()->createUrl("sales/customer")?>";
						<?PHP }else{?>
							window.location="<?=Yii::app()->createUrl("sales/dealer")?>";
						<?PHP }?>
					});
					$('.textVisitCx').html(data.name);
				}
			 }
			 
			});
}
</script>

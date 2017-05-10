<?PHP
	$controller=new Sitecontroller;
?>

<div class="cargocontent2">
	<div class="logo"><img src="<?=$controller->getLogo()?>"/></div>
	<div class="titles"><?=Yii::t('trans','Kargo Takip')?></div>
  <?PHP 
  if($model->cdtype==1){
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'type'=>'raw', 
				'name'=>'salescompleteID',
				'value'=>$model->salescompleteID+CargoController::getParams("defultfiloplus"),
			),
			array(
				'type'=>'raw', 
				'name'=>'customerdealerID',
				'value'=>CargoController::getCustomerName($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'scustomerID',
				'value'=>CargoController::getParams("dealercustomerplus")+$model->customerdealerID,
			),
			array(
				'type'=>'raw', 
				'name'=>'salesEs',
				'value'=>CargoController::getParams_("salesEs",$model->salesEs),
			),

			array(
				'type'=>'raw', 
				'name'=>'follownumber',
				'value'=>$modelSalescargo->follownumber,
			),
		 )
	   )
	);
  }else {
	  $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'type'=>'raw', 
				'name'=>'salescompleteID',
				'value'=>$model->salescompleteID+CargoController::getParams("defultfiloplus"),
			),
			array(
				'type'=>'raw', 
				'name'=>'customerdealerID',
				'value'=>CargoController::getDealerName($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'scustomerID',
				'value'=>CargoController::getParams("dealerplus")+$model->customerdealerID,
			),
			array(
				'type'=>'raw', 
				'name'=>'salesEs',
				'value'=>CargoController::getParams_("salesEs",$model->salesEs),
			),
		 )
	   )
	);
  }
  ?>
</div>
<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	Yii::t('trans','Sorunlu Ürün')=>array('index'),
	"S-".($model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Güncelle'), 'url'=>array('update', 'id'=>$model->problematicproductsID)),
	array('label'=>Yii::t('trans','Sil'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->problematicproductsID),'confirm'=>Yii::t('trans','Müşteriyi silmek istediğinize eminmisiniz?'))),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);

$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
$colorbox->addInstance('.barcode', array('frame'=>true,'width'=>'50%', 'height'=>'95%'));
?>

<h1><?=Yii::t('trans','Sorunlu Ürün')?> #<?= "S-".($model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")); ?></h1>
<br /><br />
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'type'=>'raw', 
			'name'=>'problematicproductsID',
			'value'=>"S-".($model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")),
		),
		array(
			'type'=>'raw', 
			'name'=>'productsID',
			'value'=>ProblematicproductsController::getProduct($model->productsID),
		),
		
		'text',
		
		
		array(
			'type'=>'raw', 
			'name'=>'customerdealer',
			'value'=>ProblematicproductsController::getCustomerDealer($model->customerdealerID, $model->cdtype),
		),
		array(
			'type'=>'raw', 
			'name'=>'customerdealerID',
			'value'=>$model->customerdealerID+ProblematicproductsController::getParams("dealercustomerplus"),
		),
		array(
			'type'=>'raw', 
			'name'=>'problematicStatus',
			'value'=>ProblematicproductsController::getParams_("problematicStatus",$model->problematicStatus),
		),
		
		'employeesText',
		
		array(
			'type'=>'raw', 
			'name'=>'barcode',
			'value'=>ProblematicproductsController::getBarcode($model->problematicproductsID),
		),
	),
)); ?>

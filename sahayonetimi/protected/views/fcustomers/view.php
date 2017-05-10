<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	Yii::t('trans','Fırsatlar')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Güncelle'), 'url'=>array('update', 'id'=>$model->customerID)),
	array('label'=>Yii::t('trans','Sil'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->customerID),'confirm'=>Yii::t('trans','Müşteriyi silmek istediğinize eminmisiniz?'))),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('trans','Fırsat')?> #<?php echo $model->name; ?></h1>
<br /><br />
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'type'=>'raw', 
			'name'=>'customerID',
			'value'=>$model->customerID+FcustomersController::getParams("dealercustomerplus"),
		),
		'name',
		'email',
		'phone',
		'cphone',
		'fax',
		array(
			'type'=>'raw', 
			'name'=>'country',
			'value'=>FcustomersController::getCountry($model->country),
		),
		array(
			'type'=>'raw', 
			'name'=>'city',
			'value'=>FcustomersController::getCity($model->city),
		),
		'county',
		'adress',
		'webadress',
		'dateAdd',
		array(
			'type'=>'raw', 
			'name'=>'opportunity',
			'value'=>FcustomersController::getParams_("opportunity",$model->opportunity),
		),

		array(
			'type'=>'raw', 
			'name'=>'addEmployeesID',
			'value'=>FcustomersController::getEmployeesName($model->addEmployeesID),
		),

	),
)); ?>

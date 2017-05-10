<?php
/* @var $this AppointmentsController */
/* @var $model Appointments */

$this->breadcrumbs=array(
	Yii::t('trans','Randevu')=>array('index'),
	AppointmentsController::getCustomerdealer($model->customerdealersID,$model->cdtype),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Oluştur'), 'url'=>array('create')),
	array('label'=>Yii::t('trans','Güncelle'), 'url'=>array('update', 'id'=>$model->appointmentsID)),
	array('label'=>Yii::t('trans','Sil'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->appointmentsID),'confirm'=>Yii::t('trans','Müşteriyi silmek istediğinize eminmisiniz?'))),
	array('label'=>Yii::t('trans','Yönet'), 'url'=>array($model->cdtype==1?'customersadmin':'dealersadmin')),
);

?>

<h1><?=Yii::t('trans','Randevu')?> #<?php echo AppointmentsController::getCustomerdealer($model->customerdealersID,$model->cdtype); ?></h1>
<br /><br />
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		array(
			'type'=>'raw', 
			'name'=>'appointmentsID',
			'value'=>$model->appointmentsID+AppointmentsController::getParams("appointmentsplus"),
		),
		array(
			'type'=>'raw', 
			'name'=>'customerdealer',
			'value'=>AppointmentsController::getCustomerdealer($model->customerdealersID,$model->cdtype),
		),
		array(
			'type'=>'raw', 
			'name'=>'appointmentDate',
			'value'=>AppointmentsController::getDateTimeFormat($model->appointmentDate),
		),
		'appointmentDate',
		'not',
		array(
			'type'=>'raw', 
			'name'=>'dateAdd',
			'value'=>AppointmentsController::getDateTimeFormat($model->dateAdd),
		)
		
	),
)); ?>

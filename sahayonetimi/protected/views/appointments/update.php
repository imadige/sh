<?php
/* @var $this AppointmentsController */
/* @var $model Appointments */

$this->breadcrumbs=array(
	'Appointments'=>array('index'),
	$model->appointmentsID=>array('view','id'=>$model->appointmentsID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Appointments', 'url'=>array('index')),
	array('label'=>'Create Appointments', 'url'=>array('create')),
	array('label'=>'View Appointments', 'url'=>array('view', 'id'=>$model->appointmentsID)),
	array('label'=>'Manage Appointments', 'url'=>array('admin')),
);
?>

<h1>Update Appointments <?php echo $model->appointmentsID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
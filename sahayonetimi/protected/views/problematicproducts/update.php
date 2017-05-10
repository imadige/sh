<?php
$this->breadcrumbs=array(
	'Problematicproducts'=>array('index'),
	$model->problematicproductsID=>array('view','id'=>$model->problematicproductsID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Problematicproducts','url'=>array('index')),
	array('label'=>'Create Problematicproducts','url'=>array('create')),
	array('label'=>'View Problematicproducts','url'=>array('view','id'=>$model->problematicproductsID)),
	array('label'=>'Manage Problematicproducts','url'=>array('admin')),
);
?>

<h1>Update Problematicproducts <?php echo $model->problematicproductsID; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
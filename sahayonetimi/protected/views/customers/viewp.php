
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'email',
		'phone',
		'cphone',
		'fax',
		array(
			'type'=>'raw', 
			'name'=>'country',
			'value'=>CustomersController::getCountry($model->country),
		),
		array(
			'type'=>'raw', 
			'name'=>'city',
			'value'=>CustomersController::getCity($model->city),
		),
		'county',
		'adress',
		

	),
)); ?>



<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'name',
		'title',
		'email',
		'phone',
		'cphone',
		'fax',
		
		array(
			'type'=>'raw', 
			'name'=>'country',
			'value'=>DealersController::getCountry($model->country),
		),
		array(
			'type'=>'raw', 
			'name'=>'city',
			'value'=>DealersController::getCity($model->city),
		),
		'county',
		'adres',
		
	),
)); ?>

<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	Yii::t('trans','Mesajlar')=>array('index'),
	Yii::t('trans','Yönet'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Yeni Mesaj'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ticket-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<h1><?=Yii::t('trans','Mesajlar - Yönet')?></h1>




<?php 

function getTextt($text,$messagesID){
	
	$criteria=new CDbCriteria;
	$criteria->select='readd';
	$criteria->condition='messagesID=:messagesID  AND employeesID=:employeesID';
	$criteria->params=array(':messagesID'=>$messagesID,':employeesID'=>Yii::app()->user->getState("ID"));
	$modelMessagesread=Messagesread::model()->find($criteria);

	if($modelMessagesread->readd==1)
		return mb_substr($text,0,190,"UTF-8")."...";
	else
		return "<b>".mb_substr($text,0,190,"UTF-8")."...</b>";
	
	
}

function getDates($dateAdd,$messagesID){
$criteria=new CDbCriteria;
	$criteria->select='dateAdd';
	$criteria->condition='messagesID=:messagesID';
	$criteria->params=array(':messagesID'=>$messagesID);
	$criteria->order="messagesanswerID DESC";
	$modelAnswer=Messagesanswer::model()->find($criteria);
	
	if(count($modelAnswer)>0){
		$dateAdd=$modelAnswer->dateAdd;
	}

	$dateAdd=new DateTime($dateAdd);
	return $dateAdd->format("d-m-Y H:i");
}


$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'ticket-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'type'=>'raw', 
			'name'=>'messagesID',
			'value'=>'$data->messagesID+MessagesController::getParams("messagesplus")',
			
			'headerHtmlOptions'=>array('width'=>'100px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'text',
			'value'=>'getTextt($data->text,$data->messagesID)',
			'filter'=>'',
			'headerHtmlOptions'=>array('width'=>'400px',),
		),
		array(
			'type'=>'raw', 
			'name'=>'employees',
			'value'=>'$data->Employees->name',
			'headerHtmlOptions'=>array('width'=>'180px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		array(
			'type'=>'raw', 
			'name'=>'dateAdd',
			'value'=>'getDates($data->dateAdd,$data->messagesID)',
			'headerHtmlOptions'=>array('width'=>'150px',),
			'htmlOptions'=>array('style'=>'text-align:center;'),
		),
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'headerHtmlOptions'=>array('width'=>'70px',),
		),
	),
)); ?>

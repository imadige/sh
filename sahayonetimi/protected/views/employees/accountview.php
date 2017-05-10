<?php
/* @var $this DealersController */
/* @var $model Dealers */

$this->breadcrumbs=array(
	Yii::t('trans',',Hesabım'),
);

?>

<h1><?=Yii::t('trans','Hesabım')?></h1>
<br /><br />

<div class="left" style="width:130px;"><?=EmployeesController::getEmployeesLogo120($model->avatar,$model->employeesID)?></div>
<div class="logoSettings">
	<div class="item"><a href="<?=Yii::app()->createUrl("employees/addlogo2")?>"><img src="<?=Yii::app()->baseUrl?>/images/settings.png"  /> <?=Yii::t('trans','Resim Ekle/Değiştir')?></a></div>
    <div class="item"><a href="<?=Yii::app()->createUrl("employees/deletelogo2")?>"><img src="<?=Yii::app()->baseUrl?>/images/delete.png" /> <?=Yii::t('trans','Resmi Sil')?></a></div>
    <div class="item"><a href="<?=Yii::app()->createUrl("employees/update2")?>"><img src="<?=Yii::app()->baseUrl?>/images/pencil.png" width="18" style="width:18px;" /> <?=Yii::t('trans','Hesabımı Güncelle')?></a></div>
    
    <div class="item"><a href="<?=Yii::app()->createUrl("employees/passwordchange")?>"><img src="<?=Yii::app()->baseUrl?>/images/password.png" width="18" style="width:18px;" /> <?=Yii::t('trans','Parolamı Değiştir')?></a></div>
</div>
<div class="clear"></div>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'title',
		'email',
		
		array(
			'type'=>'raw', 
			'name'=>'erights',
			'value'=>EmployeesController::getParams_("erights",$model->erights),
		),
	),
)); ?>

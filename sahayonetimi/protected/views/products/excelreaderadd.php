<?PHP
$this->breadcrumbs=array(
	Yii::t('trans','Ürünler')=>array('admin'),
	Yii::t('trans','EXCEL dosyasını yükle'),
);
?>

<style type="text/css">
input[type=text]{
	width:220px;
	height:25px;
	background:#CCE9F2;
	padding-left:10px;
}
input[type=password]{
	width:220px;
	height:25px;
	background:#CCE9F2;
	padding-left:10px;
}
select{
	width:238px;
	height:35px;
	background:#CCE9F2;
	padding-top:5px;
}
textarea{
	background:#CCE9F2;
}

.form{
	background-color:#E8F0EE;
	padding:20px 20px 20px 20px;
	margin-top:10px;
	border-radius:5px;
}
.groupSelect{
	cursor:pointer;
}
</style>

<div class="form">



<?php

 $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'products-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
   <div style="margin-bottom:10px;">
   		<?=Yii::t('trans','Excel dosyasını belirtiniz.')?>
   </div>
   
    <div class="row">
		<?php echo $form->labelEx($model,'excel'); ?>
		<?php echo $form->fileField($model,'excel'); ?>
		<?php echo $form->error($model,'excel'); ?>
	</div>
   
	
    <div class="row buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'large',
            'label'=>Yii::t('trans','Yükle'),
        	)); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
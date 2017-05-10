<?PHP
	$this->breadcrumbs=array(
	Yii::t('trans','Ürünler')=>array('admin'),
	$modelProductimages->name=>array('update','id'=>$modelProductimages->productsID),
	Yii::t('trans','Resim Ekle'),
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
input[type=file]{
	width:220px;
	height:25px;
	background:#CCE9F2;
	padding-left:10px;
}
select{
	width:238px;
	height:30px;
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
.formcont{
	margin-top:20px;
}
</style>

<div class="form">

<?PHP $this->renderPartial("items/displaymenu",array("id"=>3,"model"=>$model))?>

	<div class="formcont">
	
 <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'productsimages-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>
	
    <div class="row">
		<?php echo $form->labelEx($model,'images'); ?>
		<?php echo $form->fileField($model,'images'); ?>
		<?php echo $form->error($model,'images'); ?>
	</div>
    
      <div class="row">
		<?php echo $form->labelEx($model,'mainimages'); ?>
		<?php echo $form->dropDownList($model,'mainimages',ProductsController::getParams("yesno")); ?>
		<?php echo $form->error($model,'mainimages'); ?>
	</div>
    
    
    <div class="row buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'large',
            'label'=>Yii::t('trans','Ekle'),
        	)); ?>
	</div>
        
    <?php $this->endWidget(); ?>
	</div>
</div>
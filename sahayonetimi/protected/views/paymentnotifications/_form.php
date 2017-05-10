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
	width:450px;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'paymentnotifications-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customerdealerName'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'customerdealerName',
			'options' => array(
                'showAnim' => 'fold',
                //remove if you dont need to store the id, like i do...
                'select' => 'js:function(event, ui){ 
				
					$("#Paymentnotifications_customerdealerID").val(ui.item.id);
					$("#Paymentnotifications_cdtype").val(ui.item.cdtype);
					getCustomerDealer(ui.item.id,ui.item.cdtype);
				}'
            ),

			'source'=>$this->createUrl('paymentnotifications/getcustomerdealer'),
			'htmlOptions'=>array(
				'size'=>'50',
				'style'=>'height:20px;width:446px;',
			),
		)); ?>
        <span class="help_"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
                <div class="text"><?=Yii::t('trans','<b>Otamatik Tamamlama</b><br>Müşteri ismini veya bayi ismini yazın ve listeden müşterinizi seçin. İşlemi otomatik tamamlayın.')?> 		</div>
            </span>
		<?php echo $form->hiddenField($model,'customerdealerID'); ?>
        <?php echo $form->hiddenField($model,'cdtype'); ?>
		<?php echo $form->error($model,'customerdealerID'); ?>
	</div>
    
    <div class="customerdealer clearfix">
    
      		<div class="information">
            </div>
            
        <div class="row">
            <?php echo $form->labelEx($model,'text'); ?>
            <?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>150)); ?>
            <?php echo $form->error($model,'text'); ?>
        </div>


        <div class="row buttons">
              <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                 'type'=>'primary',
                 'size' => 'large',
                'label'=>$model->isNewRecord ? Yii::t('trans','Ekle') : Yii::t('trans','Kaydet'),
                )); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$('.Paymentnotifications_customerdealerName').keydown(function(){
	$('.Paymentnotifications_customerdealerID').val("");
});

function getCustomerDealer(ids,type){
		$('.customerdealer').slideUp();
	if(type==1){
		$.post("<?=Yii::app()->createUrl("customers/viewp")?>/"+ids,function(data){
			
			$('.information').html(data);
			$('.customerdealer').slideDown();
		});
	}else{
		$.post("<?=Yii::app()->createUrl("dealers/viewp")?>/"+ids,function(data){
			
			$('.information').html(data);
			$('.customerdealer').slideDown();
		});
	}
}

<?PHP if($model->customerdealerID!=""):?>
getCustomerDealer(<?=$model->customerdealerID?>,<?=$model->cdtype?>);
<?PHP endif;?>
</script>
<style type="text/css">
input[type=text]{
	width:346px;
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
	width:350px;
	height:100px;
}
.input-append .add-on, .input-prepend .add-on{
	height:25px;
	margin-top:3px;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'problematicproducts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'productsName'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'productsName',
			'options' => array(
                'showAnim' => 'fold',
                //remove if you dont need to store the id, like i do...
                'select' => 'js:function(event, ui){ 
				
					$("#Problematicproducts_productsID").val(ui.item.id);
					
				}'
            ),

			'source'=>$this->createUrl('products/getproduct'),
			'htmlOptions'=>array(
				'size'=>'50'
			),
		)); 
		?>
        <span class="help_"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
                <div class="text"><?=Yii::t('trans','<b>Otamatik Tamamlama</b><br>Ürünün ismini yazın ve listeden ürünü seçin. İşlemi otomatik tamamlayın.')?></div>
            </span>
           <?php echo $form->hiddenField($model,'productsID'); ?>
		<?php echo $form->error($model,'productsID'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'customerdealerID'); ?> 
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'customerdealer',
			'options' => array(
                'showAnim' => 'fold',
                //remove if you dont need to store the id, like i do...
                'select' => 'js:function(event, ui){ 
				
					$("#Problematicproducts_customerdealerID").val(ui.item.id);
					$("#Problematicproducts_cdtype").val(ui.item.cdtype);
					if(ui.item.cdtype==1)
						getCustomer(ui.item.id);
					else
						getDealer(ui.item.id);
				}'
            ),

			'source'=>$this->createUrl('paymentnotifications/getcustomerdealer'),
			'htmlOptions'=>array(
				'size'=>'50'
			),
		)); 
		?>
        <span class="help_"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
        <div class="text"><?=Yii::t('trans','<b>Otamatik Tamamlama</b><br>Sorunlü ürün Müşterinin veya Bayinin ise, Müşteri veya Bayi ismini yazın ve listeden Müşteri veya Bayi adını seçin. İşlemi otomatik tamamlayın veya bu alanı boş geçebilirsiniz.')?></div>
        </span>
         <?php echo $form->hiddenField($model,'customerdealerID'); ?>
         <?php echo $form->hiddenField($model,'cdtype'); ?>
		<?php echo $form->error($model,'customerdealerID'); ?>
	</div>
    
    <div class="information" style="display:none;">
    </div>
            
    
	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
         
		<?php echo $form->textArea($model,'text'); ?>
        
        <span class="help_"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
        <div class="text"><?=Yii::t('trans','Sorunlu ürünün hangi sorunları var belirtiniz, servis elemanları bu sorunlar üzerine çalışacaklardır.')?></div>
        </span>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<?PHP if(!$model->isNewRecord):?>
        <div class="row">
            <?php echo $form->labelEx($model,'problematicStatus'); ?>
            <?php echo $form->textField($model,'problematicStatus'); ?>
            <?php echo $form->error($model,'problematicStatus'); ?>
        </div>
    <?PHP endif;?>
    
	<?PHP if(!$model->isNewRecord):?>
        <div class="row">
            <?php echo $form->labelEx($model,'employeesText'); ?>
            <?php echo $form->textArea($model,'employeesText',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'employeesText'); ?>
        </div>
	<?PHP endif;?>
    
	<div class="row buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'large',
            'label'=>$model->isNewRecord ? Yii::t('trans','Ekle') : Yii::t('trans','Kaydet'),
        	)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$('#Problematicproducts_productsName').focus(function(){
	$(this).val("");
	$("#Problematicproducts_productsID").val("");
	
});


$('#Problematicproducts_customerdealer').focus(function(){
	$(this).val("");
	$("#Problematicproducts_customerdealerID").val("");
	$('.information').slideUp();
});

function getCustomer(ids){
		$('.information').slideUp();
		
	$.post("<?=Yii::app()->createUrl("customers/viewp")?>/"+ids,function(data){
		
		$('.information').html(data);
		$('.information').slideDown();
	});
}

function getDealer(ids){
		$('.information').slideUp();
		
	$.post("<?=Yii::app()->createUrl("dealers/viewp")?>/"+ids,function(data){
		
		$('.information').html(data);
		$('.information').slideDown();
	});
}


<?PHP if($model->customerdealerID!=""):?>

	<?PHP if($model->cdtype==1){?>
		getCustomer(<?=$model->customerdealerID?>);
	<?PHP }else{?>
		getDealer(<?=$model->customerdealerID?>);
	<?PHP }?>
	
	
<?PHP endif?>
</script>
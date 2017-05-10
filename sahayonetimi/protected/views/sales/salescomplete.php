
<style type="text/css">
.span-19{

	width: 90%;
}

</style>

<?php
/* @var $this AppointmentsController */
/* @var $model Appointments */
if(Yii::app()->user->getState("salesType")=="customer"){
	$this->breadcrumbs=array(
		Yii::t('trans','Müşteri Ürün Satış')=>array('sales/customer'),
		Yii::t('trans','Satış işlemini tamamla'),
	);
}else{
	$this->breadcrumbs=array(
		Yii::t('trans','Bayi Ürün Satış')=>array('sales/dealer'),
		Yii::t('trans','Satış işlemini tamamla'),

	);
}
?>

<div class="salescomplate clearfix">
	
    <div class="lefta">
    
     <div class="rowa" style="margin-bottom:15px;">
     <?=Yii::t('trans','Satış işlemini gerçekleştireceğiniz müşterinizi seçin.')?>
     </div>
     
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'salescomplete-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
	<?php if(count($modelProductbasket)!=0):?>

    <?PHP
	if(Yii::app()->user->getState("salesType")=="customer"){
	?>

    
    <div class="rowa">
		<?php echo $form->labelEx($model,'customerdealerID'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'customer',
			'options' => array(
                'showAnim' => 'fold',
                //remove if you dont need to store the id, like i do...
                'select' => 'js:function(event, ui){ 
				
					$("#Salescompletecustomer_customerdealerID").val(ui.item.id);
					getCustomer(ui.item.id);
				}'
            ),

			'source'=>$this->createUrl('customers/getcustomer'),
			'htmlOptions'=>array(
				'size'=>'50'
			),
		)); 
		?>
	 
            
            <span class="help_"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
                <div class="text"><?=Yii::t('trans','<b>Otamatik Tamamlama</b><br>Müşteri ismini yazın ve listeden müşterinizi seçin. İşlemi otomatik tamamlayın.')?> 		</div>
            </span>
		<?php echo $form->hiddenField($model,'customerdealerID'); ?>
		<?php echo $form->error($model,'customerdealerID'); ?>
	</div>

	

    <?PHP }elseif(Yii::app()->user->getState("salesType")=="dealer"){
	?>
    
    <div class="rowa">
		<?php echo $form->labelEx($model,'dealerID'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'customer',
			'options' => array(
                'showAnim' => 'fold',
                //remove if you dont need to store the id, like i do...
                'select' => 'js:function(event, ui){ 
				
					$("#Salescompletecustomer_customerdealerID").val(ui.item.id);
					getDealer(ui.item.id);
				}'
            ),

			'source'=>$this->createUrl('dealers/getdealer'),
			'htmlOptions'=>array(
				'size'=>'50'
			),
		)); 
		?>
	 
            
            <span class="help_"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
                <div class="text"><?=Yii::t('trans','<b>Otamatik Tamamlama</b><br>Müşteri ismini yazın ve listeden müşterinizi seçin. İşlemi otomatik tamamlayın.')?> 		</div>
            </span>
		<?php echo $form->hiddenField($model,'customerdealerID'); ?>
		<?php echo $form->error($model,'customerdealerID'); ?>
	</div>
	

    <?PHP }?>
   
<?php else:echo "<span style='color:#F00'>".Yii::t('trans',"Sepette ürün bulunamadı!")."</span>";endif;?>
    
    	<div class="company clearfix">
      		<div class="information">
            
            </div>
            <?PHP if(@Yii::app()->user->getState("setVisitID_")!=""):?>
             <div class="rowa">
				<?php echo $form->labelEx($model,'visitsID'); ?>
                <?php echo $form->textField($model,'visitsID',array('value'=>(Yii::app()->user->getState("setVisitID_")+SalesController::getParams("visitsplus")))); ?>
               
            </div>
            <?PHP endif;?>
            
            <div class="rowa">
				<?php echo $form->labelEx($model,'salesStatus'); ?>
                <?php echo $form->dropDownList($model,'salesStatus',SalesController::getParams("salesStatus")); ?>
               
            </div>
            
            <div class="row receivedPrice" style="margin-left:0px;" style="display:none;">
            	<?php echo $form->labelEx($model,'receivedPrice'); ?>
				<?php echo $form->textField($model,'received1',array('style'=>'width:40px;text-align:right','onkeypress'=>'return isNumber(event)')); ?> , 
        		<?php echo $form->textField($model,'received2',array('style'=>'width:30px','maxlength'=>2,'onkeypress'=>'return isNumber(event)',"value"=>"00")); ?>
        		 <?php echo $form->dropDownList($model,'receivedCur',SalesController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2,'options' => array(Yii::app()->user->getState('companyCur')=>array('selected'=>true)))); ?>
		
            </div>
            
            <div class="rowa buttons">
            
             <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'link',
                 'type'=>'success',
                 'size' => 'large',
				 'url'=>Yii::app()->user->getState("salesType")=="customer"?Yii::app()->createUrl('sales/customer'):Yii::app()->createUrl('sales/dealer'),
				  'htmlOptions'=>array('style'=>'margin-right:50px'),
                'label'=>Yii::t('trans','Alış Verişe Devam Et'),
                )); ?>
                
              <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'link',
                 'type'=>'primary',
                 'size' => 'large',
				 'url'=>'javascript:;',
				  'htmlOptions'=>array('onClick'=>"javascript:oks();"),
                'label'=>Yii::t('trans','Satış İşlemini Tamamla'),
                )); ?>
            </div>
        </div>
        
        <?php $this->endWidget(); ?> 
    </div>
    
    
    
    <div class="righta">
    
    
		<?PHP 
		$toplam=0;
		$i=0;
		foreach($modelProductbasket as $key=>$value):
			$i++;
           
			$toplam+=SalesController::curAccount($value->salesCur,$value->salesPrice)*$value->number;
            ?>
        <?PHP endforeach;?>
    	<div class="title"><?=Yii::t('trans','TOPLAM')?></div>
        <div class="sale"><?=number_format($toplam,2);?> <?=Yii::app()->user->getState('companyCurText')?></div>
        
        <div class="basketcount">
        <?=Yii::t('trans','Sepetteki ürün çeşiti')?> : <?=$i?>
        </div>
    </div>
</div>


<script type="text/javascript">

<?PHP if($model->customerdealerID!=""):?>

	<?PHP if($model->cdtype==1){?>
		getCustomer(<?=$model->customerdealerID?>);
	<?PHP }else{?>
		getDealer(<?=$model->customerdealerID?>);
	<?PHP }?>
	
	if(<?=$model->salesStatus?>==2 || <?=$model->salesStatus?>==3)
		$('.receivedPrice').slideDown();
	else
		$('.receivedPrice').slideUp();
<?PHP endif?>


<?PHP if(Yii::app()->user->getState("setVisitID")!=""):?>

	<?PHP if(Yii::app()->user->getState("setVisitType")==1 && Yii::app()->user->getState("salesType")=="customer"){?>
		getCustomer_(<?=Yii::app()->user->getState("setVisitID")?>);
	<?PHP }elseif(Yii::app()->user->getState("setVisitType")==2 && Yii::app()->user->getState("salesType")=="dealer"){?>
		getDealer_(<?=Yii::app()->user->getState("setVisitID")?>);
	<?PHP }?>
	
	
<?PHP endif?>

function getCustomer(ids){
		$('.company').slideUp();
		
	$.post("<?=Yii::app()->createUrl("customers/viewp")?>/"+ids,function(data){
		
		$('.information').html(data);
		$('.company').slideDown();
		$('.receivedPrice').hide();
	});
}

function getDealer(ids){
		$('.company').slideUp();
		
	$.post("<?=Yii::app()->createUrl("dealers/viewp")?>/"+ids,function(data){
		
		$('.information').html(data);
		$('.company').slideDown();
		$('.receivedPrice').hide();
	});
}


function getCustomer_(ids){
		$('.company').slideUp();
		
	$.post("<?=Yii::app()->createUrl("customers/viewp")?>/"+ids,function(data){
		
		$('.information').html(data);
		$('.company').slideDown();
		$('#Salescompletecustomer_customer').val("<?=Yii::app()->user->getState("setVisitName")?>");
		$('#Salescompletecustomer_customerdealerID').val("<?=Yii::app()->user->getState("setVisitID")?>");
	});
}

function getDealer_(ids){
		$('.company').slideUp();
		
	$.post("<?=Yii::app()->createUrl("dealers/viewp")?>/"+ids,function(data){
		
		$('.information').html(data);
		$('.company').slideDown();
		$('#Salescompletecustomer_customer').val("<?=Yii::app()->user->getState("setVisitName")?>");
		$('#Salescompletecustomer_customerdealerID').val("<?=Yii::app()->user->getState("setVisitID")?>");
	});
}

function oks(){
	var kontrol=true;
	if($('#Salescompletecustomer_salesStatus').val()==2 || $('#Salescompletecustomer_salesStatus').val()==3){
		if($('#Salescompletecustomer_received1').val()=="" || $('#Salescompletecustomer_received2').val()==""){
			alert("<?=Yii::t('trans','Lütfen Tahsis Edilen Ücret Belirtiniz.')?>");
			kontrol=false;
		}
	}
	
	if(kontrol==true){
		$('#salescomplete-form').submit();
	}
}

$('#Salescompletecustomer_salesStatus').change(function(){
	if($(this).val()==2 || $(this).val()==3)
		$('.receivedPrice').slideDown();
	else
		$('.receivedPrice').slideUp();
});


function isNumber(evt)  
{  
  var charCode = (evt.which) ? evt.which : event.keyCode  
  if (charCode > 31 && (charCode < 48 || charCode > 57))  
   return false;  
  return true; 
   
}  

</script>
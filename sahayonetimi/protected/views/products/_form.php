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

<link rel="stylesheet" href="<?= Yii::app()->baseUrl?>/css/tree/jquery.treeview.css" />

<script src="<?= Yii::app()->baseUrl?>/js/tree/lib/jquery.cookie.js" type="text/javascript"></script>
<script src="<?= Yii::app()->baseUrl?>/js/tree/jquery.treeview.js" type="text/javascript"></script>

<script type="text/javascript" src="<?= Yii::app()->baseUrl?>/js/tree/demo.js"></script>
        
<div class="form">

	<?PHP $this->renderPartial("items/displaymenu",array("id"=>1,'model'=>$model))?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'products-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    
	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	 
<div class="searcGroup" style="width:30%">

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('style'=>'width:200px;')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'brand'); ?>
		<?php echo $form->textField($model,'brand',array('style'=>'width:200px;')); ?>
		<?php echo $form->error($model,'brand'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'model'); ?>
		<?php echo $form->textField($model,'model',array('style'=>'width:200px;')); ?>
		<?php echo $form->error($model,'model'); ?>
	</div>
    

</div>

<div class="searcGroup" style="width:30%;margin-left:20px;">
	<div class="row">
		<?php echo $form->labelEx($model,'purchasePrice'); ?>
		<?php echo $form->textField($model,'alis1',array('style'=>'width:40px;text-align:right','onkeypress'=>'return isNumber(event)')); ?> ,
        <?php echo $form->textField($model,'alis2',array('style'=>'width:30px','maxlength'=>2,'onkeypress'=>'return isNumber(event)')); ?>
         <?php 
		 if($model->isNewRecord)
		 	echo $form->dropDownList($model,'purchaseCur',ProductsController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2,'options' => array(Yii::app()->user->getState('companyCur')=>array('selected'=>true)))); 
		else
			echo $form->dropDownList($model,'purchaseCur',ProductsController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2)); 
		?>
		<?php echo $form->error($model,'purchasePrice'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'salePrice'); ?>
		<?php echo $form->textField($model,'satis1',array('style'=>'width:40px;text-align:right','onkeypress'=>'return isNumber(event)')); ?> , 
        <?php echo $form->textField($model,'satis2',array('style'=>'width:30px','maxlength'=>2,'onkeypress'=>'return isNumber(event)')); ?>
         <?php 
		  if($model->isNewRecord)
			 echo $form->dropDownList($model,'saleCur',ProductsController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2,'options' => array(Yii::app()->user->getState('companyCur')=>array('selected'=>true)))); 
		 else
			echo $form->dropDownList($model,'saleCur',ProductsController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2)); 
		 ?>
		<?php echo $form->error($model,'salePrice'); ?>
	</div>

	
    
  	<div class="row">
		<div>
			<b><?=Yii::t('trans','İndirimli Fiyatı (KDV Hariç)') ?> </b>
            <span class="help_" style="margin-left:5px;"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
                    <div class="text"><?=Yii::t('trans','Ürünlerinize dilerseniz indirimli fiyat giriniz. Dikkat etmeniz gereken müşteri satış işlemleri <b>İndirimli fiyat + KDV</b> üzerinden yapılacaktır. Bu kısmı boş geçebilirsiniz.')?> 		
             </div>
            </span>
        </div>
       	
		<?php echo $form->textField($model,'reduce1',array('style'=>'width:40px;text-align:right','onkeypress'=>'return isNumber(event)')); ?> , 
        <?php echo $form->textField($model,'reduce2',array('style'=>'width:30px','maxlength'=>2,'onkeypress'=>'return isNumber(event)')); ?> 
         <?php 
		  if($model->isNewRecord)
			 echo $form->dropDownList($model,'reduceCur',ProductsController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2,'options' => array(Yii::app()->user->getState('companyCur')=>array('selected'=>true))));
		 else
			echo $form->dropDownList($model,'reduceCur',ProductsController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2)); 
		  ?>
		<?php echo $form->error($model,'reducedPrice'); ?>
	</div>
    
    
    <div class="row">
		
        <div>
			<b><?=Yii::t('trans','Bayi Fiyatı (KDV Hariç)') ?> </b>
            <span class="help_" style="margin-left:5px;"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
                    <div class="text"><?=Yii::t('trans','Ürünlerinize dilerseniz bayi fiyatı giriniz. Dikkat etmeniz gereken satış bayi fiyatı belirtilmez ise, bayilere satışlar <b>Satış fiyatı + KDV</b> veya <b>İndirimli fiyat + KDV</b> üzerinden yapılacaktır. Bu kısmı boş geçebilirsiniz.')?> 		
             </div>
            </span>
        </div>
        
		<?php echo $form->textField($model,'dealer1',array('style'=>'width:40px;text-align:right','onkeypress'=>'return isNumber(event)')); ?> , 
        <?php echo $form->textField($model,'dealer2',array('style'=>'width:30px','maxlength'=>2,'onkeypress'=>'return isNumber(event)')); ?>
         <?php 
		  if($model->isNewRecord)
		 	echo $form->dropDownList($model,'dealerCur',ProductsController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2,'options' => array(Yii::app()->user->getState('companyCur')=>array('selected'=>true))));
		 else
			echo $form->dropDownList($model,'dealerCur',ProductsController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2)); 
		  ?>
		<?php echo $form->error($model,'dealerPrice'); ?>
	</div>

</div>


<div class="searcGroup" style="width:35%;">

	<div class="productGroup">
        
        <h1 class="left"><?=Yii::t('trans','Ürün Grubu Seç')?></h1> <span class="help_ left" style="margin-left:5px;"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
                <div class="text"><?=Yii::t('trans','Ürünlerinizi grublayın. Ağac listesiden sadece bir adet ürün grub ismi seçiniz ve hemen ardından <b>Ürün Grubu</b> alanında belirecektir.')?> 		</div>
            </span>
   
        <ul id="red" class="treeview-red" style="margin-top:15px;">
        
        <?PHP
        $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")),
             'order'=>'name asc',
             ));
            
        foreach($modelCustomergroups as $key=>$value){
            
            $value=(object)$value;
                    
            if($value->pgID==0){
                echo "<li>";
                echo '<span class="groupSelect" id="a'.$value->productgroupsID.'">'.$value->name.'</span>';
                
                unset($modelCustomergroups[$key]);
                group_Find_Sub_Cats($modelCustomergroups, $value->productgroupsID);	
            
            }
            
        }
        
        
        
            
        function group_Find_Sub_Cats(&$modelCustomergroups, $productID){
            $i=0;
            foreach ($modelCustomergroups as $key => $value)
            {
                if ($value->pgID == $productID)
                {
                    $i++;
                }
            }
            
            if($i>0)
                echo "<ul>";
            foreach ($modelCustomergroups as $key => $value)
            {
                $value=(object)$value;
                
                if ($value->pgID == $productID)
                {
                    
                    
                    echo "<li>";
                    echo '<span class="groupSelect" id="a'.$value->productgroupsID.'">'.$value->name.'</span>';
                
                    group_Find_Sub_Cats($modelCustomergroups, $value->productgroupsID);
                }
            }
            
            if($i>0)
                echo "</ul>";
            
        }
        ?>
        </ul>
        
       
    </div>
    <div class="clear"></div>
    <div class="productGroupAra">
    <?= Yii::t('trans','Veya')?>
    </div>
     
    <div class="productGroup2">
   	 <h1 class="left"><?=Yii::t('trans','Ürün Grubu Seç')?></h1> <span class="help_ left" style="margin-left:5px;"><img src="<?=Yii::app()->baseUrl?>/images/help.png" id="help_" />
                <div class="text"><?=Yii::t('trans','Ürünlerinizi grublayın. Alt kısımdaki <b>otomatik tamamlama</b> editörü kullanarak, açılan listeden biri tıklayınız ve hemen ardından <b>Ürün Grubu</b> alanında belirecektir.')?> 		</div>
            </span>
             <div class="clear"></div>
            <div style="text-align:center;margin-top:5px;">
            
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$model,
			'attribute'=>'productGroupsOtoSelect',
			'options' => array(
                'showAnim' => 'fold',
                //remove if you dont need to store the id, like i do...
                'select' => 'js:function(event, ui){ 
				
				$("#Products_productgroupsID").val("a"+ui.item.id);
				$("#Products_productsGroupName").val(ui.item.value);
				}'
            ),

			'source'=>$this->createUrl('products/getGroupAutoList'),
			'htmlOptions'=>array(
				'size'=>'50',
				'style'=>'height:20px;width:200px;',
			),
		)); ?>
            </div>
    </div>
    <div class="clear"></div>
    <div class="productGroupCont">
    	<?php echo $form->labelEx($model,'productgroupsID'); ?>
		<?php echo $form->textField($model,'productsGroupName',array('disabled'=>'disabled','style'=>'background-color:#EFEFEF;color:#4D90FE;font-weight:700;')); ?>
        <?php echo $form->hiddenField($model,'productgroupsID'); ?>
		<?php echo $form->error($model,'productgroupsID'); ?>
    </div>
</div>

	
    <div class="clear"></div>
     
	<div class="row clear" style="margin-top:20px;">
    
		<?php echo $form->labelEx($model,'text'); ?>
		<?php 
    $this->widget('application.extensions.cleditor.ECLEditor', array(
        'model'=>$model,
        'attribute'=>'text', //Model attribute name. Nome do atributo do modelo.
        'options'=>array(
            'width'=>'100%',
            'height'=>350,
            'useCSS'=>true,
        ),
        'value'=>$model->text, //If you want pass a value for the widget. I think you will. Se você precisar passar um valor para o gadget. Eu acho irá.
    ));?>
		<?php echo $form->error($model,'text'); ?>
	</div>


	<div class="row buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'large',
            'label'=>$model->isNewRecord ? Yii::t('trans','Ekle ve İlerle') : Yii::t('trans','Kaydet ve İlerle'),
        	)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript">


function isNumber(evt)  
{  
  var charCode = (evt.which) ? evt.which : event.keyCode  
  if (charCode > 31 && (charCode < 48 || charCode > 57))  
   return false;  
  return true; 
   
}  


$('.groupSelect').click(function(){
	$('#Products_productsGroupName').val($(this).html());
	$('#Products_productgroupsID').val($(this).prop('id'));
});

</script>
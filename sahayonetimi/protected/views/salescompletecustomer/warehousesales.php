<div id="cboxOverlaya" style="display: block; opacity: 0.9; cursor: pointer;display:none;"></div>
    <div id="colorboxa" class="" style="padding-bottom: 42px; padding-right: 42px; display: block; position: fixed; width: 1037px; height: 376px; top: 80px; left: 135px;z-index:10000;display:none;">
        <div id="cboxWrappers" style="height: 418px; width: 1079px;display:none;">
        <div style="">
        <div id="cboxTopLeft" style="float: left;"></div>
        <div id="cboxTopCenter" style="float: left; width: 1037px;"></div>
        <div id="cboxTopRight" style="float: left;"></div>
        </div>
        <div style="clear: left;">
        <div id="cboxMiddleLeft" style="float: left; height: 376px;"></div>
        <div id="cboxContent" style="float: left; width: 1037px; height: 376px;">
        <div id="cboxLoadedContents" style="display: block; width: 1037px; overflow: auto; height: 348px;"><?=Yii::t('trans','Bekleyiniz...')?></div>
        <div id="cboxLoadingOverlay" class="" style="height: 576px; display: none;"></div>
        <div id="cboxLoadingGraphic" class="" style="height: 576px; display: none;"></div>
        <div id="cboxTitle" class="" style="display: block;"></div>
        <div id="cboxCurrent" class="" style="display: none;"></div>
        <div id="cboxNext" class="" style="display: none;"></div>
        <div id="cboxPrevious" class="" style="display: none;"></div>
        <div id="cboxSlideshow" class="" style="display: none;"></div>
        <div id="cboxClose" class="" style="" onclick="clboxxlose()">close</div>
        </div>
        <div id="cboxMiddleRight" style="float: left; height: 376px;"></div>
        </div>
        <div style="clear: left;">
        
        <div id="cboxBottomLeft" style="float: left;"></div>
        <div id="cboxBottomCenter" style="float: left; width: 1037px;"></div>
        <div id="cboxBottomRight" style="float: left;"></div>
        </div>
    </div>
    <div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div>
</div>
<?php
/* @var $this SalescompletecustomerController */
/* @var $model Salescompletecustomer */

$this->breadcrumbs=array(
	Yii::t('trans','Satış Depo - ').$modelWarehouse->name=>array('salescompletecustomer/warehouse/'.$warehouseID),
	$model->salescompleteID+Salescompletecustomer::getParams("defultfiloplus"),
);

$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
$colorbox->addInstance('.colorboxx', array('frame'=>true,'width'=>'70%', 'height'=>'50%'));

?>

<h1><?=$modelWarehouse->name?> #<?=$model->salescompleteID+Salescompletecustomer::getParams("defultfiloplus")?></h1>

<br><br>

<?php 

if($model->cdtype==1){
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'type'=>'raw', 
				'name'=>'salescompleteID',
				'value'=>$model->salescompleteID+SalescompletecustomerController::getParams("defultfiloplus"),
			),
			array(
				'type'=>'raw', 
				'name'=>'customerdealerID',
				'value'=>SalescompletecustomerController::getCustomerName($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'scustomerID',
				'value'=>SalescompletecustomerController::getParams("dealercustomerplus")+$model->customerdealerID,
			),
			array(
				'type'=>'raw', 
				'name'=>'country',
				'value'=>SalescompletecustomerController::getCustomerCountry($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'city',
				'value'=>SalescompletecustomerController::getCustomerCity($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'county',
				'value'=>SalescompletecustomerController::getCustomerCounty($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'adress',
				'value'=>SalescompletecustomerController::getCustomerAdress($model->customerdealerID),
			),
			
			
			array(
				'type'=>'raw', 
				'name'=>'salesEs',
				'value'=>SalescompletecustomerController::getParams_("salesEs",$model->salesEs),
			),
			array(
				'type'=>'raw', 
				'name'=>'salesEsDate',
				'value'=>SalescompletecustomerController::getDateTimeFormat($model->salesEsDate),
			),
			array(
				'type'=>'raw', 
				'name'=>'dateAdd',
				'value'=>SalescompletecustomerController::getDateTimeFormat($model->dateAdd),
			),
		),
	)); 
}elseif($model->cdtype==2){
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'type'=>'raw', 
				'name'=>'salescompleteID',
				'value'=>$model->salescompleteID+SalescompletecustomerController::getParams("defultfiloplus"),
			),
			array(
				'type'=>'raw', 
				'name'=>'customerdealerID',
				'value'=>SalescompletecustomerController::getDealerName($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'sdealerID',
				'value'=>SalescompletecustomerController::getParams("dealerplus")+$model->customerdealerID,
			),
			array(
				'type'=>'raw', 
				'name'=>'country',
				'value'=>SalescompletecustomerController::getDealerCountry($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'city',
				'value'=>SalescompletecustomerController::getDealerCity($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'county',
				'value'=>SalescompletecustomerController::getDealerCounty($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'adress',
				'value'=>SalescompletecustomerController::getDealerAdress($model->customerdealerID),
			),
		
		
			array(
				'type'=>'raw', 
				'name'=>'salesEs',
				'value'=>SalescompletecustomerController::getParams_("salesEs",$model->salesEs),
			),
			array(
				'type'=>'raw', 
				'name'=>'salesEsDate',
				'value'=>SalescompletecustomerController::getDateTimeFormat($model->salesEsDate),
			),
			array(
				'type'=>'raw', 
				'name'=>'dateAdd',
				'value'=>SalescompletecustomerController::getDateTimeFormat($model->dateAdd),
			),
		),
	)); 

}
?>


<div class="customerSaleUpdate clearfix">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'appointments-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="item">
    	<?php echo $form->labelEx($model,'salesEs'); ?>
        <?php 
		
		$modelCargocase=Cargocase::model()->find("salescompleteID=:salescompleteID AND warehouseID=:warehouseID",array(":salescompleteID"=>$model->salescompleteID,':warehouseID'=>$modelWarehouse->warehouseID));
		
		
		if($modelCargocase->type==2){
			echo $form->dropDownList($model,'salesEs',SalescompletecustomerController::getParams("salesEs_2"), array('options' => array('4'=>array('selected'=>true),'2'=>array('selected'=>false),'3'=>array('selected'=>false)))); 
		}elseif($modelCargocase->type==0){
			echo $form->dropDownList($model,'salesEs',SalescompletecustomerController::getParams("salesEs_2"), array('options' => array('2'=>array('selected'=>true),'3'=>array('selected'=>false),'4'=>array('selected'=>false)))); 
		}elseif($modelCargocase->type==1){
			echo $form->dropDownList($model,'salesEs',SalescompletecustomerController::getParams("salesEs_2"), array('options' => array('3'=>array('selected'=>true),'4'=>array('selected'=>false),'2'=>array('selected'=>false)))); 
		}else
			echo $form->dropDownList($model,'salesEs',SalescompletecustomerController::getParams("salesEs_2")); 
		?>
    </div>
   
    
    <div class="button">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Kaydet'),
        	)); ?>
    </div>
<?php $this->endWidget(); ?>
</div>


<div class="customerSalesmoneyreceived">

 <div class="titles"><?=Yii::t('trans','Ürünler')?></div>
 
 <div class="click_slide2">
	
    <div class="basket">
     	
      	<table>
        <tr class="title">
        	<td><?=Yii::t('trans','Ürün ID')?></td>
            <td class="w2"><?=Yii::t('trans','Ürün İsmi')?></td>
            
            <td class="w3"><?=Yii::t('trans','Ürün Cinsi')?></td>
            <td class="w3"><?=Yii::t('trans','Ürün Grubu')?></td>
            <td class="w4"><?=Yii::t('trans','Adet')?></td>
       
        </tr>
        
        <?PHP 
		
		
		foreach($modelSalesdetail as $key=>$value):
			
		?>
       
            <tr class="item product" id="P<?=$value->productsID?>" style="cursor:pointer;">
           		<td><?=$value->productsID+SalescompletecustomerController::getParams("defultproductplus")?></td>
            	<td class="w2" width="250"><?=$value->name?></td>
            	
                <td class="w3" width="150"><?=mb_substr(SalescompletecustomerController::getBottom($value->productbottomsID),0,48,"UTF-8")?></td>
                <td class="w4"><?=$value->pgname?></td>
                <td class="w5"><?=$value->numbers." ".Yii::t('trans','Adet')?></td>
               
            </tr>
        <?PHP endforeach;?>
        </table>
    </div>
  </div>
 </div>


<div class="customerSaleUpdate clearfix">
	<div class="titles"><?=Yii::t('trans','Gönderim Ekle')?></div>

	<div class="item">
    	<?php echo Yii::t('trans','Gönderim Biçimi') ?> <br />
        <?php 
		
			echo CHtml::dropDownList('cargo',null,SalescompletecustomerController::getParams("cargo")); 
		
			
		?>
    </div>
    
    
   <div class="clear"> </div>
   <div class="addcargo">
   
       <div class="item">
            <?php echo Yii::t('trans','Kargo İsmi') ?> <br />
            <?php 
                echo CHtml::textfield('cargoname');
            ?>
        </div>
        <div class="item">
            <?php echo Yii::t('trans','Ödeme Tipi') ?> <br />
            <?php 
                echo CHtml::dropDownList('cargopaymenttype',null,SalescompletecustomerController::getParams("cargopaymenttype")); 

            ?>
        </div>
        
         <div class="item cargocharge">
            <?php echo Yii::t('trans','Gönderim Ücreti') ?>
            <br />
    
            <?php 
            
                echo CHtml::textfield('cargocharge1',null,array('style'=>'width:70px','onkeypress'=>'return isNumber(event)'));
				echo " , "; 
				 echo CHtml::textfield('cargocharge2',"00",array('style'=>'width:20px','onkeypress'=>'return isNumber(event)','maxlength'=>2)); 
            	echo "&nbsp;&nbsp;";
                echo CHtml::dropDownList('cargochargecur',null,SalescompletecustomerController::getParams("currency"),array('style'=>'width:70px')); 
            
            ?>
        </div>
        
         <div class="item">
            <?php echo Yii::t('trans','Takip Nnumarası') ?> <br />
            <?php 
                echo CHtml::textfield('cargofallownumber'); 
            ?>
           <br /> <span>( <?=Yii::t('trans','Birden fazla numara alanı var ise, / işareti ile ayırınız. Örnek: 2124 / 234590')?> )</span>
       	 </div>
        
         <div class="item clear" style="margin-top:10px;">
         
          <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Ekle'),
			 'buttonType' => 'link',
			 'url'=>"javascript:;",
			 'htmlOptions'=>array('onclick'=>'javascript:cargoadd()'),
        	)); ?>
         </div>
   </div>
   
   
    <div class="addkurye">
   
       <div class="item">
            <?php echo Yii::t('trans','Kurye İsmi') ?> <br />
            <?php 
                echo CHtml::textfield('kuryename');
            ?>
        </div>
        <div class="item">
            <?php echo Yii::t('trans','Ödeme Tipi') ?> <br />
            <?php 
                echo CHtml::dropDownList('kuryepaymenttype',null,SalescompletecustomerController::getParams("cargopaymenttype")); 

            ?>
        </div>
        
         <div class="item kuryecharge">
            <?php echo Yii::t('trans','Gönderim Ücreti') ?>
            <br />
    
            <?php 
            
                echo CHtml::textfield('kuryecharge1',null,array('style'=>'width:70px','onkeypress'=>'return isNumber(event)'));
				echo " , "; 
				 echo CHtml::textfield('kuryecharge2',"00",array('style'=>'width:20px','onkeypress'=>'return isNumber(event)','maxlength'=>2)); 
            	echo "&nbsp;&nbsp;";
                echo CHtml::dropDownList('kuryechargecur',null,SalescompletecustomerController::getParams("currency"),array('style'=>'width:70px')); 
            
            ?>
        </div>
        
         <div class="item clear" style="margin-top:10px;">
         
          <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Ekle'),
			 'buttonType' => 'link',
			 'url'=>"javascript:;",
			 'htmlOptions'=>array('onclick'=>'javascript:kuryeadd()'),
        	)); ?>
         </div>
   </div>
   
   
   <div class="addsevkiyat">
   
       <div class="item">
            <?php echo Yii::t('trans','Sevkiyat/Sevkiyat Yapan İsmi') ?> <br />
            <?php 
                echo CHtml::textfield('sevkiyatname',Yii::t('trans','Sevkiyat'));
            ?>
        </div>
        
        <div class="item clear" style="margin-top:10px;">
           <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Ekle'),
			 'buttonType' => 'link',
			 'url'=>"javascript:;",
			 'htmlOptions'=>array('onclick'=>'javascript:sevkiyatadd()'),
        	)); ?>
         </div>
   </div>
</div>



<div class="customerSaleUpdate clearfix">


	<div class="titles"><?=Yii::t('trans','Eklenen Gönderimler')?> <a target="_blank" href="<?=Yii::app()->createUrl("cargo/index",array('filoID'=>SalescompletecustomerController::getParams("defultfiloplus")+$model->salescompleteID,'customerID'=>$model->cdtype==1?(SalescompletecustomerController::getParams("dealercustomerplus")+$model->customerdealerID):(SalescompletecustomerController::getParams("dealerplus")+$model->customerdealerID)))?>" style="float:right;margin-bottom:10px;"><img src="<?=Yii::app()->baseUrl?>/images/cargo.png" /> <?=Yii::t('trans','Kargo Takip')?></a></div>
        <div class="searcGroup clear" style="width:100%;">
    
        <table class="bottomitems">
           
                <tr style="background-color:#D7D7D7">
                    <td style="font-weight:700;">
                        <?=Yii::t('trans','Gönderim Tipi')?>
                    </td>
                    <td style="font-weight:700;border-left:dashed 1px #666;padding-left:10px;">
                        <?=Yii::t('trans','Gönderim Adı')?>
                    </td>
                    
                     <td style="font-weight:700;border-left:dashed 1px #666;padding-left:10px;">
                        <?=Yii::t('trans','Takip Numarası')?>
                    </td>
                    
                    <td style="font-weight:700;border-left:dashed 1px #666;padding-left:10px;">
                        <?=Yii::t('trans','Ödeme Tipi')?>
                    </td>
                    
                     <td style="font-weight:700;border-left:dashed 1px #666;padding-left:10px;">
                        <?=Yii::t('trans','Gönderim Ücreti')?>
                    </td>
                    
                    <td style="font-weight:700;border-left:dashed 1px #666;padding-left:10px;"></td>
                </tr>
           
             <?PHP foreach($modelSalescargo as $key=>$value):?>
           		<tr style="border-bottom:1px dashed #666" id="a<?=$value->salescargoID?>">
                	<td><?= @SalescompletecustomerController::getParams_("cargo",$value->type)?></td>
                    <td><?=$value->name?></td>
                    <td><?=$value->follownumber?></td>
                    <td><?= @SalescompletecustomerController::getParams_("cargopaymenttype",$value->payment)?></td>
                    <td><?PHP
                    if($value->charge!="")
						echo number_format($value->charge,2)." ".@SalescompletecustomerController::getParams_("currency",$value->chargeCur);
						?></td>
                     <td><a href="javascript:;" onclick="javascript:update(<?=$value->salescargoID?>)"><img src="<?=Yii::app()->baseUrl?>/images/pencil.png" /><a href="javascript:;" style="margin-left:10px;" onclick="javascript:adelete(<?=$value->salescargoID?>)"><img src="<?=Yii::app()->baseUrl?>/images/close.png" /></a></td>
                </tr>
            <?PHP endforeach?>
         
        </table>
    </div>

</div>

<script type="text/javascript">
function update(id){
	
	$('#cboxWrappers').show();
	$('#colorboxa').show();
	
	$.post("<?=Yii::app()->createUrl("salescargo/update")?>/"+id,function(data){
		$('#cboxLoadedContents').html(data);
	});
}


function clboxxlose(){
	
	$('#cboxWrappers').hide();
	$('#colorboxa').hide();
	$('#cboxLoadedContents').html("<?=Yii::t('trans','Bekleyiniz...')?>");
}  
function adelete(id){
		var dataString = 'id='+id;
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("salescompletecustomer/cargodelete")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				 if(data.sonuc==1)
					$('#a'+id).remove();
				else
					alert("<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>");
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	alert("<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>");
			 }
			 
			});
}

var cargotype = new Array();
<?PHP foreach(SalescompletecustomerController::getParams("cargo") as $key=>$value):?>
	cargotype["<?=$key?>"]="<?=$value?>";
<?PHP endforeach;?>

var paymenttype = new Array();
<?PHP foreach(SalescompletecustomerController::getParams("cargopaymenttype") as $key=>$value):?>
	paymenttype[<?=$key?>]="<?=$value?>";
<?PHP endforeach;?>

$('#cargo').change(function(){
	if($(this).val()==1)
		$('.addcargo').fadeIn();
	else
		$('.addcargo').hide();
		
	if($(this).val()==2)
		$('.addkurye').fadeIn();
	else
		$('.addkurye').hide();
		
	if($(this).val()==0)
		$('.addsevkiyat').fadeIn();
	else
		$('.addsevkiyat').hide();
});

var cargocharge=false;
$('#cargopaymenttype').change(function(){
	if($(this).val()==1){
		cargocharge=true;
		$('.cargocharge').fadeIn();
	}else{
		cargocharge=false;
		$('.cargocharge').fadeOut();
	}
});


var kuryecharge=false;
$('#kuryepaymenttype').change(function(){
	if($(this).val()==1){
		kuryecharge=true;
		$('.kuryecharge').fadeIn();
	}else{
		kuryecharge=false;
		$('.kuryecharge').fadeOut();
	}
});

var kontrol=true;
function cargoadd(){
	if(cargocharge==true){
	
		if($('#cargocharge1').val()==""){
			$('#cargocharge1').css("border","1px solid #F00");
			kontrol=false;
		}else{
			$('#cargocharge1').css("border","");
			kontrol=true;
		}
			
		if($('#cargocharge2').val()==""){
			$('#cargocharge2').css("border","1px solid #F00");
			kontrol=false;
		}else{
			$('#cargocharge2').css("border","");
			kontrol=true;
		}
		
	}
	
	if($('#cargoname').val()==""){
		kontrol=false;
		
		$('#cargoname').css("border","1px solid #F00");
	}else{
		$('#cargoname').css('border','');
		kontrol=true;
	}
	
	if(kontrol==false){
		alert("<?=Yii::t('trans','Lütfen hataları düzeltin.')?>");
	}else{
	
			var dataString = 'type='+$('#cargo').val()+'&cargoname='+ $('#cargoname').val()+'&cargopaymenttype='+$('#cargopaymenttype').val()+'&cargocharge1='+$('#cargocharge1').val()+'&cargocharge2='+$('#cargocharge2').val()+'&cargochargecur='+$('#cargochargecur').val()+'&cargofallownumber='+$('#cargofallownumber').val()+'&salescompleteID=<?=$model->salescompleteID?>';
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("salescompletecustomer/cargoadd")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				 if(data.sonuc==1)
					$('.bottomitems').append('<tr id="a'+data.id+'"><td>'+cargotype[$('#cargo').val()]+'</td><td>'+$('#cargoname').val()+'</td><td>'+$('#cargofallownumber').val()+'</td></td><td>'+paymenttype[$('#cargopaymenttype').val()]+'</td><td>'+data.charge+'</td><td><a href="javascript:;" onclick="javascript:update('+data.id+')"><img src="<?=Yii::app()->baseUrl?>/images/pencil.png" /><a href="javascript:;" style="margin-left:10px;" onclick="javascript:adelete('+data.id+')"><img src="<?=Yii::app()->baseUrl?>/images/close.png" /></a></td></tr>');
				else
					alert("<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>");
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	alert("<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>");
			 }
			 
			});
	}

}



function kuryeadd(){
	
	if(kuryecharge==true){
	
		if($('#kuryecharge1').val()==""){
			$('#kuryecharge1').css("border","1px solid #F00");
			kontrol=false;
		}else{
			$('#kuryecharge1').css("border","");
			kontrol=true;
		}
			
		if($('#kuryecharge2').val()==""){
			$('#kuryecharge2').css("border","1px solid #F00");
			kontrol=false;
		}else{
			$('#kuryecharge2').css("border","");
			kontrol=true;
		}
		
	}
	
	if($('#kuryename').val()==""){
		kontrol=false;
		
		$('#kuryename').css("border","1px solid #F00");
	}else{
		$('#kuryename').css('border','');
		kontrol=true;
	}
	
	if(kontrol==false){
		alert("<?=Yii::t('trans','Lütfen hataları düzeltin.')?>");
	}else{
	
			var dataString = 'type='+$('#cargo').val()+'&cargoname='+ $('#kuryename').val()+'&cargopaymenttype='+$('#kuryepaymenttype').val()+'&cargocharge1='+$('#kuryecharge1').val()+'&cargocharge2='+$('#kuryecharge2').val()+'&cargochargecur='+$('#kuryechargecur').val()+'&salescompleteID=<?=$model->salescompleteID?>';
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("salescompletecustomer/cargoadd")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				 if(data.sonuc==1)
					$('.bottomitems').append('<tr id="a'+data.id+'"><td>'+cargotype[$('#cargo').val()]+'</td><td>'+$('#kuryename').val()+'</td><td></td><td>'+paymenttype[$('#kuryepaymenttype').val()]+'</td><td>'+data.charge+'</td><td><a href="javascript:;" onclick="javascript:update('+data.id+')"><img src="<?=Yii::app()->baseUrl?>/images/pencil.png" /><a href="javascript:;" style="margin-left:10px;" onclick="javascript:adelete('+data.id+')"><img src="<?=Yii::app()->baseUrl?>/images/close.png" /></a></td></tr>');
				else
					alert("<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>");
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	alert("<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>");
			 }
			 
			});
	}

}


function sevkiyatadd(){
	
	
	
	if($('#sevkiyatname').val()==""){
		kontrol=false;
		
		$('#sevkiyatname').css("border","1px solid #F00");
	}else{
		$('#sevkiyatname').css('border','');
		kontrol=true;
	}
	
	if(kontrol==false){
		alert("<?=Yii::t('trans','Lütfen hataları düzeltin.')?>");
	}else{
	
			var dataString = 'type='+$('#cargo').val()+'&cargoname='+ $('#sevkiyatname').val()+'&salescompleteID=<?=$model->salescompleteID?>';
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("salescompletecustomer/cargoadd")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				 if(data.sonuc==1)
					$('.bottomitems').append('<tr id="a'+data.id+'"><td>'+cargotype[$('#cargo').val()]+'</td><td>'+$('#sevkiyatname').val()+'</td><td></td><td></td><td></td><td><a href="javascript:;" onclick="javascript:update('+data.id+')"><img src="<?=Yii::app()->baseUrl?>/images/pencil.png" /><a href="javascript:;" style="margin-left:10px;" onclick="javascript:adelete('+data.id+')"><img src="<?=Yii::app()->baseUrl?>/images/close.png" /></a></td></tr>');
				else
					alert("<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>");
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	alert("<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>");
			 }
			 
			});
	}

}


function isNumber(evt)  
{  
  var charCode = (evt.which) ? evt.which : event.keyCode  
  if (charCode > 31 && (charCode < 48 || charCode > 57))  
   return false;  
  return true; 
   
}  

var colorp = new Array();
$('.product').click(function(){
	if(colorp[$(this).prop("id")]==$(this).prop("id")){
		$(this).css("background-color","");
		delete colorp[$(this).prop("id")];
	}else{
		$(this).css("background-color","#b6faab");
		colorp[$(this).prop("id")]=$(this).prop("id");
	}
	
});

</script>
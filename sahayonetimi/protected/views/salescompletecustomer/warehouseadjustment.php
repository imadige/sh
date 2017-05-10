<?php
/* @var $this SalescompletecustomerController */
/* @var $model Salescompletecustomer */

$this->breadcrumbs=array(
	Yii::t('trans','Depo Ayarlanması - Müşteri Satışlar')=>array($model->cdtype==1?'warehousecustomeradmin':'warehousedealeradmin'),
	$model->salescompleteID+Salescompletecustomer::getParams("defultfiloplus"),
);


?>

<h1><?=Yii::t('trans','Depo Ayarlanması - Müşteri Satışlar')?> #<?=$model->salescompleteID+Salescompletecustomer::getParams("defultfiloplus")?></h1>

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
<div class="warehousecont" >
<?php 

Yii::app()->user->setFlash('info', Yii::t('trans','Siparişte bulunan ürünlerin hangi depolardan kaçar adet gönderilecek belirtmeniz gerekli!'));
		

$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'info'=>array('block'=>true,'closeText'=>'&times;'), // success, info, warning, error or danger
			
        ),
		'htmlOptions'=>array('style'=>'font-size:16px;'),
    )); 
	
	
	?>
<?PHP

foreach($modelSalesdetail as $key=>$value):

	if(SalescompletecustomerController::salesReturnControl($value->salesdetailID,$value->number)==false):
  ?>
  

 <div class="titles">
     <span><?=$value->productsID+SalescompletecustomerController::getParams("defultproductplus")?></span>
     <span>-</span>
     <span><?=$value->name?></span>
     <span>-</span>
     <span><?=mb_substr(SalescompletecustomerController::getBottom($value->productbottomsID),0,48,"UTF-8")?></span>
 </div>
 
 <div class="click_slide2">
 	<div class="titS"><?=Yii::t('trans','Depolar')?></div>
    
    <div class="contXS">
    	<div class="numberXS"><?=Yii::t('trans','{adetsayisi} Adet siparişte bulunulmuş.',array('{adetsayisi}'=>'<span>'.($value->number-SalescompletecustomerController::salesReturnControl2($value->salesdetailID)).'</span>'))?></div>
        <form id="f<?=$value->salesdetailID?>">
    <?PHP 
	
	
	foreach($modelWarehouse as $key2=>$value2):
	
		$stokX=SalescompletecustomerController::warehouseControl($value2->warehouseID,$value->productbottomsID,$value->salesdetailID);

	if($stokX>0){
		
	?>
    	<div class="itemSX">
        	<div class="sX"><?=$value2->name?></div>
            
           	 <input type="text" name="b<?=$value2->warehouseID?>" value="<?=SalescompletecustomerController::getWarehouseadjustmentNumber($value2->warehouseID,$value->salesdetailID,$value->productbottomsID)?>" />  <?=Yii::t('trans','{adetsayisi} adet bulunuyor.',array('{adetsayisi}'=>'<span class="numberXS">'.$stokX.'</span>'))?>
            
        </div>
    <?PHP
	}
	endforeach;?>
    	</form>
         <div class="button">
        <?php 
		$this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                 'type'=>'primary',
                 'size' => 'small',
				 'buttonType' => 'link',
				 'url'=>"javascript:;",
				 'htmlOptions'=>array('onclick'=>'javascript:warehouseadjustmentupdate('.$value->salesdetailID.','.$value->productbottomsID.',this,'.($value->number-SalescompletecustomerController::salesReturnControl2($value->salesdetailID)).')'),
                'label'=>Yii::t('trans','Kaydet'),
                )); ?>
        </div>
        <div id="a<?=$value->salesdetailID?>" style="margin-top:10px;">
        
        </div>
    </div>
 </div>
 
  
  <?PHP
  endif;
endforeach;
?>
</div>
  <div style="margin-top:20px;">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                 'type'=>'primary',
                 'size' => 'large',
				 'buttonType' => 'link',
				 'url'=>"javascript:;",
				 'htmlOptions'=>array('onclick'=>'javascript:warehouseadjustmentok('.$id.')'),
                'label'=>Yii::t('trans','Onayla ve Gönder'),
                )); ?>
        </div>

<script type="text/javascript">

function warehouseadjustmentok(ids){
	var dataString = "id="+ids;
	
	$.ajax({
	 type: "POST",
	 dataType:'json',  
	 url: "<?= Yii::app()->createUrl("salescompletecustomer/warehouseadjustmentok")?>", 
	 data: dataString,
	 success: function(data)
	 {
		
		 if(data.sonuc==0)
		 	alert("<?=Yii::t('trans','Lütfen ürün hangi depolardan gönderilecek ayarlayın.')?>");
		 else if(data.sonuc==1)
		 	window.location="<?=Yii::app()->createUrl("salescompletecustomer/".($model->cdtype==1?"warehousecustomeradmin":"warehousedealeradmin"))?>";
	 }
	});
}
function warehouseadjustmentupdate(ids,productbottomsID,element,Tet){
	$('#a'+ids).html('<img src="<?=Yii::app()->baseUrl?>/images/loading.gif" />');
	var kontrol=true;
	var iXS=0;
	var stokT=0;
	
	$('#f'+ids).find('.itemSX').each(function(index, element) {
		iXS++;
		if($(this).children('input').val()!=""){
			stokT+=parseInt($(this).children('input').val());	
		}
	});
	 	$('#f'+ids).find('.itemSX').each(function(index, element) {
			
            if($(this).children('input').val()==""){
				kontrol=false;
				$(this).children('input').css('border',"1px #FF0000 solid");
				$('#a'+ids).html('<font color="#FF0000"><?=Yii::t('trans','Adetleri boş bırakmayınız.')?></font>');
				
			
			}else{
				
			
				if(Tet!=stokT){
					
					$('#a'+ids).html('<font color="#FF0000"><?=Yii::t('trans','Adetler eşleşmiyor.')?></font>');
				}else{
					
					$(this).children('input').css('border',"");
					var iXS2=0;
					$('#f'+ids).find('.itemSX').each(function(index, element) {
						iXS2++;
						if(kontrol==true && iXS==iXS2){
						
						var dataString = $('#f'+ids).serialize()+'&salesdetailID='+ids+'&productbottomsID='+productbottomsID;
	
						$.ajax({
						 type: "POST",
						 dataType:'json',  
						 url: "<?= Yii::app()->createUrl("salescompletecustomer/warehouseadjustmentupdate")?>", 
						 data: dataString,
						 success: function(data)
						 {
							
							
							 if(data.sonuc==0){
								$('#a'+ids).html('<font color="#FF0000"><?=Yii::t('trans','Lütfen depodaki adet miktarlarını kontrol ediniz.')?></font>');
							 }else{
								 $('#a'+ids).html('<font color="##090"><?=Yii::t('trans','Başarılı bir şekilde kaydedildi.')?></font>');
				
							 }
						 }
						});
					}
						
						
					});
					
				}
			}
        });
		
}
</script>

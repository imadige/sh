<div class="basketContent">

	
	<div class="select">
    	
       <?PHP if($basket=="customer"):?>
    
        <?php $this->widget('bootstrap.widgets.TbLabel', array(
            'type'=>'success', 
            'label'=>Yii::t('trans','Müşteri'),
        )); ?>
    
    <?PHP  else:?>
   
        <?php $this->widget('bootstrap.widgets.TbLabel', array(
            'type'=>'important', 
            'label'=>Yii::t('trans','Bayi'),
        )); ?>
    
    <?PHP endif;?>
        
    </div>
    
    <span class="basketaddspana"><?=Yii::t('trans','Sepete Eklenenler')?></span>
     <div class="clear"></div>
     <a href="javascript:;" onclick="javascript:selectall()" style="margin:10px 0px 10px 0px;"><?=Yii::t('trans','Hepsini Seç')?></a>
    <?PHP 
	$toplam=0;
	
	if(count($model)>0):?>
   
    <div class="basket">
      	<table>
        <?PHP 
		
		
		foreach($model as $key=>$value):?>
            <tr>
            	<td class="w1"><input type="checkbox" id="a<?=$value->productbasketID?>"/></td>
            	<td class="w2"><?=$value->name?></td>
                <td class="w3"><?=mb_substr(SalesController::getBottom($value->productbottomsID),0,38,"UTF-8")?></td>
                
                <td class="w4"><?=$value->number." ".Yii::t('trans','Adet')?></td>
                <td class="w5"><?PHP
         
				$toplam+=SalesController::curAccount($value->salesCur,$value->salesPrice)*$value->number;
					echo number_format($value->salesPrice*$value->number,2).' '.SalesController::getParams_("currency",$value->salesCur);
			
            ?></td>
            </tr>
        <?PHP endforeach;?>
        </table>
    </div>
    <?PHP else:?>
    <div class="basketnone">
    	<div class="warning clear"><?=Yii::t('trans','Sepetiniz Boş')?></div>
    </div>
    <?PHP endif;?>
    
    <div class="button">
    
    <?php
	
	
		 $this->widget('bootstrap.widgets.TbButton', array(
				  
		 'type'=>'inverse',
		 'size' => 'small',
		 'buttonType' => 'link',
		 'url'=>"javascript:;",
		 'htmlOptions'=>array('onClick'=>"javascript:deleteitem()"),
		 
		'label'=>Yii::t('trans','Seçilenleri Sil'),
		)); 
	
	?>
    
   	<?php $this->widget('bootstrap.widgets.TbButton', array(
              
	 'type'=>'info',
	 'size' => 'small',
	 'buttonType' => 'link',
	 'htmlOptions'=>array('style'=>'margin-left:15px','class'=>'colorbox','onClick'=>"javascript:$('#cboxClose').trigger('click');"),
	 'url'=>"javascript:;",
	'label'=>Yii::t('trans','Alışverişe Devam Et'),
	)); ?>
    
     <?php
	
		  $this->widget('bootstrap.widgets.TbButton', array(
				  
		 'type'=>'success',
		 'size' => 'small',
		 'buttonType' => 'link',
		 'htmlOptions'=>array('class'=>'colorbox','style'=>'margin-left:15px'),
		 'url'=>Yii::app()->createUrl("sales/salescomplete"),
		'label'=>Yii::t('trans','Alışverişi Tamamla'),
		)); 
	
	?>
    
     
    </div>
    <div class="total">
    <?PHP 
	
	if($toplam>0):?>
    <b><?=Yii::t('trans','Toplam')?>:</b> <?=number_format($toplam,2);?> <?=Yii::app()->user->getState('companyCurText')?>
    <?PHP endif?>
    </div>
    <?PHP if(count($modelProducts)>0):?>
     <span class="basketaddspana"><?=Yii::t('trans','Eklenecek Ürün')?></span>
     <div class="clear"></div>

    <div class="add">
     	<table class="addtable">
        	<tr>
            	<td class="w1"><?=$modelProducts->name?></td>
                <td class="w3"><?=Yii::t('trans','Birim Fiyat')?>:
                
                	<?PHP
					
					 if(Yii::app()->user->getState("salesType")=="customer"){
				if($modelProducts->reducedPrice!=""){
					$birim= $modelProducts->reducedPrice+(($modelProducts->tax*$modelProducts->reducedPrice)/100);
					$cur=SalesController::getParams_("currency",$modelProducts->reduceCur);
					
				}else{
					$birim= $modelProducts->salePrice+(($modelProducts->tax*$modelProducts->salePrice)/100);
					 $cur=SalesController::getParams_("currency",$modelProducts->saleCur);
					
				}
					
			}elseif(Yii::app()->user->getState("salesType")=="dealer"){
				
				if($modelProducts->dealerPrice!=""){
					
					$birim= $modelProducts->dealerPrice+(($modelProducts->tax*$modelProducts->dealerPrice)/100);
					$cur=SalesController::getParams_("currency",$modelProducts->dealerCur);
					
				}else{
					
					if($modelProducts->reducedPrice!=""){
					$birim= $modelProducts->reducedPrice+(($modelProducts->tax*$modelProducts->reducedPrice)/100);
					$cur=SalesController::getParams_("currency",$modelProducts->reduceCur);
					
				}else{
					$birim= $modelProducts->salePrice+(($modelProducts->tax*$modelProducts->salePrice)/100);
					$cur=SalesController::getParams_("currency",$modelProducts->saleCur);
					
					}
				}
			}
			$birim=explode(".",$birim);
			if(@$birim[1]){
				if(strlen($birim[1]) ==1)
					$birim[1]=$birim[1]."0";
			}else
				$birim[1]="00";
			?>
                <input type="text" class="productscount" onKeyPress="return isNumber(event)" style="width:50px;margin-top:9px" maxlength="7" id="birim1" value="<?=$birim[0]?>">,
                <input type="text" class="productscount" onKeyPress="return isNumber(event)" style="width:20px;margin-top:9px" maxlength="2" id="birim2" value="<?=$birim[1]?>">
                <?=$cur?>
                </td>
                <td class="w2"><?=CHtml::dropDownList("productbottomsID",null,$bottom,array("style"=>"width:220px;margin-top:9px"))?></td>
                <td><?=Yii::t('trans','Adet')?>: <input type="text" class="productscount" onKeyPress="return isNumber(event)" style="width:60px;margin-top:9px" maxlength="5" id="number"></td>
                <td> 
				<?php $this->widget('bootstrap.widgets.TbButton', array(
              
				 'type'=>'success',
				 'size' => 'small',
				 'buttonType' => 'link',
				  'htmlOptions'=>array('onClick'=>'javascript:basketadd(this)'),
				 'url'=>"javascript:;",
				'label'=>Yii::t('trans','Ekle'),
				)); ?>
    			</td>
            </tr>
           
        </table>
        <table class="totalstocktable">
         <tr class="totalstock">
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size:16px;color:#498af3;"></td>
          </tr>
        </table>
    </div>
    <?PHP endif?>
</div>

<script type="text/javascript">
var selects=true;
function selectall(){
	if(selects==true){
		$('.basket').children('table').children('tbody').find('tr').each(function() {
			 $(this).children('td').children('input').attr('checked',true);
		});
		$('.basketnone').children('table').children('tbody').find('tr').each(function() {
			 $(this).children('td').children('input').attr('checked',true);
		});
		selects=false;
	}else{
		$('.basket').children('table').children('tbody').find('tr').each(function() {
			 $(this).children('td').children('input').attr('checked',false);
		});
		$('.basketnone').children('table').children('tbody').find('tr').each(function() {
			 $(this).children('td').children('input').attr('checked',false);
		});
		selects=true;
	}
}

function deleteitem(){
	$('.basket').children('table').children('tbody').find('tr').each(function() {
         if($(this).children('td').children('input').attr('checked')=='checked'){
			 var dataString = 'id='+$(this).children('td').children('input').attr('id');
			 var element=$(this);
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("sales/basketdelete")?>", 
			 data: dataString,
			 success: function(data)
			 {
				 if(data.sonuc==1){
					 $(element).remove();
					 
					 $('.total').html('<b><?=Yii::t('trans','Toplam')?>:</b> '+data.totalbasket+' <?=Yii::app()->user->getState('companyCurText')?>');
					 parent.$('.countBasket').html(data.count);
					 
				 }
			 }
			});
		 }
    });
	
	$('.basketnone').children('table').children('tbody').find('tr').each(function() {
         if($(this).children('td').children('input').attr('checked')=='checked'){
			 var dataString = 'id='+$(this).children('td').children('input').attr('id');
			 var element=$(this);
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("sales/basketdelete")?>", 
			 data: dataString,
			 success: function(data)
			 {
				 if(data.sonuc==1){
					 $(element).remove();
					 
					 $('.total').html('<b><?=Yii::t('trans','Toplam')?>:</b> '+data.totalbasket+' <?=Yii::app()->user->getState('companyCurText')?>');
					 parent.$('.countBasket').html(data.count);
					 
				 }
			 }
			});
		 }
    });
}
function isNumber(evt)  
{  
  var charCode = (evt.which) ? evt.which : event.keyCode  
  if (charCode > 31 && (charCode < 48 || charCode > 57))  
   return false;  
  return true; 
   
}  
 <?PHP if(count($modelProducts)>0):?>
 $('#productbottomsID').change(function(){
	
	getStockKontrol();
 });
 getStockKontrol();
 
 var stokNumber=0;
 function getStockKontrol(){
	 
	 $('.totalstock').children('td:eq(0)').html('<img src="<?=Yii::app()->baseUrl?>/images/loading.gif" />');
	 $('.totalstock').children('td:eq(1)').html('<img src="<?=Yii::app()->baseUrl?>/images/loading.gif" />');
	 $('.totalstock').children('td:eq(2)').html('<img src="<?=Yii::app()->baseUrl?>/images/loading.gif" />');
	  $('.totalstock').children('td:eq(3)').html('<img src="<?=Yii::app()->baseUrl?>/images/loading.gif" />');
	 var dataString = 'id=<?=$modelProducts->productsID?> &productbottomsID='+$('#productbottomsID').val();
	$.ajax({
	 type: "POST",
	 dataType:'json',  
	 url: "<?= Yii::app()->createUrl("sales/stockcontrol")?>", 
	 data: dataString,
	 success: function(data)
	 {
		 stokNumber=data.kalan;
		 $('.totalstock').children('td:eq(0)').html("<?=Yii::t('trans','Stok')?>: <b>"+data.total+"</b> <?=Yii::t('trans','Adet')?>");
		 $('.totalstock').children('td:eq(1)').html("<?=Yii::t('trans','Tüm Sepetlerde')?>: <b>"+data.basket+"</b> <?=Yii::t('trans','Adet')?>");
		 
		  $('.totalstock').children('td:eq(2)').html("<?=Yii::t('trans','İşlemde')?>: <b>"+data.islem+"</b> <?=Yii::t('trans','Adet')?>");
		  if(data.kalan>0)
		 	 $('.totalstock').children('td:eq(3)').html("<?=Yii::t('trans','Eklenebilir')?>: <b>"+data.kalan+"</b> <?=Yii::t('trans','Adet')?>");
		 else
		 	 $('.totalstock').children('td:eq(3)').html('<font color="#F00"><?=Yii::t('trans','Eklenebilir')?>: <b>'+data.kalan+'</b> <?=Yii::t('trans','Adet')?></font>');
	 }
	});
 }

 var kontrol=true;
	function basketadd(element){
		
		if(stokNumber>=$('#number').val()){
			
		
			var dataString = 'id=<?=$modelProducts->productsID?> &number='+$('#number').val()+' &productbottomsID='+$('#productbottomsID').val()+' &birim1='+$('#birim1').val()+' &birim2='+$('#birim2').val();
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("sales/basketadd")?>", 
			 data: dataString,
			 success: function(data)
			 {
				 	
			  var number=$('#number').val();
			   if(data.sonuc==1){
					$(element).parent().parent().parent().parent().parent().remove();
					$('.basketaddspana').remove();
					 <?PHP if(count($model)>0){?>
						$('.basket').children('table').children('tbody').append('<tr><td class="w1"><input type="checkbox" id="a'+data.id+'"></td><td class="w2"><?=$modelProducts->name?></td><td class="w3">'+data.bottom+'</td><td class="w4">'+number+' <?=Yii::t('trans','Adet')?></td><td class="w5">'+data.total+'</td></tr>');
					<?PHP }else{?>
					if(kontrol==false)
						$('.basketnone').append('<tr><td class="w1"><input type="checkbox" id="a'+data.id+'"></td><td class="w2"><?=$modelProducts->name?></td><td class="w3">'+data.bottom+'</td><td class="w4">'+number+' <?=Yii::t('trans','Adet')?></td><td class="w5">'+data.total+'</td></tr>');
					else
						$('.basketnone').html('<table><tbody><tr><td class="w1"><input type="checkbox" id="a'+data.id+'"></td><td class="w2"><?=$modelProducts->name?></td><td class="w3">'+data.bottom+'</td><td class="w4">'+number+' <?=Yii::t('trans','Adet')?></td><td class="w5">'+data.total+'</td></tr></tbody></table>');
						kontrol=false;
					<?PHP }?>
					
					$('.total').html('<b><?=Yii::t('trans','Toplam')?>:</b> '+data.totalbasket+' <?=Yii::app()->user->getState('companyCurText')?>');
					parent.$('.countBasket').html(data.count);
			   }else
					alert("<?=Yii::t('trans','Hata: Ürün Eklenmedi.')?>");
			 }
			});
			
		}else{
			alert("<?=Yii::t('trans','Stokta yeterli adet yok.')?>");
		}
	}

<?PHP endif;?>

</script>

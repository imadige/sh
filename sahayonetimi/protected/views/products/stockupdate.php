<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	Yii::t('trans','Stok Güncelleme - Yönet')=>array('stockadmin'),
	Yii::t('trans','Stok Güncelle'),
);


$this->menu=array(
	array('label'=>Yii::t('trans','Stok Yönet'), 'url'=>array('stockadmin')),
	
);

?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'brand',
		'model',
		
	),
)); ?>

<div class="searcGroup clear" style="width:100%;margin-top:30px">

	<table class="bottomitems">
        <tr>
       	 <td class="title"><?=Yii::t('trans','Stoklar')?></td>
        </tr>
        
        
        <?PHP 
		
		if(count($modelProductbot)==0){
			
			?>
            <tr style="background-color:#efefef;">
            <td style="text-align:center; padding:20px 20px 20px 20px;"><?=Yii::t('trans','İlk Stok bilgi girişi yapılmamış.')?></td>
            </tr>
            <?PHP
			
		}else{
			
			?>
            
            
            <tr style="background-color:#D7D7D7">
                <td style="font-weight:700;">
                	<?=Yii::t('trans','Stok ismi')?>
                </td>
                <td style="font-weight:700;border-left:dashed 1px #666;padding-left:10px;">
                	<?=Yii::t('trans','Stok Sayısı')?>
                </td>
        	</tr>
        <?PHP
		}
		
				foreach($modelProductbot as $key=>$value):
				
		?>
       
       
        <tr style="background-color:#efefef;border-bottom:dashed 1px #666;">
       	 <td class="bottomDtitem" style="padding:5px 5px 5px 5px;" width="700">
         	<div class="item">
				
               <div id="bottomRenk" class="value1">
                	<div class="item" style="background-color:<?=ProductsController::getParams_("colorCod",$value->bottomvalue1)?>" title="<?=ProductsController::getParams_("color",$value->bottomvalue1)?>"></div>     
                    <?PHP if($value->bottomvalue2!=""):?>
 						<span class="bold"><?=Yii::t('trans','En ve Boy')?>:</span> <span><?=$value->bottomvalue2?></span>
                	<?PHP endif;?>
                    
                     <?PHP if($value->bottomvalue3!=""):?>
 						<span class="bold"><?=Yii::t('trans','Beden')?>:</span> <span><?=$value->bottomvalue3?></span>
                	<?PHP endif;?>
                    
                     <?PHP if($value->bottomvalue4!=""):?>
 						<span class="bold"><?=Yii::t('trans','Numara')?>:</span> <span><?=$value->bottomvalue4?></span>
                	<?PHP endif;?>
                    
                     <?PHP if($value->bottomvalue5!=""):?>
 						<span class="bold"><?=Yii::t('trans','Ağırlık')?>:</span> <span><?=$value->bottomvalue5?></span>
                	<?PHP endif;?>
                    
                     <?PHP if($value->bottomvalue6!=""):?>
 						<span class="bold"><?=Yii::t('trans','Hacim')?>:</span> <span><?=$value->bottomvalue6?></span>
                	<?PHP endif;?>
                    
                     <?PHP if($value->bottomvalue7!=""):?>
 						<span class="bold"><?=Yii::t('trans','Derinlik')?>:</span> <span><?=$value->bottomvalue7?></span>
                	<?PHP endif;?>
                
                <div class="value4">
				<?PHP 
					$is=0;
					foreach($modelWarehousebottomstok as $key2=>$value2){
					
						if($value->productbottomsID==$value2->productbottomsID){
							if($is==0)
								echo '<span>'.$value2->wname.' (<span class="sc'.$value2->warehousebottomstokID.'">'.$value2->stok.'</span>) <img src="'.Yii::app()->baseUrl.'/images/chan1.png" onclick="javascript:bottomupdate(this, '.$value2->warehousebottomstokID.')" /></span><div class="pop"></div>';
							else
								echo '<span>'.", ".$value2->wname.' (<span class="sc'.$value2->warehousebottomstokID.'">'.$value2->stok.'</span>) <img src="'.Yii::app()->baseUrl.'/images/chan1.png" onclick="javascript:bottomupdate(this, '.$value2->warehousebottomstokID.')" /></span><div class="pop"></div>';
							
							$is++;
						}
					}
				?>
				</div>
               </div>
               </td>
               <td style="border-left:dashed 1px #666;padding-left:10px;">
                <div class="value2 sp<?=$value->productbottomsID?>"><?PHP
                
                $stok=0;
					foreach($modelWarehousebottomstok as $key2=>$value2){
					
						if($value->productbottomsID==$value2->productbottomsID){
							$stok+=$value2->stok;
						}
					}
                	echo $stok;
                ?> <?=Yii::t('trans','Adet')?></div>
              </td>
        </tr>
        <?PHP  endforeach;?>
    </table>
</div>

<script type="text/javascript">
function bottomupdate(element, ids){
	$.post("<?=Yii::app()->createUrl("products/stockwarehouseupdate")?>",{id:ids},function(data){
		$('.pop').fadeOut();
		$('.pop').html("");
		$(element).parent().next(".pop").css('top',$(element).position().top+10);
		$(element).parent().next(".pop").css('left',$(element).position().left+10);
		$(element).parent().next(".pop").html(data);
		$(element).parent().next(".pop").slideDown();
	});
}
</script>
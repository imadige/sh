<?PHP

$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
$colorbox->addInstance('.colorbox', array('width'=>'60%', 'height'=>'80%'));
$colorbox->addInstance('.colorbox2', array('frame'=>true,'width'=>'80%', 'height'=>'93%'));

?>
<style type="text/css">


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


	<div class="formcont clearfix">
    
    
		<div class="title">
        <?=$model->name?>
        </div>
        
        
        <div class="kapakimageview">
        	<?PHP if(isset($kapakimage)){?>
                <div class="border">
                 <a rel="x1" href="<?=Yii::app()->baseUrl?>/resimler/productimages/<?=$kapakimage->productID?>/<?=$kapakimage->images?>" class="colorbox">
                    <img class="kapakImageT" src="<?=Yii::app()->baseUrl?>/resimler/productimages/<?=$kapakimage->productID?>/thumb_<?=$kapakimage->images?>"  />
                   </a>
                </div>
            <?PHP }else{?>
            
             <div class="border">
                 <a rel="x1" href="<?=Yii::app()->baseUrl?>/images/no_product_photo.jpg" class="colorbox">
                    <img class="kapakImageT" src="<?=Yii::app()->baseUrl?>/images/no_product_photo.jpg"  />
                   </a>
               </div>
             <?PHP }?>
            <div class="imagelist clearfix">
				<?PHP foreach($imagelist as $key=>$value):?>
                    <div class="item">
                     <a rel="x1" href="<?=Yii::app()->baseUrl?>/resimler/productimages/<?=$value->productID?>/<?=$value->images?>" class="colorbox">
                        <img src="<?=Yii::app()->baseUrl?>/resimler/productimages/<?=$value->productID?>/thumb_<?=$value->images?>" />
                        </a>
                    </div>
                <?PHP endforeach?>
            </div>
        </div>
       
        
       <div class="productDetail">
       
       		
      <?PHP if(Yii::app()->user->getState("salesType")=="customer"){?>
            <div class="item">
            <table>
                <tr>
                <td class="title w1"><?=Yii::t('trans','Satış Fiyatı')?></td>
                <td class="w2">:</td>
                <td class="w3 <?PHP if($model->reducedPrice!=""){?>line <?PHP }?>"><?=number_format($model->salePrice,2).' '.SalesController::getParams_("currency",$model->saleCur)." + ".Yii::t('trans','KDV')?></td>
                </tr>
            </table>
            </div>
            
            <?PHP if($model->reducedPrice!=""):?>
            <div class="item">
            <table>
                <tr>
                <td class="title w1"><?=Yii::t('trans','İndirimli')?></td>
                <td class="w2">:</td>
                <td class="w3 reduced"><?=number_format($model->reducedPrice,2).' '.SalesController::getParams_("currency",$model->reduceCur)." + ".Yii::t('trans','KDV')?></td>
                </tr>
            </table>
            </div>
            <?PHP endif;?>
             <div class="item">
            <table>
                <tr>
                <td class="title w1 reduced"><?=Yii::t('trans','Kdv Dahil')?></td>
                <td class="w2">:</td>
                <td class="w3 reduced"><?PHP
                if($model->reducedPrice!="")
					echo number_format($model->reducedPrice+(($model->tax*$model->reducedPrice)/100),2).' '.SalesController::getParams_("currency",$model->reduceCur);
				else
					echo number_format($model->salePrice+(($model->tax*$model->salePrice)/100),2).' '.SalesController::getParams_("currency",$model->saleCur);
					
					?>
                </td>
                </tr>
          <?PHP }else{?>
			  
               <div class="item">
            <table>
                <tr>
                <td class="title w1"><?=Yii::t('trans','Satış Fiyatı')?></td>
                <td class="w2">:</td>
                <td class="w3"><?PHP
				
				 if($model->dealerPrice!=""){
					
					echo number_format($model->dealerPrice,2).' '.SalesController::getParams_("currency",$model->dealerCur);
					
				}else{
					
					
						echo number_format($model->salePrice,2).' '.SalesController::getParams_("currency",$model->saleCur);
				}
				echo " + ".Yii::t('trans','KDV');
				
				
				?></td>
                </tr>
            </table>
            </div>
            
          
             <div class="item">
            <table>
                <tr>
                <td class="title w1 reduced"><?=Yii::t('trans','Kdv Dahil')?></td>
                <td class="w2">:</td>
                <td class="w3 reduced"><?PHP
               if($model->dealerPrice!=""){
					
					echo number_format($model->dealerPrice+(($model->tax*$model->dealerPrice)/100),2).' '.SalesController::getParams_("currency",$model->dealerCur);
					
				}else{
					
					if($model->reducedPrice!="")
						echo number_format($model->reducedPrice+(($model->tax*$model->reducedPrice)/100),2).' '.SalesController::getParams_("currency",$model->reduceCur);
					else
						echo number_format($model->salePrice+(($model->tax*$model->salePrice)/100),2).' '.SalesController::getParams_("currency",$model->saleCur);
				}
					?>
                </td>
                </tr>
              
              
		 <?PHP }?>
            </table>
            </div>
            
           
             
            <div class="item" style="margin-top:50px;">
             <table>
                <tr>
                <td class="title w1"><?=Yii::t('trans','Marka')?></td>
                <td class="w2">:</td>
                <td class="w3"><?=$model->brand?></td>
                </tr>
            </table>
            </div>
            
            <div class="item">
             <table>
                <tr>
                <td class="title w1"><?=Yii::t('trans','Model')?></td>
                <td class="w2">:</td>
                <td class="w3"><?=$model->model?></td>
                </tr>
            </table>
            </div>
            
              
            <div class="items">
             <table>
                <tr>
                <td class="title w1"><?=Yii::t('trans','Ürün Numarası')?></td>
                <td class="w2">:</td>
                <td class="w3"><?=$model->productsID+SalesController::getParams("defultproductplus")?></td>
                </tr>
            </table>
            </div>
            
             <div class="items clearfix">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
              
			 'type'=>'primary',
			 'size' => 'large',
			 'buttonType' => 'link',
			 'htmlOptions'=>array('style'=>'float:right','class'=>'colorbox2'),
			 'url'=>Yii::app()->createUrl("sales/basket")."/".$model->productsID,
			'label'=>Yii::t('trans','Sepete Ekle'),
			)); ?>
            </div>
       </div>
        
        <div class="clear"></div>
        
        <div class="featuresTitle"><?=Yii::t('trans','Stoklar')?></div>
        <div class="features">
               <table class="bottomitems">
               
               <?PHP foreach($modelProductbot as $key=>$value):?>
                 <tr>
       		 <td class="bottomDtitem" style="padding:5px 5px 5px 5px;">
         	
				
		
			  
            <div class="item">
                <div id="bottomRenk" class="value1">
                	<div class="item" style="background-color:<?=SalesController::getParams_("colorCod",$value->bottomvalue1)?>" title="<?=SalesController::getParams_("color",$value->bottomvalue1)?>"></div>
                    
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
                
                </div>
             
                
                <div class="value4">
				<?PHP 
					$is=0;
					foreach($modelWarehousebottomstok as $key2=>$value2){
					
						if($value->productbottomsID==$value2->productbottomsID){
							if($is==0)
								echo '<span>'.$value2->wname.'</span>';
							else
								echo '<span>'.", ".$value2->wname.'</span>';
							
							$is++;
						}
					}
				?>
				</div>
                
            </div>
    
			
         	
         </td>
        </tr>
                
                  <?PHP endforeach?> 
            </table>
        </div>
        
        <div class="featuresTitle"><?=Yii::t('trans','Teknik Özelikleri')?></div>
        <div class="features">
        	<?=$model->text?>
        </div>
        
     

	</div>
</div>

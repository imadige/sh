<style type="text/css">
.span-19{
	width:816px;
}
</style>

<?PHP


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

");

$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
$colorbox->addInstance('.colorboxx', array('frame'=>true,'width'=>'80%', 'height'=>'96%'));


?>

<?PHP  if(Yii::app()->user->getState("salesType")=="customer"):?>

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
<div class="clear"></div>

<div style="margin:20px 0px 20px 0px">
 	<?php echo CHtml::link(Yii::t('trans','Detaylı Arama'),'#',array('class'=>'search-button')); ?>
</div>

<div class="search-form" style="display:none">
<?PHP $this->renderPartial("search",array('model'=>$model))?>
</div><!-- search-form -->


<div class="productssale clearfix">

    <?PHP if(@$pages):?>
    <div class="orderby">
        <span>
        	<a href="javascript:;" onclick="javascript:orderby(1);"><?=Yii::t('trans','İsme Göre')?> </a> 
       		<img src="<?=Yii::app()->baseUrl?>/images/<?PHP if($model->nameorder!="1"){?>sans_up_.png<?PHP }else{?>sans_up.png<?PHP }?> " /> <img src="<?=Yii::app()->baseUrl?>/images/<?PHP if($model->nameorder!="2"){?>sans_down_.png<?PHP }else{?>sans_down.png<?PHP }?>" />
        </span>
        
        <span>
        	<a href="javascript:;" onclick="javascript:orderby(2);"><?=Yii::t('trans','Fiyata Göre')?> </a> 
       		<img src="<?=Yii::app()->baseUrl?>/images/<?PHP if($model->saleorder!="1"){?>sans_up_.png<?PHP }else{?>sans_up.png<?PHP }?> " /> <img src="<?=Yii::app()->baseUrl?>/images/<?PHP if($model->saleorder!="2"){?>sans_down_.png<?PHP }else{?>sans_down.png<?PHP }?>" />
        </span>
        
        <span>
        	<a href="javascript:;" onclick="javascript:orderby(3);"><?=Yii::t('trans','Markaya Göre')?> </a> 
       		<img src="<?=Yii::app()->baseUrl?>/images/<?PHP if($model->brandorder!="1"){?>sans_up_.png<?PHP }else{?>sans_up.png<?PHP }?> " /> <img src="<?=Yii::app()->baseUrl?>/images/<?PHP if($model->brandorder!="2"){?>sans_down_.png<?PHP }else{?>sans_down.png<?PHP }?>" />
        </span>
        
        <span>
        	<a href="javascript:;" onclick="javascript:orderby(4);"><?=Yii::t('trans','Modele Göre')?> </a> 
       		<img src="<?=Yii::app()->baseUrl?>/images/<?PHP if($model->modelorder!="1"){?>sans_up_.png<?PHP }else{?>sans_up.png<?PHP }?> " /> <img src="<?=Yii::app()->baseUrl?>/images/<?PHP if($model->modelorder!="2"){?>sans_down_.png<?PHP }else{?>sans_down.png<?PHP }?>" />
        </span>
        
       
    </div>
    <?PHP endif;?>
    
    
<?PHP 

if(count($modelProducts)<1){
?>
<div class="sonuc"><?=Yii::t('trans','Hiç bir sonuç bulunamadı.')?></div>
<?PHP }
$i=0;
foreach($modelProducts as $key=>$value):
 $i++;
?>

<div class="salesborder <?PHP if($i%4==0){ ?>noneborder<?PHP }?> <?PHP if($i%4==1){ ?> clear<?PHP }?>" >

	<div class="q1">
    	<?PHP if(($value->dealerPrice=="" && $value->reducedPrice!="" && Yii::app()->user->getState("salesType")=="dealer") || ($value->reducedPrice!="" && Yii::app()->user->getState("salesType")=="customer")):?>
        <div class="discount">
         <?=mb_substr(Yii::t('trans','İndirim'),0,8,"UTF-8")?>
        </div>
     <?PHP endif?>
        <a href="<?=Yii::app()->createUrl("sales/view")."/".$value->productsID?>" target="_blank">
            <?PHP if($value->images!=""){?>
                <img src="<?=Yii::app()->baseUrl?>/resimler/productimages/<?=$value->productsID?>/thumb_<?=$value->images?>"  />
            <?PHP }else{?>
                 <img src="<?=Yii::app()->baseUrl?>/images/no_product_photo.jpg"  />
            <?PHP }?>
        </a>
    </div>
    <div class="q4">
    <?=$value->name?>
    </div>
    <div class="q2">
        <span class="sale">
			<?PHP
            if(Yii::app()->user->getState("salesType")=="customer"){
				if($value->reducedPrice!="")
					echo number_format($value->reducedPrice,2).' '.SalesController::getParams_("currency",$value->reduceCur);
				else
					echo number_format($value->salePrice,2).' '.SalesController::getParams_("currency",$value->saleCur);
			}elseif(Yii::app()->user->getState("salesType")=="dealer"){
				
				if($value->dealerPrice!=""){
					
					echo number_format($value->dealerPrice,2).' '.SalesController::getParams_("currency",$value->dealerCur);
					
				}else{
					
					if($value->reducedPrice!="")
						echo number_format($value->reducedPrice,2).' '.SalesController::getParams_("currency",$value->reduceCur);
					else
						echo number_format($value->salePrice,2).' '.SalesController::getParams_("currency",$value->saleCur);
				}
			}
            if($value->tax!="" || $value->tax!="0")
				echo " ".Yii::t('trans','+ KDV');
            ?>
        </span>
     
   
    </div>
    <div class="q3">
     <?php $this->widget('bootstrap.widgets.TbButton', array(
              
	 'type'=>'info',
	 'size' => 'mini',
	 'buttonType' => 'link',
	 'htmlOptions'=>array('style'=>'float:left;','target'=>'_blank'),
	 'url'=>Yii::app()->createUrl("sales/view")."/".$value->productsID,
	'label'=>Yii::t('trans','Ürünü İncele'),
	)); ?>
   	
    <?php $this->widget('bootstrap.widgets.TbButton', array(
              
	 'type'=>'success',
	 'size' => 'mini',
	 'buttonType' => 'link',
	 'htmlOptions'=>array('style'=>'float:right','class'=>'colorboxx'),
	 'url'=>Yii::app()->createUrl("sales/basket")."/".$value->productsID,
	'label'=>Yii::t('trans','Sepete Ekle'),
	)); ?>
    </div>
</div>
	<?PHP 
    if($i%4==0){ ?>
    <div class="line clear"></div>
    <?PHP }?>
<?PHP endforeach?>
	
    <?PHP if(@$pages):?>
    	<div class="clear"></div>
       <div class="pagination clear">
            <?php $this->widget('bootstrap.widgets.TbPager', array(
            'pages' => $pages,
        )) ?>
        </div>
    <?PHP endif;?>
</div>

<script type="text/javascript">
function  orderby(ids){
	if(ids==1){
		if($('#Products_nameorder').val()!="1")
			$('#Products_nameorder').val("1");
		else
			$('#Products_nameorder').val("2");
		
		$('#Products_modelorder').val("");
		$('#Products_saleorder').val("");
		$('#Products_brandorder').val("");
	}else if(ids==2){
		if($('#Products_saleorder').val()!="1")
			$('#Products_saleorder').val("1");
		else
			$('#Products_saleorder').val("2");
			
		$('#Products_modelorder').val("");
		$('#Products_nameorder').val("");
		$('#Products_brandorder').val("");
		
	}else if(ids==3){
		if($('#Products_brandorder').val()!="1")
			$('#Products_brandorder').val("1");
		else
			$('#Products_brandorder').val("2");
			
		$('#Products_modelorder').val("");
		$('#Products_saleorder').val("");
		$('#Products_nameorder').val("");
		
	}else if(ids==4){
		if($('#Products_modelorder').val()!="1")
			$('#Products_modelorder').val("1");
		else
			$('#Products_modelorder').val("2");
		
		$('#Products_nameorder').val("");
		$('#Products_saleorder').val("");
		$('#Products_brandorder').val("");
	}
	$('#search-form').submit();
}
</script>
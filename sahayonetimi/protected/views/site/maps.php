<?php echo '<?xml version="1.0" encoding="UTF-8"?>';


 ?>

<product>

<?php foreach($model as $key=>$value): 

?>
		<item>
            <name><?=$value->name?></name>
            <brand><?=$value->brand?></brand>
            <model><?=$value->model?></model>
            <purchaseprice><?=$value->purchasePrice." ".SiteController::getParams_("currency",$value->purchaseCur)?></purchaseprice>
            <saleprice><?=$value->salePrice." ".SiteController::getParams_("currency",$value->saleCur)?></saleprice>
            <reducedprice><?=$value->reducedPrice." ".@SiteController::getParams_("currency",$value->reduceCur)?></reducedprice>
            
            <dealerprice><?=$value->dealerPrice." ".@SiteController::getParams_("currency",$value->dealerCur)?></dealerprice>
            <group><?=$value->productsGroupName?></group>
        </item>
<?php endforeach; ?>


</product>
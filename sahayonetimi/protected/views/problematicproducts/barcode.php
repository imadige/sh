
<div class="barcodes">
	
    <div class="item">
		<img src="<?=Yii::app()->createUrl("barcode/getbarcode")?>?number=S-<?=$model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")?>&size=b" title="<?=Yii::t('trans','Barkod')?>" style="border:1px dashed #498af3";>
    </div>
	<div class="print">
    	<a href="javascript:;" onclick="javascript:prints('b')">
            <table>
                <tr>
                    <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/print.png" title="<?=Yii::t('trans','Yazdır')?>" /></td>
                    <td><?=Yii::t('trans','Yazdır')?></td>
                </tr>
            </table>
        </a>
    </div>
    
    
    <div class="item">
		<img src="<?=Yii::app()->createUrl("barcode/getbarcode")?>?number=S-<?=$model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")?>&size=o" title="<?=Yii::t('trans','Barkod')?>" style="border:1px dashed #498af3";>
    </div>
	<div class="print">
    	<a href="javascript:;" onclick="javascript:prints('o')">
            <table>
                <tr>
                    <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/print.png" title="<?=Yii::t('trans','Yazdır')?>" /></td>
                    <td><?=Yii::t('trans','Yazdır')?></td>
                </tr>
            </table>
        </a>
    </div>
    
    
    <div class="item">
		<img src="<?=Yii::app()->createUrl("barcode/getbarcode")?>?number=S-<?=$model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")?>&size=k" title="<?=Yii::t('trans','Barkod')?>" style="border:1px dashed #498af3";>
    </div>
	<div class="print">
    	<a href="javascript:;" onclick="javascript:prints('k')">
            <table>
                <tr>
                    <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/print.png" title="<?=Yii::t('trans','Yazdır')?>" /></td>
                    <td><?=Yii::t('trans','Yazdır')?></td>
                </tr>
            </table>
        </a>
    </div>
   

</div>


<script type="text/javascript">
function prints(ids){
	window.open ("<?=Yii::app()->createUrl("problematicproducts/barcodeprints")?>/?id=<?=$model->problematicproductsID?>&param="+ids,"<?=Yii::t('trans','Barkod Yazdır')?>","location=1,status=1,scrollbars=1, width=700,height=600");
}
</script>

<div class="barcodes">
	
    <div class="item left">
		<img src="<?=Yii::app()->createUrl("barcode/getqrbarcode")?>?size=7&number=S-<?=$model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")?>&id=<?=$model->problematicproductsID?>_1" title="<?=Yii::t('trans','Barkod')?>" style="border:1px dashed #498af3";>
        
        
        <div class="print">
    	<a href="javascript:;" onclick="javascript:prints(7)">
            <table>
                <tr>
                    <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/print.png" title="<?=Yii::t('trans','Yazdır')?>" /></td>
                    <td><?=Yii::t('trans','Yazdır')?></td>
                </tr>
            </table>
        </a>
   	 </div>
    </div>
	
    
    
    <div class="item left" style="margin-left:40px;">
		<img src="<?=Yii::app()->createUrl("barcode/getqrbarcode")?>?size=5&number=S-<?=$model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")?>&id=<?=$model->problematicproductsID?>_1" title="<?=Yii::t('trans','Barkod')?>" style="border:1px dashed #498af3";>
        
         <div class="print">
            <a href="javascript:;" onclick="javascript:prints(5)">
                <table>
                    <tr>
                        <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/print.png" title="<?=Yii::t('trans','Yazdır')?>" /></td>
                        <td><?=Yii::t('trans','Yazdır')?></td>
                    </tr>
                </table>
            </a>
        </div>
    </div>

    
    
    <div class="item clear left">
		<img src="<?=Yii::app()->createUrl("barcode/getqrbarcode")?>?size=3&number=S-<?=$model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")?>&id=<?=$model->problematicproductsID?>_1" title="<?=Yii::t('trans','Barkod')?>" style="border:1px dashed #498af3";>
        
        <div class="print">
    	<a href="javascript:;" onclick="javascript:prints(3)">
            <table>
                <tr>
                    <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/print.png" title="<?=Yii::t('trans','Yazdır')?>" /></td>
                    <td><?=Yii::t('trans','Yazdır')?></td>
                </tr>
            </table>
        </a>
    	</div>
   
    </div>
    
     <div class="item left" style="margin-left:140px;">
		<img src="<?=Yii::app()->createUrl("barcode/getqrbarcode")?>?size=2&number=S-<?=$model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")?>&id=<?=$model->problematicproductsID?>_1" title="<?=Yii::t('trans','Barkod')?>" style="border:1px dashed #498af3";>
        
         <div class="print">
            <a href="javascript:;" onclick="javascript:prints(2)">
                <table>
                    <tr>
                        <td width="10"><img src="<?=Yii::app()->baseUrl?>/images/print.png" title="<?=Yii::t('trans','Yazdır')?>" /></td>
                        <td><?=Yii::t('trans','Yazdır')?></td>
                    </tr>
                </table>
            </a>
        </div>
    </div>

	

</div>


<script type="text/javascript">
function prints(ids){
	window.open ("<?=Yii::app()->createUrl("problematicproducts/qrbarcodeprints")?>/?id=<?=$model->problematicproductsID?>&param="+ids,"<?=Yii::t('trans','Barkod Yazdır')?>","location=1,status=1,scrollbars=1, width=700,height=600");
}
</script>
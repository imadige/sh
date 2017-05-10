<table>
    <tr>
    <td><?=Yii::t('trans','Stok Güncelle')?></td>
    <td><img src="<?=Yii::app()->baseUrl?>/images/close.png" height="21" style="float:right;margin-right:5px;"  onClick="javascript:$('.pop').slideUp();"></td>
    </tr>
</table>
<div class="clear"></div>

<table class="tables">
	<tr>
        <td><?=CHtml::textField('stockval', $model->stok,array('style'=>'width:100px;margin-top:6px;'));?></td>
        <td> <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
			 'buttonType' => 'link',

			 'url'=>"javascript:;",
			 'htmlOptions'=>array('onclick'=>'javascript:bottomupdateSc()'),
            'label'=>Yii::t('trans','Güncelle'),
        	)); ?></td>
    </tr>
</table>
<div class="imagesSc">

</div>

<script type="text/javascript">
function bottomupdateSc(){
	$('.imagesSc').html('<img src="<?=Yii::app()->baseUrl?>/images/loading.gif" />');
	var dataString = 'warehousebottomstokID=<?=$model->warehousebottomstokID?>&stock='+$('#stockval').val();
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("products/bottomwarehouseupdate")?>", 
			 data: dataString,
			 success: function(data)
			 {
				 
				 if(data.sonuc==1){
					$('.imagesSc').html('<font color="#0C0"><?=Yii::t('trans','Güncellendi.')?></font>');
					$('.sc<?=$model->warehousebottomstokID?>').html($('#stockval').val());
					$('.sp'+data.productbottomsID).html(data.tstock+" <?=Yii::t('trans','Adet')?>");
				 }else
				 	$('.imagesSc').html('<font color="#F00"><?=Yii::t('trans','Hata.')?></font>');
			 }
			});
}
</script>
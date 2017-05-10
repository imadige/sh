
<div class="displayMenu">
	<table>
        <tr>
        <td style="padding-left:40px;"<?PHP if($id==1){?>class="check" <?PHP }?>>
		
		<?PHP if(!$model->isNewRecord){?><a href="<?=Yii::app()->createUrl("products/update")?>/<?=$model->productsID?>" class="link <?PHP if($id==1){?>check<?PHP }?>"><?PHP }?><?=Yii::t('trans','Ürün Bilgileri')?><?PHP if($model->isNewRecord){?></a><?PHP }?>
        
        </td>
        <td <?PHP if($id==2){?>class="check" <?PHP }?>>
		
		<?PHP if(!$model->isNewRecord){?><a href="<?=Yii::app()->createUrl("products/bottomproduct")?>/<?=$model->productsID?>" class="link <?PHP if($id==2){?>check<?PHP }?>"><?PHP }?><?=Yii::t('trans','Stok Girişi')?><?PHP if($model->isNewRecord){?></a><?PHP }?>
        
        </td>
        <td <?PHP if($id==3){?>class="check" <?PHP }?>>
		
		<?PHP if(!$model->isNewRecord){?><a href="<?=Yii::app()->createUrl("products/imageslist")?>/<?=$model->productsID?>" class="link <?PHP if($id==3){?>check<?PHP }?>"><?PHP }?><?=Yii::t('trans','Ürün Fotoğrafları')?><?PHP if($model->isNewRecord){?></a><?PHP }?>
        
        </td>
        <td <?PHP if($id==4){?>class="check" <?PHP }?>>
		
		<?PHP if(!$model->isNewRecord){?><a href="<?=Yii::app()->createUrl("products/viewp")?>/<?=$model->productsID?>" class="link <?PHP if($id==4){?>check<?PHP }?>"><?PHP }?><?=Yii::t('trans','Ürün Görünümü')?><?PHP if($model->isNewRecord){?></a><?PHP }?>
        
        </td>
        <tr>
    </table>
</div>
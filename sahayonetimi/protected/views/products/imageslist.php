<?PHP
	$this->breadcrumbs=array(
	Yii::t('trans','Ürünler')=>array('admin'),
	$model->name=>array('update','id'=>$model->productsID),
	Yii::t('trans','Ürün Fotoğrafları'),
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
$colorbox->addInstance('.colorbox', array('width'=>'60%', 'height'=>'80%'));


?>
<style type="text/css">
input[type=text]{
	width:220px;
	height:25px;
	background:#CCE9F2;
	padding-left:10px;
}
input[type=password]{
	width:220px;
	height:25px;
	background:#CCE9F2;
	padding-left:10px;
}
select{
	width:238px;
	height:35px;
	background:#CCE9F2;
	padding-top:5px;
}
textarea{
	background:#CCE9F2;
}

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

<?PHP $this->renderPartial("items/displaymenu",array("id"=>3,'model'=>$model))?>

	<div class="formcont">
    
    
		<?php
		
		if($imagesCount<13){
			 $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'link',
				'type'=>'primary',
				'label'=>Yii::t('trans','Resim Ekle'),
				 'url'=>Yii::app()->createUrl("products/imageadd")."/".$model->productsID,
			)); 
		}
		
		?>
        
        <?PHP if(isset($kapakimage)):?>
        <div class="kapakimage">
        	<div class="kapak"><?=Yii::t('trans','Kapak Resmi')?></div>
            
            <a href="<?=Yii::app()->baseUrl?>/resimler/productimages/<?=$kapakimage->productID?>/<?=$kapakimage->images?>" class="colorbox img">
        	<img class="kapakImageT" src="<?=Yii::app()->baseUrl?>/resimler/productimages/<?=$kapakimage->productID?>/thumb_<?=$kapakimage->images?>"  />
            </a>
            
            <div class="control clearfix">
            <span class="del"><a href="javascript:;" onclick="javascript:kapakdel(this)" class="a<?=$kapakimage->productimagesID?>"><img   src="<?=Yii::app()->baseUrl?>/images/delete.png"  /><?=Yii::t('trans','Sil')?></a></span>
            </div>
        </div>
        <?PHP endif?>
        
        <div class="imagelist clearfix">
        <?PHP foreach($imagelist as $key=>$value):?>
        	<div class="item">
             <a href="<?=Yii::app()->baseUrl?>/resimler/productimages/<?=$value->productID?>/<?=$value->images?>" class="colorbox img">
        		<img src="<?=Yii::app()->baseUrl?>/resimler/productimages/<?=$value->productID?>/thumb_<?=$value->images?>" />
             </a>
                <div class="control clearfix">
                
                	<span class="kap"><a href="<?=Yii::app()->createUrl("products/kapakchange")."/".$value->productimagesID?>"><img src="<?=Yii::app()->baseUrl?>/images/cover.png"   /><?=Yii::t('trans','Kapak Resmi')?></a></span>
                    
            		<span class="del"><a href="javascript:;" class="a<?=$value->productimagesID?>" onclick="javascript:imagedel(this)" ><img src="<?=Yii::app()->baseUrl?>/images/delete.png"  /><?=Yii::t('trans','Sil')?></a></span>
            	</div>
        	</div>
        <?PHP endforeach?>
        </div>
        
        
        <div class="row buttons clear" style="margin-top:70px;">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
              
                 'type'=>'primary',
                 'size' => 'large',
                 'buttonType' => 'link',
    
                 'url'=>Yii::app()->createUrl("products/viewp")."/".$model->productsID,
                'label'=>Yii::t('trans','Tamam ve İlerle'),
                )); ?>
		</div>

	</div>
</div>

<script type="text/javascript">

function imagedel(element){

	$(element).children('img').attr('src','<?=Yii::app()->baseUrl?>/images/loading.gif');
	var dataString = 'id='+ $(element).prop('class');
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("products/imagedelete")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				
				if(data.sonuc==1){
					$(element).parent().parent().parent().remove();
				}else{
					$(element).children('img').attr('src','<?=Yii::app()->baseUrl?>/images/delete.png');
				}
				
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	$(element).children('img').attr('src','<?=Yii::app()->baseUrl?>/images/delete.png');
			 }
			 
			});
	
}



function kapakdel(element){

	$(element).children('img').attr('src','<?=Yii::app()->baseUrl?>/images/loading.gif');
	var dataString = 'id='+ $(element).prop('class');
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("products/imagedelete")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				
			
				if(data.sonuc==1){
					if(data.id!=0){
						$('.kapakImageT').attr('src',$('.a'+data.id).parent().parent().parent().children('.img').children('img').prop('src'));
						$('.a'+data.id).parent().parent().parent().remove();
					}else{
						
						$(element).parent().parent().parent().remove();
					}
				}
				$(element).attr('class','a'+data.id);
				$(element).children('img').attr('src','<?=Yii::app()->baseUrl?>/images/delete.png');
				
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	$(element).children('img').attr('src','<?=Yii::app()->baseUrl?>/images/delete.png');
			 }
			 
			});
	
}

</script>
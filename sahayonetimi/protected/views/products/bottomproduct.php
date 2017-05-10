<?PHP
	$this->breadcrumbs=array(
	Yii::t('trans','Ürünler')=>array('admin'),
	$model->name=>array('update','id'=>$model->productsID),
	Yii::t('trans','Stok Girişi'),
);

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
</style>
  
<div class="form">

	<?PHP $this->renderPartial("items/displaymenu",array("id"=>2,'model'=>$model))?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'productbottoms-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	 
<div class="searcGroup">

	<div class="row left">
		<?php echo $form->labelEx($modelProductbottoms,'productsType'); ?>
		<?php echo $form->dropDownList($modelProductbottoms,'productsType',ProductsController::getParams("productsType"),array('style'=>'width:150px')); ?>
        
		<?php echo $form->error($modelProductbottoms,'productsType'); ?>
	</div>
  

</div>



<div class="searcGroup clear bottomInput" style="width:300px;">
	<div class="row" style="border-bottom:1px solid #999">
		
	</div>
	<div class="row"></div>
    
    <div class="row" style="margin-top:10px"></div>

	<div class="row" style="margin-top:10px"></div>
</div>

<div class="searcGroup clear" style="width:100%;margin-top:30px">

	<table class="bottomitems">
        <tr>
       	 <td class="title"><?=Yii::t('trans','Stoklar')?></td>
        </tr>
        <?PHP 
				foreach($modelProductbot as $key=>$value):
				
		?>
        <tr>
       	 <td class="bottomDtitem" id="a<?=$value->productbottomsID?>" style="padding:5px 5px 5px 5px;">
         	
				
		
			  
            <div class="item">
                <div id="bottomRenk" class="value1 ">
                <?PHP if($value->bottomvalue1!=""):?>
                	<div class="item" style="background-color:<?=ProductsController::getParams_("colorCod",$value->bottomvalue1)?>" title="<?=ProductsController::getParams_("color",$value->bottomvalue1)?>"></div>
                  <?PHP endif;?>  
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
                <div class="value2"><?=Yii::t('trans','Toplam Stok Adet')?>: <span><?PHP
                
                $stok=0;
					foreach($modelWarehousebottomstok as $key2=>$value2){
					
						if($value->productbottomsID==$value2->productbottomsID){
							$stok+=$value2->stok;
						}
					}
                	echo $stok;
                ?></span></div>
                
                <div class="value4">
				<?PHP 
					$is=0;
					foreach($modelWarehousebottomstok as $key2=>$value2){
					
						if($value->productbottomsID==$value2->productbottomsID){
							if($is==0)
								echo '<span>'.$value2->wname.' ('.$value2->stok.') <img src="'.Yii::app()->baseUrl.'/images/delete.png" onclick="javascript:productsdelete(this, '.$value2->warehousebottomstokID.')" /></span>';
							else
								echo '<span>'.", ".$value2->wname.' ('.$value2->stok.') <img src="'.Yii::app()->baseUrl.'/images/delete.png" onclick="javascript:productsdelete(this, '.$value2->warehousebottomstokID.')" /></span>';
							
							$is++;
						}
					}
				?>
				</div>
            </div>
    
			
         	
         </td>
        </tr>
        <?PHP  endforeach;?>
    </table>
</div>

	
  
	<div class="clear"></div>
	<div class="row buttons clear" style="margin-top:70px;">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'large',
			 'buttonType' => 'link',

			 'url'=>Yii::app()->createUrl("products/imageslist")."/".$model->productsID,
            'label'=>Yii::t('trans','Tamam ve İlerle'),
        	)); ?>
	</div>

    <div id="color" style="display:none;">
        <?php echo $form->labelEx($modelProductbottoms,'color'); ?>
        <?php echo $form->dropDownList($modelProductbottoms,'bottomvalue1',ProductsController::getParams("color"),array('style'=>'width:150px')); ?>
        <img class="notcheckPBot" src="<?=Yii::app()->baseUrl?>/images/notcheck2.png" onclick="javascript:clearB(this,1)" />
    </div>
    
    <div id="enboy" style="display:none;">
        <?php echo $form->labelEx($modelProductbottoms,'enboy'); ?>
        <?php echo $form->textField($modelProductbottoms,'bottomvalue2a',array('style'=>'width:50px','onkeypress'=>'return isNumber(event)')); ?> X
        <?php echo $form->textField($modelProductbottoms,'bottomvalue2b',array('style'=>'width:50px','onkeypress'=>'return isNumber(event)')); ?>
        <?php echo $form->dropDownList($modelProductbottoms,'bottombirim2',ProductsController::getParams("enboybirim"),array('style'=>'width:80px','options' => array('6'=>array('selected'=>true)))); ?>
        
        <img class="notcheckPBot" src="<?=Yii::app()->baseUrl?>/images/notcheck2.png" onclick="javascript:clearB(this,2)" />
    </div>
    
    
     
     <div id="beden" style="display:none;">
        <?php echo $form->labelEx($modelProductbottoms,'beden'); ?>
        <?php echo $form->textField($modelProductbottoms,'bottomvalue3',array('style'=>'width:150px')); ?>
        <img class="notcheckPBot" src="<?=Yii::app()->baseUrl?>/images/notcheck2.png" onclick="javascript:clearB(this,3)" />
    </div>
    
    <div id="numara" style="display:none;">
        <?php echo $form->labelEx($modelProductbottoms,'numara'); ?>
        <?php echo $form->textField($modelProductbottoms,'bottomvalue4',array('style'=>'width:150px')); ?>
        <img class="notcheckPBot" src="<?=Yii::app()->baseUrl?>/images/notcheck2.png" onclick="javascript:clearB(this,4)" />
    </div>
    
	
    
    <div id="agirlik" style="display:none;">
        <?php echo $form->labelEx($modelProductbottoms,'agirlik'); ?>
        <?php echo $form->textField($modelProductbottoms,'bottomvalue5',array('style'=>'width:50px','onkeypress'=>'return isNumber(event)')); ?>
        <?php echo $form->dropDownList($modelProductbottoms,'bottombirim5',ProductsController::getParams("agirlik"),array('style'=>'width:80px','options' => array('6'=>array('selected'=>true)))); ?>
        <img class="notcheckPBot" src="<?=Yii::app()->baseUrl?>/images/notcheck2.png" onclick="javascript:clearB(this,5)" />
    </div>
    
    <div id="hacim" style="display:none;">
        <?php echo $form->labelEx($modelProductbottoms,'hacim'); ?>
        <?php echo $form->textField($modelProductbottoms,'bottomvalue6',array('style'=>'width:50px','onkeypress'=>'return isNumber(event)')); ?>
        <?php echo $form->dropDownList($modelProductbottoms,'bottombirim6',ProductsController::getParams("hacim"),array('style'=>'width:80px','options' => array('6'=>array('selected'=>true)))); ?>
        <img class="notcheckPBot" src="<?=Yii::app()->baseUrl?>/images/notcheck2.png" onclick="javascript:clearB(this,6)" />
    </div>
    
     
    <div id="derinlik" style="display:none;">
        <?php echo $form->labelEx($modelProductbottoms,'derinlik'); ?>
        <?php echo $form->textField($modelProductbottoms,'bottomvalue7',array('style'=>'width:150px')); ?>
        <img class="notcheckPBot" src="<?=Yii::app()->baseUrl?>/images/notcheck2.png" onclick="javascript:clearB(this,7)" />
    </div>
    
     <div id="stok" style="display:none;">
        <?php echo $form->labelEx($modelProductbottoms,'stok'); ?>
        <?php echo $form->textField($modelProductbottoms,'stok',array('style'=>'width:133px','onkeypress'=>'return isNumber(event)')); ?>
    </div>
     <div id="warehouse" style="display:none;">
        <?php 
		$array=array(''=>'');
		foreach($modelWarehouse as $key=>$value)
			$array[$value->warehouseID]=$value->name;
		echo $form->labelEx($modelProductbottoms,'warehouseID'); ?>
        <?php echo $form->dropDownList($modelProductbottoms,'warehouseID',$array,array('style'=>'width:150px')); ?>
    </div>
    
    <div id="button" style="display:none;">
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'warning',
			 'size' => 'small',
			 'buttonType' => 'link',

			 'url'=>"javascript:;",
			 'htmlOptions'=>array('onclick'=>'javascript:bottomItemsAdd()'),
            'label'=>Yii::t('trans','Ekle'),
        	)); ?>
       
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->


<script type="text/javascript">

function productsdelete(element,ids){

	var dataString = 'warehousebottomstokID='+ids;
	
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("products/bottomdelete")?>", 
			 data: dataString,
			 success: function(data)
			 {
				 
				 if(data.sonuc==1){
					 $(element).parent().parent().prev('.value2').html("<?=Yii::t('trans','Toplam Stok Adet')?>: <span>"+data.stok+"</span>");
				 	$(element).parent().remove();
					
				 }
			 }
			});
}

var colorarray = new Array();

colorarray[1]='#FFF';
colorarray[2]='#bdbdbd';
colorarray[3]='#712727';
colorarray[4]='#844040';
colorarray[5]='#ff0000';
colorarray[6]='#1c377b';
colorarray[7]='#3665dc';
colorarray[8]='#87a9ff';
colorarray[9]='#8c0852';
colorarray[10]='#ff1197';
colorarray[11]='#ff0';
colorarray[12]='#000000';
colorarray[13]='#fe6c00';
colorarray[14]='#18fe00';
colorarray[15]='#92fe86';
colorarray[16]='#0f8702';

var colornamearray = new Array();
colornamearray[1]="<?=Yii::t('trans','Beyaz')?>";
colornamearray[2]="<?=Yii::t('trans','Gri')?>";
colornamearray[3]="<?=Yii::t('trans','Kahverengi')?>";
colornamearray[4]="<?=Yii::t('trans','Açık Kahverengi')?>";
colornamearray[5]="<?=Yii::t('trans','Kırmızı')?>";
colornamearray[6]="<?=Yii::t('trans','Lacivert')?>";
colornamearray[7]="<?=Yii::t('trans','Mavi')?>";
colornamearray[8]="<?=Yii::t('trans','Açık Mavi')?>";
colornamearray[9]="<?=Yii::t('trans','Mor')?>";
colornamearray[10]="<?=Yii::t('trans','Pembe')?>";
colornamearray[11]="<?=Yii::t('trans','Sarı')?>";
colornamearray[12]="<?=Yii::t('trans','Siyah')?>";
colornamearray[13]="<?=Yii::t('trans','Truncu')?>";
colornamearray[14]="<?=Yii::t('trans','Yeşil')?>";
colornamearray[15]="<?=Yii::t('trans','Açık Yeşil')?>";
colornamearray[0]="<?=Yii::t('trans','Diğeri')?>";



function bottomItemsAdd(){
	var kontrol=true;	
	var input=$('.bottomInput').children('.row:eq(0)');
	var input1=$('.bottomInput').children('.row:eq(1)');
	var input2=$('.bottomInput').children('.row:eq(2)');
	
	var dataString = 'productsID=<?=$model->productsID?> &stok='+input1.children('#Productbottoms_stok').val()+' &warehouseID='+input2.children('#Productbottoms_warehouseID').val();
	
	if(typeof bottom["1"]!= "undefined"){
		
		if(input.children('.b1').children('#Productbottoms_bottomvalue1').val()==""){
			kontrol=false;
			input.children('.b1').children('#Productbottoms_bottomvalue1').css("background-color",'#F4CACA');
			
		}else{
			input.children('.b1').children('#Productbottoms_bottomvalue1').css("background-color",'');
			dataString+=' &bottomvalue1='+input.children('.b1').children('#Productbottoms_bottomvalue1').val();
		}
	
		
	}
	
	if(typeof bottom["2"]!="undefined"){
		
		var value=input.children('.b2').children('#Productbottoms_bottomvalue2a').val();
		var value2=input.children('.b2').children('#Productbottoms_bottomvalue2b').val();
		
		if(value==""){
			kontrol=false;
			input.children('.b2').children('#Productbottoms_bottomvalue2a').css("background-color",'#F4CACA');
		}else{
			input.children('.b2').children('#Productbottoms_bottomvalue2a').css("background-color",'');
			dataString+=' &bottomvalue2a='+input.children('.b2').children('#Productbottoms_bottomvalue2a').val();
		}
			
		if(value2==""){
			kontrol=false;
			input.children('.b2').children('#Productbottoms_bottomvalue2b').css("background-color",'#F4CACA');
		}else{
			input.children('.b2').children('#Productbottoms_bottomvalue2b').css("background-color",'');
			dataString+=' &bottomvalue2b='+input.children('.b2').children('#Productbottoms_bottomvalue2b').val();
			dataString+=' &bottombirim2='+input.children('.b2').children('#Productbottoms_bottombirim2').val();
			
		}
		
	}
	
	if(typeof bottom["3"]!= "undefined"){
		
		if(input.children('.b3').children('#Productbottoms_bottomvalue3').val()==""){
		
			kontrol=false;
			input.children('.b3').children('#Productbottoms_bottomvalue3').css("background-color",'#F4CACA');
		}else{
			input.children('.b3').children('#Productbottoms_bottomvalue3').css("background-color",'');
			dataString+=' &bottomvalue3='+input.children('.b3').children('#Productbottoms_bottomvalue3').val();
		}
	}
	if(typeof bottom["4"]!= "undefined"){
		
		if(input.children('.b4').children('#Productbottoms_bottomvalue4').val()==""){
		
			kontrol=false;
			input.children('.b4').children('#Productbottoms_bottomvalue4').css("background-color",'#F4CACA');
		}else{
			input.children('.b4').children('#Productbottoms_bottomvalue4').css("background-color",'');
			dataString+=' &bottomvalue4='+input.children('.b4').children('#Productbottoms_bottomvalue4').val();
		}
	}
	if(typeof bottom["5"]!= "undefined"){
		
		if(input.children('.b5').children('#Productbottoms_bottomvalue5').val()==""){
		
			kontrol=false;
			input.children('.b5').children('#Productbottoms_bottomvalue5').css("background-color",'#F4CACA');
			
		}else{
			input.children('#Productbottoms_bottomvalue5').css("background-color",'');
			dataString+=' &bottomvalue5='+input.children('.b5').children('#Productbottoms_bottomvalue5').val();
			dataString+=' &bottombirim5='+input.children('.b5').children('#Productbottoms_bottombirim5').val();
			
		}
	}
	if(typeof bottom["6"]!= "undefined"){
		
		if(input.children('.b6').children('#Productbottoms_bottomvalue6').val()==""){
		
			kontrol=false;
			input.children('.b6').children('#Productbottoms_bottomvalue6').css("background-color",'#F4CACA');
		}else{
			input.children('.b6').children('#Productbottoms_bottomvalue6').css("background-color",'');
			dataString+=' &bottomvalue6='+input.children('.b6').children('#Productbottoms_bottomvalue6').val();
			dataString+=' &bottombirim6='+input.children('.b6').children('#Productbottoms_bottombirim6').val();
		}
	}
	if(typeof bottom["7"]!= "undefined"){
		
		if(input.children('.b7').children('#Productbottoms_bottomvalue7').val()==""){
		
			kontrol=false;
			input.children('.b7').children('#Productbottoms_bottomvalue7').css("background-color",'#F4CACA');
		}else{
			input.children('.b7').children('#Productbottoms_bottomvalue2b').css("background-color",'');
			dataString+=' &bottomvalue7='+input.children('.b7').children('#Productbottoms_bottomvalue7').val();
		}
		
	}
	
	
	if(input1.children('#Productbottoms_stok').val()==""){
		
			kontrol=false;
			input1.children('#Productbottoms_stok').css("background-color",'#F4CACA');
	}else
		input1.children('#Productbottoms_stok').css("background-color",'');
	
	
	if(input2.children('#Productbottoms_warehouseID').val()==""){
		
			kontrol=false;
			input2.children('#Productbottoms_warehouseID').css("background-color",'#F4CACA');
	}else
		input2.children('#Productbottoms_warehouseID').css("background-color",'');
	
	if(kontrol==true){
	 	
		
		
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("products/bottomadd")?>", 
			 data: dataString,
			 success: function(data)
			 {
				 
				
				if(data.sonuc==1){
					
					var STR='<tr><td class="bottomDtitem" id="a'+data.id+'" style="padding:5px 5px 5px 5px;"><div class="item"><div id="bottomRenk" class="value1">';
					
					if(typeof data.bottomvalue1!="undefined")
						STR+='<div class="item" title="'+colornamearray[data.bottomvalue1]+'" style="background-color:'+colorarray[data.bottomvalue1]+'"></div>';

					if(typeof data.bottomvalue2!="undefined")
						STR+='<span class="bold"><?=Yii::t('trans','En ve Boy')?>:</span><span>'+data.bottomvalue2+'</span>';
						
					if(typeof data.bottomvalue3!="undefined")
						STR+='<span class="bold"><?=Yii::t('trans','Beden')?>:</span><span>'+data.bottomvalue3+'</span>';
						
					if(typeof data.bottomvalue4!="undefined")
						STR+='<span class="bold"><?=Yii::t('trans','Numara')?>:</span><span>'+data.bottomvalue4+'</span>';
					
					if(typeof data.bottomvalue5!="undefined")
						STR+='<span class="bold"><?=Yii::t('trans','Ağırlık')?>:</span><span>'+data.bottomvalue5+'</span>';
						
					if(typeof data.bottomvalue6!="undefined")
						STR+='<span class="bold"><?=Yii::t('trans','Hacim')?>:</span><span>'+data.bottomvalue6+'</span>';
						
					if(typeof data.bottomvalue7!="undefined")
						STR+='<span class="bold"><?=Yii::t('trans','Derinlik')?>:</span><span>'+data.bottomvalue7+'</span>';
						
					
					STR+='</div><div class="value2"><?=Yii::t('trans','Toplam Stok Adet')?>: <span>'+data.stok+'</span></div><div class="value4"><span>'+data.warehouse+' ('+data.stok+') <img src="<?=Yii::app()->baseUrl?>/images/delete.png" onclick="javascript:productsdelete(this, '+data.warehousebottomstokID+')" /></span></div></div></td></tr>';
					$('.bottomitems').append(STR);
					alert("<?=Yii::t('trans','Başarılı bir şekilde eklendi.')?>");
				}else if(data.sonuc==0){
					alert("<?=Yii::t('trans','Bir Sorun Oluştu. Lütfen Sayfayı yenileyip tekrar deneyiniz.')?>");
				}else if(data.sonuc==2){
					alert("<?=Yii::t('trans','Bu stok daha önce eklenmiş.')?>");
				}else if(data.sonuc==3){
				
					$('.bottomitems').children('tbody').find('tr').each(function(index, element) {
						
						if($(this).children('td').attr('id')=='a'+data.id){
							$(this).children('td').children('.item').children('.value4').append('<span>, '+data.warehouse+' ('+data.stok+') <img src="<?=Yii::app()->baseUrl?>/images/delete.png" onclick="javascript:productsdelete(this, '+data.warehousebottomstokID+')" /></span>');
							$(this).children('td').children('.item').children('.value2').html("<?=Yii::t('trans','Toplam Stok Adet')?>: <span>"+data.stok+"</span>");
						}
						
                    });
					alert("<?=Yii::t('trans','Başarılı bir şekilde eklendi.')?>");
				}
				
			 }
			});
	}
}



function isNumber(evt)  
{  

  var charCode = (evt.which) ? evt.which : event.keyCode  
  if (charCode > 31 && (charCode < 48 || charCode > 57))  
   return false;  
  return true; 
   
}  


var bottom= new Array();	
$('#Productbottoms_productsType').change(function(){
	var ids=$(this).val();

	if(ids=="1" && typeof bottom["1"]== "undefined"){
		
		$('.bottomInput').children('.row:eq(0)').append('<div class="b1">'+$('#color').html()+'</div>');
		
		bottom["1"]=1;
	}else if(ids=="2" && typeof bottom["2"]== "undefined"){
		$('.bottomInput').children('.row:eq(0)').append('<div class="b2">'+$('#enboy').html()+'</div>');
		
		bottom["2"]=2;
	}else if(ids=="3" && typeof bottom["3"]== "undefined"){
		$('.bottomInput').children('.row:eq(0)').append('<div class="b3">'+$('#beden').html()+'</div>');
		
		bottom["3"]=3;
	}else if(ids=="4" && typeof bottom["4"]== "undefined"){
		$('.bottomInput').children('.row:eq(0)').append('<div class="b4">'+$('#numara').html()+'</div>');
		
		bottom["4"]=4;
	}else if(ids=="5" && typeof bottom["5"]== "undefined"){
		$('.bottomInput').children('.row:eq(0)').append('<div class="b5">'+$('#agirlik').html()+'</div>');
		
		bottom["5"]=5;
	}else if(ids=="6" && typeof bottom["6"]== "undefined"){
		$('.bottomInput').children('.row:eq(0)').append('<div class="b6">'+$('#hacim').html()+'</div>');
		
		bottom["6"]=6;
	}else if(ids=="7" && typeof bottom["7"]== "undefined"){
		$('.bottomInput').children('.row:eq(0)').append('<div class="b7">'+$('#derinlik').html()+'</div>');
		bottom["7"]=7;
	}
	
	if($('.bottomInput').children('.row:eq(1)').html()==""){
		$('.bottomInput').children('.row:eq(2)').html($('#warehouse').html());
		$('.bottomInput').children('.row:eq(1)').html($('#stok').html());
		$('.bottomInput').children('.row:eq(3)').html($('#button').html());
	}
});


function clearB(element,ids){
	delete bottom[ids];
	
	$('.bottomInput').children('.row:eq(0)').children('.b'+ids).remove();

}
</script>
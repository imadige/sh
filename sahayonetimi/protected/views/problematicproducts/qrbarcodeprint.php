

<style type="text/css" media="print">

a {
	display:none;
}

@page   
{  
	size: auto;   
	margin: 0mm;  
}  
body  
{  
	background-color:#FFFFFF;   
	border: solid 1px black ;  
	margin: 0px;  
} 
.print{
	display:none;
	
}
</style>

<style>
.print{
	position:absolute;
	left:400px;
	top:20px;
	font-size:11px;
}
input[type=text]{
	width:50px;
	height:25px;
	background:#CCE9F2;
	padding-left:10px;
}
#image{
	position:absolute;
}
</style>

<img id="image" src="<?=Yii::app()->createUrl("barcode/getqrbarcode")?>?size=<?=$param?>&number=S-<?=$model->problematicproductsID+ProblematicproductsController::getParams("problematicplus")?>&id=<?=$model->problematicproductsID?>_1" title="<?=Yii::t('trans','Barkod 130X50')?>">

<div class="print">

            <table>
                <tr>
                	<td><?=Yii::t('trans','Yukarı - Aşağı')?></td><td><input type="text" value="0"></td><td><input type="button" onClick="javascript:up(this)" value="<?=Yii::t('trans','Yukarı')?>"> <input type="button" onClick="javascript:down(this)" value="<?=Yii::t('trans','Aşağı')?>"></td>
                </tr>
                <tr>
                	<td><?=Yii::t('trans','Sol - Sağ')?></td><td><input type="text" value="0"></td><td><input type="button" onClick="javascript:left(this)" value="<?=Yii::t('trans','Sol')?>"> <input type="button" onClick="javascript:right(this)" value="<?=Yii::t('trans','Sağ')?>"></td>
                </tr>
                <tr>
                
                	<td width="10"></td>
                    <td onClick="javascript:prints()" style="cursor:pointer;"><img src="<?=Yii::app()->baseUrl?>/images/print.png" title="<?=Yii::t('trans','Yazdır')?>"  /> <?=Yii::t('trans','Yazdır')?></td>
                    
                </tr>
            </table>
        
</div>

<script>

	function up(element){
		 $( "#image" ).animate({
			
			top: "-=5",
			
			}, 1, function() {
			// Animation complete.
		});
		$(element).parent().prev('td').children('input').val($('#image').css('top'));
	}
	function down(element){
		 $( "#image" ).animate({
			
			top: "+=5",
			
			}, 1, function() {
			// Animation complete.
		});
		
		$(element).parent().prev('td').children('input').val($('#image').css('top'));
	}
	
	function left(element){
		 $( "#image" ).animate({
			
			left: "-=5",
			
			}, 1, function() {
			// Animation complete.
		});
		$(element).parent().prev('td').children('input').val($('#image').css('left'));
	}
	function right(element){
		 $( "#image" ).animate({
			
			left: "+=5",
			
			}, 1, function() {
			// Animation complete.
		});
		
		$(element).parent().prev('td').children('input').val($('#image').css('left'));
	}

	function prints(){
		window.print();
	}
</script>
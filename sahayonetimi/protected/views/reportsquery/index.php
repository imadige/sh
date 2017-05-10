<?PHP

$this->breadcrumbs=array(
	Yii::t('trans','Sorgulamalar')=>array('index'),
	Yii::t('trans','Genel'),
);

?>
<style>
.span-19{
	width:90%;
}
.basket{
	display:none;
}

</style>

<div class="customerSalesmoneyreceived">
	<div class="titles"><img src="<?=Yii::app()->baseUrl?>/images/plus.png" /> <?=Yii::t('trans','Müşteri')?></div>
 	
    <div class="click_slide">
	    <table>
	    <tr>
	    	<td>
	      <?=Yii::t('trans','Müşteri')?> : 
	      </td>
	      <td>
	      
 		  <?PHP CHtml::hiddenField("musteri");?>
	      <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'name',
				'id'=>'name',
				'options' => array(
	                'showAnim' => 'fold',
	                //remove if you dont need to store the id, like i do...
	                'select' => 'js:function(event, ui){ 
					
						itemadd(ui.item.id,ui.item.label,1);
						$(this).val("");
						return false;
					}'
	            ),

				'source'=>$this->createUrl('customers/getcustomer'),
				'htmlOptions'=>array(
					'size'=>'50'
				),
			)); 
			?>
			</td>

			<td>
				<?=Yii::t('trans','Tarih')?> :
			</td>
			<td>
				  <?php echo CHtml::dropDownList('reportsdate1', null,ReportsqueryController::getParams("reportsdate2")); ?>
			
			</td>

			<td>
				<?=Yii::t('trans','Rapor')?> :
			</td>
			<td>
				  <?php echo CHtml::dropDownList('raporlama1',  null,ReportsqueryController::getParams("raporlamaQuery1")); ?>
			
			</td>
		  </tr>
		</table>

		<div class="queryX" id="queryX1">
			<?PHP 
	       echo CHtml::hiddenField("customers1");
 		   echo CHtml::hiddenField("dates1");
 		   echo CHtml::hiddenField("reports1");
 		   ?>
			<div class="button">
				 <?php $this->widget('bootstrap.widgets.TbButton', array(
		            'buttonType'=>'submit',
		           	 'type'=>'primary',
					 'size' => 'small',
		            'label'=>Yii::t('trans','Raporla'),
					'htmlOptions'=>array(
						'onclick'=>'raporla1()'
					),
		        	)); ?>
        		</div>
			<div class="item">
				<?=Yii::t('trans','[Musteri] [Tarih] ne kadar [Rapor] yaptı.',array(
					"[Musteri]"=>'<font color="#f00" class="qucustomers">'.Yii::t('trans','[Müşteri]').'</font>',
					"[Tarih]"=>'<font color="#f00" class="qudates">'.Yii::t('trans','[Tarih]').'</font>',
					"[Rapor]"=>'<font color="#f00" class="qureport">'.Yii::t('trans','[Rapor]').'</font>')
				)?>

				
			</div>
			<div class="qu" id="qu1">
				<div class="close" onclick="closeB(this)"><img src="<?=Yii::app()->baseUrl?>/images/close.png"></div>
					<div class="te"></div>
				</div>

			<div class="button">
				 <?php $this->widget('bootstrap.widgets.TbButton', array(
		            'buttonType'=>'submit',
		           	 'type'=>'primary',
					 'size' => 'small',
		            'label'=>Yii::t('trans','Raporla'),
					'htmlOptions'=>array(
						'onclick'=>'raporla2()'
					),
		        	)); 


		        	?>
        		</div>
			<div class="item">
				<?=Yii::t('trans','[Musteri] [Tarih] yapılan satışları?',array(
					"[Musteri]"=>'<font color="#f00" class="qucustomers">'.Yii::t('trans','[Müşteri]').'</font>',
					"[Tarih]"=>'<font color="#f00" class="qudates">'.Yii::t('trans','[Tarih]').'</font>',
					))
				?>

				
			</div>

			<div class="qu" id="qu2">
				<div class="close" onclick="closeB(this)"><img src="<?=Yii::app()->baseUrl?>/images/close.png"></div>
				<div class="te"></div>
				
			</div>
		</div>
    </div>


    <div class="titles"><img src="<?=Yii::app()->baseUrl?>/images/plus.png" /> <?=Yii::t('trans','Bayi')?></div>
 	
    <div class="click_slide">
	    <table>
	    <tr>
	    	<td>
	      <?=Yii::t('trans','Bayi')?> : 
	      </td>
	      <td>
	      
 		  <?PHP CHtml::hiddenField("Bayi");?>
	      <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'name2',
				'id'=>'name2',
				'options' => array(
	                'showAnim' => 'fold',
	                //remove if you dont need to store the id, like i do...
	                'select' => 'js:function(event, ui){ 
					
						itemadd2(ui.item.id,ui.item.label,1);
						$(this).val("");
						return false;
					}'
	            ),

				'source'=>$this->createUrl('dealers/getdealer'),
				'htmlOptions'=>array(
					'size'=>'50'
				),
			)); 
			?>
			</td>

			<td>
				<?=Yii::t('trans','Tarih')?> :
			</td>
			<td>
				  <?php echo CHtml::dropDownList('reportsdate2', null,ReportsqueryController::getParams("reportsdate2")); ?>
			
			</td>

			<td>
				<?=Yii::t('trans','Rapor')?> :
			</td>
			<td>
				  <?php echo CHtml::dropDownList('raporlama2',  null,ReportsqueryController::getParams("raporlamaQuery1")); ?>
			
			</td>
		  </tr>
		</table>

		<div class="queryX" id="queryX2">
			<?PHP 
	       echo CHtml::hiddenField("bayi2");
 		   echo CHtml::hiddenField("dates2");
 		   echo CHtml::hiddenField("reports2");
 		   ?>
			<div class="button">
				 <?php $this->widget('bootstrap.widgets.TbButton', array(
		            'buttonType'=>'submit',
		           	 'type'=>'primary',
					 'size' => 'small',
		            'label'=>Yii::t('trans','Raporla'),
					'htmlOptions'=>array(
						'onclick'=>'raporla3()'
					),
		        	)); ?>
        		</div>
			<div class="item">
				<?=Yii::t('trans','[Bayi] [Tarih] ne kadar [Rapor] yaptı.',array(
					"[Bayi]"=>'<font color="#f00" class="qubayi2">'.Yii::t('trans','[Bayi]').'</font>',
					"[Tarih]"=>'<font color="#f00" class="qudates2">'.Yii::t('trans','[Tarih]').'</font>',
					"[Rapor]"=>'<font color="#f00" class="qureport2">'.Yii::t('trans','[Rapor]').'</font>')
				)?>

				
			</div>
			<div class="qu" id="qu3">
				<div class="close" onclick="closeB(this)"><img src="<?=Yii::app()->baseUrl?>/images/close.png"></div>
					<div class="te"></div>
				</div>

			<div class="button">
				 <?php $this->widget('bootstrap.widgets.TbButton', array(
		            'buttonType'=>'submit',
		           	 'type'=>'primary',
					 'size' => 'small',
		            'label'=>Yii::t('trans','Raporla'),
					'htmlOptions'=>array(
						'onclick'=>'raporla4()'
					),
		        	)); 


		        	?>
        		</div>
			<div class="item">
				<?=Yii::t('trans','[Bayi] [Tarih] yapılan satışları?',array(
					"[Bayi]"=>'<font color="#f00" class="qubayi2">'.Yii::t('trans','[Bayi]').'</font>',
					"[Tarih]"=>'<font color="#f00" class="qudates2">'.Yii::t('trans','[Tarih]').'</font>',
					))
				?>

				
			</div>

			<div class="qu" id="qu4">
				<div class="close" onclick="closeB(this)"><img src="<?=Yii::app()->baseUrl?>/images/close.png"></div>
				<div class="te"></div>
				
			</div>
		</div>
    </div>


     <div class="titles"><img src="<?=Yii::app()->baseUrl?>/images/plus.png" /> <?=Yii::t('trans','Kullanıcı')?></div>
 	
    <div class="click_slide">
	    <table>
	    <tr>
	    	<td>
	      <?=Yii::t('trans','Kullanıcı')?> : 
	      </td>
	      <td>
	      
 		  <?PHP CHtml::hiddenField("Bayi");?>
	      <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'name3',
				'id'=>'name3',
				'options' => array(
	                'showAnim' => 'fold',
	                //remove if you dont need to store the id, like i do...
	                'select' => 'js:function(event, ui){ 
					
						itemadd3(ui.item.id,ui.item.label,1);
						$(this).val("");
						return false;
					}'
	            ),

				'source'=>$this->createUrl('employees/getemployees'),
				'htmlOptions'=>array(
					'size'=>'50'
				),
			)); 
			?>
			</td>

			<td>
				<?=Yii::t('trans','Tarih')?> :
			</td>
			<td>
				  <?php echo CHtml::dropDownList('reportsdate3', null,ReportsqueryController::getParams("reportsdate2")); ?>
			
			</td>

			<td>
				<?=Yii::t('trans','Rapor')?> :
			</td>
			<td>
				  <?php echo CHtml::dropDownList('raporlama3',  null,ReportsqueryController::getParams("raporlamaQuery1")); ?>
			
			</td>
		  </tr>
		</table>

		<div class="queryX" id="queryX2">
			<?PHP 
	       echo CHtml::hiddenField("employees3");
 		   echo CHtml::hiddenField("dates3");
 		   echo CHtml::hiddenField("reports3");
 		   ?>
			<div class="button">
				 <?php $this->widget('bootstrap.widgets.TbButton', array(
		            'buttonType'=>'submit',
		           	 'type'=>'primary',
					 'size' => 'small',
		            'label'=>Yii::t('trans','Raporla'),
					'htmlOptions'=>array(
						'onclick'=>'raporla5()'
					),
		        	)); ?>
        		</div>
			<div class="item">
				<?=Yii::t('trans','[Kullanıcı] [Tarih] ne kadar [Rapor] yaptı.',array(
					"[Kullanıcı]"=>'<font color="#f00" class="quemployees3">'.Yii::t('trans','[Kullanıcı]').'</font>',
					"[Tarih]"=>'<font color="#f00" class="qudates3">'.Yii::t('trans','[Tarih]').'</font>',
					"[Rapor]"=>'<font color="#f00" class="qureport3">'.Yii::t('trans','[Rapor]').'</font>')
				)?>

				
			</div>
			<div class="qu" id="qu5">
				<div class="close" onclick="closeB(this)"><img src="<?=Yii::app()->baseUrl?>/images/close.png"></div>
					<div class="te"></div>
				</div>

			<div class="button">
				 <?php $this->widget('bootstrap.widgets.TbButton', array(
		            'buttonType'=>'submit',
		           	 'type'=>'primary',
					 'size' => 'small',
		            'label'=>Yii::t('trans','Raporla'),
					'htmlOptions'=>array(
						'onclick'=>'raporla6()'
					),
		        	)); 


		        	?>
        		</div>
			<div class="item">
				<?=Yii::t('trans','[Kullanıcı] [Tarih] yapılan satışları?',array(
					"[Kullanıcı]"=>'<font color="#f00" class="quemployees3">'.Yii::t('trans','[Kullanıcı]').'</font>',
					"[Tarih]"=>'<font color="#f00" class="qudates3">'.Yii::t('trans','[Tarih]').'</font>',
					))
				?>

				
			</div>

			<div class="qu" id="qu6">
				<div class="close" onclick="closeB(this)"><img src="<?=Yii::app()->baseUrl?>/images/close.png"></div>
				<div class="te"></div>
				
			</div>
		</div>
    </div>

     <div class="titles"><img src="<?=Yii::app()->baseUrl?>/images/plus.png" /> <?=Yii::t('trans','Ürünler')?></div>
 	
    <div class="click_slide" id="odemelertab">

    </div>

     <div class="titles"><img src="<?=Yii::app()->baseUrl?>/images/plus.png" /> <?=Yii::t('trans','Sorunlu Ürünler')?></div>
 	
    <div class="click_slide" id="odemelertab">

    </div>
</div>

<script>

function closeB(element){
	$(element).parent().fadeOut();

}

$('.titles').click(function(){
	if($(this).next('.click_slide').css('display')=='none'){
		$(this).next('.click_slide').slideDown();
		$(this).children('img').attr('src','<?=Yii::app()->baseUrl?>/images/noplus.png');
	}else{
		$(this).next('.click_slide').slideUp();
		$(this).children('img').attr('src','<?=Yii::app()->baseUrl?>/images/plus.png');
	}
});

function itemadd(id,label,ids){
	$('#customers1').val(id);
	
	$('.qucustomers').html("["+label+"]");
	$('.qucustomers').css("color","#10770A");

}
$('#reportsdate1').change(function(){
	if($(this).val()!=""){
		$('#dates1').val($(this).val());

		$('.qudates').html("["+$('#reportsdate1 option:selected').text()+"]");
		$('.qudates').css("color","#10770A");
	}else{

		$('#dates1').val();
		$('.qudates').html("[Tarih]");
		$('.qudates').css("color","#f00");

	}
});

$('#raporlama1').change(function(){
	if($(this).val()!=""){

		$('#reports1').val($(this).val());

		$('.qureport').html("["+$('#raporlama1 option:selected').text()+"]");
		$('.qureport').css("color","#10770A");
	}else{

		$('#dates1').val();
		$('.qureport').html("[Rapor]");
		$('.qureport').css("color","#f00");

	}
});

function raporla1(){

	if($('#customers1').val()==""){
		alert('<?=Yii::t('trans','Müşteri alanını boş bırakmayınız.')?>');

		
	}else if($('#dates1').val()==""){
		alert('<?=Yii::t('trans','Tarih alanını boş bırakmayınız.')?>');

		
	}else if($('#reports1').val()==""){
		alert('<?=Yii::t('trans','Rapor alanını boş bırakmayınız.')?>');

		
	}else{
		var dataString='id='+$('#customers1').val()+'&dates='+$('#dates1').val()+'&reports='+$('#reports1').val()+'&cdtype=1';
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("reportsquery/report1")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				
				
			 	$('#qu1').children(".te").html(data.sonuc);
			 
			 	$('#qu1').slideDown();
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	alert('<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>');

			 }
			 
			});
	}
}


function raporla2(){

	if($('#customers1').val()==""){
		alert('<?=Yii::t('trans','Müşteri alanını boş bırakmayınız.')?>');

	
	}else if($('#dates1').val()==""){
		alert('<?=Yii::t('trans','Tarih alanını boş bırakmayınız.')?>');

		
	}else{
		var dataString='id='+$('#customers1').val()+'&cdtype=1'+'&dates='+$('#dates1').val();
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("reportsquery/report2")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				
				
			 	$('#qu2').children(".te").html(data.sonuc);
			 
			 	$('#qu2').slideDown();
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	alert('<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>');

			 }
			 
			});
	}
}



//************************************************2222222222*****************************************************************************************************/////////////


function itemadd2(id,label,ids){
	$('#bayi2').val(id);
	
	$('.qubayi2').html("["+label+"]");
	$('.qubayi2').css("color","#10770A");

}
$('#reportsdate2').change(function(){
	if($(this).val()!=""){
		$('#dates2').val($(this).val());

		$('.qudates2').html("["+$('#reportsdate2 option:selected').text()+"]");
		$('.qudates2').css("color","#10770A");
	}else{

		$('#dates2').val();
		$('.qudates2').html("[Tarih]");
		$('.qudates2').css("color","#f00");

	}
});

$('#raporlama2').change(function(){
	if($(this).val()!=""){

		$('#reports2').val($(this).val());

		$('.qureport2').html("["+$('#raporlama2 option:selected').text()+"]");
		$('.qureport2').css("color","#10770A");
	}else{

		$('#dates2').val();
		$('.qureport2').html("[Rapor]");
		$('.qureport2').css("color","#f00");

	}
});

function raporla3(){

	if($('#bayi2').val()==""){
		alert('<?=Yii::t('trans','Bayi alanını boş bırakmayınız.')?>');

		
	}else if($('#dates2').val()==""){
		alert('<?=Yii::t('trans','Tarih alanını boş bırakmayınız.')?>');

		
	}else if($('#reports2').val()==""){
		alert('<?=Yii::t('trans','Rapor alanını boş bırakmayınız.')?>');

		
	}else{
		var dataString='id='+$('#bayi2').val()+'&dates='+$('#dates2').val()+'&reports='+$('#reports2').val()+'&cdtype=2';
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("reportsquery/report1")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				
				
			 	$('#qu3').children(".te").html(data.sonuc);
			 
			 	$('#qu3').slideDown();
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	alert('<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>');

			 }
			 
			});
	}
}


function raporla4(){

	if($('#bayi2').val()==""){
		alert('<?=Yii::t('trans','Bayi alanını boş bırakmayınız.')?>');

	
	}else if($('#dates2').val()==""){
		alert('<?=Yii::t('trans','Tarih alanını boş bırakmayınız.')?>');

		
	}else{
		var dataString='id='+$('#bayi2').val()+'&cdtype=2'+'&dates='+$('#dates2').val();
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("reportsquery/report2")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				
				
			 	$('#qu4').children(".te").html(data.sonuc);
			 
			 	$('#qu4').slideDown();
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	alert('<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>');

			 }
			 
			});
	}
}



//************************************************33333*****************************************************************************************************/////////////


function itemadd3(id,label,ids){
	$('#employees3').val(id);
	
	$('.quemployees3').html("["+label+"]");
	$('.quemployees3').css("color","#10770A");

}
$('#reportsdate3').change(function(){
	if($(this).val()!=""){
		$('#dates3').val($(this).val());

		$('.qudates3').html("["+$('#reportsdate3 option:selected').text()+"]");
		$('.qudates3').css("color","#10770A");
	}else{

		$('#dates3').val();
		$('.qudates3').html("[Tarih]");
		$('.qudates3').css("color","#f00");

	}
});

$('#raporlama3').change(function(){
	if($(this).val()!=""){

		$('#reports3').val($(this).val());

		$('.qureport3').html("["+$('#raporlama3 option:selected').text()+"]");
		$('.qureport3').css("color","#10770A");
	}else{

		$('#dates2').val();
		$('.qureport2').html("[Rapor]");
		$('.qureport2').css("color","#f00");

	}
});

function raporla5(){

	if($('#employees3').val()==""){
		alert('<?=Yii::t('trans','Kullanıcı alanını boş bırakmayınız.')?>');

		
	}else if($('#dates3').val()==""){
		alert('<?=Yii::t('trans','Tarih alanını boş bırakmayınız.')?>');

		
	}else if($('#reports3').val()==""){
		alert('<?=Yii::t('trans','Rapor alanını boş bırakmayınız.')?>');

		
	}else{
		var dataString='id='+$('#employees3').val()+'&dates='+$('#dates3').val()+'&reports='+$('#reports3').val();
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("reportsquery/report3")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				
				
			 	$('#qu5').children(".te").html(data.sonuc);
			 
			 	$('#qu5').slideDown();
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	alert('<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>');

			 }
			 
			});
	}
}


function raporla6(){

	if($('#employees3').val()==""){
		alert('<?=Yii::t('trans','Kullanıcı alanını boş bırakmayınız.')?>');

	
	}else if($('#dates3').val()==""){
		alert('<?=Yii::t('trans','Tarih alanını boş bırakmayınız.')?>');

		
	}else{
		var dataString='id='+$('#employees3').val()+'&dates='+$('#dates3').val();
			$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("reportsquery/report4")?>", 
			 data: dataString,
			 timeout: 5000,
			 success: function(data)
			 {
				
				
			 	$('#qu6').children(".te").html(data.sonuc);
			 
			 	$('#qu6').slideDown();
			 },error: function (xhr, ajaxOptions, thrownError) {
				 	alert('<?=Yii::t('trans','Hata oluştu. Tekrar deneyiniz.')?>');

			 }
			 
			});
	}
}
</script>

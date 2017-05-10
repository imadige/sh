<?PHP
$this->breadcrumbs=array(
	Yii::t('trans','Ürünler')=>array('admin'),
	Yii::t('trans','XML'),
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
.span-19{
	width:95%;
}
</style>

<div class="form">



<?php
 if($kontrol==false){
 $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'products-form',
	'enableAjaxValidation'=>false,

)); ?>
   <div style="margin-bottom:10px;">
   		<?=Yii::t('trans','Xml yolunu belirtiniz.')?><br />
        <?=Yii::t('trans','Örnek')?>: <?=Yii::t('trans','http://www.domain.com/xml')?>
   </div>
   
    <div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url'); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>
   
	
    <div class="row buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'large',
            'label'=>Yii::t('trans','Yükle'),
        	)); ?>
	</div>
<?php $this->endWidget(); 


 }else{
	 
	$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>$success_, 'closeText'=>'&times;'), // success, info, warning, error or danger
			'error'=>array('block'=>true, 'fade'=>$error_, 'closeText'=>'&times;'), // success, info, warning, error or danger
			
        ),
    )); 
	
	 if(@$getRss  = simplexml_load_file($model->url)){
		?>
      <div style="margin-top:20px;">
      
        <div class="xmlexcelcolor clearfix">
   			<div class="items"><div class="color w3"></div><?=Yii::t('trans','Yüklenebilir')?></div>
            <div class="items"><div class="color w2"></div><?=Yii::t('trans','Hatalı')?></div>
            <div class="items"><div class="color w1"></div><?=Yii::t('trans','Kayıtlı')?></div>
   		</div>
        <table class="excelTable" style="margin-top:20px;">
            <tr class="title">
                <td width="30px"></td>
                <td width="30%"><?=Yii::t('trans','Ürün tam adı')?></td>
                <td><?=Yii::t('trans','Marka adı')?></td>
                <td><?=Yii::t('trans','Model adı')?></td>
                <td><?=Yii::t('trans','Alış Fiyatı')?></td>
                <td><?=Yii::t('trans','Satış Fiyatı')?></td>
                <td><?=Yii::t('trans','İndirimli Fiyatı')?></td>
                <td><?=Yii::t('trans','Bayi Fiyatı')?></td>
                <td><?=Yii::t('trans','Ürün Grubu')?></td>
            </tr>
            
            <tr>
                <td style="padding:10px"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?PHP
		
					
			$xmlItemCount = count($getRss->item);
			
			$check=array(
				"0"=>true,
				"1"=>true,
				"2"=>true,
				"3"=>true,
				"4"=>true,
				"5"=>true,
				"6"=>true,
				"7"=>true,
			);
			
			$error=0;
			$warning=0;
			
			$count=0;
			
			if($xmlItemCount-$rows>29)
				$max=$rows+30;
			else
				$max=$xmlItemCount;
				
			for ($row = $rows; $row < $max; $row++) {
				$count++;
				$renk="green";
				
				$items[0]  = $getRss->item[$row]->name;
				$items[1]  = $getRss->item[$row]->brand;
				$items[2]  = $getRss->item[$row]->model;
				$items[3]  = $getRss->item[$row]->purchaseprice;
				$items[4]  = $getRss->item[$row]->saleprice;
				$items[5]  = $getRss->item[$row]->reducedprice;
				$items[6]  = $getRss->item[$row]->dealerprice;
				$items[7]  = $getRss->item[$row]->group;	
				
				if($items[0]==""){
					 $renk="red";
					 $check[0]=false;
				}
			
				if($items[1] ==""){
					 $renk="red";
					 $check[1]=false;
				}
					 
				if($items[2] ==""){
					 $renk="red";
					  $check[2]=false;
				}
				
				if($items[3] ==""){
					 $renk="red";
					  $check[3]=false;
				}
				
				if($items[4] ==""){
					 $renk="red";
					 $check[4]=false;
				}
				
					 
				if($items[7] ==""){
					 $renk="red";
					 $check[7]=false;
				}
				
				
				if($items[3] !=""){
					$value=$items[3] ;
					$value=explode(" ",$value);
					
					if(@ProductsController::getParams_("currencyValue",$value[1])){
						
					}else{
						$renk="red";
						$check[3]=false;
					}
						
					
				}
				
				if($items[4] !=""){
					$value=$items[4] ;
					$value=explode(" ",$value);
					
					if(@ProductsController::getParams_("currencyValue",$value[1])){
						
					}else{
						$renk="red";
						$check[4]=false;
					}
					
					
				}
				
				if($items[5] !=""){
					$value=$items[5] ;
					$value=explode(" ",$value);
					
					
						if(@ProductsController::getParams_("currencyValue",$value[1])){
							
						}else{
							$renk="red";
							$check[5]=false;
						}
					
						
					
				}
				
				if($items[6] !=""){
					$value=$items[6] ;
					$value=explode(" ",$value);
					
					
						if(@ProductsController::getParams_("currencyValue",$value[1])){
							
						}else{
							$renk="red";
							$check[5]=false;
						}
					
					
				}
				
				
				
				if($items[0]!=""){
					if(strlen($items[0])>75){
						$renk="red";
						$check[0]=false;
					}
				}
				
				if($items[1] !=""){
					if(strlen($items[1] )>30){
						$renk="red";
						$check[1]=false;
					}
				}
				
				if($items[2] !=""){
					if(strlen($items[2] )>30){
						$renk="red";
						$check[2]=false;
					}
				}
				
				if($items[7] !=""){
					if(!ProductsController::getProductgroupsCheck($items[7] )){
						$renk="red";
						$check[7]=false;
					}
				}
				
				
				if($items[0]!=""){
					if(ProductsController::getProductNameCheck($items[0])){
						$renk="yellow";
						$warning++;
					}
					
				}
				
				
				
				
				if($renk=="red")
					$error++;
				echo '<tr class="items '.$renk.'">';
				echo '<td style="font-weight:700">'.($row+1).')</td>';
				foreach($items as $key=>$value){
					if($check[$key]==true)
						$images=Yii::app()->baseUrl."/images/check.png";
					else
						$images=Yii::app()->baseUrl."/images/notcheck.png";
					
					if($renk=="red")
						echo "<td>". $value.' <img src="'.$images.'" /></td>';
					else
						echo "<td>". $value.'</td>';
				
				}
				echo "</tr>";
				
							
			}
			
			echo "</table>";	
	
 
  ?>
	 
   </div> 
	 <div style="margin-bottom:10px;">
     <table class="excelRe">
     	<tr>
            <td class="bold"><?=Yii::t('trans','Hatalı Veri Sayısı')?>:</td>
            <td><?=$error?></td>
            <td class="bold"><?=Yii::t('trans','Kayıtlı Veri Sayısı')?>:</td>
            <td ><?=$warning?></td>
            <td class="bold"><?=Yii::t('trans','Yüklenebilir Veri Sayısı')?>:</td>
            <td><?=$count-$error-$warning?></td>
        </tr>
     </table> 
     </div>
     
     <div class="row buttons">
		<?php 
		
		if($rows>=30){
				$array2=array(
					'rows'=>$rows-30,
					'url'=>$model->url,
				);
			
			
			$this->widget('bootstrap.widgets.TbButton', array(
				  
					 'type'=>'primary',
					 'size' => 'small',
					 'buttonType' => 'link',
					 'url'=>Yii::app()->createUrl("products/xmlreaderadd")."?data=".json_encode($array2),
					 
					'label'=>Yii::t('trans','Geri'),
				)); 
			}
		if($count-$error-$warning>0){
			
			
			$array=array(
				'rows'=>$rows,
				'url'=>$model->url,
			);
			$this->widget('bootstrap.widgets.TbButton', array(
			  
				'type'=>'primary',
				 'size' => 'small',
				 'buttonType' => 'link',
				 'url'=>Yii::app()->createUrl("products/xmldatadb")."?data=".json_encode($array),
				 'htmlOptions'=>array('style'=>'margin-left:20px'),
				'label'=>Yii::t('trans','Verileri Aktar'),
			)); 
			
			
			
			
			if($error>0){
				$this->widget('bootstrap.widgets.TbButton', array(
				  
					 'type'=>'primary',
					 'size' => 'small',
					 'buttonType' => 'link',
					 'url'=>Yii::app()->createUrl("products/xmlreaderadd"),
					 'htmlOptions'=>array('style'=>'margin-left:20px'),
					'label'=>Yii::t('trans','XML Yükleme Sayfasına Git'),
				)); 
			}
		}else{
			$this->widget('bootstrap.widgets.TbButton', array(
				 'type'=>'primary',
				 'size' => 'small',
				 'buttonType' => 'link',
				 'url'=>Yii::app()->createUrl("products/xmlreaderadd"),
				 'htmlOptions'=>array('style'=>'margin-left:20px'),
				'label'=>Yii::t('trans','Hatalı Veri XML Yükleme Sayfasına Geri Dön'),
			)); 
			
			
		}
		
		if($xmlItemCount-$rows>=30){
			$array2=array(
				'rows'=>$rows+30,
				'url'=>$model->url,
			);
			
			$this->widget('bootstrap.widgets.TbButton', array(
				  
					 'type'=>'primary',
					 'size' => 'small',
					 'buttonType' => 'link',
					 'url'=>Yii::app()->createUrl("products/xmlreaderadd")."?data=".json_encode($array2),
					 'htmlOptions'=>array('style'=>'margin-left:20px'),
					'label'=>Yii::t('trans','İleri'),
				)); 
				
		}
		?>
	</div>
<?PHP 
	 }else{
	?>
    
    <?=Yii::t('trans','XML yolunun doğru olduguna emin olun.')?>
    <?PHP	 
	 }
}?>
</div>
<?PHP
$this->breadcrumbs=array(
	Yii::t('trans','Ürünler')=>array('admin'),
	Yii::t('trans','EXCEL'),
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



	<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>$success_, 'closeText'=>'&times;'), // success, info, warning, error or danger
			'error'=>array('block'=>true, 'fade'=>$error_, 'closeText'=>'&times;'), // success, info, warning, error or danger
			
        ),
    )); 
	
	
	?>
    
   <div style="margin-bottom:10px;">
   
   		<div class="xmlexcelcolor clearfix">
   			<div class="items"><div class="color w3"></div><?=Yii::t('trans','Yüklenebilir')?></div>
            <div class="items"><div class="color w2"></div><?=Yii::t('trans','Hatalı')?></div>
            <div class="items"><div class="color w1"></div><?=Yii::t('trans','Kayıtlı')?></div>
   		</div>
            <table class="excelTable">
                <tr class="title">
                	<td width="30px"></td>
                	<td width="20%"><?=Yii::t('trans','Ürün tam adı')?></td>
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
			
			
			for($row = $rows; $row <= $highestRow; $row++)
     	    {
				$renk="green";
				
				if($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()==""){
					 $renk="red";
					 $check[0]=false;
				}
			
				if($objWorksheet->getCellByColumnAndRow(1, $row)->getValue()==""){
					 $renk="red";
					 $check[1]=false;
				}
					 
				if($objWorksheet->getCellByColumnAndRow(2, $row)->getValue()==""){
					 $renk="red";
					  $check[2]=false;
				}
				
				if($objWorksheet->getCellByColumnAndRow(3, $row)->getValue()==""){
					 $renk="red";
					  $check[3]=false;
				}
				
				if($objWorksheet->getCellByColumnAndRow(4, $row)->getValue()==""){
					 $renk="red";
					 $check[4]=false;
				}
				
					
				
				if($objWorksheet->getCellByColumnAndRow(7, $row)->getValue()==""){
					 $renk="red";
					 $check[7]=false;
				}
				
				
				if($objWorksheet->getCellByColumnAndRow(3, $row)->getValue()!=""){
					$value=$objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
					$value=explode(" ",$value);
					
					if(@ProductsController::getParams_("currencyValue",$value[1])){
						
					}else{
						$renk="red";
						$check[3]=false;
					}
						
					
				}
				
				if($objWorksheet->getCellByColumnAndRow(4, $row)->getValue()!=""){
					$value=$objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
					$value=explode(" ",$value);
					
					if(@ProductsController::getParams_("currencyValue",$value[1])){
						
					}else{
						$renk="red";
						$check[4]=false;
					}
					
					
				}
				
				if($objWorksheet->getCellByColumnAndRow(5, $row)->getValue()!=""){
					$value=$objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
					$value=explode(" ",$value);
					
					
						if(@ProductsController::getParams_("currencyValue",$value[1])){
							
						}else{
							$renk="red";
							$check[5]=false;
						}
					
						
					
				}
				
				
				if($objWorksheet->getCellByColumnAndRow(6, $row)->getValue()!=""){
					$value=$objWorksheet->getCellByColumnAndRow(6, $row)->getValue();
					$value=explode(" ",$value);
					
					
						if(@ProductsController::getParams_("currencyValue",$value[1])){
							
						}else{
							$renk="red";
							$check[6]=false;
						}
					
						
					
				}
				
				
				if($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()!=""){
					if(strlen($objWorksheet->getCellByColumnAndRow(0, $row)->getValue())>75){
						$renk="red";
						$check[0]=false;
					}
				}
				
				if($objWorksheet->getCellByColumnAndRow(1, $row)->getValue()!=""){
					if(strlen($objWorksheet->getCellByColumnAndRow(1, $row)->getValue())>30){
						$renk="red";
						$check[1]=false;
					}
				}
				
				if($objWorksheet->getCellByColumnAndRow(2, $row)->getValue()!=""){
					if(strlen($objWorksheet->getCellByColumnAndRow(2, $row)->getValue())>30){
						$renk="red";
						$check[2]=false;
					}
				}
				
				if($objWorksheet->getCellByColumnAndRow(7, $row)->getValue()!=""){
					if(!ProductsController::getProductgroupsCheck($objWorksheet->getCellByColumnAndRow(7, $row)->getValue())){
						$renk="red";
						$check[7]=false;
					}
				}
				
				
				if($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()!=""){
					if(ProductsController::getProductNameCheck($objWorksheet->getCellByColumnAndRow(0, $row)->getValue())){
						$renk="yellow";
						$warning++;
					}
					
				}
				
				
				
				
				if($renk=="red")
					$error++;
				
				
				echo '<tr class="items '.$renk.'">';
				echo '<td style="font-weight:700">'.$row.')</td>';
				for ($col = 0; $col <= 7; ++$col)
      			{
					if($check[$col]==true)
						$images=Yii::app()->baseUrl."/images/check.png";
					else
						$images=Yii::app()->baseUrl."/images/notcheck.png";
					
					if($renk=="red")
						echo "<td>". $objWorksheet->getCellByColumnAndRow($col, $row)->getValue().' <img src="'.$images.'" /></td>';
					else
						echo "<td>". $objWorksheet->getCellByColumnAndRow($col, $row)->getValue().'</td>';
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
            <td><?=$highestRow-$error-$warning?></td>
        </tr>
     </table> 
     </div>
     

     
    <div class="row buttons">
		<?php 
		
		if($rows>=30){
				$array2=array(
					'rows'=>$rows-30,
					
				);
			
			
			$this->widget('bootstrap.widgets.TbButton', array(
				  
					 'type'=>'primary',
					 'size' => 'small',
					 'buttonType' => 'link',
					 'url'=>Yii::app()->createUrl("products/excelreaderlist")."?data=".json_encode($array2),
					 
					'label'=>Yii::t('trans','Geri'),
				)); 
		}
			
		if($highestRow-$error-$warning>0){
			$this->widget('bootstrap.widgets.TbButton', array(
			  
				'type'=>'primary',
				 'size' => 'small',
				 'buttonType' => 'link',
				 'url'=>Yii::app()->createUrl("products/exceldatadb")."/".$rows,
				  'htmlOptions'=>array('style'=>'margin-left:20px'),
				'label'=>Yii::t('trans','Verileri Aktar'),
			)); 
			
			if($error>0){
				$this->widget('bootstrap.widgets.TbButton', array(
				  
					 'type'=>'primary',
					 'size' => 'small',
					 'buttonType' => 'link',
					 'url'=>Yii::app()->createUrl("products/excelreaderadd"),
					 'htmlOptions'=>array('style'=>'margin-left:20px'),
					'label'=>Yii::t('trans','Excel Yükleme Sayfasına Git'),
				)); 
			}
		}else{
			$this->widget('bootstrap.widgets.TbButton', array(
				 'type'=>'primary',
				 'size' => 'small',
				 'buttonType' => 'link',
				 'url'=>Yii::app()->createUrl("products/excelreaderadd"),
				  'htmlOptions'=>array('style'=>'margin-left:20px'),
				'label'=>Yii::t('trans','Hatalı Veri Excel Yükleme Sayfasına Geri Dön'),
			)); 
			
			
		}
		
		
		if($highestRow2-$rows>0){
		$array2=array(
			'rows'=>$rows+30,
		);
		
		$this->widget('bootstrap.widgets.TbButton', array(
			  
				 'type'=>'primary',
				 'size' => 'small',
				 'buttonType' => 'link',
				 'url'=>Yii::app()->createUrl("products/excelreaderlist")."?data=".json_encode($array2),
				 'htmlOptions'=>array('style'=>'margin-left:20px'),
				'label'=>Yii::t('trans','İleri'),
			)); 
				
		}
		?>
	</div>


</div>
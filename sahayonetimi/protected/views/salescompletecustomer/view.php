<?php


if($model->cdtype==1){
	$this->breadcrumbs=array(
		Yii::t('trans','Satış Takip ve Fatura - Müşteri Satışlar')=>array('customer'),
		Yii::t('trans','Muhasebe')
	);
	
	$this->menu=array(

	array('label'=>Yii::t('trans','Müşteri Satışlar'), 'url'=>array('customer')),
	);
}elseif($model->cdtype==2){
	$this->breadcrumbs=array(
		Yii::t('trans','Satışlar Muhasebe ve Takip - Bayi Satışlar')=>array('dealer'),
	);
	
	$this->menu=array(

	array('label'=>Yii::t('trans','Bayi Satışlar'), 'url'=>array('dealer')),
	);
}


?>

	<h1><?=Yii::t('trans','Filo')?> #<?php echo $model->salescompleteID+Salescompletecustomer::getParams("defultproductplus")?></h1>

<br /><br />
<?php 

if($model->cdtype==1){
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'type'=>'raw', 
				'name'=>'salescompleteID',
				'value'=>$model->salescompleteID+SalescompletecustomerController::getParams("defultfiloplus"),
			),
			array(
				'type'=>'raw', 
				'name'=>'customerdealerID',
				'value'=>SalescompletecustomerController::getCustomerName($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'scustomerID',
				'value'=>SalescompletecustomerController::getParams("dealercustomerplus")+$model->customerdealerID,
			),
			array(
				'type'=>'raw', 
				'name'=>'visits',
				'value'=>($model->visitsID==""?Yii::t('trans','Hayır'):Yii::t('trans','Evet')).' '.($model->visitsID!=""?'<a trget"_blank" style="margin-left:20px;" href="'.Yii::app()->createUrl("visits/view",array("id"=>$model->visitsID)).'" ><img src="'.Yii::app()->baseUrl.'/images/eye.png" /></a>':""),
			),
			
			array(
				'type'=>'raw', 
				'name'=>'email',
				'value'=>SalescompletecustomerController::getCustomerEmail($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'phone',
				'value'=>SalescompletecustomerController::getCustomerPhone($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'cphone',
				'value'=>SalescompletecustomerController::getCustomerCphone($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'country',
				'value'=>SalescompletecustomerController::getCustomerCountry($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'city',
				'value'=>SalescompletecustomerController::getCustomerCity($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'county',
				'value'=>SalescompletecustomerController::getCustomerCounty($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'adress',
				'value'=>SalescompletecustomerController::getCustomerAdress($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'taxno',
				'value'=>SalescompletecustomerController::getTaxno($model->cdtype,$model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'taxoffice',
				'value'=>SalescompletecustomerController::getTaxoffice($model->cdtype,$model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'employeesName',
				'value'=>SalescompletecustomerController::getEmployeesName($model->employeesID),
			),
			array(
				'type'=>'raw', 
				'name'=>'salesStatus',
				'value'=>SalescompletecustomerController::getParams_("salesStatus",$model->salesStatus),
			),
			array(
				'type'=>'raw', 
				'name'=>'salesEs',
				'value'=>SalescompletecustomerController::getParams_("salesEs",$model->salesEs),
			),
			array(
				'type'=>'raw', 
				'name'=>'salesEsDate',
				'value'=>SalescompletecustomerController::getDateTimeFormat($model->salesEsDate),
			),
			array(
				'type'=>'raw', 
				'name'=>'dateAdd',
				'value'=>SalescompletecustomerController::getDateTimeFormat($model->dateAdd),
			),
		),
	)); 
}elseif($model->cdtype==2){
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'type'=>'raw', 
				'name'=>'salescompleteID',
				'value'=>$model->salescompleteID+SalescompletecustomerController::getParams("defultfiloplus"),
			),
			array(
				'type'=>'raw', 
				'name'=>'customerdealerID',
				'value'=>SalescompletecustomerController::getDealerName($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'sdealerID',
				'value'=>SalescompletecustomerController::getParams("dealerplus")+$model->customerdealerID,
			),
			
			array(
				'type'=>'raw', 
				'name'=>'visits',
				'value'=>($model->visitsID==""?Yii::t('trans','Hayır'):Yii::t('trans','Evet')).' '.($model->visitsID!=""?'<a trget"_blank" style="margin-left:20px;" href="'.Yii::app()->createUrl("visits/view",array("id"=>$model->visitsID)).'" ><img src="'.Yii::app()->baseUrl.'/images/eye.png" /></a>':""),
			),
			
			array(
				'type'=>'raw', 
				'name'=>'email',
				'value'=>SalescompletecustomerController::getDealerEmail($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'phone',
				'value'=>SalescompletecustomerController::getDealerPhone($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'cphone',
				'value'=>SalescompletecustomerController::getDealerCphone($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'country',
				'value'=>SalescompletecustomerController::getDealerCountry($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'city',
				'value'=>SalescompletecustomerController::getDealerCity($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'county',
				'value'=>SalescompletecustomerController::getDealerCounty($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'adress',
				'value'=>SalescompletecustomerController::getDealerAdress($model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'taxno',
				'value'=>SalescompletecustomerController::getTaxno($model->cdtype,$model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'taxoffice',
				'value'=>SalescompletecustomerController::getTaxoffice($model->cdtype,$model->customerdealerID),
			),
			array(
				'type'=>'raw', 
				'name'=>'employeesName',
				'value'=>SalescompletecustomerController::getEmployeesName($model->employeesID),
			),
			array(
				'type'=>'raw', 
				'name'=>'salesStatus',
				'value'=>SalescompletecustomerController::getParams_("salesStatus",$model->salesStatus),
			),
			array(
				'type'=>'raw', 
				'name'=>'salesEs',
				'value'=>SalescompletecustomerController::getParams_("salesEs",$model->salesEs),
			),
			array(
				'type'=>'raw', 
				'name'=>'salesEsDate',
				'value'=>SalescompletecustomerController::getDateTimeFormat($model->salesEsDate),
			),
			array(
				'type'=>'raw', 
				'name'=>'dateAdd',
				'value'=>SalescompletecustomerController::getDateTimeFormat($model->dateAdd),
			),
		),
	)); 

}
?>
<div class="customerSaleUpdate clearfix">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'appointments-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="item">
    	<?php echo $form->labelEx($model,'salesEs'); ?>
        <?php 
		
		if($model->salesEs>=2 && $model->salesEs!=4)
			echo $form->dropDownList($model,'salesEs',SalescompletecustomerController::getParams("salesEs_"), array('options' => array('2'=>array('selected'=>true)))); 
		elseif($model->salesEs==4)
			echo "<b>".Yii::t('trans','Filo (Kargoya) Verildi')."</b>";
		else
			echo $form->dropDownList($model,'salesEs',SalescompletecustomerController::getParams("salesEs_")); 
			
		?>
       
    </div>
    
    <div class="item">
    	<?php echo $form->labelEx($model,'salesStatus'); ?>
        <?php echo $form->dropDownList($model,'salesStatus',SalescompletecustomerController::getParams("salesStatus")); ?>
    </div>
    
    <div class="button">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Kaydet'),
        	)); ?>
    </div>
    
    <span class="right"><a target="_blank" href="<?=Yii::app()->createUrl("salescompletecustomer/pdf",array("id"=>$model->salescompleteID+SalescompletecustomerController::getParams("defultfiloplus"),'type'=>2))?>"><img src="<?=Yii::app()->baseUrl?>/images/pdf2.png" /></a></span>
     <span class="right" style="margin-right:5px;"><a target="_blank" href="<?=Yii::app()->createUrl("salescompletecustomer/pdf",array("id"=>$model->salescompleteID+SalescompletecustomerController::getParams("defultfiloplus")))?>"><img src="<?=Yii::app()->baseUrl?>/images/pdf.png" /></a></span>
     <span class="right" style="margin-right:5px;"><a target="_blank" href="<?=Yii::app()->createUrl("salescompletecustomer/excel",array("id"=>$model->salescompleteID+SalescompletecustomerController::getParams("defultfiloplus")))?>"><img src="<?=Yii::app()->baseUrl?>/images/excel.png" /></a></span>
<?php $this->endWidget(); ?>
</div>
<div class="clear"></div>

<div class="customerSalesmoneyreceived">

 <div class="titles"><img src="<?=Yii::app()->baseUrl?>/images/plus.png" /> <?=Yii::t('trans','Ürünler')?></div>
 
 <div class="click_slide">
	
    <div class="basket">
     	<div class="productsalecolor clearfix">
            <div class="items">
            	<div class="color w3"></div>
                 <?=Yii::t('trans','Normal')?>
            	</div>
            
            <div class="items">
           	 <div class="color w1"></div>
             	<?=Yii::t('trans',"Satış fiyatından düşük ")?>
            </div>
            
            <div class="items">
            	<div class="color w2"></div>
            	 <?=Yii::t('trans',"Alış fiyatından düşük ")?>
            </div>
            
        </div>
      	<table>
        <tr class="title">
        	<td><?=Yii::t('trans','Ürün ID')?></td>
            <td class="w2"><?=Yii::t('trans','Ürün İsmi')?></td>
            
            <td class="w3"><?=Yii::t('trans','Ürün Cinsi')?></td>
            <td class="w4"><?=Yii::t('trans','Adet')?></td>
            <td class="w5"><?=Yii::t('trans','Birim Fiyatı')?></td>
            <td class="w6"><?=Yii::t('trans','Satış Birim Fiyatı')?></td>
            <td class="w8"></td>
        </tr>
        
        <?PHP 
		
		$toplamAccount=array();
		$accountCur=array();
		foreach($modelSalesdetail as $key=>$value):
			$toplamAccount[$value->salesCur]=0;
			$accountCur[$value->salesCur]=SalescompletecustomerController::getParams_("currency",$value->salesCur);
		
		$color="";
		if($value->salesPrice>=$value->unitPrice)
			$color="#CDEDB6";
		elseif($value->salesPrice>=$value->purchasePrice)
			$color="#ffff8c";
		else
			$color="#FDC6C6";
			
		?>
       
            <tr class="item" bgcolor="<?=$color?>">
           		<td><?=$value->productsID+SalescompletecustomerController::getParams("defultproductplus")?></td>
            	<td class="w2" width="250"><?=$value->name?></td>
            
                <td class="w3" width="150"><?=mb_substr(SalescompletecustomerController::getBottom($value->productbottomsID),0,48,"UTF-8")?></td>
                
                <td class="w4"><?=$value->number." ".Yii::t('trans','Adet')?></td>
                <td class="w5"><?= number_format($value->unitPrice,2).' '.SalescompletecustomerController::getParams_("currency",$value->unitCur);?></td>
                <td class="w6"><?= number_format($value->salesPrice,2).' '.SalescompletecustomerController::getParams_("currency",$value->salesCur);
            ?></td>
            
           
             <td class="w7"><?PHP if($model->salesEs<=3){?><img src="<?=Yii::app()->baseUrl?>/images/delete.png" style="cursor:pointer;" title="<?=Yii::t('trans','Sil')?>" onclick="javascript:salesdelete(this,<?=$value->salesdetailID?>,<?=$model->salesEs?>)" /><?PHP }?></td>
            </tr>
            
        <?PHP endforeach;?>
        </table>
    </div>
  </div>
  
	<div class="titles"><img src="<?=Yii::app()->baseUrl?>/images/plus.png" /> <?=Yii::t('trans','Ödemeler')?></div>
 	
    <div class="click_slide" id="odemelertab">
    
    <table>
        <tr class="title">
    		<td><?=Yii::t('trans','Tarih')?></td>
            <td><?=Yii::t('trans','Durumu')?></td>
            <td><?=Yii::t('trans','Ödenen Tutar')?></td>
            <td></td>
        </tr>
        <?PHP
		 $onaytoplam=array(
		 	'0'=>0,
		 	'1'=>0,
			'2'=>0,
		 	'3'=>0,
			'4'=>0,
		 	'5'=>0,
			'6'=>0,
		 	'7'=>0,
		    '8'=>0,
		 	'9'=>0,
			'10'=>0,
			'11'=>0,
			
		 );
		 foreach($modelSalesmoneyreceived as $key=>$value):
		 	 if($value->unpayment==0):
			 
			  
			
		 ?>
        <tr class="item">
    		<td><?=SalescompletecustomerController::getDateTimeFormat($value->dateAdd)?></td>
            <td><?PHP 
				if($value->deleted==0)
					echo '<font color="#FF0000">'.Yii::t('trans','Silindi').'</font>';
				elseif($value->deleted==1){
					echo '<font color="#009900">'.Yii::t('trans','Onaylandı').'</font>';
					
				
			 	       $onaytoplam[$value->receivedCur]+=round($value->receivedPrice,2);
				}
				
					
			?></td>
            <td><?=number_format(round($value->receivedPrice,2),2).' '.SalescompletecustomerController::getParams_("currency",$value->receivedCur)?></td>
            <td><?PHP if($value->deleted==1){?><img src="<?=Yii::app()->baseUrl?>/images/delete.png" title="<?=Yii::t('trans','Sil')?>" onclick="javascript:check(<?=$value->salesmoneyreceivedID?>,this)" style="cursor:pointer;" /><?PHP }?></td>
        </tr>
        <?PHP
			endif;
		 endforeach?>
    </table>
   
    <div class="title"><?=Yii::t('trans','Ödeme Ekle')?></div>
    <div class="salesAdd" style="background-color:#EFEFEF">
     <?php 
	 
	 	if($modelSalesmoneyreceivedNew->unpayment=="0")
	 		echo $form->errorSummary($modelSalesmoneyreceivedNew); ?>
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'appointments-form',
	'enableAjaxValidation'=>false,
)); ?>
	
     <table>
        <tr class="title">
    		<td><?=Yii::t('trans','Tarih')?></td>
            <td><?=Yii::t('trans','Ödenen Tutar')?></td>
            <td><?=Yii::t('trans','Hesap')?></td>
            <td></td>
        </tr>
        <tr>
        	<td> 
			<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
   		 $this->widget('CJuiDateTimePicker',array(
        'model'=>$modelSalesmoneyreceivedNew,
        'attribute'=>'dateAdd', //attribute name
		'id'=>'destes1',
                'mode'=>'datetime', //use "time","date" or "datetime" (default)
				'options'=>array(
				'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
				
				'buttonImageOnly'=>true,
			),
		'htmlOptions' => array(
            'style' => 'width:120px;',
         ),

			));
		?>
        </td>
            
            <td>
				<?php echo $form->textField($modelSalesmoneyreceivedNew,'received1',array('style'=>'width:40px;text-align:right','onkeypress'=>'return isNumber(event)')); ?> , 
        		<?php 
				
				if($modelSalesmoneyreceivedNew->received2=="")
					echo $form->textField($modelSalesmoneyreceivedNew,'received2',array('style'=>'width:30px','maxlength'=>2,'onkeypress'=>'return isNumber(event)',"value"=>"00"));
				else
					echo $form->textField($modelSalesmoneyreceivedNew,'received2',array('style'=>'width:30px','maxlength'=>2,'onkeypress'=>'return isNumber(event)'));
				 ?>
        		 <?php 
				 if($modelSalesmoneyreceivedNew->receivedCur=="")
				 	echo $form->dropDownList($modelSalesmoneyreceivedNew,'receivedCur',SalescompletecustomerController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2,'options' => array(Yii::app()->user->getState('companyCur')=>array('selected'=>true))));
				else
					echo $form->dropDownList($modelSalesmoneyreceivedNew,'receivedCur',SalescompletecustomerController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2));
				 
				  ?></td>
             <td><?php echo $form->dropDownList($modelSalesmoneyreceivedNew,'account',$accountCur,array('style'=>'width:70px')); ?> </td>    
                 
                
            <td>
				<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                 'type'=>'primary',
                 'size' => 'small',
				 'htmlOptions'=>array("style"=>"margin-top:-10px"),
                'label'=>Yii::t('trans','Ekle'),
                )); ?>
            </td>
        </tr>
     </table>
    <?php echo $form->hiddenField($modelSalesmoneyreceivedNew,'unpayment',array('value'=>"0"))?>
     <?php $this->endWidget(); ?>
    	</div>
    </div>
    
    
    <!--------------------------- geri ödeme--------------------------------------------------- -->
    
    
    <div class="titles"><img src="<?=Yii::app()->baseUrl?>/images/plus.png" /> <?=Yii::t('trans','Geri Ödemeler')?></div>
 
    <div class="click_slide" id="geriodemlertab">
    
    <table>
        <tr class="title">
    		<td><?=Yii::t('trans','Tarih')?></td>
            <td><?=Yii::t('trans','Durumu')?></td>
            <td><?=Yii::t('trans','Ödenen Tutar')?></td>
            
            <td></td>
        </tr>
        <?PHP
		 $unonaytoplam=array(
		 	'0'=>0,
		 	'1'=>0,
			'2'=>0,
		 	'3'=>0,
			'4'=>0,
		 	'5'=>0,
			'6'=>0,
		 	'7'=>0,
		    '8'=>0,
		 	'9'=>0,
			'10'=>0,
			'11'=>0,
			
		 );
		 foreach($modelSalesmoneyreceived as $key=>$value):
		 if($value->unpayment==1):
		 
		 ?>
        <tr class="item">
    		<td><?=SalescompletecustomerController::getDateTimeFormat($value->dateAdd)?></td>
            <td><?PHP 
				if($value->deleted==0)
					echo '<font color="#FF0000">'.Yii::t('trans','Silindi').'</font>';
				elseif($value->deleted==1){
					echo '<font color="#009900">'.Yii::t('trans','Onaylandı').'</font>';
					
			 	       $unonaytoplam[$value->receivedCur]+=round($value->receivedPrice,2);
				}
					
			?></td>
            <td><?=number_format(round($value->receivedPrice,2),2).' '.SalescompletecustomerController::getParams_("currency",$value->receivedCur)?></td>
            <td><?PHP if($value->deleted==1){?><img src="<?=Yii::app()->baseUrl?>/images/delete.png" title="<?=Yii::t('trans','Sil')?>" onclick="javascript:check(<?=$value->salesmoneyreceivedID?>,this)" style="cursor:pointer;" /><?PHP }?></td>
        </tr>
        <?PHP 
		endif;
		endforeach?>
    </table>
    
    <div class="title"><?=Yii::t('trans','Geri Ödeme Ekle')?></div>
    <div class="salesAdd" style="background-color:#EFEFEF">
    <?php 
	
	if($modelSalesmoneyreceivedNew->unpayment=="1")
		echo $form->errorSummary($modelSalesmoneyreceivedNew);
	
	 ?>
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'appointments-form',
	'enableAjaxValidation'=>false,
)); ?>
	
     <table>
        <tr class="title">
    		<td><?=Yii::t('trans','Tarih')?></td>
            
            <td><?=Yii::t('trans','Ödenen Tutar')?></td>
            <td><?=Yii::t('trans','Hesap')?></td>
            <td></td>
        </tr>
        <tr>
        	<td> 
			<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
   		 $this->widget('CJuiDateTimePicker',array(
        'model'=>$modelSalesmoneyreceivedNew,
        'attribute'=>'dateAdd', //attribute name
		'id'=>'adess',
		
        'mode'=>'datetime', //use "time","date" or "datetime" (default)
				'options'=>array(
				'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
				
				'buttonImageOnly'=>true,
			),
		'htmlOptions' => array(
            'style' => 'width:120px;',
         ),
			));
		?>
        </td>
            
            <td>
				<?php echo $form->textField($modelSalesmoneyreceivedNew,'received1',array('style'=>'width:40px;text-align:right','onkeypress'=>'return isNumber(event)')); ?> , 
        		<?php if($modelSalesmoneyreceivedNew->received2=="")
					echo $form->textField($modelSalesmoneyreceivedNew,'received2',array('style'=>'width:30px','maxlength'=>2,'onkeypress'=>'return isNumber(event)',"value"=>"00"));
				else
					echo $form->textField($modelSalesmoneyreceivedNew,'received2',array('style'=>'width:30px','maxlength'=>2,'onkeypress'=>'return isNumber(event)'));
 ?>
        		 <?php  if($modelSalesmoneyreceivedNew->receivedCur=="")
				 	echo $form->dropDownList($modelSalesmoneyreceivedNew,'receivedCur',SalescompletecustomerController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2,'options' => array(Yii::app()->user->getState('companyCur')=>array('selected'=>true))));
				else
					echo $form->dropDownList($modelSalesmoneyreceivedNew,'receivedCur',SalescompletecustomerController::getParams("currency"),array('style'=>'width:70px','maxlength'=>2));?></td>
                  <td><?php echo $form->dropDownList($modelSalesmoneyreceivedNew,'account',$accountCur,array('style'=>'width:70px')); ?> </td>    
            <td>
            
             
				<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                 'type'=>'primary',
                 'size' => 'small',
				 'htmlOptions'=>array("style"=>"margin-top:-10px"),
                'label'=>Yii::t('trans','Ekle'),
                )); ?>
            </td>
        </tr>
     </table>
      <?php echo $form->hiddenField($modelSalesmoneyreceivedNew,'unpayment',array('value'=>"1"))?>
     <?php $this->endWidget(); ?>
    	</div>
    </div>
    
    <div class="titles"><img src="<?=Yii::app()->baseUrl?>/images/plus.png" /> <?=Yii::t('trans','Geri İade Ürünler')?></div>
 
    <div class="click_slide" id="geriiadetab">
    
    <div class="basket">
      	<table>
        <tr class="title">
        	<td><?=Yii::t('trans','Ürün ID')?></td>
            <td class="w2"><?=Yii::t('trans','Ürün İsmi')?></td>
            
            <td class="w3"><?=Yii::t('trans','Ürün Cinsi')?></td>
            <td class="w4"><?=Yii::t('trans','Adet')?></td>
            <td class="w5"><?=Yii::t('trans','İade Birim Fiyatı')?></td>
            <td class="w6"><?=Yii::t('trans','Durumu')?></td>
          	<td></td>
        </tr>
        <?PHP 
		
		$returntoplam=array(
			'0'=>0,
		 	'1'=>0,
			'2'=>0,
		 	'3'=>0,
			'4'=>0,
		 	'5'=>0,
			'6'=>0,
		 	'7'=>0,
		    '8'=>0,
		 	'9'=>0,
			'10'=>0,
			'11'=>0,
		);
		foreach($modelSalesreturnList as $key=>$value):
		
			
		?>
       
            <tr class="item">
           		<td><?=$value->productsID+SalescompletecustomerController::getParams("defultproductplus")?></td>
            	<td class="w2"><?=$value->name?></td>
            
                <td class="w3"><?=mb_substr(SalescompletecustomerController::getBottom($value->productbottomsID),0,42,"UTF-8")?></td>
                
                <td class="w4"><?=$value->number." ".Yii::t('trans','Adet')?></td>
                <td class="w5"><?= number_format($value->salesreturnPrice,2).' '.SalescompletecustomerController::getParams_("currency",$value->salesreturnCur);
            ?></td>
            	 <td class="w6"><?PHP
                 if($value->deleted==0)
					echo '<font color="#FF0000">'.Yii::t('trans','Silindi').'</font>';
				elseif($value->deleted==1){
					echo '<font color="#009900">'.Yii::t('trans','Onaylandı').'</font>';
					$returntoplam[$value->salesreturnCur]+=$value->salesreturnPrice*$value->number;
				}
					?>
                 </td>
            	<td class="w7"><?PHP if($value->deleted==1){?><img src="<?=Yii::app()->baseUrl?>/images/delete.png" style="cursor:pointer;" title="<?=Yii::t('trans','Sil')?>" onclick="javascript:salesreturncheck(this,<?=$value->salesreturnID?>,<?=$value->productsID?>)" /><?PHP }?></td>
            </tr>
        <?PHP endforeach;?>
        </table>
    </div>
    
    	<div class="title"><?=Yii::t('trans','Geri İade Ürün Ekle')?></div>
    <div class="salesAdd" style="background-color:#EFEFEF">
    
    <?php echo $form->errorSummary($modelSalesreturn); ?>
    <?php 
	
	
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'appointments-form',
	'enableAjaxValidation'=>false,
)); ?>
	
     <table>
        <tr class="title">
    		<td><?=Yii::t('trans','Tarih')?></td>
            <td><?=Yii::t('trans','Ürün')?></td>
            <td><?=Yii::t('trans','Adet')?></td>
            <td><?=Yii::t('trans','Birim Fiyatı')?></td>
          
        </tr>
        <tr>
        	<td> 
			<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
   		 $this->widget('CJuiDateTimePicker',array(
        'model'=>$modelSalesreturn,
        'attribute'=>'dateAdd', //attribute name
		'id'=>'adess2',
		
                'mode'=>'datetime', //use "time","date" or "datetime" (default)
				'options'=>array(
				'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
				
				'buttonImageOnly'=>true,
			),
		'htmlOptions' => array(
            'style' => 'width:120px;',
         ),

			));
		?>
        </td>
            <td>
            <?PHP 
			$array=array(""=>"");
			foreach($modelSalesdetail as $key=>$value){
				$array[$value->salesdetailID]=$value->name." | ".mb_substr(SalescompletecustomerController::getBottom($value->productbottomsID),0,42,"UTF-8");
			}
			
			echo  $form->dropDownList($modelSalesreturn,"salesdetailID",$array,array('style'=>'width:240px'));
			?>
			</td>
            <td>
				<?=  $form->dropDownList($modelSalesreturn,"number",array(),array('style'=>'width:100px'));?>
            </td>
            
            <td id="geriadesalesprice">
				
            </td>
            
            </tr>
            <tr class="title">
    		
            <td colspan="3"><?=Yii::t('trans','Açıklama')?></td>
           
       		 </tr>
            <tr>
           
            
            <td>
            <?=  $form->textArea($modelSalesreturn,"text");?>
            </td>
            
            <td>
				<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                 'type'=>'primary',
                 'size' => 'small',
				 'htmlOptions'=>array("style"=>"margin-top:-10px"),
                'label'=>Yii::t('trans','Ekle'),
                )); ?>
            </td>
            </tr>
        </tr>
     </table>
    
     <?php $this->endWidget(); ?>
    	</div>
    </div>
    
    <div class="total">
    	  <div class="title"><?=Yii::t('trans','Filo Toplam Tutar')?></div>
    	<?PHP
		$toplam=0;
		
		$notr=array();
		foreach($modelSalesdetail as $key=>$value){
			
			$toplamAccount[$value->salesCur]+=$value->salesPrice*$value->number;
			$to=($value->salesPrice*$value->number) - $onaytoplam[$value->salesCur] + $unonaytoplam[$value->salesCur];
			$toplam+=SalescompletecustomerController::curAccount($value->salesCur,$to);
			
			if(@$notr[$value->salesCur]==""){
				$toplam-=SalescompletecustomerController::curAccount($value->salesCur,$returntoplam[$value->salesCur]);
				$notr[$value->salesCur]=$value->salesCur;
			}
		}
		
		?>
       
    	<div class="item clear" >
        <table>
         <?PHP foreach($toplamAccount as $key=>$value):?>
            <tr>
                <td width="120">
               <?=SalescompletecustomerController::getParams_("currency",$key)?> <?=Yii::t('trans','Hesap')?>
                </td>
                <td width="5">:</td>
                <td class="X_a<?=$key?>">
                	<b ><?=number_format($value-$returntoplam[$key],2);?> <?=SalescompletecustomerController::getParams_("currency",$key)?></b>
                </td>
            </tr>
              <?PHP endforeach;?>
        </table>
        
        </div>
     
        
        
        <div class="title clear" style="margin-top:10px;"><?=Yii::t('trans','Ödenen Toplam Tutar')?></div>
       
        
    	<div class="item clear">
        
         <table>
         <?PHP foreach($toplamAccount as $key=>$value):?>
            <tr>
                <td width="120">
               <?=SalescompletecustomerController::getParams_("currency",$key)?> <?=Yii::t('trans','Hesap')?>
                </td>
                <td width="5">:</td>
                <td class="X_b<?=$key?>"><b><?=number_format($onaytoplam[$key],2);?> <?=SalescompletecustomerController::getParams_("currency",$key)?></b>
        		</td>
            </tr>
              <?PHP endforeach;?>
        </table>
        
        </div>
       
       
       <div class="title clear" style="margin-top:10px;"><?=Yii::t('trans','Geri Ödenen Toplam Tutar')?></div>
       
         
    	<div class="item clear">
        
      <table>
         <?PHP foreach($toplamAccount as $key=>$value):?>
            <tr>
                <td width="120">
               <?=SalescompletecustomerController::getParams_("currency",$key)?> <?=Yii::t('trans','Hesap')?>
                </td>
                <td width="5">:</td>
                <td class="X_c<?=$key?>"><b><?=number_format($unonaytoplam[$key],2);?> <?=SalescompletecustomerController::getParams_("currency",$key)?></b>
        		</td>
            </tr>
              <?PHP endforeach;?>
        </table>
        
        </div>
      
       
       
        <div class="title clear border" style="margin-top:10px;"> <?=Yii::t('trans','Kalan Tutar')?></div>
        
        
    	<div class="item kalan">
        
         <table>
         <?PHP foreach($toplamAccount as $key=>$value):?>
            <tr>
                <td width="120">
               <?=SalescompletecustomerController::getParams_("currency",$key)?> <?=Yii::t('trans','Hesap')?>
                </td>
                <td width="5">:</td>
                <td class="X_d<?=$key?>"><span class="kalans"><?=number_format($value-$returntoplam[$key]-$onaytoplam[$key]+$unonaytoplam[$key],2);?> <?=SalescompletecustomerController::getParams_("currency",$key)?></span>
        		</td>
            </tr>
              <?PHP endforeach;?>
        </table>
       		
        </div>
      
    </div>
    
    
</div>


<script type="text/javascript">

function salesreturncheck(element, ids, productsID){

	var dataString= "id="+ids+'&productsID='+productsID;
	$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("salescompletecustomer/salesreturncheck")?>", 
			 data: dataString,
			 success: function(data)
			 {
					
				 if(data.sonuc==1){
					 $(element).parent().prev().children().html('<font color="#F00"><?=Yii::t('trans','Silindi')?></font>');
					
					 $(element).remove();
					
					
					 var total= data.total.split("_");
					 var toplam= data.toplam.split("_");
					 $('.X_d'+total[0]).html('<span class="kalans">'+total[1]+'</span>');
					 $('.X_a'+toplam[0]).html('<b>'+toplam[1]+'</b>'); 
				 }
				 
			 }
			});
	
}

function salesdelete(element, salesdetailID,salesEs){
	var confirms=true;
	if(salesEs==3){
		var confirms =  confirm('<?=Yii::t('trans',"Filo hazırlanma aşamasındadır.\\n\\rDepo sorumlularına bildirim geçmeniz gerekebilir.\\n\\rBu ürünü filodan silmek istiyormusunuz?")?>');
	}
	
	if( confirms==true){
		var dataString= "id="+salesdetailID;
		$.ajax({
				 type: "POST",
				 dataType:'json',  
				 url: "<?= Yii::app()->createUrl("salescompletecustomer/salesdelete")?>", 
				 data: dataString,
				 success: function(data)
				 {
						
					 if(data.sonuc==1){
						
						 $(element).parent().parent().remove();
						
						
						 var total= data.total.split("_");
						 var toplam= data.toplam.split("_");
						 $('.X_d'+total[0]).html('<span class="kalans">'+total[1]+'</span>');
						 $('.X_a'+toplam[0]).html('<b>'+toplam[1]+'</b>'); 
					 }
					 
				 }
				});
	}
}


function check(ids,element){

	var dataString= "id="+ids;
	$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("salescompletecustomer/checkmoney")?>", 
			 data: dataString,
			 success: function(data)
			 {
				
				 if(data.sonuc==1){
					 $(element).parent().prev().prev().children().html('<font color="#F00"><?=Yii::t('trans','Silindi')?></font>');
					
					 $(element).remove();
					
					 var toplam= data.toplam.split("_");
					 var total= data.total.split("_");
					 if(data.hesap=="X_b"){
						
						 $('.X_b'+toplam[0]).html("<b >"+toplam[1]+"</b>");
					 }else if(data.hesap=="X_c"){
						
						 $('.X_c'+toplam[0]).html("<b >"+toplam[1]+"</b>");
					 }
					 
					 $('.X_d'+total[0]).html('<span class="kalans">'+total[1]+'</span>');
					 
				 }
				 
			 }
			});
}

function isNumber(evt)  
{  
  var charCode = (evt.which) ? evt.which : event.keyCode  
  if (charCode > 31 && (charCode < 48 || charCode > 57))  
   return false;  
  return true; 
   
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


<?PHP if($modelSalesmoneyreceivedNew->unpayment=="0"):?>
 $('#odemelertab').fadeIn();
<?PHP endif;?>

<?PHP if($modelSalesmoneyreceivedNew->unpayment=="1"):?>
 $('#geriodemlertab').fadeIn();
<?PHP endif;?>


<?PHP if($modelSalesreturn->companyID!=""):?>
 $('#geriiadetab').fadeIn();
<?PHP endif;?>

$('#Salesreturn_salesdetailID').change(function(){
	
	$('#Salesreturn_number').html('<option><?=Yii::t('trans','Yükleniyor')?></option>');
	
	var dataString= "id="+$(this).val();
	$.ajax({
		 type: "POST",
		 dataType:'json',  
		 url: "<?= Yii::app()->createUrl("salescompletecustomer/getnumber")?>", 
		 data: dataString,
		 success: function(data)
		 {
			 
			data= data.list.split(',');
			$('#Salesreturn_number').html('<option></option>');
			for(var i in data)
			{
				$('#Salesreturn_number').append('<option value="'+data[i]+'">'+data[i]+' <?=Yii::t('trans','Adet')?></option>');
			}
			
			$('#Salesreturn_number').val(<?=$modelSalesreturn->number?>);
			 
		 },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
     		$('#Salesreturn_number').html('');
  		 }
	});
	
	var dataString= "id="+$(this).val();
	$.ajax({
		 type: "POST",
		 dataType:'json',  
		 url: "<?= Yii::app()->createUrl("salescompletecustomer/getsalesdetailsalesprice")?>", 
		 data: dataString,
		 success: function(data)
		 {
			
			 $('#geriadesalesprice').html(data.price);
			 
		 }
	});
});

<?PHP if($modelSalesreturn->salesdetailID!=""):?>
	$('#Salesreturn_number').html('<option><?=Yii::t('trans','Yükleniyor')?></option>');
	
	
	var dataString= "id=<?=$modelSalesreturn->salesdetailID?>";
	$.ajax({
		 type: "POST",
		 dataType:'json',  
		 url: "<?= Yii::app()->createUrl("salescompletecustomer/getnumber")?>", 
		 data: dataString,
		 success: function(data)
		 {
			 
			data= data.list.split(',');
			$('#Salesreturn_number').html('<option></option>');
			for(var i in data)
			{
				$('#Salesreturn_number').append('<option value="'+data[i]+'">'+data[i]+' <?=Yii::t('trans','Adet')?></option>');
			}
			
			$('#Salesreturn_number').val(<?=$modelSalesreturn->number?>);
			 
		 },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
     		$('#Salesreturn_number').html('');
  		 }
	});
	
	var dataString= "id=<?=$modelSalesreturn->salesdetailID?>";
	$.ajax({
		 type: "POST",
		 dataType:'json',  
		 url: "<?= Yii::app()->createUrl("salescompletecustomer/getsalesdetailsalesprice")?>", 
		 data: dataString,
		 success: function(data)
		 {
			 
			 $('#geriadesalesprice').html(data.price);
			 
		 }
	});
<?PHP endif;?>
</script>

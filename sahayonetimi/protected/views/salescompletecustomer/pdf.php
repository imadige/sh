<?PHP
	$controller=new Sitecontroller;
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/pdf.css" />
	
<div class="header">

	
	<div class="item">
    	<table>
        	<tr>
            <td width="40%"><?=Yii::t('trans','Satış Tarihi')?></td>
            <td><?=$this->getDateTimeFormat($model->dateAdd)?></td>
            </tr>
        </table>
    </div>
    
    <div class="item">&nbsp;</div>

	<div class="item">
    	<table>
        	<tr>
            <td width="40%"><b><?=Yii::t('trans','Unvanı')?></b></td>
            <td><?=$model->name?></td>
            </tr>
        </table>
    </div>
    
    
    <div class="item">
    	<table>
        	<tr>
            <td width="40%"><b><?=Yii::t('trans','Telefon')?></b></td>
            <td><?=$model->phone?></td>
            </tr>
         </table>
    </div>
    
    
    <div class="item">
    	<table>
        	<tr>
            <td width="40%"><b><?=Yii::t('trans','Cep Telefon')?></b></td>
            <td><?=$model->cphone?></td>
            </tr>
         </table>
    </div>
    
    
      
    <div class="item">
    	<table>
        	<tr>
            <td width="40%"><b><?=Yii::t('trans','Fax')?></b></td>
            </td><?=$model->fax?></td>
            </tr>
         </table>
    </div>
    
    
    <div class="item">
    	<table>
        	<tr>
            <td width="40%"><b><?=Yii::t('trans','E-Posta')?></b></td>
            <td><?=$model->email?></td>
            </tr>
        </table>
    </div>
    
    
    <div class="item">
    	<table>
        	<tr>
            <td width="40%"><b><?=Yii::t('trans','Vergi Numarası')?></b></td>
            <td><?=SalescompletecustomerController::getParams_("taxnoType",$model->taxnotype)." ".$model->taxno?></td>
            </tr>
         </table>
    </div>
    
    <div class="item">
    	<table>
        	<tr>
            <td width="40%"><b><?=Yii::t('trans','Vergi Dairesi')?></b></td>
            <td><?=$model->taxoffice?></td>
            </tr>
        </table>
    </div>
    
    
     <div class="item">
    	<table>
        	<tr>
            <td width="40%"><b><?=Yii::t('trans','Ülke')?></b></td>
            <td><?=@$controller->getCountry($model->country)?></td>
            </tr>
        </table>
    </div>
    
    
    
     <div class="item">
    	<table>
        	<tr>
            <td width="40%"><b><?=Yii::t('trans','Şehir')?></b></td>
            <td><?= @$controller->getCity($model->city)?></td>
            </tr>
        </table>
    </div>
    
    <div class="item">
    	<table>
        	<tr>
            <td width="40%"><b><?=Yii::t('trans','Adres')?></b></td>
            <td><?=$model->adress?></td>
            </tr>
        </table>
    </div>
    
   

</div><!--header-->

	<img class="logo" src="<?=$controller->getLogo2()?>" />
    
   <div class="clear"></div>
   
   <table class="products">
       <tr class="tr">
       		<td width="10%"><?=Yii::t('trans','Ürün ID')?></td>
            <td width="30%"><?=Yii::t('trans','Ürün İsmi')?></td>
            <td width="20%"><?=Yii::t('trans','Ürün Cinsi')?></td>
            <td width="10%"><?=Yii::t('trans','Adet')?></td>
            <td width="15%"> <?=Yii::t('trans','Birim Fiyatı')?></td>
            <td width="15%"><?=Yii::t('trans','Toplam Fiyat')?></td>
       </tr>
       <?PHP foreach($modelSalesdetail as $key=>$value):?>
			
       	<tr  <?PHP if($key%2==0){?>class="tr2"<?PHP }?>>
            <td><?=$value->productsID+SalescompletecustomerController::getParams("defultproductplus")?></td>
            <td><?=$value->name?></td>
            <td><?=SalescompletecustomerController::getBottom($value->productbottomsID)?></td>
            <td><?=$value->number?></td>
            <td><?=number_format($value->salesPrice,2).' '.SalescompletecustomerController::getParams_("currency",$value->unitCur)?></td>
            <td><?=number_format($value->salesPrice*$value->number,2).' '.SalescompletecustomerController::getParams_("currency",$value->unitCur)?></td>
       </tr>
       <?PHP endforeach;?>
   </table>
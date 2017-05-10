<?PHP

$this->breadcrumbs=array(
	Yii::t('trans','Raporlar')=>array('index'),
	Yii::t('trans','Genel Bakış'),
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
<div class="reports">
 <form id="form" method="post">
 	<?php echo CHtml::dropDownList('cur', $cur,ReportsController::getParams("currency")); ?>
    <?php echo CHtml::dropDownList('reportsdate', $reportsdate,ReportsController::getParams("reportsdate")); ?>
 </form>
	<div class="main">
    
    	<div class="item valback">
        	<div class="val1"><?=Yii::t('trans','Şu anda')?></div>
            <div class="val2"><?=Yii::t('trans','Sistemde')?></div>
            <div class="val3">1</div>
            <div class="val4"><?=Yii::t('trans','Aktif kişi var')?></div>
        </div>
        
        <div class="item">
        	<div class="val1"><?=$reportsdate=='0 day'?Yii::t('trans','Bügün'):ReportsController::getParams_("reportsdate",$reportsdate)?></div>
            <div class="val2"><?=Yii::t('trans','Sisteme')?></div>
            <div class="val3"><?=$modelCustomers?></div>
            <div class="val4"><?=Yii::t('trans','Müşteri kaydedilmiştir')?></div>
        </div>
        
        
        <div class="item">
        	<div class="val1"><?=$reportsdate=='0 day'?Yii::t('trans','Bügün'):ReportsController::getParams_("reportsdate",$reportsdate)?></div>
            <div class="val2"><?=Yii::t('trans','Sisteme')?></div>
            <div class="val3"><?=$modelDealers?></div>
            <div class="val4"><?=Yii::t('trans','Bayi kaydedilmiştir')?></div>
        </div>
        
        
        
    </div><!--main-->
    
    
   
		<script type="text/javascript">
		
var renk=new Array();
renk[1]="#337cd0";
renk[2]="#0d233a";
renk[3]="#8bbc21";
renk[4]="#89270c";
renk[5]="#1aadce";
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'spline'
            },
			
            title: {
                text: '<?=Yii::t('trans','Genel Bakış')?>'
            },
           credits: { 
				enabled: true,
				href: "http://www.sahayoönetimi.com",
				text: "Sahayonetimi.com",
			},
            xAxis: {
                categories: [
				 <?PHP foreach($command1 as $key=>$value){
					 $value=(object)$value;
					 
				   echo "'".ReportsController::getParams_("month",$value->dates)."',";
				 }?>			
				]
            },
            yAxis: {
                title: {
                    text: '<?=Yii::t('trans','Miktar')?>'
                },
                labels: {
                    formatter: function() {
                        return this.value +' <?=ReportsController::getParams_("currency",$cur)?>'
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true,
				
				formatter: function () {
					var s = '<span style="font-size:10px;font-weight:700;color:#333">'+this.x + '</span><br>';
					var netkar=0;
					
					$.each(this.points, function (i, point) {
						s += '<br/><span style="font-size:11px;font-weight:700;color:'+renk[point.series.name[1]]+'">' + point.series.name[0] + ':</span> ' +(point.series.name[1]==5?Highcharts.numberFormat(point.y): Highcharts.numberFormat(point.y, 2)) + ' <?=ReportsController::getParams_("currency",$cur)?>';
						if(point.series.name[1]!=1 && point.series.name[1]!=4){
							netkar+=point.y;
						}
						
					});
					
					if(netkar>=0)
						 txt='<?=Yii::t('trans','Net Kar')?>';
					else
						 txt='<?=Yii::t('trans','Net Zarar')?>';
					s+='<br/>---------------------<br>'+txt+': <span style="font-size:16px;font-weight:700;color:#3d7feb">' + Highcharts.numberFormat(netkar, 2) + '  <?=ReportsController::getParams_("currency",$cur)?></span>';
					return s;
				}
				
            },
			
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
			 legend: {
                
                  labelFormatter: function() {
               		 return this.name[0];
            	}
               
            },
            series: [{
                name: ['<?=Yii::t('trans','Toplam Satış')?>',1],
                
                data: [
				 <?PHP foreach($command1 as $key=>$value){
					 $value=(object)$value;
				   echo $value->price.",";
				 }?>	
				
				]
    
            }, {
                name: ['<?=Yii::t('trans','Kargo Gider')?>',2],
               
                data: [
				
				 <?PHP foreach($command3 as $key=>$value){
					 $value=(object)$value;
				   echo $value->price.",";
				 }?>	
				]
            }, {
                name: ['<?=Yii::t('trans','Brüt Kar')?>',3],
                
                data: [
				 <?PHP foreach($command2 as $key=>$value){
					 $value=(object)$value;
				   echo $value->price.",";
				 }?>	
				]
            }, {
                name: ['<?=Yii::t('trans','Ürün İadesi')?>',4],
                
                data: [
				 <?PHP foreach($command4 as $key=>$value){
					 $value=(object)$value;
				   echo $value->price.",";
				 }?>	
				]
            }, {
                name: ['<?=Yii::t('trans','Ürün İadesi (Kar)')?>',5],
                
                data: [
				 <?PHP foreach($command4 as $key=>$value){
					 $value=(object)$value;
				   echo $value->bkar.",";
				 }?>	
				]
            },]
        });
    });
    

		</script>
<script src="<?=Yii::app()->baseUrl?>/js/highchart/highcharts.js"></script>
<script src="<?=Yii::app()->baseUrl?>/js/highchart/modules/exporting.js"></script>  
<div class="clear"></div>
<div class="charts">    
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
	<div class="titleB"><?=$reportsdate=='0 day'?Yii::t('trans','Bügün'):ReportsController::getParams_("reportsdate",$reportsdate)?></div>
    
<div class="alt">
	
	<div class="title"><?=Yii::t('trans','Blanço')?></div>
	<div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Toplam Satış')?> :</div><span class="span"><?=number_format($modelToplamSatis->salesPrice,2)?> <?=ReportsController::getParams_("currency",$cur)?></span>
    </div>
    
    <div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Brüt Kar')?> :</div><span class="span"><?=number_format($modelBrutKar->salesPrice,2)?> <?=ReportsController::getParams_("currency",$cur)?></span>
    </div>
    
	<div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Kargo Gideri')?> :</div><span class="span">-<?=number_format($modelCargoGider->charge,2)?> <?=ReportsController::getParams_("currency",$cur)?></span>
    </div>
    
     
	<div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Ürün İadesi')?> :</div><span class="span">-<?=number_format($modelUIade->salesreturnPrice,2)?> <?=ReportsController::getParams_("currency",$cur)?></span>
    </div>
    
    <div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Ürün İadesi (Kar)')?> :</div><span class="span">-<?=number_format($modelUIade->bkar,2)?> <?=ReportsController::getParams_("currency",$cur)?></span>
    </div>
    
    
    <div class="altValue color clearfix">
    	<div class="item"><?=($modelBrutKar->salesPrice-$modelCargoGider->charge-$modelUIade->bkar)>0?Yii::t('trans','Net Kar'):Yii::t('trans','Net Zarar')?> :</div><span class="span"><?=number_format(($modelBrutKar->salesPrice-$modelCargoGider->charge-$modelUIade->bkar),2)?> <?=ReportsController::getParams_("currency",$cur)?></span>
    </div>
    
    <div class="title" style="margin-top:50px;"><?=Yii::t('trans','Kasa')?></div>
    <div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Gelir')?> :</div><span class="span"><?=number_format($modelKasayaGiren->receivedPrice,2)?> <?=ReportsController::getParams_("currency",$cur)?></span>
    </div>
    
    
    <div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Geri Ödemeler')?> :</div><span class="span"><?=number_format($modelIadeEdilmis->receivedPrice,2)?> <?=ReportsController::getParams_("currency",$cur)?></span>
    </div>
    
</div>

<div class="alt">
	
	<div class="title"><?=Yii::t('trans','Ürünler')?></div>
	<div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Satılan')?> :</div><span class="span"><?=$modelSatilanAdet->number==0?0:$modelSatilanAdet->number?> <?=Yii::t('trans','Adet')?></span>
    </div>
    
    <div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Yeni ürün')?> :</div><span class="span"><?=$modelUEklenenAdet?> <?=Yii::t('trans','Çeşit')?></span>
    </div>
    
	<div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','İade Edilen')?> :</div><span class="span"><?=$modelUIadeAdet->number?> <?=Yii::t('trans','Adet')?></span>
    </div>
    
     <div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Sorunlu')?> :</div><span class="span"><?=$modelUSorunluAdet?> <?=Yii::t('trans','Adet')?></span>
    </div>
    
	 <div class="altValue clearfix">
    	<div class="item"><?=Yii::t('trans','Onarımı Tamamlanan')?> :</div><span class="span"><?=$modelUOnarAdet?> <?=Yii::t('trans','Adet')?></span>
    </div>
    
</div>
	
</div><!--reports-->

<script type="text/javascript">
	$('#cur').change(function(){
		$('#form').submit();
	});
	
	$('#reportsdate').change(function(){
		$('#form').submit();
	});
</script>
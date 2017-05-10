<?PHP

$this->breadcrumbs=array(
	Yii::t('trans','Raporlar')=>array('index'),
	Yii::t('trans','Mali Tablolar'),
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
     <?=Chtml::dropDownList("raporlama",$raporlama,ReportsController::getParams("raporlama"),array('style'=>'min-width:100px;width:100px;'))?>
     
   <?php 
	 $this->widget('zii.widgets.jui.CJuiDatePicker',array(
	 'name'=>'basTar',	
	 'value'=>$basTar,
		'options'=>array(
				'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
				'showOn'=>'button', // 'focus', 'button', 'both'
				'buttonText'=>Yii::t('trans','Takvimden Tarih Seçiniz'),
				'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
				'buttonImageOnly'=>true,
				'dateFormat'=>'dd-mm-yy',
			),
			'htmlOptions'=>array(
				'style'=>'width:136px;vertical-align:top'
			),	
		));
		?>
    
     <?php 
	 $this->widget('zii.widgets.jui.CJuiDatePicker',array(
	 'name'=>'bitTar',
	 'value'=>$bitTar,	
		'options'=>array(
				'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
				'showOn'=>'button', // 'focus', 'button', 'both'
				'buttonText'=>Yii::t('trans','Takvimden Tarih Seçiniz'),
				'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
				'buttonImageOnly'=>true,
				'dateFormat'=>'dd-mm-yy',
			),
			'htmlOptions'=>array(
				'style'=>'width:136px;vertical-align:top'
			),
		));
	?>
    

    
      <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Raporla'),
			'htmlOptions'=>array(
				'style'=>'margin:-10px 0px 0px 20px;'
			),
        	)); ?>
 </form>

    
 <?PHP
 function dateArray($dateStart,$dateEnd,$raporlama,$command){
	 
		if($raporlama==0){
			$dateStart = strtotime($dateStart);
			$dateEnd = strtotime($dateEnd);
			$dates[] = date("d-m-Y",$dateStart);
			$current = $dateStart;
			while($current<$dateEnd){
				$current=strtotime ( '+1 day' ,$current) ;
				$dates[] = date("d-m-Y",($current));
			}
		}elseif($raporlama==2){
			
			$x=strtotime($dateStart);
			$y=strtotime($dateEnd);
			
			while($x<$y){
				$dates[date("m",$x).date("Y",$x)]=date("m",$x).','.date("Y",$x);
				$x=strtotime ( '+1 month' , $x) ;
			}
			$dates[date("m",$x).date("Y",$x)]=date("m",$x).','.date("Y",$x);
			
		}elseif($raporlama==1){
			
			$x=strtotime($dateStart);
			$y=strtotime($dateEnd);
			
			while($x<$y){
				$dates[date("W",$x).date("Y",$x)]=date("W",$x).','.date("Y",$x).','.date("m",$x);
				$x=strtotime ( '+1 week' , $x) ;
			}
			$dates[date("W",$x).date("Y",$x)]=date("W",$x).','.date("Y",$x).','.date("m",$x);
			
		}elseif($raporlama==3){
			
			$x=strtotime($dateStart);
			$y=strtotime($dateEnd);
			
			while($x<$y){
				
				$dates[date("Y",$x)]=date("Y",$x);
				$x=strtotime ( '+1 year' , $x) ;
			}
			$dates[date("Y",$x)]=date("Y",$x);
		}
		
		
		return $dates;
}

 $gunsayisi=dateArray($basTar,$bitTar,$raporlama,$command1);
 ?>   
   
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
				 <?PHP 
				 foreach(dateArray($basTar,$bitTar,$raporlama,$command1) as $key=>$value){
						
						if($raporlama==0){
							echo "'".$value."',";
						}elseif($raporlama==3){
							echo "'".$value."',";
						}elseif($raporlama==2){
							
							$ab=explode(',',$value);
							
							echo "'".ReportsController::getParams_("month",$ab[0]).' '.$ab[1]."',";
						}elseif($raporlama==1){
							
							$ab=explode(',',$value);
							
							echo "'".$ab[0].'. '.Yii::t('trans','Hf').' '.ReportsController::getParams_("month",$ab[2]).' '.$ab[1]."',";				}
				
				 }
				 ?>			
				],
				 <?PHP if($raporlama==0 || $raporlama==3){
					 if((int)(count($gunsayisi)>6)){
					 ?>
				tickInterval: <?=(int)(count($gunsayisi)/6)?>,
				labels:{
					y:20
				}
				<?PHP
					 }
					 }elseif($raporlama==1){
					if((int)(count($gunsayisi)>6)){
					?>
				tickInterval: <?=(int)(count($gunsayisi)/6)?>,
				labels:{
					y:20
				}
				<?PHP }
				}
				elseif($raporlama==2){
					
					if((int)(count($gunsayisi)>12)){
				?>
				tickInterval: <?=(int)(count($gunsayisi)/12)?>,
				
				<?PHP
					}
				
				
				 }?>
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
        
        
	<script type="text/javascript">
$(function () {
        $('#container2').highcharts({
            chart: {
                type: 'column',
				backgroundColor: '#DFE6EA' 
            },
            title: {
                text: ' '
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
            xAxis: {
                categories: ["<?=Yii::t('trans','Müşteri')?>"]
            },
            credits: {
                enabled: false
            },
			  tooltip: {
			
				formatter: function () {
					var s = '<span style="font-size:10px;font-weight:700;color:#333">'+this.x + '</span><br>';
					s+="<b>"+this.series.name+":</b> "+Highcharts.numberFormat(this.y)+' <?=ReportsController::getParams_("currency",$cur)?>';
					return s;
				}
			  },
            series: [{
                name: '<?=Yii::t('trans','Toplam Satış')?>',
                data: [ <?PHP foreach($command5 as $key=>$value){
					 $value=(object)$value;
					if($key==1)
				  	 echo $value->price;
				 }?>]
            }, {
                name: '<?=Yii::t('trans','Brüt Kar')?>',
                data: [<?PHP foreach($command6 as $key=>$value){
					 $value=(object)$value;
					if($key==1)
				  	 echo $value->price;
				 }?>]
            }, {
                name: '<?=Yii::t('trans','Kargo Gider')?>',
                data: [<?PHP foreach($command7 as $key=>$value){
					 $value=(object)$value;
					if($key==1)
				  	 echo $value->price;
				 }?>]
            },{
                name: '<?=Yii::t('trans','Ürün İadesi')?>',
                data: [<?PHP foreach($command8 as $key=>$value){
					 $value=(object)$value;
					if($key==1)
				  	 echo $value->price;
				 }?>]
            },{
                name: '<?=Yii::t('trans','Ürün İadesi (Kar)')?>',
                data: [<?PHP foreach($command8 as $key=>$value){
					 $value=(object)$value;
					if($key==1)
				  	 echo $value->bkar;
				 }?>]
            }]
        });
    });
    
$(function () {
        $('#container3').highcharts({
            chart: {
                type: 'column',
				backgroundColor: '#DFE6EA' 
            },
            title: {
                text: ' '
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
            xAxis: {
                categories: ["<?=Yii::t('trans','Bayi')?>"]
            },
            credits: {
                enabled: false
            },
			  tooltip: {
			
				formatter: function () {
					var s = '<span style="font-size:10px;font-weight:700;color:#333">'+this.x + '</span><br>';
					s+="<b>"+this.series.name+":</b> "+Highcharts.numberFormat(this.y)+' <?=ReportsController::getParams_("currency",$cur)?>';
					return s;
				}
			  },
            series: [{
                name: '<?=Yii::t('trans','Toplam Satış')?>',
                data: [ <?PHP foreach($command5 as $key=>$value){
					 $value=(object)$value;
					if($key==2)
				  	 echo $value->price;
				 }?>]
            }, {
                name: '<?=Yii::t('trans','Brüt Kar')?>',
                data: [<?PHP foreach($command6 as $key=>$value){
					 $value=(object)$value;
					if($key==2)
				  	 echo $value->price;
				 }?>]
            }, {
                name: '<?=Yii::t('trans','Kargo Gider')?>',
                data: [<?PHP foreach($command7 as $key=>$value){
					 $value=(object)$value;
					if($key==2)
				  	 echo $value->price;
				 }?>]
            },{
                name: '<?=Yii::t('trans','Ürün İadesi')?>',
                data: [<?PHP foreach($command8 as $key=>$value){
					 $value=(object)$value;
					if($key==2)
				  	 echo $value->price;
				 }?>]
            },{
                name: '<?=Yii::t('trans','Ürün İadesi (Kar)')?>',
                data: [<?PHP foreach($command8 as $key=>$value){
					 $value=(object)$value;
					if($key==2)
				  	 echo $value->bkar;
				 }?>]
            }]
        });
    });
		</script>
<script src="<?=Yii::app()->baseUrl?>/js/highchart/highcharts.js"></script>
<script src="<?=Yii::app()->baseUrl?>/js/highchart/modules/exporting.js"></script>  
<div class="clear"></div>

<div>
    <div class="charts1">
        <div class="titleC"><?=Yii::t('trans','Müşteri')?></div>
        <div id="container2" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
    </div>
    
    <div class="charts1">
        <div class="titleC"><?=Yii::t('trans','Bayi')?></div>
         <div id="container3" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
    </div>
</div>

<div class="clear"></div>

<div class="charts">    
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
	
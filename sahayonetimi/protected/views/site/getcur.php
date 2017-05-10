<?PHP
	
   function curAccount2($id,$dateAdd,$ecur){
		$model=Currencyd::model()->find("currencyID=:currencyID AND dateAdd=:dateAdd",array(":currencyID"=>$ecur,"dateAdd"=>$dateAdd));
		$model2=Currencyd::model()->find("currencyID=:currencyID AND dateAdd=:dateAdd",array(":currencyID"=>$id,"dateAdd"=>$dateAdd));
		
		$t=$model2->cur/$model->cur;
		return $t;
	}
	
	
	function curAccountTL($id,$dateAdd){
		
		$model2=Currencyd::model()->find("currencyID=:currencyID AND dateAdd=:dateAdd",array(":currencyID"=>$id,"dateAdd"=>$dateAdd));
		
		$t=1/$model2->cur;
		return $t;
	}
	$datebas=date("Y-m-d",strtotime('-30 day',strtotime(date("Y-m-d"))));
	
	$criteria=new CDbCriteria;
	$criteria->select='*';
	if($id!=0){
		$criteria->condition="dateAdd >=:date and  dateAdd<=:dateN AND currencyID=:currencyID";
	$criteria->params=array(
			':date'=>$datebas,':dateN'=>date("Y-m-d"),':currencyID'=>$id,
		);
	}else{
		$criteria->condition="dateAdd >=:date and  dateAdd<=:dateN AND currencyID=1";
		$criteria->params=array(
			':date'=>$datebas,':dateN'=>date("Y-m-d")
		);
	}
	$modelCurrencyd1=Currencyd::model()->findAll($criteria);
	
	
	$data1=array();
	foreach($modelCurrencyd1 as $key=>$value){
		if($id!=0)
			$data1[$value->dateAdd]=array('cur'=>$value->cur,'dateAdd'=>$value->dateAdd,'currencyID'=>$value->currencyID);
		else
			$data1[$value->dateAdd]=array('cur'=>1/$value->cur,'dateAdd'=>$value->dateAdd,'currencyID'=>$value->currencyID);
	}
		
	$veri1=array();
	$datebas2=$datebas;
	for($i=0;$i<31;$i++){
		if(@$data1[$datebas2])
			$veri1[$datebas2]=array("cur"=>$data1[$datebas2]["cur"],"currencyID"=>$data1[$datebas2]["currencyID"],'dateAdd'=>$data1[$datebas2]["dateAdd"]);
		else
			$veri1[$datebas2]=array("cur"=>0);
		$datebas2=date("Y-m-d",strtotime('+1 day',strtotime($datebas2)));
	}
	

	
?> 


<script type="text/javascript">
$(function () {
        $('#container<?=$type?>').highcharts({
            chart: {
                zoomType: 'x',
                spacingRight: 20
            },
			credits: {
    			text:"sahayonetimi.com",
				href:"http://www.sahayonetimi.com",
  			},
            title: {
                text: '1 Aylık Değerleri'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                   'Tıklayın ve yakınlaştırma için çizim alanını sürükleyin' :
                    'Yakınlaştırmak için grafik tıklayın'
            },
            xAxis: {
                type: 'datetime',
                maxZoom: 14 * 24 * 3600000, // fourteen days
                title: {
                    text: null
                }
            },
            yAxis: {
                title: {
                    text: 'Değerler'
                }
            },
            tooltip: {
                shared: true
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    lineWidth: 1,
                    marker: {
                        enabled: false
                    },
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
    
            series: [{
                type: 'area',
                name: '<?= SiteController::getParams_("currency",$id)?>',
                pointInterval: 24 * 3600 * 1000,
				<?PHP
				
				$datebas2=date("Y-m-d",strtotime('-31 day',strtotime($datebas)));
				$datebas2=new DateTime($datebas2);
				?>
                pointStart: Date.UTC(<?=$datebas2->format("Y")?>, <?=$datebas2->format("m")?>, <?=str_pad($datebas2->format("d"), 2, "0", STR_PAD_LEFT);?>),
                data: [
				<?PHP foreach($veri1 as $key=>$value){
					 $value=(object)$value;
					 if(@$value->currencyID){
					 	if($id!=0)
							echo number_format(curAccount2($value->currencyID,$value->dateAdd,Yii::app()->user->getState('companyCur')),3).",";	
						else
							echo number_format($value->cur,3).",";		
					}else
						echo "0,";	
				}
				?>
                   
                ]
            }]
         });
    });
		
		
</script>   
 <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script src="<?=Yii::app()->baseUrl?>/js/highchart/highcharts.js"></script>
<script src="<?=Yii::app()->baseUrl?>/js/highchart/modules/exporting.js"></script>  

<div id="container<?=$type?>" class="item" style="min-width: 310px; height: 300px; margin: 0 auto"></div>    
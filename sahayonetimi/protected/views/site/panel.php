<style type="text/css">

.span-19{
	width:97%;
}
</style>


        <div class="middleContent clearfix">  
        	<div class="td1"> 
                <span class="mainAN">
                    <?=Yii::t('trans','Anasayfa')?>
                    
                </span>
                <div class="clear"></div>
                <span class="ozetTitle"><?=Yii::t('trans','Tüm Panel İçeriklerinin Özet Görüntüleri')?></span>
            </div>
            
            <div class="td2">
            <!--date-->
				<?PHP 
                function haftanin_gunu($tarih)
                {
                    $gunler = array();
                    $gunler[0] = "Pazar";
                    $gunler[1] = "Pazartesi";
                    $gunler[2] = "Salı";
                    $gunler[3] = "Çarşamba";
                    $gunler[4] = "Perşembe";
                    $gunler[5] = "Cuma";
                    $gunler[6] = "Cumartesi";
                 
                    return $gunler[strftime("%w",strtotime($tarih))];
                }
                
                function ay($ays){
                    $ay["01"]="Ocak";
                    $ay["02"]="Şubat";
                    $ay["03"]="Mart";
                    $ay["04"]="Nisan";
                    $ay["05"]="Mayıs";
                    $ay["06"]="Haziran";
                    $ay["07"]="Temmuz";
                    $ay["08"]="Ağustos";
                    $ay["09"]="Eylül";
                    $ay["10"]="Ekim";
                    $ay["11"]="Kasım";
                    $ay["12"]="Aralık";
                    return $ay[$ays];
                }
                ?>
                <div class="date">
                    <span class="day"><?=date("d")?></span>
                    <span class="mounth">
                        <span><?=haftanin_gunu(date("Y-m-d"));?></span>
                         <?= ay(date("m"))?> <?=date("Y")?>
                    </span>
                </div>
                <!--date finish-->
                
            </div>
        </div>
        <!--middleContent finish-->
      
		<div class="mainBottom">
            <b>Sistem Mesajı </b>"yeni görevler eklendi."
        </div>

<div class="boxMini">
            <div class="boxHeader">
                <span class="boxTask"></span><?=Yii::t('trans','Ziyaretler')?> <!--<a href="#" title="Yeni ziyaret Ekle" class="addItem tooltip">Ekle</a>-->
            </div>
            <ul class="taskList">
                                                 
            </ul>
        </div>

    	<div class="boxMini">
            <div class="boxHeader">
                <span class="boxCalendar"></span><?=Yii::t('trans','Randevular')?> <!--<a href="#" title="Yeni Randevu Ekle" class="addItem tooltip">Ekle</a>-->
            </div>
           <?php
		   
function randevuS($id){
	if($id<10){
		$date=date("Y-m")."-0".$id." 00:00:00";
		$dateN=date("Y-m")."-0".$id." 23:59:59";
	}else{
		$date=date("Y-m")."-".$id." 00:00:00";
		$dateN=date("Y-m")."-".$id." 23:59:59";
	}
	$criteria=new CDbCriteria;
	$criteria->select='*';
	$criteria->condition="appointmentDate >=:date and  appointmentDate<=:dateN AND worldID=:worldID AND companyID=:companyID";
	$criteria->params=array(
	':date'=>$date,':dateN'=>$dateN,
	':companyID'=>yii::app()->user->getState('companyID'),
	':worldID'=>yii::app()->user->getState('worldID'),);
	$modelAppointments=Appointments::model()->count($criteria);
	if($modelAppointments>0){
		if(date("d")<=$id)
			return 1;
		else
			return 2;
	}
	
	return 0;
}

function ays($ays){
				$ay["01"]="Ocak";
				$ay["02"]="Şubat";
				$ay["03"]="Mart";
				$ay["04"]="Nisan";
				$ay["05"]="Mayıs";
				$ay["06"]="Haziran";
				$ay["07"]="Temmuz";
				$ay["08"]="Ağustos";
				$ay["09"]="Eylül";
				$ay["10"]="Ekim";
				$ay["11"]="Kasım";
				$ay["12"]="Aralık";
				return $ay[$ays];
}
function showCalendar(){
    // Get key day informations. 
    // We need the first and last day of the month and the actual day
	$today    = getdate();
	$firstDay = getdate(mktime(0,0,0,$today['mon'],1,$today['year']));
	$lastDay  = getdate(mktime(0,0,0,$today['mon']+1,0,$today['year']));
	
	
	// Create a table with the necessary header informations
	echo '<table>';
	echo '  <tr><th colspan="7">'.ays(date("m"))." - ".$today['year']."</th></tr>";
	echo '<tr class="days">';
	echo '  <td>'.Yii::t('trans','Pazartesi').'</td><td>'.Yii::t('trans','Salı').'</td><td>'.Yii::t('trans','Çarşamba').'</td><td>'.Yii::t('trans','Perşembe').'</td>';
	echo '  <td>'.Yii::t('trans','Cuma').'</td><td>'.Yii::t('trans','Cumartesi').'</td><td>'.Yii::t('trans','Pazar').'</td></tr>';
	
	
	// Display the first calendar row with correct positioning
	echo '<tr>';
	if ($firstDay['wday'] == 0) $firstDay['wday'] = 7;
	for($i=1;$i<$firstDay['wday'];$i++){
		echo '<td>&nbsp;</td>';
	}
	$actday = 0;
	for($i=$firstDay['wday'];$i<=7;$i++){
		$actday++;
		if ($actday == $today['mday']) {
			$class = ' class="actday"';
		} else {
			$class = '';
		}
		if(randevuS($actday)==1)
			echo '<td class="ab" id="ab'.$actday.'">'.$actday.'</td>';
		elseif(randevuS($actday)==2)
			echo '<td class="tm">'.$actday.'</td>';	
		else
			echo '<td class="ac">'.$actday.'</td>';
	}
	echo '</tr>';
	
	//Get how many complete weeks are in the actual month
	$fullWeeks = floor(($lastDay['mday']-$actday)/7);
	
	for ($i=0;$i<$fullWeeks;$i++){
		echo '<tr>';
		for ($j=0;$j<7;$j++){
			$actday++;
			if ($actday == $today['mday']) {
				$class = ' class="actday"';
			} else {
				$class = '';
			}
			if(randevuS($actday)==1)
			echo '<td class="ab" id="ab'.$actday.'">'.$actday.'</td>';
			elseif(randevuS($actday)==2)
				echo '<td class="tm" id="tm'.$actday.'">'.$actday.'</td>';	
			else
				echo '<td class="ac">'.$actday.'</td>';
		}
		echo '</tr>';
	}
	
	//Now display the rest of the month
	if ($actday < $lastDay['mday']){
		echo '<tr>';
		
		for ($i=0; $i<7;$i++){
			$actday++;
			if ($actday == $today['mday']) {
				$class = ' class="actday"';
			} else {
				$class = '';
			}
			
			if(randevuS($actday)==1)
			echo '<td class="ab">'.$actday.'</td>';
			elseif(randevuS($actday)==2)
				echo '<td class="tm">'.$actday.'</td>';	
			else
				echo '<td class="ac">'.$actday.'</td>';
		}
		
		
		echo '</tr>';
	}
	
	echo '</table>';
}

showCalendar();
?>
        </div>
        <div class="clear"></div>  
        <div class="popAppointments"></div>
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
	if(Yii::app()->user->getState('companyCur')!=1)
		$criteria->condition="dateAdd >=:date and  dateAdd<=:dateN AND currencyID=1";
	else
		$criteria->condition="dateAdd >=:date and  dateAdd<=:dateN AND currencyID=2";
		
	$criteria->params=array(
		':date'=>$datebas,':dateN'=>date("Y-m-d"),
	);
	$modelCurrencyd1=Currencyd::model()->findAll($criteria);
	
	
	$criteria=new CDbCriteria;
	$criteria->select='*';
	
	$criteria->condition="dateAdd >=:date and  dateAdd<=:dateN AND currencyID=2";
			
	$criteria->params=array(
		':date'=>$datebas,':dateN'=>date("Y-m-d"),
	);
	$modelCurrencyd2=Currencyd::model()->findAll($criteria);
	
	$data1=array();
	foreach($modelCurrencyd1 as $key=>$value){
		$data1[$value->dateAdd]=array('cur'=>$value->cur,'dateAdd'=>$value->dateAdd,'currencyID'=>$value->currencyID);
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
	
	$data2=array();
	foreach($modelCurrencyd2 as $key=>$value){
		$data2[$value->dateAdd]=array('cur'=>$value->cur,'dateAdd'=>$value->dateAdd,'currencyID'=>$value->currencyID);
	}
	$veri2=array();
	
	$datebas2=$datebas;
	for($i=0;$i<31;$i++){
		if(@$data2[$datebas2])
			$veri2[$datebas2]=array("cur"=>$data2[$datebas2]["cur"],"currencyID"=>$data2[$datebas2]["currencyID"],'dateAdd'=>$data2[$datebas2]["dateAdd"]);
		else
			$veri2[$datebas2]=array("cur"=>0);
		$datebas2=date("Y-m-d",strtotime('+1 day',strtotime($datebas2)));
	}
	
?>        
<script type="text/javascript">
Abkontrol=false;
$('.ab').hover(function(){
	if(Abkontrol==false){
		element=$(this);
		$('.popAppointments').css('top',$(element).position().top+40);
		$('.popAppointments').css('left',$(element).position().left-268);
		$('.popAppointments').slideDown("fast");
		
		$('.popAppointments').html("&nbsp;");
		Abkontrol=true;
		$.post("<?=Yii::app()->createUrl("site/hoverappointment")?>",{day:$(this).prop('id')},function(data){
		
			$('.popAppointments').html(data);
			
		});
		}
},function(){

	Abkontrol=false;
	$('.popAppointments').slideUp("fast");
	$('.popAppointments').html("");
});


Tmkontrol=false;
$('.tm').hover(function(){
	if(Tmkontrol==false){
		element=$(this);
		$('.popAppointments').css('top',$(element).position().top+40);
		$('.popAppointments').css('left',$(element).position().left-267);
		$('.popAppointments').slideDown("fast");
		
		$('.popAppointments').html("&nbsp;");
		Tmkontrol=true;
		$.post("<?=Yii::app()->createUrl("site/hoverappointment")?>",{day:$(this).prop('id')},function(data){
			$('.popAppointments').html("");
			
			$('.popAppointments').html(data);
			
		});
		}
},function(){

	Tmkontrol=false;
	$('.popAppointments').html("");
	$('.popAppointments').slideUp("fast");
});


$(function () {
        $('#container1').highcharts({
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
                name: '<?PHP
                    	if(Yii::app()->user->getState('companyCur')==1)
							echo "EUR";
						else
							echo "USD";
					?>',
                pointInterval: 24 * 3600 * 1000,
				<?PHP
				
				$datebas2=date("Y-m-d",strtotime('-31 day',strtotime($datebas)));
				$datebas2=new DateTime($datebas2);
				?>
                pointStart: Date.UTC(<?=$datebas2->format("Y")?>, <?=$datebas2->format("m")?>, <?=str_pad($datebas2->format("d"), 2, "0", STR_PAD_LEFT);?>),
                data: [
				<?PHP foreach($veri1 as $key=>$value){
					 $value=(object)$value;
					 if(@$value->currencyID)
						echo number_format(curAccount2($value->currencyID,$value->dateAdd,Yii::app()->user->getState('companyCur')),3).",";			else
						echo "0,";	
				}
				?>
                   
                ]
            }]
        });
		
		
		$('#container2').highcharts({
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
                name: '<?PHP
                    	if(Yii::app()->user->getState('companyCur')==2 || Yii::app()->user->getState('companyCur')==1)
							echo "TL";
						else
							echo "EUR";
					?>',
                pointInterval: 24 * 3600 * 1000,
				<?PHP
				$datebas2=date("Y-m-d",strtotime('-31 day',strtotime($datebas)));
				$datebas2=new DateTime($datebas2);
				?>
                pointStart: Date.UTC(<?=$datebas2->format("Y")?>, <?=$datebas2->format("m")?>, <?=str_pad($datebas2->format("d"), 2, "0", STR_PAD_LEFT);?>),
                data: [
				<?PHP foreach($veri2 as $key=>$value){
					$value=(object)$value;
					if(Yii::app()->user->getState('companyCur')==1 || Yii::app()->user->getState('companyCur')==2)
							if(@$value->currencyID)
								echo number_format(curAccountTL(Yii::app()->user->getState('companyCur'),$value->dateAdd),3).",";
							else
								echo "0,";	
		
						else{
						
							 if(@$value->currencyID)
								echo number_format(curAccount2($value->currencyID,$value->dateAdd,Yii::app()->user->getState('companyCur')),3).",";		else
								echo "0,";	
						
					}		
					
				}
				?>
                    
                ]
            }]
        });
    });
    

</script>        
<script src="<?=Yii::app()->baseUrl?>/js/highchart/highcharts.js"></script>
<script src="<?=Yii::app()->baseUrl?>/js/highchart/modules/exporting.js"></script>      
        <div class="boxBig">
        	 <div class="boxHeader">
                <span class="boxPerform"></span><?=Yii::t('trans','Piyasalar')?>
          		
       		 </div>
             
             <div class="pColumn">
             
                	<div class="titlesP"><?=Yii::app()->user->getState('companyCurText')?> ->
					<?PHP
					
					foreach(SiteController::getParams("currency") as $key=>$value){
						if(Yii::app()->user->getState('companyCur')!=$key)
							$arr[$key]=$value;
					}
					
                    	if(Yii::app()->user->getState('companyCur')==1)
							echo CHtml::dropDownList("cur1",2,$arr,array('style'=>'width:80px'));
						else
							echo CHtml::dropDownList("cur1",1,$arr,array('style'=>'width:80px'));
					?>
                    </div>
                    <div class="cont">
                    	<div id="container1" class="item" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
					</div>
            </div>
            
            <div class="pColumn right" style="margin-right:inherit;">
                <div class="titlesP"><?=Yii::app()->user->getState('companyCurText')?> ->
                <?PHP
                    	if(Yii::app()->user->getState('companyCur')==1 || Yii::app()->user->getState('companyCur')==2)
							echo CHtml::dropDownList("cur2",0,$arr,array('style'=>'width:80px'));
						else
							echo CHtml::dropDownList("cur2",2,$arr,array('style'=>'width:80px'));
					?>
                
                </div>
                 <div class="cont">
                	<div id="container2" class="item" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
				</div>
            </div>
        </div>

<script type="text/javascript">
$('#cur1').change(function(){
	var ids=$(this).val();
	var element=$(this);
	$(this).parent().next('.cont').html('<div style="text-align:center;padding-top:130px;height:170px;"><img src="<?=Yii::app()->baseUrl?>/images/loading.gif" /></div>');
	$.post("<?=Yii::app()->createUrl("site/getcur")?>/"+ids,{type:1},function(data){
		
		$(element).parent().next('.cont').html(data);
	});
});

$('#cur2').change(function(){
	var ids=$(this).val();
	var element=$(this);
	$(this).parent().next('.cont').html('<div style="text-align:center;padding-top:130px;height:170px;"><img src="<?=Yii::app()->baseUrl?>/images/loading.gif" /></div>');
	$.post("<?=Yii::app()->createUrl("site/getcur")?>/"+ids,{type:2},function(data){
		
		$(element).parent().next('.cont').html(data);
	});
});
</script>
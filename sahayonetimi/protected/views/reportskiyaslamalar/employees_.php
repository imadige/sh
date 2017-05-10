

  <?php echo CHtml::dropDownList('cur', $cur,ReportskiyaslamalarController::getParams("currency")); ?>
     <?=Chtml::dropDownList("raporlamacd",$raporlamacd,ReportskiyaslamalarController::getParams("raporlamacd"),array('style'=>'min-width:150px;width:150px;'))?>
     
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
              'style'=>'margin:-10px 0px 0px 20px;height:50px;',
              'onclick'=>'reportX()',
            ),
          )); ?>

<div class="reportset">
 <?=$this->renderPartial("menu/reportupmenu");?>
 </div>

 <script type="text/javascript">

var renk=new Array();
renk[0]="#337cd0";
renk[1]="#0d233a";
renk[2]="#8bbc21";
renk[3]="#89270c";
renk[4]="#1aadce";
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar',
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
                        return this.value +' <?=ReportskiyaslamalarController::getParams_("currency",$cur)?>'
                    }
                }
            },
              xAxis: {
                 categories: [<?PHP
                
                
                foreach($command as $key =>$value){
                    $value=(object)$value;
                    echo "'".mb_substr($value->name,0,40,"UTF-8")."',";
                }
                 ?>],
                
            },
            credits: {
                enabled: false
            },
              tooltip: {
            
                formatter: function () {
                    var s = '<span style="font-size:10px;font-weight:700;color:#333">'+this.x + '</span><br>';
                    s+='<span style="color:'+renk[<?=$raporlamacd?>]+';font-weight:700;">'+this.series.name+':</span> '+Highcharts.numberFormat(this.y)+' <?=ReportskiyaslamalarController::getParams_("currency",$cur)?>';
                    return s;
                }
              },
            series: [{
                name: '<?=ReportskiyaslamalarController::getParams_("raporlamacd",$raporlamacd)?>',
                data: [
                 <?PHP foreach($command  as $key=>$value){
                     $value=(object)$value;
                     echo $value->price.",";
                 }?>
                 ]
            }]
        });
    });
    </script>
    
    
 </div>
 
 <div class="clear"></div>

<div class="charts">    
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
  
<script>

function reportX(){
var data="<?=$array_?>";
   $.post("<?=Yii::app()->createUrl("reportskiyaslamalar/employees_")?>",{data:data,basTar:$('#basTar').val(),bitTar:$('#bitTar').val(),raporlamacd:$('#raporlamacd').val(),cur:$('#cur').val()},function(data){
      $('.reports_Ki').html(data);

     });
}


function siralaX(e){
var data="<?=$array_?>";
   $.post("<?=Yii::app()->createUrl("reportskiyaslamalar/employees_")?>?desc="+e,{data:data},function(data){
      $('.reports_Ki').html(data);

     });
}

function getirX(e){
var data="<?=$array_?>";
   $.post("<?=Yii::app()->createUrl("reportskiyaslamalar/employees_")?>?bt="+e,{data:data},function(data){
      $('.reports_Ki').html(data);

     });
}



</script>
<?PHP

$this->breadcrumbs=array(
	Yii::t('trans','Kıyaslamalar'),
	Yii::t('trans','Ülke Bazlı'),
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
  <div class="kiyastop clearfix">

  	<div class="ik1">
  	<?=Yii::t('trans','Ülke')?><br>
  	<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'name'=>'name',
			'attribute'=>'name',
			'id'=>'name',
			'options' => array(
                'showAnim' => 'fold',
                //remove if you dont need to store the id, like i do...
                'select' => 'js:function(event, ui){ 
				
					itemadd(ui.item.id,ui.item.label);
					$(this).val("");
					return false;
				}'
            ),

			'source'=>$this->createUrl('customers/getcountry'),
			'htmlOptions'=>array(
				'size'=>'50'
			),
		)); 
		?>
		<div class="button">
		 <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'small',
            'label'=>Yii::t('trans','Raporla'),
			'htmlOptions'=>array(
				'style'=>'padding:10px 50px 10px 50px',
				'onclick'=>'raporla()'
			),
        	)); ?>
        </div>
  	</div>

  	<div class="ik2">

  	</div>
  </div>
<script src="<?=Yii::app()->baseUrl?>/js/highchart/highcharts.js"></script>
<script src="<?=Yii::app()->baseUrl?>/js/highchart/modules/exporting.js"></script> 

  <div class="reports_Ki">
  </div>
</div>

<script>

var dataItem=new Array();

var idT=0;
function itemadd(id,label){
	dataItem[idT]=id;

	$('.ik2').append('<div class="clear item clearfix" ><div class="val">'+label+'</div> <div class="delete"><a href="javascript:;" id="'+id+'" onclick="itemDelete(this)"><img src="<?=Yii::app()->baseUrl?>/images/delete.png" /></a></div></div>');
	idT++;
}

function itemDelete(element){
	var ids=dataItem.indexOf($(element).prop("id")); 
	delete dataItem[ids];
	$(element).parent().parent().remove();

}

function raporla(){
	if(dataItem.length<1){
		alert("Lütfen Ülke Belirtiniz.");

	}else{
		var data_="";
		for(dt in dataItem)
			data_+=dataItem[dt]+",";

		$('.reports_Ki').html('<div class="loading"><img src="<?=Yii::app()->baseUrl?>/images/loading.gif" /></div>');
		 $.post("<?=Yii::app()->createUrl("reportskiyaslamalar/country_")?>",{data:data_},function(data){
		 	$('.reports_Ki').html(data);

		 });
	}


}
</script>
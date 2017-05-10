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
.input-append .add-on, .input-prepend .add-on{
	height:25px;
	margin-top:3px;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'message-form',
	'enableAjaxValidation' => false,
	
)); ?>


	<p class="note" style="margin-top:30px;"><?=Yii::t('trans','Lütfen yıldızlı(*) alanları boş bırakmayınız.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row clear">
		<?php echo $form->labelEx($model,'whomTextField'); ?>
		
  	<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'name'=>'whomTextField',
			'attribute'=>'whomTextField',
			'id'=>'whomTextField',
			'options' => array(
                'showAnim' => 'fold',
                //remove if you dont need to store the id, like i do...
                'select' => 'js:function(event, ui){ 
                	if(ui.item.id=='.Yii::app()->user->getState("ID").')
                		return false;
                	addEmployees(ui.item.id,ui.item.label);
					$(this).val("");
					return false;
				}'
            ),

			'source'=>$this->createUrl('employees/getemployees'),
			'htmlOptions'=>array(
				'size'=>'50'
			),
		)); 
		?>
		<?php echo $form->hiddenField($model,'whomID'); ?>
	</div>
	<div class="row clear employeesmessage">
			<?php

			if($model->whomID!=""){
				$datab=explode(",",substr($model->whomID,0,strlen($model->whomID)-1));
			
				foreach($datab as $key=>$value){
					$value=explode(":",$value);
					echo '<div class="item">'.$value[1].'<span class="closeEx" onclick="deleteEmployees('.$value[0].',this)"><img src="'.Yii::app()->baseUrl.'/images/delete.png"></span></div>';

				}
			}

			?>
			<?php echo $form->error($model,'whomID'); ?>
	</div>
	<div class="row clear">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('style'=>'width:500px;height:150px;')); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>



	<div class="row buttons clear">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
           	 'type'=>'primary',
			 'size' => 'large',
			 
            'label'=>Yii::t('trans','Gönder'),
           
	 		
        	)); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->


<script>
var employees =new Array();
function addEmployees(id,label){
	if(employees[id]!=label){
		employees[id]=label;
		$(".employeesmessage").append('<div class="item">'+label+'<span class="closeEx" onclick="deleteEmployees('+id+',this)"><img src="<?=Yii::app()->baseUrl;?>/images/delete.png"></span></div>');

		sctkl();
	}
}

function deleteEmployees(id,element){
	$(element).parent().remove();
	delete employees[id];
	sctkl();
	
}


function sctkl(){

	$("#Messages_whomID").val("");
	for(key in employees){
		$("#Messages_whomID").val($("#Messages_whomID").val()+key+":"+employees[key]+",");
	}
}
</script>
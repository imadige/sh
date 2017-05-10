<?PHP

$this->breadcrumbs=array(
	Yii::t('trans','Kullanıcılar')=>array('index'),
	$model->name=>array('view','id'=>$model->employeesID),
	Yii::t('trans','Resim Ekle'),
);

?>
<h1><?=Yii::t('trans','Kullanıcı')?> #<?php echo $model->name; ?></h1>

<div class="addLogoContent clearfix">
  <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'logo-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>
  <?php echo $form->errorSummary($model); ?>
    <div class="formcontent">
    
    	<div class="baslik" style="color:#329b9b;font-weight:700;text-align:center;">
        <?= Yii::t('trans','Resim Ekleyin');?>
        </div>
    
         
         <div class="input clearfix" style="text-align:center;">
             <div class="form">
       		
  
            <div class="row">
                <?php echo $form->FileField($model,'avatar',array('size'=>40)); ?>
                <?php echo $form->error($model,'avatar'); ?>
              
                 <?php echo $form->hiddenField($model,'logoLogo'); ?>
            </div>
          
            <div class="celarfix">
           <table style="margin:auto;">
          		 <tr>
           			<td>
                    
                     <?php 
					
					 	echo CHtml::link(Yii::t('trans','Resmi Ekle'),'javascript:void(0)',array('class'=>'daBt','onclick'=>'javascript:$("#logo-form").submit()')); 
					
					?>
             		</td>
        		    <td>
              		<?php
					
					
						 echo CHtml::link(Yii::t('trans','Bu Adımı Atla'),'javascript:void(0)',array('class'=>'daBt','onclick'=>'javascript:atla()')); 
					 ?>
              		</td>
              	</tr>
          </table> 
            </div>
       
         	</div>
    	</div>
    </div>
<?php $this->endWidget();?>
</div><!--addLogoContent-->
<script type="text/javascript">
function atla(){
	window.location.href="<?= Yii::app()->createUrl("employees/view/".$model->employeesID)?>";
}

<?PHP if(!empty($model->logo)){  ?>

 $('.logocontent2').css('width',$('.jcrop-holder').css('width'));
 
<?PHP }?>


</script>
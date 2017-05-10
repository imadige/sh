<?PHP
	$this->breadcrumbs=array(
	Yii::t('trans','Ürünler')=>array('admin'),
	$modelProduct->name=>array('update','id'=>$modelProduct->productsID),
	Yii::t('trans','Resim düzenle'),
);

?>

<div class="addLogoContent clearfix">
  <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'logo-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <script type="application/javascript" src="<?=Yii::app()->baseUrl?>/js/jcrop/jquery.Jcrop.min.js"></script>
    <script type="application/javascript" src="<?=Yii::app()->baseUrl?>/js/jcrop/jquery.color.js"></script>
     <link rel="stylesheet" href="<?=Yii::app()->baseUrl?>/js/jcrop/jquery.Jcrop.css" type="text/css" media="all" />
    <?=CHtml::activeHiddenField($model, 'cropID');?>
    <?=CHtml::activeHiddenField($model, 'cropX', array('value' => '0'));?>
    <?=CHtml::activeHiddenField($model, 'cropY', array('value' => '0'));?>
    <?=CHtml::activeHiddenField($model, 'cropW', array('value' => '100'));?>
    <?=CHtml::activeHiddenField($model, 'cropH', array('value' => '100'));?>
    <?PHP $previewWidth = 100; $previewHeight = 100;?>
    <?PHP 
	
	
	$this->widget('ext.yii-jcrop.jCropWidget',array(
         'imageUrl'=>Yii::app()->baseUrl.'/resimler/productimages/'.$modelProduct->productsID.'/'.$model->images,
        'formElementX'=>'Productimages_cropX',
        'formElementY'=>'Productimages_cropY',
        'formElementWidth'=>'Productimages_cropW',
        'formElementHeight'=>'Productimages_cropH',
        'previewId'=>'avatar-preview', //optional preview image ID, see preview div below
        'previewWidth'=>$previewWidth,
        'previewHeight'=>$previewHeight,
        'jCropOptions'=>array(
            'boxWidth'=>600,
            'boxHeight'=>600,
            'setSelect'=>array(20, 20, 300, 300),
        ),
    )
    );
    ?>
     
        

    <div class="formcontent">
    
         
         <div class="input clearfix" style="text-align:center;">
             <div class="form">
       		
            <div class="celarfix">
           <table style="margin:auto;">
          		 <tr>
           			<td>
                    
                     <?php 
				
             			echo CHtml::link(Yii::t('trans','Tamam'),'javascript:void(0)',array('class'=>'btn btn-primary','onclick'=>'javascript:$("#logo-form").submit()','style'=>'margin-left:100px')); 
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

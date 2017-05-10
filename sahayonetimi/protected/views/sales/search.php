
<?PHP
$modelSearch=new Products;

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl("sales/search"),
	'id'=>'search-form',
	'enableAjaxValidation'=>false,
	'method'=>'get',
)); ?>
<div class="search clearfix">
	<div class="titles"><?=Yii::t('trans','Detaylı Ara')?></div>
    
    <div class="searcGroup">
        <div class="item">
            <span class="title"><?=Yii::t('trans','Ürün İsmi')?>:</span><br />
           <?PHP
		   $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model'=>$modelSearch,
			'attribute'=>'name',
			
			'source'=>$this->createUrl('sales/getSearchName'),
			'htmlOptions'=>array(
				'size'=>'40',
				'style'=>'width:500px',
				'value'=>$model->name,
			),
			));
		   ?>
        </div>
    
      
    
     </div>
     
     <div class="searcGroup clear">
       <div class="item">
             <span class="title"><?=Yii::t('trans','Model İsmi')?>:</span><br />
			  <?PHP
               $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$modelSearch,
                'attribute'=>'model',
                
                'source'=>$this->createUrl('sales/getSearchModel'),
                'htmlOptions'=>array(
                    'size'=>'40',
                    'value'=>$model->model,
                ),
                ));
               ?>
        </div>
        
         <div class="item">
            <span class="title"><?=Yii::t('trans','Marka İsmi')?>:</span><br />
            <?PHP
               $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$modelSearch,
                'attribute'=>'brand',
                
                'source'=>$this->createUrl('sales/getSearchBrand'),
                'htmlOptions'=>array(
                    'size'=>'40',
                    'value'=>$model->brand,
                ),
                ));
               ?>
        </div>
     </div>
     
     <div class="searcGroup ">
       
    
        <div class="item">
             <span class="title"><?=Yii::t('trans','Ürün Grubu')?>:</span><br />
             
             <?php echo $form->dropDownList($modelSearch,'productgroupsID',SalesController::getProductgroups_(2)); ?>
          
        </div>
    
     </div>
     
     <div class="clear" style="width:514px;">
         <div class="item">
             <?php $this->widget('bootstrap.widgets.TbButton', array(
                  
             'type'=>'info',
             'size' => 'small',
             'buttonType' => 'submit',
             'htmlOptions'=>array('style'=>'float:right;padding:5px 30px 5px 30px'),
            'label'=>Yii::t('trans','Ara'),
            )); ?>
        </div>
     </div>
     
	<?php echo $form->hiddenField($modelSearch,'nameorder',array('value'=>$model->nameorder)); ?>
    <?php echo $form->hiddenField($modelSearch,'saleorder',array('value'=>$model->saleorder)); ?>
    <?php echo $form->hiddenField($modelSearch,'brandorder',array('value'=>$model->brandorder)); ?>
    <?php echo $form->hiddenField($modelSearch,'modelorder',array('value'=>$model->modelorder)); ?>
</div>

<?php $this->endWidget(); ?>
<div class="hAMenu">
                	
                    <div class="title"><?=Yii::t('trans','ARA')?></div>
                    
                    <div class="item curnone clearfix">
                    	<div class="Xq clearfix">
                    		 <a href="javascript:;"><img src="<?=Yii::app()->baseUrl?>/images/icon/search.png" />	</a>
                             <span class="text"><?=CHtml::textField("search",'', array('class'=>'search'))?></span>
                     	 </div>
                    </div>
                    
                	<div class="title"><?=Yii::t('trans','TÜM KATEGORİLER')?></div>
                    
                   


                    <ul id="menu" class="clearfix">
        
        <?PHP
        $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")),
             'order'=>'name asc',
             ));
            
        foreach($modelCustomergroups as $key=>$value){
            
            $value=(object)$value;
                    
            if($value->pgID==0){
                echo "<li >";
                echo '<a href="javascript:;" onclick="javascript:goto('.$value->productgroupsID.')">'.$value->name.'</a>';
                
                unset($modelCustomergroups[$key]);
                group_Find_Sub_Cats($modelCustomergroups, $value->productgroupsID);	
            
            }
            
        }
        
        
        
            
        function group_Find_Sub_Cats(&$modelCustomergroups, $productID){
            $i=0;
            foreach ($modelCustomergroups as $key => $value)
            {
                if ($value->pgID == $productID)
                {
                    $i++;
                }
            }
            
            if($i>0)
                echo "<ul>";
            foreach ($modelCustomergroups as $key => $value)
            {
                $value=(object)$value;
                
                if ($value->pgID == $productID)
                {
                    
                    
                    echo "<li>";
                    echo '<a href="javascript:;" onclick="javascript:goto('.$value->productgroupsID.')">'.$value->name.'</a>';
                
                    group_Find_Sub_Cats($modelCustomergroups, $value->productgroupsID);
                }
            }
            
            if($i>0)
                echo "</ul>";
            
        }
        ?>
        </ul>
                    
 </div>
 
 <?php
 $modelSearch=new Products;
  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl("sales/search"),
	'id'=>'menu-form',
	'enableAjaxValidation'=>false,
	'method'=>'get',
)); ?>
	<?php echo $form->hiddenField($modelSearch,'productgroupsID'); ?>
<?php $this->endWidget(); ?>

<script type="text/javascript">

function goto(ids){
	$('#Products_productgroupsID').val(ids);
	$('#menu-form').submit();
}
</script>
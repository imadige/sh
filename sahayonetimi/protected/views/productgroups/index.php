<?php
/* @var $this CompaniesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('trans','Ürün Grubları'),
);

$this->menu=array(
	array('label'=>Yii::t('trans','Grub Oluştur'), 'url'=>array('create')),

);
?>

<h1><?=Yii::t('trans','Ürün Grubları - Yönet')?></h1>

<div style="margin-top:50px">
<link rel="stylesheet" href="<?= Yii::app()->baseUrl?>/css/tree/jquery.treeview.css" />

<script src="<?= Yii::app()->baseUrl?>/js/tree/lib/jquery.cookie.js" type="text/javascript"></script>
<script src="<?= Yii::app()->baseUrl?>/js/tree/jquery.treeview.js" type="text/javascript"></script>

<script type="text/javascript" src="<?= Yii::app()->baseUrl?>/js/tree/demo.js"></script>
<ul id="red" class="treeview-red" style="margin-top:15px;">
        
<?PHP
        $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")),
             'order'=>'name asc',
             ));
            
        foreach($modelCustomergroups as $key=>$value){
            
            $value=(object)$value;
                    
            if($value->pgID==0){
                echo "<li>";
                echo '<span class="groupSelect" id="a'.$value->productgroupsID.'">'.$value->name.' <a href="'.Yii::app()->createUrl("productgroups/update").'/'.$value->productgroupsID.'">(Düzenle)</a>&nbsp;&nbsp;<a href="'.Yii::app()->createUrl("productgroups/deletegroup").'/'.$value->productgroupsID.'">(Sil)</a></span>';
                
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
                    echo '<span class="groupSelect" id="a'.$value->productgroupsID.'">'.$value->name.' <a href="'.Yii::app()->createUrl("productgroups/update").'/'.$value->productgroupsID.'">(Düzenle)</a>&nbsp;&nbsp;<a href="'.Yii::app()->createUrl("productgroups/deletegroup").'/'.$value->productgroupsID.'">(Sil)</a></span>';
                
                    group_Find_Sub_Cats($modelCustomergroups, $value->productgroupsID);
                }
            }
            
            if($i>0)
                echo "</ul>";
            
        }
        ?>
        </ul>
</div>


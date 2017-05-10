<?php
function getParams($param){
		$params = new Params;
		return $params->get($param);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	
	<title><?= getParams('title')?></title>
    
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <?php Yii::app()->bootstrap->register(); ?>
</head>

<body>
<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

<div class="container">

	<div class="header clearfix">
    
    	
    	<div class="row buttons clear" style="float:right;margin-top:5px;">
       	 <?PHP if(Yii::app()->controller->action->id!="registration"){?>
                <?php echo CHtml::link(Yii::t('trans','HESAP OLUŞTRUN'),array('site/registration'),array('class'=>'button2')); ?>
         <?PHP }else{?>
         	<div style="height:15px;"></div>
         <?PHP }?>
        </div>
       
		<div class="logo clear"><a href="<?=Yii::app()->baseUrl?>"><img src="<?=Yii::app()->baseUrl?>/images/logo.png" /></a></div>

        <div class="menu">
             <ul>
                  <a href="#"><li>Referanslar</li></a>
                 <a href="#"><li>İletişim</li></a>
             </ul>
        </div>
	</div><!-- header -->
	
   
    
	<div class="content">
    <?=$content?>
    </div><!--content-->
    
</div><!-- container -->

</body>
</html>



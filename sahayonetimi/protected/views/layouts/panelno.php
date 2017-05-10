<?php
function getParams($param){
		$params = new Params;
		return $params->get($param);
}


function getEmployeesLogo40($file,$id){
		$empty=Yii::app()->baseUrl.'/images/avatar.png';
		if(!empty($file)){
			if(file_exists(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$id.'/'.$file))
				return Yii::app()->baseUrl.'/resimler/employees/'.$id.'/'.$file;
			else
				return $empty;
		}else
			return $empty;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?= getParams('title')?></title>
    
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    
</head>

<body>
<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/panel.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />

<div class="container">

	<div class="header clearfix">
    	<div class="logo">
        	<a href="<?=Yii::app()->createUrl("site")?>">
           		 <img src="<?=Yii::app()->baseUrl?>/images/logo.png" />
            </a>
        </div>
        
         <div class="menu">
        	<ul>
            	
                 <a href="#"><li>Ayarlar</li></a>
            	
                 <a href="#"><li>İletişim</li></a>
                 
                 <a href="<?=Yii::app()->createUrl("employees/accountview")?>" >
                 <li>
                     <div class="mainAvatar">
                        <img src="<?PHP 
						$modelEmployees=Employees::model()->findByPk(Yii::app()->user->getState("ID"));
						echo getEmployeesLogo40($modelEmployees->avatar,$modelEmployees->employeesID)?>
                        
                        " width="40" height="40" />
                     </div>
                     <div class="mainAvatarText">
                         <?=mb_substr(Yii::app()->user->getState("nameSurname"),0,20,"UTF-8");?>
                         <br />
                         <span><?=Yii::app()->user->getState("title")?></span>
                     </div>
				
                 </li>
                 
            	 </a>
                 <a href="<?=Yii::app()->createUrl("site/logout")?>" ><li><img style="margin-top:-2px;" src="<?=Yii::app()->baseUrl?>/images/logout.png" /></li></a>
            </ul>
        </div>
    </div><!-- header -->

	<div class="contentMenu clearfix">
    	<div class="home">
       		 <a href="<?=Yii::app()->createUrl("site")?>">
             	<img src="<?=Yii::app()->baseUrl?>/images/home.png" />
             </a>
        </div>
       
        
        <div class="world">
        	<div id="select">
       		 <a href="<?=Yii::app()->baseUrl?>" class="left">
             	<img src="<?=Yii::app()->baseUrl?>/images/world.png" class="worldicon" />
             </a>
               
            <div class="title">
            <?PHP
				$modelWorld=World::model()->cache($this->cache)->findByPk(Yii::app()->user->getState("worldID"));
				echo $modelWorld->name;
			?>
               
            </div>
            
             <img src="<?=Yii::app()->baseUrl?>/images/down.png" class="down" />
            </div>
             <div class="list">
             
             <?PHP
			 	$modelWorld=World::model()->cache($this->cache)->findAll("status=1 AND companyID=".Yii::app()->user->getState("companyID"));
				
				foreach($modelWorld as $key=>$value):
			 ?>
             	<a href="<?=Yii::app()->createUrl("site/setworld")?>/<?=$value->worldID?>"><div class="worlditem"><?=$value->name?></div></a>
               
                
                <?PHP endforeach;?>
             </div>
             
        </div>
    </div><!-- contentMenu -->
   
    <table class="contentMiddle">
        <tr>
            <td class="leftmenu">
          
            	<?=$this->renderPartial("//layouts/companymenu")?>
            </td>
            <td class="content">
			  <?php if(isset($this->breadcrumbs)):?>
                    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=>$this->breadcrumbs,
                    )); ?><!-- breadcrumbs -->
             <?php endif?>
         
			<div class="span-19">
                <div id="content">
                    <?php echo $content; ?>
                </div><!-- content -->
            </div>
            
            <?PHP  if(count($this->menu)>0):?>
              <div class="span-5 last">
                <div id="sidebar">
                <?php
              		 $this->beginWidget('zii.widgets.CPortlet', array(
						'title'=>Yii::t('trans','Hızlı Menü'),
					));
                    $this->widget('zii.widgets.CMenu', array(
                        'items'=>$this->menu,
                        'htmlOptions'=>array('class'=>'operations'),
                    ));
                    $this->endWidget();
                ?>
                </div><!-- sidebar -->
            </div>
           <?PHP endif?>
            </td>
        </tr>
    </table><!-- contentMiddle -->
 
    
</div><!-- container -->

</body>
</html>
<script type="text/javascript">
	var kontrol=false;
	$('#select').click(function(){
		if(kontrol==false){
			$(this).parent().children('.list').show();
			kontrol=true;
		}else
		{
			kontrol=false;
			$(this).parent().children('.list').hide();;
		}
	});
	
	
$('.help_').hover(function(){
	var thiss=$(this);
	$(this).append('<div class="help_div"></div>');
	$(this).children('.help_div').css({'top':$(thiss).position().top+15,'left':$(thiss).position().left});
	$(this).children('.help_div').html($(this).children('.text').html());
},function(){
	$(this).children('.help_div').remove();
});


$('.xTab').click(function(){
	
	if($(this).next('.altF').css('display')=='none')
		$(this).next('.altF').fadeIn();
	else
		$(this).next('.altF').fadeOut();
});
</script>
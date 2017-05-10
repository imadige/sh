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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<?php Yii::app()->bootstrap->register(); ?>
	
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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/table.css" />
    
    
    <div class="visitcontent" <?PHP if(@Yii::app()->user->getState("setVisitID")!=""){?>style="display:inline"<?PHP }?>>
    	<table>
        	<tr>
        		<td><span class="span"><?=Yii::t('trans','Ziyaret')?>:</span> <span class="textVisitCx"><?=@Yii::app()->user->getState("setVisitName")?></span>
                </td>
                <td>
                <a href="javascript:;" onclick="javascript:visitClear()"><img src="<?=Yii::app()->baseUrl?>/images/close2.png"  /></a>
                </td>
        	</tr>
        </table>
    </div>
    
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
            	
             <?PHP
            $criteria=new CDbCriteria;
            $criteria->select='name';
            $criteria->condition='employeesID=:employeesID';
            $criteria->params=array(':employeesID'=>Yii::app()->user->getState("ID"));
            $modelM=Messages::model()->count($criteria);

            $criteria=new CDbCriteria;
            $criteria->select='readd';
            $criteria->condition='readd=0 AND employeesID=:employeesID';
            $criteria->params=array(':employeesID'=>Yii::app()->user->getState("ID"));
            $modelMa=Messagesread::model()->count($criteria);


            $criteria=new CDbCriteria;
            $criteria->select='name';
            $criteria->condition='companyID=:companyID';
            $criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"));
            $modelT=Ticket::model()->count($criteria);

            $criteria=new CDbCriteria;
            $criteria->select='name';
            $criteria->condition='companyID=:companyID AND cevap=1';
            $criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"));
            $modelTa=Ticket::model()->count($criteria);



             ?>
                 <a href="<?=Yii::App()->createUrl("ticket/admin")?>"><li><img src="<?=Yii::app()->baseUrl?>/images/ticket.png"/>  Ticket (<?=$modelT?>/<?=$modelTa?>)</li></a>

                 <a href="<?=Yii::App()->createUrl("messages/admin")?>"><li><img src="<?=Yii::app()->baseUrl?>/images/message<?=$modelMa>0?"_":""?>.png"/> <?=Yii::t('trans','Mesajlar')?> (<?=$modelM?>/<?=$modelMa?>)</li></a>
                 
                 <a href="<?=Yii::app()->createUrl("employees/accountview")?>" >
                 <li>
                     <div class="mainAvatar">
                        <img src="<?PHP 
						$modelEmployees=Employees::model()->findByPk(Yii::app()->user->getState("ID"));
						echo getEmployeesLogo40($modelEmployees->avatar,$modelEmployees->employeesID)?>
                        
                        "  width="40" height="40" />
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


	<?PHP $this->renderPartial("//layouts/contentmenu")?>

     <div class="contentMiddle">
       <div class="leftmenu">
        <?=$this->renderPartial("//layouts/companymenu")?>
       </div>

        <div class="content">
              <?php if(isset($this->breadcrumbs)):?>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links'=>$this->breadcrumbs,
                        )); ?>
                 <?php endif?>
             
                <div class="span-19">
                    <div id="content">
                        <?php echo $content; ?>
                    </div>
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
                    </div>
                </div>
               <?PHP endif?>
           </div>
    </div>
  
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

function visitClear(){
	$.ajax({
			 type: "POST",
			 dataType:'json',  
			 url: "<?= Yii::app()->createUrl("visits/visitclear")?>", 
			 success: function(data)
			 {
				
				if(data.sonuc==1){
					$('.visitcontent').slideUp();
					
				}
			 }
			 
			});
}

$(document).ready(function(){
     $(".hAMenu").attr("style","height:"+(window.innerHeight-135)+"px;");
     $(".content").attr("style","width:79.8%;height:"+(window.innerHeight-175)+"px;overflow:scroll; overflow-x: hidden;");
     
});

$(window).resize(function(){
    $(".hAMenu").attr("style","height:"+(window.innerHeight-135)+"px;");
     $(".content").attr("style","width:79.8%;height:"+(window.innerHeight-175)+"px;overflow:scroll; overflow-x: hidden;");
     
});

</script>
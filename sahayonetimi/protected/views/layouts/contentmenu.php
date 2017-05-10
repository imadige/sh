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
         <?PHP
		 $colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
         $colorbox->addInstance('.colorbox', array('frame'=>true,'width'=>'80%', 'height'=>'93%'));

		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='t.worldID=:worldID AND t.companyID=:companyID AND t.employeesID=:employeesID';
		
		
		$criteria->params=array(
			':companyID'=>yii::app()->user->getState('companyID'),
			':worldID'=>yii::app()->user->getState('worldID'),
			':employeesID'=>yii::app()->user->getState('ID'),
		);
	
		$modelProductbasket=Productbasket::model()->count($criteria);
		 
		 ?>
        <div class="basket">
            <div class="btn-group right">
                <a class="btn colorbox" href="<?=Yii::app()->createUrl("sales/basket")?>"><img src="<?=Yii::app()->baseUrl?>/images/shopcart.png" /></a>
                <a class="btn dropdown-toggle colorbox" href="<?=Yii::app()->createUrl("sales/basket")?>">
               		<div class="count countBasket"><?=$modelProductbasket?></div>
                </a>
    
    		</div>
        </div>
    </div><!-- contentMenu -->
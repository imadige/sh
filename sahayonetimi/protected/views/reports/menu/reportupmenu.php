<table>
    	<tr>
        	<td class="ik"><?php echo CHtml::checkBox('allcustomers', $allcustomers); ?></td>
            <td><?=Yii::t('trans','Tümü')?></td>
          	

           <td class="ik"><a href="<?=Yii::app()->createUrl("reports/".Yii::app()->controller->action->id,array(
				'desc'=>2
			))?>"><img src="<?=Yii::app()->baseUrl?>/images/report/09.png" /></a></td>
            <td class="ik"><a href="<?=Yii::app()->createUrl("reports/".Yii::app()->controller->action->id,array(
				'desc'=>3
			))?>"><img src="<?=Yii::app()->baseUrl?>/images/report/90.png" /></a></td>
            <td class="ik"></td>

            <td class="ik"><a href="<?=Yii::app()->createUrl("reports/".Yii::app()->controller->action->id,array(
				'desc'=>0
			))?>"><img src="<?=Yii::app()->baseUrl?>/images/report/az.png" /></a></td>
            <td class="ik"><a href="<?=Yii::app()->createUrl("reports/".Yii::app()->controller->action->id,array(
				'desc'=>1
			))?>"><img src="<?=Yii::app()->baseUrl?>/images/report/za.png" /></a></td>
            <td class="ik"></td>
             
            <?PHP if($bt>0){?> 
            	<td class="ik iBi"><a href="<?=Yii::app()->createUrl("reports/".Yii::app()->controller->action->id,array(
				'bt'=> 0,
			))?>"><img src="<?=Yii::app()->baseUrl?>/images/report/fastback.png" /></a></td>
            <?PHP }else{?>
             	<td class="ik iBi"><img src="<?=Yii::app()->baseUrl?>/images/report/fastback_.png" /></td>
            <?PHP }?>
            
            <?PHP if($bt>0){?> 
            <td class="ik iBi"><a href="<?=Yii::app()->createUrl("reports/".Yii::app()->controller->action->id,array(
				'bt'=> ($bt>=$st?$bt-$st:0),
			))?>"><img src="<?=Yii::app()->baseUrl?>/images/report/back.png" /></a></td>
             <?PHP }else{?>
             	<td class="ik iBi"><img src="<?=Yii::app()->baseUrl?>/images/report/back_.png" /></td>
            <?PHP }?>
            
            <?PHP if($count-($bt+$st)>0){?> 
            <td class="ik iBi"><a href="<?=Yii::app()->createUrl("reports/".Yii::app()->controller->action->id,array(
				'bt'=> $bt+$st,
			))?>"><img src="<?=Yii::app()->baseUrl?>/images/report/next.png" /></a></td>
             <?PHP }else{?>
             	<td class="ik iBi"><img src="<?=Yii::app()->baseUrl?>/images/report/next_.png" /></td>
            <?PHP }?>
            
             <?PHP if($count-($bt+$st)>0){?> 
            <td class="ik iBi"><a href="<?=Yii::app()->createUrl("reports/".Yii::app()->controller->action->id,array(
				'bt'=> $count-$st,
			))?>"><img src="<?=Yii::app()->baseUrl?>/images/report/fastnext.png" /></a></td>
             <?PHP }else{?>
             	<td class="ik iBi"><img src="<?=Yii::app()->baseUrl?>/images/report/fastnext_.png" /></td>
            <?PHP }?>
             
        </tr>
    </table>
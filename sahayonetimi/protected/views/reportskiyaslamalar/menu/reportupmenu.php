<table>
    	<tr>
        	<td class="ik"><?php echo CHtml::checkBox('allcustomers', $allcustomers); ?></td>
            <td><?=Yii::t('trans','Tüm Bayiler')?></td>
          	

           <td class="ik"><a href="javascript:;" onclick="siralaX(2)"><img src="<?=Yii::app()->baseUrl?>/images/report/09.png" /></a></td>
            <td class="ik"><a href="javascript:;" onclick="siralaX(3)"><img src="<?=Yii::app()->baseUrl?>/images/report/90.png" /></a></td>
            <td class="ik"></td>

            <td class="ik"><a href="javascript:;" onclick="siralaX(0)"><img src="<?=Yii::app()->baseUrl?>/images/report/az.png" /></a></td>
            <td class="ik"><a href="javascript:;" onclick="siralaX(1)"><img src="<?=Yii::app()->baseUrl?>/images/report/za.png" /></a></td>
            <td class="ik"></td>
             
            
            <?PHP if($bt>0){?> 
                <td class="ik iBi"><a href="javascript:;" onclick="getirX(0)"><img src="<?=Yii::app()->baseUrl?>/images/report/fastback.png" /></a></td>
            <?PHP }else{?>
                <td class="ik iBi"><img src="<?=Yii::app()->baseUrl?>/images/report/fastback_.png" /></td>
            <?PHP }?>
            
            <?PHP if($bt>0){?> 
            <td class="ik iBi"><a href="javascript:;" onclick="getirX(<?=($bt>=$st?$bt-$st:0)?>)"><img src="<?=Yii::app()->baseUrl?>/images/report/back.png" /></a></td>
             <?PHP }else{?>
                <td class="ik iBi"><img src="<?=Yii::app()->baseUrl?>/images/report/back_.png" /></td>
            <?PHP }?>
            
            <?PHP if($count-($bt+$st)>0){?> 
            <td class="ik iBi"><a href="javascript:;" onclick="getirX(<?=($bt+$st)?>)"><img src="<?=Yii::app()->baseUrl?>/images/report/next.png" /></a></td>
             <?PHP }else{?>
                <td class="ik iBi"><img src="<?=Yii::app()->baseUrl?>/images/report/next_.png" /></td>
            <?PHP }?>
            
             <?PHP if($count-($bt+$st)>0){?> 
            <td class="ik iBi"><a href="javascript:;" onclick="getirX(<?=($count-$st)?>)"><img src="<?=Yii::app()->baseUrl?>/images/report/fastnext.png" /></a></td>
             <?PHP }else{?>
                <td class="ik iBi"><img src="<?=Yii::app()->baseUrl?>/images/report/fastnext_.png" /></td>
            <?PHP }?>
             
        </tr>
    </table>
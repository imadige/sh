<?PHP
	$controller=new Sitecontroller;
?>
<div class="cargocontent">
	<div class="logo"><img src="<?=$controller->getLogo()?>"/></div>
    <div class="titles"><?=Yii::t('trans','Kargo Takip')?></div>
 <form method="post">
 	<div class="item"><?=Yii::t('trans','Müşteri/Bayi Numarası')?>:<br><?=CHtml::textField("musteri",@$_GET["customerID"])?></div>
    <div class="item"><?=Yii::t('trans','Filo Numarası')?>:<br><?=CHtml::textField("filo",@$_GET["filoID"])?></div>
     <div class="item" style="color:#F00"><?PHP if($sonuc==0){echo Yii::t('trans','Hatalı giriş yaptınız.');}?></div>
    <div class="item">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                 'type'=>'primary',
                 'size' => 'large',
                'label'=>Yii::t('trans','Tamam'),
                )); ?>
    </div>
 </form>
</div>
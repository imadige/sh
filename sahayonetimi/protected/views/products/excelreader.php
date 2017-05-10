<?PHP
$this->breadcrumbs=array(
	Yii::t('trans','Ürünler')=>array('admin'),
	Yii::t('trans','EXCEL Toplu Ürün Ekle'),
);
?>

<style type="text/css">
input[type=text]{
	width:220px;
	height:25px;
	background:#CCE9F2;
	padding-left:10px;
}
input[type=password]{
	width:220px;
	height:25px;
	background:#CCE9F2;
	padding-left:10px;
}
select{
	width:238px;
	height:35px;
	background:#CCE9F2;
	padding-top:5px;
}
textarea{
	background:#CCE9F2;
}

.form{
	background-color:#E8F0EE;
	padding:10px 10px 10px 10px;
	margin-top:10px;
	border-radius:5px;
	
}
.groupSelect{
	cursor:pointer;
}

</style>

<div class="form">



   <div style="margin-bottom:50px;">
   		<?=Yii::t('trans','Excel yardımı ile toplu ürün giriş yapabilirsiniz.')?>
   </div>
   
   <div class="expressionTitle">
   <?=Yii::t('trans','Excel verilerin ayarlanışı')?>
   </div>
   
   <div class="expression">
   <img src="<?=Yii::app()->baseUrl?>/images/data/excel1.jpg" />
   </div>
   
   <div class="expression">
   
 
   <table class="expressionTable">
   		<tr class="title">
            <td width="50"><?=Yii::t('trans','Hücre')?></td>
            <td width="200"><?=Yii::t('trans','Alan ismi')?></td>
            <td width="300"><?=Yii::t('trans','Koşullar')?></td>
        </tr>
        
        <tr>
            <td class="bold">A:</td>
            <td><?=Yii::t('trans','Ürün tam adı')?></td>
            <td><?=Yii::t('trans','Maximum <b>75</b> karekter')?></td>
        </tr>
        
        <tr>
            <td class="bold">B:</td>
            <td><?=Yii::t('trans','Marka adı')?></td>
            <td><?=Yii::t('trans','Maximum <b>30</b> karekter')?></td>
        </tr>
        
        <tr>
            <td class="bold">C:</td>
            <td><?=Yii::t('trans','Model adı')?></td>
            <td><?=Yii::t('trans','Maximum <b>30</b> karekter')?></td>
        </tr>
        
        <tr>
            <td class="bold">D:</td>
            <td><?=Yii::t('trans','Alış Fiyatı')?></td>
            <td><?=Yii::t('trans','Metin formatta olmalıdır. <b>TL, USD, EU</b> parabirimlerini belirtiniz. Ondalıklı değer için <b>(.) nokta</b> işaretini kullanınız.')?></td>
        </tr>
        
         <tr>
            <td class="bold">E:</td>
            <td><?=Yii::t('trans','Satış Fiyatı')?></td>
            <td><?=Yii::t('trans','Metin formatta olmalıdır.  <b>TL, USD, EU</b> parabirimlerini belirtiniz.Ondalıklı değer için <b>(.) nokta</b> işaretini kullanınız.')?></td>
        </tr>
        
        <tr>
            <td class="bold">F:</td>
            <td><?=Yii::t('trans','İndirimli Fiyatı')?></td>
            <td><?=Yii::t('trans','Boş değer girebilirsiniz. Metin formatta olmalıdır. <b>TL, USD, EU</b> parabirimlerini belirtiniz.Ondalıklı değer için <b>(.) nokta</b> işaretini kullanınız.')?></td>
        </tr>
        
        <tr>
            <td class="bold">G:</td>
            <td><?=Yii::t('trans','Bayi Fiyatı')?></td>
            <td><?=Yii::t('trans','Boş değer girebilirsiniz. Metin formatta olmalıdır. <b>TL, USD, EU</b> parabirimlerini belirtiniz.Ondalıklı değer için <b>(.) nokta</b> işaretini kullanınız.')?></td>
        </tr>
       
        <tr>
            <td class="bold">H:</td>
            <td><?=Yii::t('trans','Ürün Grubu')?></td>
            <td><?=Yii::t('trans','Ürün grupları, <b>Ürünler->Ürün grupları</b> kısmından oluşturulmaktadır. Eğer grubu oluşturysanız ismini yazmanız yeterlidir. Yanlış veya boş veri girildiğinde, aksi halde hata alabilirsiniz.')?></td>
        </tr>
    </table>
   </div>
	
    <div class="row buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
          
			 'type'=>'primary',
			 'size' => 'large',
			 'buttonType' => 'link',
    		 'url'=>Yii::app()->createUrl("products/excelreaderadd"),
            'label'=>Yii::t('trans','Tamam anladım'),
        	)); ?>
	</div>

</div>
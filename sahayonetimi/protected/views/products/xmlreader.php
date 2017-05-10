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
   		<?=Yii::t('trans','Xml yardımı ile başka bir siteden toplu ürün giriş yapabilirsiniz. Bunun için bilgisayar yazılımcınıza danışınız.')?>
   </div>
   
   <div class="expressionTitle">
   <?=Yii::t('trans','Xml verilerin ayarlanışı')?>
   </div>
   
   <div class="expression">
   	<img src="<?=Yii::app()->baseUrl?>/images/data/xml1.jpg" />
   </div>
   
   
   <div class="expression">
   	<a href="javascript:;" onclick="javascript:sourcecode()"><?=Yii::t('trans','Xml kodu için tıklayınız.')?></a>
   </div>
   
   <div class="expression sourcecode" style="display:none;border:1px dashed #0099FF;background:#EFEFEF;padding:10px 10px 10px 10px;">
		<font color="#FF0000">&lt;?xml version="1.0" encoding="UTF-8"?&gt;</font>
        <br /><br />
       <font color="#0066FF"> &lt;product&gt;</font>
         <br />
         <font color="#0066FF"> &nbsp;&nbsp;&lt;item&gt;</font>
         <br />
        <font color="#0066FF">&nbsp;&nbsp;&nbsp;&nbsp;&lt;name&gt;<font color="#000000">Canon PowerShot A810 IS 16 MP 5x Optik 2,7"LCD Dijital Fotoğraf Makinesi</font>&lt;/name&gt;</font>
        <br />
        <font color="#0066FF">&nbsp;&nbsp;&nbsp;&nbsp;&lt;brand&gt;<font color="#000000">Canon</font>&lt;/brand&gt;</font>
        <br />
        <font color="#0066FF">&nbsp;&nbsp;&nbsp;&nbsp;&lt;model&gt;<font color="#000000">A810 IS</font>&lt;/model&gt;</font>
        <br />
        <font color="#0066FF">&nbsp;&nbsp;&nbsp;&nbsp;&lt;purchaseprice&gt;<font color="#000000">450 EU</font>&lt;/purchaseprice&gt;</font>
        <br />
        <font color="#0066FF">&nbsp;&nbsp;&nbsp;&nbsp;&lt;saleprice&gt;<font color="#000000">600 EU</font>&lt;/saleprice&gt;</font>
        <br />
        <font color="#0066FF">&nbsp;&nbsp;&nbsp;&nbsp;&lt;reducedprice&gt;<font color="#000000">530 EU</font>&lt;/reducedprice&gt; </font>    
        <br />
         <font color="#0066FF">&nbsp;&nbsp;&nbsp;&nbsp;&lt;reducedprice&gt;<font color="#000000">530 EU</font>&lt;/reducedprice&gt; </font>    
        <br />
        <font color="#0066FF">&nbsp;&nbsp;&nbsp;&nbsp;&lt;dealerprice&gt;<font color="#000000">510 EU</font>&lt;/group&gt; </font>    
        
        <br />
         <font color="#0066FF"> &nbsp;&nbsp;&lt;/item&gt;</font>
        
          <br />
        <font color="#0066FF">  &lt;/product&gt;</font>
   </div>
   
   <div class="expression">
   
 
   <table class="expressionTable">
   		<tr class="title">
            <td width="50">XML tag</td>
            <td width="200"><?=Yii::t('trans','Alan ismi')?></td>
            <td width="300"><?=Yii::t('trans','Koşullar')?></td>
        </tr>
        
        <tr>
            <td class="bold">name</td>
            <td><?=Yii::t('trans','Ürün tam adı')?></td>
            <td><?=Yii::t('trans','Maximum <b>75</b> karekter')?></td>
        </tr>
        
        <tr>
            <td class="bold">brand</td>
            <td><?=Yii::t('trans','Marka adı')?></td>
            <td><?=Yii::t('trans','Maximum <b>30</b> karekter')?></td>
        </tr>
        
        <tr>
            <td class="bold">model</td>
            <td><?=Yii::t('trans','Model adı')?></td>
            <td><?=Yii::t('trans','Maximum <b>30</b> karekter')?></td>
        </tr>
        
        <tr>
            <td class="bold">purchaseprice</td>
            <td><?=Yii::t('trans','Alış Fiyatı')?></td>
            <td><?=Yii::t('trans','Metin formatta olmalıdır. <b>TL, USD, EU</b> parabirimlerini belirtiniz. Ondalıklı değer için <b>(.) nokta</b> işaretini kullanınız.')?></td>
        </tr>
        
         <tr>
            <td class="bold">saleprice</td>
            <td><?=Yii::t('trans','Satış Fiyatı')?></td>
            <td><?=Yii::t('trans','Metin formatta olmalıdır.  <b>TL, USD, EU</b> parabirimlerini belirtiniz.Ondalıklı değer için <b>(.) nokta</b> işaretini kullanınız.')?></td>
        </tr>
        
        <tr>
            <td class="bold">reducedprice</td>
            <td><?=Yii::t('trans','İndirimli Fiyatı')?></td>
            <td><?=Yii::t('trans','Boş değer girebilirsiniz. Metin formatta olmalıdır. <b>TL, USD, EU</b> parabirimlerini belirtiniz.Ondalıklı değer için <b>(.) nokta</b> işaretini kullanınız.')?></td>
        </tr>
        
        <tr>
            <td class="bold">dealerprice</td>
            <td><?=Yii::t('trans','Bayi Fiyatı')?></td>
            <td><?=Yii::t('trans','Boş değer girebilirsiniz. Metin formatta olmalıdır. <b>TL, USD, EU</b> parabirimlerini belirtiniz.Ondalıklı değer için <b>(.) nokta</b> işaretini kullanınız.')?></td>
        </tr>
       
        <tr>
            <td class="bold">group</td>
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
    		 'url'=>Yii::app()->createUrl("products/xmlreaderadd"),
            'label'=>Yii::t('trans','Tamam anladım'),
        	)); ?>
	</div>

</div>
<script type="text/javascript">
function sourcecode(){
   if($('.sourcecode').css('display')=="none")
   		$('.sourcecode').slideDown();
   else
		$('.sourcecode').slideUp();
}
</script>

<?php

class Params 
{
	 public function get($param){
		return $this->arrays($param);
	 }
	 
	 private function arrays($param){
		 $array=array(
		 	'title'=>'Saha Yönetimi',
		 	'web'=>'www.sahayonetimi.com',
			'web2'=>'www.fieldmanager.com',
			'barcodeHttpTr1'=>'Sahayonetimi.com',
			'barcodeHttpTr2'=>'fieldmanager.com',
			'facebook'=>'https://www.facebook.com/SahaYonetimi',
			'teweet'=>'',
			
			'defultproductplus'=>1000,
			'defultemployeesplus'=>1000,
			'defultfiloplus'=>1000,
			'dealercustomerplus'=>1000,
			'dealerplus'=>1000,
			'paymentplus'=>1000,
			'problematicplus'=>1000,
			'appointmentsplus'=>1000,
			'visitsplus'=>1000,
			'ticketplus'=>1000,
			'messagesplus'=>1000,

			'language'=>array(
				'0'=>'English',
				'1'=>'Türkçe',
			),	

			'welcome'=>Yii::t('trans','Sizleri aramızda görmekten memnun olduk. SahaYöntimi kullanmayı düşündüğünüz için teşşekür ederiz.'),
		 	'yonetici'=>array(1=>Yii::t('trans','Admin'),2=>Yii::t('trans','Direktör'),3=>Yii::t('trans','Satış Müdürü'),4=>Yii::t('trans','Satış Yöneticisi'),5=>Yii::t('trans','Satış Destek'),6=>Yii::t('trans','Bayi Kordinatörü')),
			'user'=>array(1=>Yii::t('trans','Admin'),2=>Yii::t('trans','Direktör'),3=>Yii::t('trans','Satış Müdürü'),4=>Yii::t('trans','Satış Yöneticisi'),5=>Yii::t('trans','Satış Destek'),6=>Yii::t('trans','Bayi Kordinatörü'),7=>Yii::t('trans','Bayi')),
			

			'ticketType'=>array(
				'0'=>Yii::t('trans','Hata Bildirimi'),
				'1'=>Yii::t('trans','Soru'),
				'2'=>Yii::t('trans','Şikayet'),
				'3'=>Yii::t('trans','Öneri'),
				'4'=>Yii::t('trans','Teşekkür'),
				'5'=>Yii::t('trans','Diğer'),
			),

			'erights'=>array(
				'1'=>Yii::t('trans','Admin'),
				'2'=>Yii::t('trans','Üst Yönetici'),
				'3'=>Yii::t('trans','Kullanıcı'),
			),
			'erights_'=>array(
				'3'=>Yii::t('trans','Kullanıcı'),
				'2'=>Yii::t('trans','Üst Yönetici'),
				'1'=>Yii::t('trans','Admin'),
			),
			
			'taxnoType'=>array(
				'1'=>Yii::t('trans','Vergi Numarası'),
				'2'=>Yii::t('trans','Sicil Numarası'),
				'3'=>Yii::t('trans','Vatandaşlık Numarası'),
			),
			'visitType'=>array(
				'1'=>Yii::t('trans','Çatkapı'),
				'2'=>Yii::t('trans','Referans'),
				'3'=>Yii::t('trans','Randevu'),
			),
			'visitStatus'=>array(
				1=>Yii::t('trans','Satış'),
				2=>Yii::t('trans','Red'),
				3=>Yii::t('trans','Teklif'),
				4=>Yii::t('trans','Düşünecek'),
			),
			
			
			'deleted'=>array(
				'0'=>Yii::t('trans','Evet'),
				'1'=>Yii::t('trans','Hayır'),
			),
			'opportunity'=>array(
				'0'=>Yii::t('trans','Hayır'),
				'1'=>Yii::t('trans','Evet'),
			),
			
			'yesno'=>array(
				'0'=>Yii::t('trans','Hayır'),
				'1'=>Yii::t('trans','Evet'),
			),
			
			'currency'=>array(
				'0'=>'TRY',
				'1'=>'USD',
				'2'=>'EUR',
				'3'=>'CAD',
				'4'=>'DKK',
				'5'=>'SEK',
				'6'=>'CHF',
				'7'=>'NOK',
				'8'=>'SAR',
				'9'=>'KWD',
				'10'=>'AUD',
				'11'=>'GBP',
				
			
			),
			
			'currencyValue'=>array(
				"TRY"=>"TRY",
				"USD"=>"USD",
				"EUR"=>"EUR",
				'CAD'=>'CAD',
				'DKK'=>'DKK',
				'SEK'=>'SEK',
				'CHF'=>'CHF',
				'NOK'=>'NOK',
				'SAR'=>'SAR',
				'KWD'=>'KWD',
				'AUD'=>'AUD',
				'GBP'=>'GBP',
				
			),
			
			'currencyNumber'=>array(
				"TRY"=>"0",
				"USD"=>"1",
				"EUR"=>"2",
				'CAD'=>'3',
				'DKK'=>'4',
				'SEK'=>'5',
				'CHF'=>'6',
				'NOK'=>'7',
				'SAR'=>'8',
				'KWD'=>'9',
				'AUD'=>'10',
				'GBP'=>'11',
				
			),
			
			
			
			
			'color'=>array(
				''=>'',
				'1'=>Yii::t('trans','Beyaz'),
				'2'=>Yii::t('trans','Gri'),
				'3'=>Yii::t('trans','Kahverengi'),
				'4'=>Yii::t('trans','Açık Kahverengi'),
				'5'=>Yii::t('trans','Kırmızı'),
				'6'=>Yii::t('trans','Lacivert'),
				'7'=>Yii::t('trans','Mavi'),
				'8'=>Yii::t('trans','Açık Mavi'),
				'9'=>Yii::t('trans','Mor'),
				'10'=>Yii::t('trans','Pembe'),
				'11'=>Yii::t('trans','Sarı'),
				'12'=>Yii::t('trans','Siyah'),
				'13'=>Yii::t('trans','Truncu'),
				'14'=>Yii::t('trans','Yeşil'),
				'15'=>Yii::t('trans','Açık Yeşil'),
				'0'=>Yii::t('trans','Diğeri'),
			),
			
			'colorCod'=>array(
				'0'=>'#333',
				'1'=>'#FFF',
				'2'=>'#bdbdbd',
				'3'=>'#712727',
				'4'=>'#844040',
				'5'=>'#ff0000',
				'6'=>'#1c377b',
				'7'=>'#3665dc',
				'8'=>'#87a9ff',
				'9'=>'#8c0852',
				'10'=>'#ff1197',
				'11'=>'#ff0',
				'12'=>'#000000',
				'13'=>'#fe6c00',
				'14'=>'#18fe00',
				'15'=>'#92fe86',
				'16'=>'#0f8702',
			),
			
			'productsType'=>array(
				''=>Yii::t('trans',''),
				'1'=>Yii::t('trans','Renk'),
				'2'=>Yii::t('trans','En ve Boy'),
				'3'=>Yii::t('trans','Beden'),
				'4'=>Yii::t('trans','Numara'),
				'5'=>Yii::t('trans','Ağırlık ve Birimi'),
				'6'=>Yii::t('trans','Hacim ve Birimi'),
				'7'=>Yii::t('trans','Derinlik'),
			),
			
			'enboybirim'=>array(
				'Km'=>Yii::t('trans','Km'),
				'Hm'=>Yii::t('trans','Hm'),
				'Dam'=>Yii::t('trans','Dam'),
				'M'=>Yii::t('trans','M'),
				'Dm'=>Yii::t('trans','Dm'),
				'Cm'=>Yii::t('trans','Cm'),
				'Mm'=>Yii::t('trans','Mm'),
				
			),
			
			'hacim'=>array(
			
				'Km2'=>Yii::t('trans','Km2'),
				'Hm2'=>Yii::t('trans','Hm2'),
				'Dam2'=>Yii::t('trans','Dam2'),
				'M2'=>Yii::t('trans','M2'),
				'Dm2'=>Yii::t('trans','Dm2'),
				'Cm2'=>Yii::t('trans','Cm2'),
				'Mm2'=>Yii::t('trans','Mm2'),
				
				'Km3'=>Yii::t('trans','Km3'),
				'Hm3'=>Yii::t('trans','Hm3'),
				'Dam3'=>Yii::t('trans','Dam3'),
				'M3'=>Yii::t('trans','M3'),
				'Dm3'=>Yii::t('trans','Dm3'),
				'Cm3'=>Yii::t('trans','Cm3'),
				'Mm3'=>Yii::t('trans','Mm3'),
				
				'kL'=>Yii::t('trans','kL'),
				'hL'=>Yii::t('trans','hL'),
				'daL'=>Yii::t('trans','daL'),
				'L'=>Yii::t('trans','L'),
				'dL'=>Yii::t('trans','dL'),
				'cL'=>Yii::t('trans','cL'),
				'mL'=>Yii::t('trans','mL'),
				
			),
			
			'agirlik'=>array(
				'gram'=>Yii::t('trans','gram'),
				'kilogram'=>Yii::t('trans','kilogram'),
				'ton'=>Yii::t('trans','ton'),
				'onunce'=>Yii::t('trans','onunce'),
				'pound'=>Yii::t('trans','pound'),
				'küçük ton'=>Yii::t('trans','küçük ton'),
				'büyük ton'=>Yii::t('trans','büyük ton'),
				
			),
			
			
			'salesStatus'=>array(
				'0'=>Yii::t('trans','Ödeme Bekliyor'),
				'1'=>Yii::t('trans','Ödeme Daha Sonra Gerçekletirilecek'),
				'2'=>Yii::t('trans','Ödeme Kısmi Yapıldı'),
				'3'=>Yii::t('trans','Ödeme Yapıldı'),
				'4'=>Yii::t('trans','Ret'),
			),
			
			'salesStatus_S'=>array(
				''=>'',
				'0'=>Yii::t('trans','Onay Bekliyor'),
				'1'=>Yii::t('trans','Onaylandı'),
				
			),
			
			'salesEs'=>array(
				'0'=>Yii::t('trans','Ödeme Bekliyor'),
				'1'=>Yii::t('trans','Onaylandı'),
				'2'=>Yii::t('trans','Depo Ayarlandı'),
				'3'=>Yii::t('trans','Filo Hazırlanıyor'),
				'4'=>Yii::t('trans','Filo (Kargoya) Verildi'),
				'5'=>Yii::t('trans','Ret'),
			),
			
			
			'salesEs_'=>array(
				'0'=>Yii::t('trans','Ödeme Bekliyor'),
				'1'=>Yii::t('trans','Onaylandı'),
				'4'=>Yii::t('trans','Ret'),
			),
			
			'salesEs_1'=>array(
				'4'=>Yii::t('trans','Filo (Kargoya) Verildi'),
			),

			'salesEs_2'=>array(
				'2'=>Yii::t('trans','Depo Ayarlandı'),
				'3'=>Yii::t('trans','Filo Hazırlanıyor'),
				'4'=>Yii::t('trans','Filo (Kargoya) Verildi'),
			),
			
			'paymentStatus'=>array(
				'0'=>Yii::t('trans','Onay Bekliyor'),
				'1'=>Yii::t('trans','Onaylandı'),
				'2'=>Yii::t('trans','Ret'),
			),
			
			'cdtype'=>array(
				'1'=>Yii::t('trans','Müşteri'),
				'2'=>Yii::t('trans','Bayi'),
				
			),
		
			
			'salesreturnStatus'=>array(
				
				'1'=>Yii::t('trans','Onaylandı'),
				'0'=>Yii::t('trans','Ret'),
			),
			
			'problematicStatus'=>array(
			
				'0'=>Yii::t('trans','Beklemede'),
				'1'=>Yii::t('trans','Onarımda'),
				'2'=>Yii::t('trans','Servise Gönderildi'),
				'3'=>Yii::t('trans','Onarıldı'),
				'4'=>Yii::t('trans','Onarılamadı'),
			),
			'cargo'=>array(
				''=>'',
				'0'=>Yii::t('trans','Sevkiyat'),
				'1'=>Yii::t('trans','Kargo'),
				'2'=>Yii::t('trans','Kurye'),
			),
			'cargopaymenttype'=>array(
				
				'0'=>Yii::t('trans','Alıcı Öder'),
				'1'=>Yii::t('trans','Gönderici Öder'),
			),
			
			
			'month'=>array(
				'01'=>Yii::t('trans','Ocak'),
				'02'=>Yii::t('trans','Şubat'),
				'03'=>Yii::t('trans','Mart'),
				'04'=>Yii::t('trans','Nisan'),
				'05'=>Yii::t('trans','Mayıs'),
				'06'=>Yii::t('trans','Haziran'),
				'07'=>Yii::t('trans','Temmuz'),
				'08'=>Yii::t('trans','Ağustos'),
				'09'=>Yii::t('trans','Eylül'),
				'10'=>Yii::t('trans','Ekim'),
				'11'=>Yii::t('trans','Kasım'),
				'12'=>Yii::t('trans','Aralık'),
				
				
				'1'=>Yii::t('trans','Ocak'),
				'2'=>Yii::t('trans','Şubat'),
				'3'=>Yii::t('trans','Mart'),
				'4'=>Yii::t('trans','Nisan'),
				'5'=>Yii::t('trans','Mayıs'),
				'6'=>Yii::t('trans','Haziran'),
				'7'=>Yii::t('trans','Temmuz'),
				'8'=>Yii::t('trans','Ağustos'),
				'9'=>Yii::t('trans','Eylül'),
				
			),
			
			'reportsdate'=>array(
				'0 day'=>Yii::t('trans','Bügün'),
				'1 day'=>Yii::t('trans','Son 2 Gün'),
				'2 day'=>Yii::t('trans','Son 3 Gün'),
				'1 month'=>Yii::t('trans','Son 5 Gün'),
				'10 day'=>Yii::t('trans','Son 10 Gün'),
				'1 month'=>Yii::t('trans','Son Ay'),
				'3 month'=>Yii::t('trans','Son 3 Ay'),
				'5 month'=>Yii::t('trans','Son 5 Ay'),
				'6 month'=>Yii::t('trans','Son 6 Ay'),
				'9 month'=>Yii::t('trans','Son 9 Ay'),
				'1 year'=>Yii::t('trans','Son 1 Yıl'),
				
			),



			'reportsdate2'=>array(
				''=>'',
				'0 day'=>Yii::t('trans','Bügün'),
				'1 day'=>Yii::t('trans','Son 2 Gün'),
				'2 day'=>Yii::t('trans','Son 3 Gün'),
				'1 month'=>Yii::t('trans','Son 5 Gün'),
				'10 day'=>Yii::t('trans','Son 10 Gün'),
				'1 month'=>Yii::t('trans','Son Ay'),
				'3 month'=>Yii::t('trans','Son 3 Ay'),
				'5 month'=>Yii::t('trans','Son 5 Ay'),
				'6 month'=>Yii::t('trans','Son 6 Ay'),
				'9 month'=>Yii::t('trans','Son 9 Ay'),
				'1 year'=>Yii::t('trans','Son 1 Yıl'),
				
			),
			
			'raporlama'=>array(
				"0"=>Yii::t('trans','Günlük'),
				"1"=>Yii::t('trans','Haftalık'),
				"2"=>Yii::t('trans','Aylık'),
				"3"=>Yii::t('trans','Yıllık')
			),
			
			'raporlamacd'=>array(
				"0"=>Yii::t('trans','Toplam Satış'),
				"1"=>Yii::t('trans','Kargo Gider'),
				"2"=>Yii::t('trans','Brüt Kar'),
				"3"=>Yii::t('trans','Ürün İadesi'),
				"4"=>Yii::t('trans','Ürün İadesi(Kar)'),
				"5"=>Yii::t('trans','Net Kar'),
			),

			'raporlamacdProduct'=>array(
				"0"=>Yii::t('trans','Toplam Satış'),
				"2"=>Yii::t('trans','Brüt Kar'),
				"3"=>Yii::t('trans','Ürün İadesi'),
				"4"=>Yii::t('trans','Ürün İadesi(Kar)'),
				
			),
			

			'raporlamaQuery1'=>array(
				''=>'',
				"0"=>Yii::t('trans','Toplam Satış'),
				"1"=>Yii::t('trans','Brüt Kar'),
			)
		 );
		 
		 return $array[$param];
	 }
	
}
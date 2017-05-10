<?PHP 


class Sitecontroller
{	

	public function getServerMail(){
		
		if($_SERVER['SERVER_NAME']=="sahayonetimi"){
			return "1";
		}elseif($_SERVER['SERVER_NAME']=="managerfield"){
			return "2";
		}else{
			return "1";
		}
	}
	
	public function getContact(){
		
		if($_SERVER['SERVER_NAME']=="sahayonetimi"){
			return "contact@sahayonetimi.com";
		}elseif($_SERVER['SERVER_NAME']=="managerfield"){
			return "contact@managerfield.com";
		}else{
			return "contact@sahayonetimi.com";
		}
	}
	
	public function getLink(){
		
		if($_SERVER['SERVER_NAME']=="sahayonetimi"){
			return "www.sahayonetimi.com";
		}elseif($_SERVER['SERVER_NAME']=="managerfield"){
			return "www.managerfield.com";
		}else{
			return "www.sahayonetimi.com";
		}
	}
	
	public function getServerName(){
		
		if($_SERVER['SERVER_NAME']=="sahayonetimi"){
			return "Saha Yönetimi";
		}elseif($_SERVER['SERVER_NAME']=="managerfield"){
			return "Manager Field";
		}else{
			return "Saha Yönetimi";
		}
	}
	
	public function getLogo(){
		
		if($_SERVER['SERVER_NAME']=="sahayonetimi"){
			return Yii::app()->baseUrl."/images/logo.png";
		}elseif($_SERVER['SERVER_NAME']=="managerfield"){
			return Yii::app()->baseUrl."/images/logo2.png";
		}else{
			return Yii::app()->baseUrl."/images/logo.png";
		}
	}
	
	
	public function getLogo2(){
		
		if($_SERVER['SERVER_NAME']=="sahayonetimi"){
			return Yii::app()->baseUrl."/images/logo3.png";
		}elseif($_SERVER['SERVER_NAME']=="managerfield"){
			return Yii::app()->baseUrl."/images/logo4.png";
		}else{
			return Yii::app()->baseUrl."/images/logo3.png";
		}
	}
	
	public function qrBarcodeGenerator($id,$number,$size){
	
	
		Yii::import('application.data.phpqrcode.qrlib',true);
		
		if($size==7){
			$width=250;
			$height=250;
			$paddingleft=42;
			$rt1=205;
			$rt2=235;
			
			$textsize1=20;
			$textsize2=12;
		}elseif($size==5){
			$width=210;
			$height=210;
			$paddingleft=40;
			$rt1=160;
			$rt2=190;
			
			$textsize1=16;
			$textsize2=11;
		}elseif($size==3){
			$width=150;
			$height=150;
			$paddingleft=35;
			$rt1=105;
			$rt2=130;
			
			$textsize1=11;
			$textsize2=9;
		}elseif($size==2){
			$width=100;
			$height=100;
			$paddingleft=30;
			$rt1=75;
			$rt2=90;
			
			$textsize1=8;
			$textsize2=6;
		}
		
		$filename=Yii::getPathOfAlias('webroot')."/tmp/".$id."temp.png";
		QRcode::png($number, $filename,"S",$size,1);
		
		$img=ImageCreateFromPNG(Yii::getPathOfAlias('webroot')."/tmp/".$id."temp.png"); 
		


		$src = imagecreatefrompng(Yii::getPathOfAlias('webroot')."/tmp/".$id."temp.png");
		
		$imgsizex=imagesx($src);
		$imgsizey=imagesy($src);
		$dest = imagecreatetruecolor($width, $height);
		$red = imagecolorallocate($dest, 255, 255, 255);
		imagefill($dest, 0, 0, $red);
		imagecopy($dest, $src, $paddingleft, 10, 0, 0, $imgsizex,$imgsizey);
		
		if($_SERVER['SERVER_NAME']==$this->getParams('web'))
			$text=$this->getParams('barcodeHttpTr1');
		elseif($_SERVER['SERVER_NAME']==$this->getParams('web2'))
			$text=$this->getParams('barcodeHttpTr2');
		else
			$text=$this->getParams('barcodeHttpTr1');
		
		$plain_font   = Yii::getPathOfAlias('webroot').'/fonts/arial.ttf';
		
		$black = imagecolorallocate($img, 0, 0, 0);
		imagettftext($dest, $textsize1, 0, 10, $rt1, $black, $plain_font, $text);
		
		imagettftext($dest, $textsize2, 0, 10, $rt2, $black, $plain_font, $number);
		header('Content-Type: image/jpeg');
		
		imagejpeg($dest);
		
		imagedestroy($dest);
		
		imagedestroy($src);
		
		
	}
	public function barcodeGenerator($number,$boy){
		$number = $number;
		
		if($_SERVER['SERVER_NAME']==$this->getParams('web'))
			$text=$this->getParams('barcodeHttpTr1');
		elseif($_SERVER['SERVER_NAME']==$this->getParams('web2'))
			$text=$this->getParams('barcodeHttpTr2');
		else
			$text=$this->getParams('barcodeHttpTr1');
		
		$barcode_font = Yii::getPathOfAlias('webroot').'/fonts/FREE3OF9.TTF';
		$plain_font   = Yii::getPathOfAlias('webroot').'/fonts/arial.ttf';
		
		if($boy=="b"){
			$width = 369;
			$height = 142;
			
			$textsize1=46;
			$textsize2=18;
			$textsize3=12;
			$rt1=60;
			$rt2=90;
			$rt3=120;
		}elseif($boy=="o"){
			$width = 255;
			$height = 120;
			
			$textsize1=24;
			$textsize2=14;
			$textsize3=11;
			$rt1=40;
			$rt2=70;
			$rt3=95;
		}elseif($boy=="k"){
			$width = 200;
			$height = 80;
			
			$textsize1=18;
			$textsize2=11;
			$textsize3=8;
			$rt1=25;
			$rt2=45;
			$rt3=65;
		}
		
		$img = imagecreate($width, $height);
		
		// First call to imagecolorallocate is the background color
		$white = imagecolorallocate($img, 255, 255, 255);
		$black = imagecolorallocate($img, 0, 0, 0);
		
		// Reference for the imagettftext() function
		// imagettftext($img, $fontsize, $angle, $xpos, $ypos, $color, $fontfile, $text);
		imagettftext($img, $textsize1, 0, 10, $rt1, $black, $barcode_font, $number);
		imagettftext($img, $textsize2, 0, 10, $rt2, $black, $plain_font, $text);
		imagettftext($img, $textsize3, 0, 10, $rt3, $black, $plain_font, $number);
		
		header('Content-type: image/png');
		
		imagepng($img);
		imagedestroy($img);
	}
	
	public function curAccount($id, $cur){
		$model=Currencymoney::model()->find("currencyID=:currencyID",array(":currencyID"=>Yii::app()->user->getState('companyCur')));
		$model2=Currencymoney::model()->find("currencyID=:currencyID",array(":currencyID"=>$id));
		
		$t=($model2->cur/$model->cur)*$cur;
		return $t;
	}
	
	public function curAccount2($id, $cur,$ecur){
		$model=Currencymoney::model()->find("currencyID=:currencyID",array(":currencyID"=>$ecur));
		$model2=Currencymoney::model()->find("currencyID=:currencyID",array(":currencyID"=>$id));
		
		$t=($model2->cur/$model->cur)*$cur;
		return $t;
	}
	
	
	
	public function accsesControl($model){
		if($model->worldID!=Yii::app()->user->getState("worldID"))
			return true;
	}
	
		
	public function accsesControl2($model){
		if($model->companyID!=Yii::app()->user->getState("companyID"))
			return true;
	}
	
	public function dataControl(){
		
		
		if(Yii::app()->user->getState('dataControl')){
			
			if(Yii::app()->user->getState('dataControlPlus') >=15){
				Yii::app()->user->setState('dataControlPlus',0);
				return false;
			
			}
			if(strtotime(date("Y-m-d H:i:s"))-strtotime(Yii::app()->user->getState('dataControl'))<10){
				Yii::app()->user->setState('dataControl',date("Y-m-d H:i:s"));
				$plus=Yii::app()->user->getState('dataControlPlus');
				Yii::app()->user->setState('dataControlPlus',$plus+1);
			}else{
				Yii::app()->user->setState('dataControl',date("Y-m-d H:i:s"));
				Yii::app()->user->setState('dataControlPlus',0);
			}
		}else{
			Yii::app()->user->setState('dataControl',date("Y-m-d H:i:s"));
			Yii::app()->user->setState('dataControlPlus',0);
		}
		
		return true;
	}
	
	public function languageList(){
		$path=Yii::getPathOfAlias('webroot').'/protected/messages/';
		$dir_handle = @opendir($path) or die("$path klasörü açılamıyor.");
		while ($file = readdir($dir_handle)) 
		{
			
		if (is_dir($path."/".$file) AND ($file != "..") AND ($file != ".")) { 
		  $files[$file]=$this->getParams_("dil",$file);
		 }
		}
		closedir($dir_handle);
		return $files;
	}
	
	public function getCountry($id){
		$modelCountry= Country::model()->findByPk($id);
		if(count($modelCountry)>0)
			return $modelCountry->name;
		else
			return "-";
	}
	
	public function getCity($id){
		$modelCity= City::model()->findByPk($id);
		if(count($modelCity)>0)
			return $modelCity->name;
		else
			return "-";
	}
	
	public function getCompany($id){
		$criteria=new CDbCriteria();
		$criteria->select = 'companyName';
		$criteria->condition='companyID=:companyID';
		$criteria->params=array(':companyID'=>$id);
		$model=Companies::model()->find($criteria);
		if(count($model)>0)
			return $model->companyName;
		else
			return "-";
	}
	
	public function getEmployeesName($id){
		$criteria=new CDbCriteria();
		$criteria->select = 'name';
		$criteria->condition='employeesID=:employeesID';
		$criteria->params=array(':employeesID'=>$id);
		$model=Employees::model()->find($criteria);
		if(count($model)>0)
			return $model->name;
		else
			return "-";
	}
	
	
	
	public function getDealerLogo30($file,$id){
		$empty='<div class="avatar2">
				<img src="'.Yii::app()->baseUrl.'/images/noimage.png" width="70" style="width:70px" />		</div>';
		if(!empty($file)){
			if(file_exists(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$id.'/'.$file))
				return '<div class="avatar2"><img src="'.Yii::app()->baseUrl.'/resimler/dealers/'.$id.'/'.$file.'" width="70" style="width:70px" /></div>';
			else
				return $empty;
		}else
			return $empty;
	}
	
	public function getEmployeesLogo30($file,$id){
		$empty='<div class="avatar2">
				<img src="'.Yii::app()->baseUrl.'/images/avatar.png" width="70" style="width:70px" />		</div>';
		if(!empty($file)){
			if(file_exists(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$id.'/'.$file))
				return '<div class="avatar2"><img src="'.Yii::app()->baseUrl.'/resimler/employees/'.$id.'/'.$file.'" width="70" style="width:70px" /></div>';
			else
				return $empty;
		}else
			return $empty;
	}
	
	public function getDealerLogo120($file,$id){
		$empty='<div class="avatar2">
				<img src="'.Yii::app()->baseUrl.'/images/noimage.png" width="120" style="width:120px" />		</div>';
		if(!empty($file)){
			if(file_exists(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$id.'/'.$file))
				return '<div class="avatar2"><img src="'.Yii::app()->baseUrl.'/resimler/dealers/'.$id.'/'.$file.'" width="120" style="width:120px" /></div>';
			else
				return $empty;
		}else
			return $empty;
	}
	
	public function getEmployeesLogo120($file,$id){
		$empty='<div class="avatar2">
				<img src="'.Yii::app()->baseUrl.'/images/avatar.png" width="120" style="width:120px" />		</div>';
		if(!empty($file)){
			if(file_exists(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$id.'/'.$file))
				return '<div class="avatar2"><img src="'.Yii::app()->baseUrl.'/resimler/employees/'.$id.'/'.$file.'" width="120" style="width:120px" /></div>';
			else
				return $empty;
		}else
			return $empty;
	}
	
	
	
	
	
	public function getDateTimeFormat($dateTime){
		$date=new DateTime($dateTime);
		return $date->format('d-m-Y H:i:s');
	}
	
	public function getDateFormat($date){
		$date=new DateTime($date);
		return $date->format('d-m-Y');
	}

	
	public function getParams($param){
		$params = new Params;
		return $params->get($param);
	}
	
	public function getParams_($param,$id){
		$params = new Params;
		$array=$params->get($param);
		return $array[$id];
	}
	
	
	public function randfunc(){
		$password = "";
		$harf=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
		$sayilar=array('1','2','3','4','5','6','7','8','9');
		$basamak= rand(5,7);
		for($i=0;$i<$basamak;$i++){
			$password.= $harf[rand(0,count($harf)-1)];
			$password.= $sayilar[rand(0,count($sayilar)-1)];
		}
		
		return $password;
	}
	
	
	
	public function groupTree(){
		$modelList=Productgroups::model()->findAll(
		array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1",
		 'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")),
		 'order'=>'name asc',
		 ));
		
		$array=array();
		foreach ($modelList as $key => $value)
		{
				$value=(object)$value;
				
				if($value->pgID==0){
					$array[$value->productgroupsID]["productgroupsID"] = $value->productgroupsID;
					$array[$value->productgroupsID]["name"] = $value->name;
					$array[$value->productgroupsID]["pgID"] = $value->pgID;
				
		 
					unset($modelList[$key]);
					
					
					$array[$value->productgroupsID]=$this->group_Find_Sub_Cats($modelList, $array[$value->productgroupsID]);
				}
	 
		}
		
		return  $array;
	}
	
	private function group_Find_Sub_Cats(&$modelList, &$array)
	{ 
		
		foreach ($modelList as $key => $value)
		{
			$value=(object)$value;
			
			if ($value->pgID == $array['productgroupsID'])
			{
				
				$array["sub_cats"][$value->productgroupsID] = array(
					"productgroupsID"=>$value->productgroupsID,
					"name"  =>$value->name,
					"pgID" =>$value->pgID
				);
				
				unset($modelList[$key]);
				
				$this->group_Find_Sub_Cats($modelList, $array["sub_cats"][$value->productgroupsID]);
			}
		}
		
		return $array;
	}
	
	
	
	public function getProductgroups_($type=3){
		
		$array=$this->groupTree();
		if($type==1)
			$array2=array(0=>Yii::t('trans','En Üst Kategori'));
		elseif($type==3)
			$array2=array();
		else
			$array2=array(""=>"");
			
			
		foreach($array as $key=>$value){
			$value=(object)$value;
			$array2[$value->productgroupsID]=$value->name;
			$line=1;
			unset($array[$key]);
			if(@$value->sub_cats)
				$array2=$this->sub_cats($value->sub_cats,$array2,$line);
			
			
		}
		return $array2;
	}
	
	private function sub_cats(&$array,&$array2,&$line){
		$line2=$line;
		foreach($array as $key=>$value){
			$value=(object)$value;
			$line++;
			$array2[$value->productgroupsID]=str_repeat('.....', $line).$value->name;
			unset($array[$key]);
			if(@$value->sub_cats)
				$array2=$this->sub_cats($value->sub_cats,$array2,$line);
			$line=$line2;
		}
		
		
		return $array2;
	}
}
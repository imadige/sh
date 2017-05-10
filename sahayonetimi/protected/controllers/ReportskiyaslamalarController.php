<?php

class ReportskiyaslamalarController extends Controller
{
	
	public $layout='//layouts/panel';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	private function accsesControl($model){
		$controller= new Sitecontroller;
		$return=$controller->accsesControl($model);
		if($return==true)
			$this->redirect(array("//site"));
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('customers','customers_'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('dealers','dealers_'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('employees','employees_'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('products','products_'),
				'users'=>array('*'),
			),

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('country','country_'),
				'users'=>array('*'),
			),

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('city','city_'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){

		$this->redirect(array("customers"));
	}

	public function actionCustomers(){

		$this->render("customers",array(

		));
	}

	public function actionCustomers_(){

		$array=explode(",",substr($_POST["data"],0,strlen($_POST["data"])-1));
		$array_="";
		foreach($array as $key=>$value)
			$array_.=$value.",";

		$array_=substr($array_,0,strlen($array_)-1);

		
		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
			  
		}
		 Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			if(@$_POST["basTar"]!="")
				Yii::app()->user->setState('r_basTar',$_POST["basTar"]);

			if(@$_POST["bitTar"]!="")
				Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);

			if(@$_POST["raporlamacd"]!="")
				Yii::app()->user->setState('r_raporlamacd',@$_POST["raporlamacd"]);
			
			if(@$_POST["basTar"]!="" && @$_POST["bitTar"]!="" && @$_POST["raporlamacd"]!="" ){
				$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
				$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				$allcustomers=Yii::app()->user->getState('r_allcustomers');
				$bt=0;
			}


			
		}else{
		
		
			$this->redirect(array("//site/panel"));
		}


		if(Yii::app()->user->getState('r_basTar') !=""){
			$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
			$basTar=$basTar." 00:00:00";
		}
		
		
		if(Yii::app()->user->getState('r_bitTar') !="")	{
			$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
			$bitTar=$bitTar." 23:59:59";
		}
		
		if(Yii::app()->user->getState('r_raporlamacd') !="")	
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			
		if(Yii::app()->user->getState('r_allcustomers') !="")	
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			
		
		
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');
		
		$command=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,1,$bt,$st,false,$array_);
			
		$count=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,1,$bt,$st,true,$array_);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->renderPartial("customers_",array(
			'array_'=>$_POST["data"],
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}

	public function actionEmployees(){

		$this->render("employees",array(

		));
	}

	public function actionEmployees_(){

		$array=explode(",",substr($_POST["data"],0,strlen($_POST["data"])-1));
		$array_="";
		foreach($array as $key=>$value)
			$array_.=$value.",";

		$array_=substr($array_,0,strlen($array_)-1);

		
		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
			  
		}

		 Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			if(@$_POST["basTar"]!="")
				Yii::app()->user->setState('r_basTar',$_POST["basTar"]);

			if(@$_POST["bitTar"]!="")
				Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);

			if(@$_POST["raporlamacd"]!="")
				Yii::app()->user->setState('r_raporlamacd',@$_POST["raporlamacd"]);
			
			if(@$_POST["basTar"]!="" && @$_POST["bitTar"]!="" && @$_POST["raporlamacd"]!="" ){
				$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
				$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				$allcustomers=Yii::app()->user->getState('r_allcustomers');
				$bt=0;
			}


			
		}else{
		
		
			$this->redirect(array("//site/panel"));
		}


		if(Yii::app()->user->getState('r_basTar') !=""){
			$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
			$basTar=$basTar." 00:00:00";
		}
		
		
		if(Yii::app()->user->getState('r_bitTar') !="")	{
			$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
			$bitTar=$bitTar." 23:59:59";
		}
		
		if(Yii::app()->user->getState('r_raporlamacd') !="")	
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			
		if(Yii::app()->user->getState('r_allcustomers') !="")	
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			
		
		
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');
		
		$command=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,3,$bt,$st,false,$array_);
			
		$count=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,3,$bt,$st,true,$array_);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->renderPartial("employees_",array(
			'array_'=>$_POST["data"],
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}


	public function actionDealers(){

		$this->render("dealers",array(

		));
	}

	public function actionDealers_(){

		$array=explode(",",substr($_POST["data"],0,strlen($_POST["data"])-1));
		$array_="";
		foreach($array as $key=>$value)
			$array_.=$value.",";

		$array_=substr($array_,0,strlen($array_)-1);

		
		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
			  
		}
		 Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			if(@$_POST["basTar"]!="")
				Yii::app()->user->setState('r_basTar',$_POST["basTar"]);

			if(@$_POST["bitTar"]!="")
				Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);

			if(@$_POST["raporlamacd"]!="")
				Yii::app()->user->setState('r_raporlamacd',@$_POST["raporlamacd"]);
			
			if(@$_POST["basTar"]!="" && @$_POST["bitTar"]!="" && @$_POST["raporlamacd"]!="" ){
				$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
				$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				$allcustomers=Yii::app()->user->getState('r_allcustomers');
				$bt=0;
			}


			
		}else{
		
		
			$this->redirect(array("//site/panel"));
		}


		if(Yii::app()->user->getState('r_basTar') !=""){
			$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
			$basTar=$basTar." 00:00:00";
		}
		
		
		if(Yii::app()->user->getState('r_bitTar') !="")	{
			$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
			$bitTar=$bitTar." 23:59:59";
		}
		
		if(Yii::app()->user->getState('r_raporlamacd') !="")	
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			
		if(Yii::app()->user->getState('r_allcustomers') !="")	
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			
		
		
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');
		
		$command=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,2,$bt,$st,false,$array_);
			
		$count=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,2,$bt,$st,true,$array_);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->renderPartial("dealers_",array(
			'array_'=>$_POST["data"],
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}


	public function actionProducts(){

		$this->render("products",array(

		));
	}

	public function actionProducts_(){

		$array=explode(",",substr($_POST["data"],0,strlen($_POST["data"])-1));
		$array_="";
		foreach($array as $key=>$value)
			$array_.=$value.",";

		$array_=substr($array_,0,strlen($array_)-1);

		
		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
			  
		}
		 Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			if(@$_POST["basTar"]!="")
				Yii::app()->user->setState('r_basTar',$_POST["basTar"]);

			if(@$_POST["bitTar"]!="")
				Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);

			if(@$_POST["raporlamacd"]!="")
				Yii::app()->user->setState('r_raporlamacd',@$_POST["raporlamacd"]);
			
			if(@$_POST["basTar"]!="" && @$_POST["bitTar"]!="" && @$_POST["raporlamacd"]!="" ){
				$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
				$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				$allcustomers=Yii::app()->user->getState('r_allcustomers');
				$bt=0;
			}


			
		}else{
		
		
			$this->redirect(array("//site/panel"));
		}


		if(Yii::app()->user->getState('r_basTar') !=""){
			$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
			$basTar=$basTar." 00:00:00";
		}
		
		
		if(Yii::app()->user->getState('r_bitTar') !="")	{
			$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
			$bitTar=$bitTar." 23:59:59";
		}
		
		if(Yii::app()->user->getState('r_raporlamacd') !="")	
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			
		if(Yii::app()->user->getState('r_allcustomers') !="")	
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			
		
		
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');
		
		$command=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,4,$bt,$st,false,$array_);
			
		$count=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,4,$bt,$st,true,$array_);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->renderPartial("products_",array(
			'array_'=>$_POST["data"],
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}



	public function actionCountry(){

		$this->render("country",array(

		));
	}

	public function actionCountry_(){

		$array=explode(",",substr($_POST["data"],0,strlen($_POST["data"])-1));
		$array_="";
		foreach($array as $key=>$value)
			$array_.="'".$value."',";

		$array_=substr($array_,0,strlen($array_)-1);


		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
			  
		}
		 Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			if(@$_POST["basTar"]!="")
				Yii::app()->user->setState('r_basTar',$_POST["basTar"]);

			if(@$_POST["bitTar"]!="")
				Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);

			if(@$_POST["raporlamacd"]!="")
				Yii::app()->user->setState('r_raporlamacd',@$_POST["raporlamacd"]);
			
			if(@$_POST["basTar"]!="" && @$_POST["bitTar"]!="" && @$_POST["raporlamacd"]!="" ){
				$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
				$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				$allcustomers=Yii::app()->user->getState('r_allcustomers');
				$bt=0;
			}


			
		}else{
		
		
			$this->redirect(array("//site/panel"));
		}


		if(Yii::app()->user->getState('r_basTar') !=""){
			$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
			$basTar=$basTar." 00:00:00";
		}
		
		
		if(Yii::app()->user->getState('r_bitTar') !="")	{
			$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
			$bitTar=$bitTar." 23:59:59";
		}
		
		if(Yii::app()->user->getState('r_raporlamacd') !="")	
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			
		if(Yii::app()->user->getState('r_allcustomers') !="")	
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			
		
		
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');
		
		$command=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,5,$bt,$st,false,$array_);
			
		$count=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,5,$bt,$st,true,$array_);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->renderPartial("country_",array(
			'array_'=>$_POST["data"],
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}


	public function actionCity(){

		$this->render("city",array(

		));
	}

	public function actionCity_(){

		$array=explode(",",substr($_POST["data"],0,strlen($_POST["data"])-1));
		$array_="";
		foreach($array as $key=>$value)
			$array_.=$value.",";

		$array_=substr($array_,0,strlen($array_)-1);


		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
			  
		}
		 Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			if(@$_POST["basTar"]!="")
				Yii::app()->user->setState('r_basTar',$_POST["basTar"]);

			if(@$_POST["bitTar"]!="")
				Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);

			if(@$_POST["raporlamacd"]!="")
				Yii::app()->user->setState('r_raporlamacd',@$_POST["raporlamacd"]);
			
			if(@$_POST["basTar"]!="" && @$_POST["bitTar"]!="" && @$_POST["raporlamacd"]!="" ){
				$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
				$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				$allcustomers=Yii::app()->user->getState('r_allcustomers');
				$bt=0;
			}


			
		}else{
		
		
			$this->redirect(array("//site/panel"));
		}


		if(Yii::app()->user->getState('r_basTar') !=""){
			$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
			$basTar=$basTar." 00:00:00";
		}
		
		
		if(Yii::app()->user->getState('r_bitTar') !="")	{
			$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
			$bitTar=$bitTar." 23:59:59";
		}
		
		if(Yii::app()->user->getState('r_raporlamacd') !="")	
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			
		if(Yii::app()->user->getState('r_allcustomers') !="")	
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			
		
		
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');
		
		$command=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,6,$bt,$st,false,$array_);
			
		$count=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,6,$bt,$st,true,$array_);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->renderPartial("city_",array(
			'array_'=>$_POST["data"],
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}

	private function cdCommandHesap($companyID,$worldID,$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,$cdtype,$bt,$st,$count,$array_){
		
		
		
			
		$connection=Yii::app()->db; 

		if($cdtype<=4){

			if($desc==0)
				$desc="c.name ASC";
			elseif($desc==1)
				$desc="c.name DESC";
			elseif($desc==2)
				$desc="price ASC";
			elseif($desc==3)
				$desc="price DESC";

			if($cdtype==1){
				$params="customers";
				$params2="customerID";
				$params3="customerdealerID";
			}elseif($cdtype==2){
				$params="dealers";
				$params2="dealersID";
				$params3="customerdealerID";
			}elseif($cdtype==3){
				$params="employees";
				$params2="employeesID";
				$params3="employeesID";
			}elseif($cdtype==4){
				$params="products";
				$params2="productsID";
				$params3="productsID";
			}
			
		
				if($raporlamacd==0)
					$command = $connection->createCommand('SELECT count(*) as count,c.'.$params2.', c.name as name,sum(salesPrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on('.($cdtype==4?'s':'sc').'.'.$params3.'=c.'.$params2.')  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.'.$params2.' IN('.$array_.')  GROUP BY  salesCur, '.$params3.' ORDER BY '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
					
				elseif($raporlamacd==1)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.'.$params2.', c.name as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) '.($cdtype==4?"left join salesdetail f on ( s.salescompleteID=s.salescompleteID)":"").' left join '.$params.' c on('.($cdtype==4?'f':'sc').'.'.$params3.'=c.'.$params2.')  WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.'.$params2.' IN('.$array_.')   GROUP BY  chargeCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==2)
					$command = $connection->createCommand('SELECT count(*) as count,c.'.$params2.', c.name as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on('.($cdtype==4?'s':'sc').'.'.$params3.'=c.'.$params2.')  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.'.$params2.' IN('.$array_.')   GROUP BY  salesCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');	
				elseif($raporlamacd==3)
					$command = $connection->createCommand('SELECT count(*) as count,c.'.$params2.', c.name as name,-sum(salesreturnPrice*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on('.($cdtype==4?'s':'sc').'.'.$params3.'=c.'.$params2.') WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.'.$params2.' IN('.$array_.')  GROUP BY  salesreturnCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==4)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.'.$params2.', c.name as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on('.($cdtype==4?'s':'sc').'.'.$params3.'=c.'.$params2.') WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').'  AND c.'.$params2.' IN('.$array_.')  GROUP BY  salesreturnCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==5)
					$command = $connection->createCommand('
					select count,'.$params2.', name,sum(price) as price from (
					
					(
					SELECT count(*) as count,c.'.$params2.', c.name as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) '.($cdtype==4?"left join salesdetail f on ( s.salescompleteID=s.salescompleteID)":"").' left join '.$params.' c on('.($cdtype==4?'f':'sc').'.'.$params3.'=c.'.$params2.')  WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.'.$params2.' IN('.$array_.')   GROUP BY  chargeCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					) 
					union
					(
					SELECT count(*) as count,c.'.$params2.', c.name as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on('.($cdtype==4?'s':'sc').'.'.$params3.'=c.'.$params2.')  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.'.$params2.' IN('.$array_.')  GROUP BY  salesCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)
					
					union
					(
					SELECT count(*) as count,c.'.$params2.', c.name as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on('.($cdtype==4?'s':'sc').'.'.$params3.'=c.'.$params2.') WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').'  AND c.'.$params2.' IN('.$array_.')  GROUP BY  salesreturnCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)) as ca group by '.$params2.'  
					
					');
				
			
	
			if($count==true){
				$command=$command->execute();
				
			}else
				$command=$command->queryAll();	

			return $command;
		}elseif($cdtype==5){

			if($desc==0)
				$desc="co.name ASC";
			elseif($desc==1)
				$desc="co.name DESC";
			elseif($desc==2)
				$desc="price ASC";
			elseif($desc==3)
				$desc="price DESC";
			
			$params="customers";
			$params2="customerID";
			$params3="customerdealerID";
			

			if($raporlamacd==0)
					$command = $connection->createCommand('SELECT count(*) as count,c.country, co.name as name,sum(salesPrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')  GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
					
				elseif($raporlamacd==1)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.country, co.name  as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code)  WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')   GROUP BY  co.code ORDER BY '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==2)
					$command = $connection->createCommand('SELECT count(*) as count,c.country, co.name  as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')   GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');	
				elseif($raporlamacd==3)
					$command = $connection->createCommand('SELECT count(*) as count,c.country, co.name  as name,-sum(salesreturnPrice*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')  GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==4)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.country, co.name  as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').'  AND c.country IN('.$array_.')  GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==5)
					$command = $connection->createCommand('
					select count,country, name,sum(price) as price from (
					
					(
					SELECT count(*) as count,c.country, co.name  as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) '.($cdtype==4?"left join salesdetail f on ( s.salescompleteID=s.salescompleteID)":"").' left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.')  left join country co on ( c.country=co.code) WHERE  s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')   GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					) 
					union
					(
					SELECT count(*) as count,c.country, co.name  as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')  GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)
					
					union
					(
					SELECT count(*) as count,c.country, co.name  as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').'  AND c.country IN('.$array_.')  GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)) as ca group by country
					
					');
				
			//****************************************************************//

			
			$params="dealers";
			$params2="dealersID";
			$params3="customerdealerID";
		
			

			if($raporlamacd==0)
					$command2 = $connection->createCommand('SELECT count(*) as count,c.country, co.name as name,sum(salesPrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')  GROUP BY  co.code ORDER BY '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
					
				elseif($raporlamacd==1)
				
					$command2 = $connection->createCommand('SELECT count(*) as count,c.country, co.name  as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code)  WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')   GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==2)
					$command2 = $connection->createCommand('SELECT count(*) as count,c.country, co.name  as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')   GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');	
				elseif($raporlamacd==3)
					$command2 = $connection->createCommand('SELECT count(*) as count,c.country, co.name  as name,-sum(salesreturnPrice*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')  GROUP BY  co.code ORDER BY '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==4)
				
					$command2= $connection->createCommand('SELECT count(*) as count,c.country, co.name  as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').'  AND c.country IN('.$array_.')  GROUP BY  co.code ORDER BY '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==5)
					$command2 = $connection->createCommand('
					select count,country, name,sum(price) as price from (
					
					(
					SELECT count(*) as count,c.country, co.name  as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) '.($cdtype==4?"left join salesdetail f on ( s.salescompleteID=s.salescompleteID)":"").' left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.')  left join country co on ( c.country=co.code) WHERE  s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')   GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					) 
					union
					(
					SELECT count(*) as count,c.country, co.name  as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.country IN('.$array_.')  GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)
					
					union
					(
					SELECT count(*) as count,c.country, co.name  as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join country co on ( c.country=co.code) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').'  AND c.country IN('.$array_.')  GROUP BY  co.code ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)) as ca group by country
					
					');
				
			
			if($count==true){
				$command2=$command2->execute();
				
			}else
				$command2=$command2->queryAll();

			if($count==true){
				$command=$command->execute();
				
			}else
				$command=$command->queryAll();


		

			if($count==true){
				return $command+$command2;
			}else{
				$newcommand=array();
				
				foreach($command as $key=>$value){
					$value=(object)$value;
					$newcommand[$value->country]["country"]=$value->country;
					$newcommand[$value->country]["name"]=$value->name;
					$newcommand[$value->country]["price"]=$value->price;
					
				}

				foreach($command2 as $key=>$value){
					$value=(object)$value;
					$newcommand[$value->country]["country"]=$value->country;
					$newcommand[$value->country]["name"]=$value->name;
					$newcommand[$value->country]["price"]=$value->price;
					
				}	
				return $newcommand;
			}

		}elseif($cdtype==6){

			if($desc==0)
				$desc="co.name ASC";
			elseif($desc==1)
				$desc="co.name DESC";
			elseif($desc==2)
				$desc="price ASC";
			elseif($desc==3)
				$desc="price DESC";
			
			$params="customers";
			$params2="customerID";
			$params3="customerdealerID";
			

			if($raporlamacd==0)
					$command = $connection->createCommand('SELECT count(*) as count,c.city, co.name as name,sum(salesPrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')  GROUP BY  co.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
					
				elseif($raporlamacd==1)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.city, co.name  as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID)   WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')   GROUP BY  co.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==2)
					$command = $connection->createCommand('SELECT count(*) as count,c.city, co.name  as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID)   WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')   GROUP BY  co.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');	
				elseif($raporlamacd==3)
					$command = $connection->createCommand('SELECT count(*) as count,c.city, co.name  as name,-sum(salesreturnPrice*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID)  WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')  GROUP BY  co.ID ORDER BY '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==4)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.city, co.name  as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').'  AND c.city IN('.$array_.')  GROUP BY  co.ID ORDER BY '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==5)
					$command = $connection->createCommand('
					select count,country, name,sum(price) as price from (
					
					(
					SELECT count(*) as count,c.city, co.name  as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) '.($cdtype==4?"left join salesdetail f on ( s.salescompleteID=s.salescompleteID)":"").' left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.')  left join city co on ( c.city=co.ID)  WHERE  s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')   GROUP BY  co.ID ORDER BY '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					) 
					union
					(
					SELECT count(*) as count,c.city, co.name  as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')  GROUP BY  co.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)
					
					union
					(
					SELECT count(*) as count,c.city, co.name  as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID)  WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').'  AND c.city IN('.$array_.')  GROUP BY  co.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)) as ca group by country
					
					');
				
			//****************************************************************//

			
			$params="dealers";
			$params2="dealersID";
			$params3="customerdealerID";
		
			

			if($raporlamacd==0)
					$command2 = $connection->createCommand('SELECT count(*) as count,c.city, co.name as name,sum(salesPrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')  GROUP BY  co.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
					
				elseif($raporlamacd==1)
				
					$command2 = $connection->createCommand('SELECT count(*) as count,c.city, co.name  as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID)  WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')   GROUP BY  c.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==2)
					$command2 = $connection->createCommand('SELECT count(*) as count,c.city, co.name  as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')   GROUP BY  c.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');	
				elseif($raporlamacd==3)
					$command2 = $connection->createCommand('SELECT count(*) as count,c.city, co.name  as name,-sum(salesreturnPrice*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')  GROUP BY  c.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==4)
				
					$command2= $connection->createCommand('SELECT count(*) as count,c.city, co.name  as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').'  AND c.city IN('.$array_.')  GROUP BY  c.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==5)
					$command2 = $connection->createCommand('
					select count,city, name,sum(price) as price from (
					
					(
					SELECT count(*) as count,c.city, co.name  as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) '.($cdtype==4?"left join salesdetail f on ( s.salescompleteID=s.salescompleteID)":"").' left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.')  left join city co on ( c.city=co.ID) WHERE  s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')   GROUP BY  c.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					) 
					union
					(
					SELECT count(*) as count,c.city, co.name  as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').' AND c.city IN('.$array_.')  GROUP BY  c.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)
					
					union
					(
					SELECT count(*) as count,c.city, co.name  as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') left join city co on ( c.city=co.ID) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype<3?'AND cdtype="'.$cdtype.'"':'').'  AND c.city IN('.$array_.')  GROUP BY  c.ID ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)) as ca group by city
					
					');
				
			
			if($count==true){
				$command2=$command2->execute();
				
			}else
				$command2=$command2->queryAll();

			if($count==true){
				$command=$command->execute();
				
			}else
				$command=$command->queryAll();


		

			if($count==true){
					return $command+$command2;
				}else{
					$newcommand=array();
					$i=0;
					foreach($command as $key=>$value){
						$value=(object)$value;
						$newcommand[$i]["city"]=$value->city;
						$newcommand[$i]["name"]=$value->name;
						$newcommand[$i]["price"]=$value->price;
						$i++;
					}

					foreach($command2 as $key=>$value){
						$value=(object)$value;
						$newcommand[$i]["city"]=$value->city;
						$newcommand[$i]["name"]=$value->name;
						$newcommand[$i]["price"]=$value->price;
						$i++;
					}	
					return $newcommand;

				}
		}
		
	}

	public static function getParams($param){
		$params = new Params;
		return $params->get($param);
	}
	
	public static function getParams_($param,$id){
		$params = new Params;
		$array=$params->get($param);
		return $array[$id];
	}

}


<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	
	public function actionGetcur($id){
		$this->renderPartial("getcur",array("id"=>$id,'type'=>@$_POST["type"]));
	}
	
	public function actionCur(){
		
		$model=Currencymoney::model()->findAll();
		
		
		
			foreach($model as $key=>$value){
				$url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $value->moneya . "TRY" .'=X';
				$handle = @fopen($url, 'r');
				 
				if ($handle) {
				    $result = fgets($handle, 4096);
				    fclose($handle);
				}
				$allData = explode(',',$result); /* Get all the contents to an array */
			
				$ds=$allData[1];

					$modelA=Currencymoney::model()->find("moneya=:money",array(":money"=>$value->moneya));
					$modelA->cur=$ds;
					$modelA->update();
					
						$modelCurrencyd=Currencyd::model()->find("dateAdd=:dateAdd AND currencyID=:currencyID",array("dateAdd"=>date("Y-m-d"),"currencyID"=>$modelA->currencyID));
						
						if(count($modelCurrencyd)>0){
							$modelCurrencyd->cur=$ds;
							$modelCurrencyd->update();
						}else{
							$modelCurrencyd= new Currencyd;
							$modelCurrencyd->currencyID=$modelA->currencyID;
							$modelCurrencyd->moneya=$modelA->moneya;
							$modelCurrencyd->cur=$ds;
							$modelCurrencyd->dateAdd=date("Y-m-d");
							$modelCurrencyd->save();
						}
				
			}
			
		
		
	}
	public function actionMaps(){
		
		
		$criteria=new CDbCriteria;
		$criteria->select='*, t.name as name, p.name as productsGroupName';
		$criteria->join="left join productgroups p  on t.productgroupsID=p.productgroupsID left join productdetail pd on (t.productsID=pd.productsID)";
		$modelProducts=Products::model()->findAll($criteria);
		
		header('Content-Type: application/xml');
		$this->renderPartial('maps',array(
			'model'=>$modelProducts,
		));
	}
	
	public function actionIndex()
	{
		if(yii::app()->user->getState('ADMIN')){
			$this->layout="panel";
			$this->render('panel');
		}else{
			$this->render('index');
		}
		
	}
	
	public function actionPanel()
	{
		if(yii::app()->user->getState('ADMIN')){
			$this->layout="panel";
			$this->render('panel');
		}else{
			$this->actionIndex();
		}
	}

	/*
	
	public function actionRegistration()
	{
		$model=new Companies;
		$cityothervalid="";
		$city="";
		$saveOk=false;
		$message="";

		
		if(isset($_POST['Companies']))
		{
			$model->attributes=$_POST['Companies'];
			$cityothervalid=$model->cityothervalid;
			$city=$model->city;
			$model->deleted=1;
			$model->dateAdd=date("Y-m-d H:i:s");
			$password=$model->password;
			$repassword=$model->repassword;
			
			$model->password=md5(md5($model->password));
			$model->repassword=md5(md5($model->repassword));
			
			if($model->save()){
				
				$modelEmployees= new Employees;
				$modelEmployees->name=$model->nameSurname;
				$modelEmployees->erights=1;
				$modelEmployees->email=$model->email;
				$modelEmployees->password=$model->password;
				$modelEmployees->title="-";
				$modelEmployees->companyID=$model->companyID;
				$modelEmployees->deleted=1;
				$modelEmployees->status=0;
				$modelEmployees->dateAdd=date("Y-m-d H:i:s");
				$modelEmployees->admins=1;
				$modelEmployees->save();
				
				$this->addProc($model);
				
				$this->loginSession($model,$modelEmployees);
				$saveOk=true;
				$EmailIdentity = new EmailIdentity;
				$EmailIdentity->sendMailonay($modelEmployees,$this->getLink()."/site/onay?code=".$this->randfunc());
				$message=Yii::t('trans','Başarlı bir şekilde kayıt oldunuz. Lütfen Bekleyiniz...');
			}else{
				$model->password=$password;
				$model->repassword=$repassword;
			}
		}
		$this->render('registration',array(
			'model'=>$model,
			'cityothervalid'=>$cityothervalid,
			'city'=>$city,
			'saveOk'=>$saveOk,
			'message'=>$message,
		)
		);
	}

	*/
	public function getLink(){
		
		if($_SERVER['SERVER_NAME']=="sahayonetimi"){
			return "www.sahayonetimi.com";
		}elseif($_SERVER['SERVER_NAME']=="managerfield"){
			return "www.managerfield.com";
		}else{
			return "www.sahayonetimi.com";
		}
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
	
	public function addProc($model){
		$modelWorld=new World;
		$modelWorld->name= Yii::t('trans','Ticaretim - 1');
		$modelWorld->status=1;
		$modelWorld->companyID=$model->companyID;
		$modelWorld->save();
	}
	
	public function actionSetworld($id){
		Yii::app()->user->setState('worldID',$id);
		$this->redirect(array('//site'));
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	
	public function actionGetcity(){
		
		$modelCity= City::model()->findAll('code =:code',array(':code'=>$_POST['code']));
		$strCity="";
		foreach($modelCity as $key =>$value){
			$strCity .= $value->name.':'.$value->cityID.',';
		}
		echo substr($strCity,0,strlen($strCity)-1);
	}
	
	

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	private function loginSession($modelCompanies,$modelEmployees){
		$controller=new Logincontroller;
		$controller->loginSession($modelCompanies,$modelEmployees);
	}
	
	
	public function actionDataControl(){
		$this->layout="panel";
		Yii::app()->user->setFlash('warning', Yii::t('trans','Bukadar çok işlem yapamazsınız.'));
		
		$this->render('datacontrol');
	}
	
	
	public function actionHoverappointment(){
		$date=date("Y-m")."-0".substr($_POST["day"],2,strlen($_POST["day"]))." 00:00:00";
		$dateN=date("Y-m")."-0".substr($_POST["day"],2,strlen($_POST["day"]))." 23:59:59";
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition="appointmentDate >=:date and  appointmentDate<=:dateN AND worldID=:worldID AND companyID=:companyID";
		$criteria->params=array(
		':date'=>$date,':dateN'=>$dateN,
		':companyID'=>yii::app()->user->getState('companyID'),
		':worldID'=>yii::app()->user->getState('worldID'),);
		$modelAppointments=Appointments::model()->findAll($criteria);
		
		foreach($modelAppointments as $key=>$value){
			$date=new DateTime($value->appointmentDate);
			$str=$value->cdtype==1?$this->getCustomerName($value->customerdealersID):$this->getDealersName($value->customerdealersID);
			echo "<span>".$date->format("d-m-Y H:i:s")."</span>: ".$str."<br>";
		}
	}
	
	public  function getCustomerName($id){
		$model=Customers::model()->findByPk($id);
		return $model->name;
	}
	
	public function getDealersName($id){
		$model=Dealers::model()->findByPk($id);
		return $model->name;
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
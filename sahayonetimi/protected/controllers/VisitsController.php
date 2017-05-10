<?php

class VisitsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
		
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('customersadmin','dealeradmin','setvisit','visitclear','create','update','getcustomerdealer'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('dealersadmin'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('dealeradmin'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionVisitclear(){
		Yii::app()->user->setState("setVisitID",null);
		Yii::app()->user->setState("setVisitName",null);
		Yii::app()->user->setState("setVisitType",null);
		Yii::app()->user->setState("setVisitID_",null);
		$data["sonuc"]=1;
		echo json_encode($data);

	}
	
	public function actionSetvisit(){
		$data["sonuc"]=0;
		if($_POST["cdtype"]==1){
			$modelCustomers=Customers::model()->findByPk($_POST["id"]);
			if(count($modelCustomers)>0){
				Yii::app()->user->setState("setVisitID_",$_POST["visitsID"]);
				Yii::app()->user->setState("setVisitID",$modelCustomers->customerID);
				Yii::app()->user->setState("setVisitName",$modelCustomers->name);
				Yii::app()->user->setState("setVisitType",1);
				$data["sonuc"]=1;
				$data["name"]=$modelCustomers->name;
			}
		}else{
			$modelDealers=Dealers::model()->findByPk($_POST["id"]);
			if(count($modelDealers)>0){
				Yii::app()->user->setState("setVisitID_",$_POST["visitsID"]);
				Yii::app()->user->setState("setVisitID",$modelDealers->dealersID);
				Yii::app()->user->setState("setVisitName",$modelDealers->name);
				Yii::app()->user->setState("setVisitType",2);
				$data["sonuc"]=1;
				$data["name"]=$modelDealers->name;
			}
		}
		echo json_encode($data);
	}

	public function actionGetcustomerdealer(){
		$arr = array();
		  $term = Yii::app()->getRequest()->getParam('term', false);
		  if ($term)
		  {
			  	 $sql = 'SELECT customerID, name FROM customers where companyID='.Yii::app()->user->getState("companyID").' AND worldID='.Yii::app()->user->getState("worldID").' AND LCASE(name) LIKE :name AND deleted=1';
				 $cmd = Yii::app()->db->createCommand($sql);
				 $cmd->bindValue(":name","%".strtolower($term)."%", PDO::PARAM_STR);
				 $res = $cmd->queryAll();
				 foreach($res as $model)
				 {
					 $model=(object)$model;
					$arr[] = array(
					  'label'=>$model->name,  // label for dropdown list
					  'value'=>$model->name,  // value for input field
					  'id'=>$model->customerID,  
					  'cdtype'=>1,           
					);
				 }
				 
				  $sql = 'SELECT dealersID, name FROM dealers where companyID='.Yii::app()->user->getState("companyID").' AND worldID='.Yii::app()->user->getState("worldID").' AND LCASE(name) LIKE :name AND deleted=1';
				 $cmd = Yii::app()->db->createCommand($sql);
				 $cmd->bindValue(":name","%".strtolower($term)."%", PDO::PARAM_STR);
				 $res = $cmd->queryAll();
				 foreach($res as $model)
				 {
					 $model=(object)$model;
					$arr[] = array(
					  'label'=>$model->name,  // label for dropdown list
					  'value'=>$model->name,  // value for input field
					  'id'=>$model->dealersID,            // return value from autocomplete
					  'cdtype'=>2,
					);
				 }
			
		  }
		  
		  
		  echo CJSON::encode($arr);
		  Yii::app()->end();
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$this->accessRules($model);
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Visits;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_GET["appointmentsID"]))
			$model->appointmentsID=$_GET["appointmentsID"];
			
		if(isset($_GET["customerdealersID"]) && isset($_GET["cdtype"])){
			$modelCustomers=Customers::model()->cache($this->cache)->findByPk($_GET["customerdealersID"]-$this->getParams("dealercustomerplus"));
			if(count($modelCustomers)>0){
				$model->customerdealer=$modelCustomers->name;
				$model->customerdealerID=$_GET["customerdealersID"]-$this->getParams("dealercustomerplus");
			}
				
			$modelDealers=Dealers::model()->cache($this->cache)->findByPk($_GET["customerdealersID"]-$this->getParams("dealerplus"));
			if(count($modelDealers)>0){
					$model->customerdealer=$modelDealers->name;
					$model->customerdealerID=$_GET["customerdealersID"]-$this->getParams("dealerplus");
			}
					
			$model->cdtype=$_GET["cdtype"];
			
		}
		if(isset($_POST['Visits']))
		{
			$model->attributes=$_POST['Visits'];
			
			if($model->cdtype==1){
				$modelCustomers=Customers::model()->cache($this->cache)->findByPk($model->customerdealerID);
				if(count($modelCustomers)>0)
					$model->customerdealer=$modelCustomers->name;
			}elseif($model->cdtype==2){
				$modelDealers=Dealers::model()->cache($this->cache)->findByPk($model->customerdealerID);
				if(count($modelDealers)>0)
					$model->customerdealer=$modelDealers->name;
			}
			$model->worldID=Yii::app()->user->getState("worldID");
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->deleted=1;
			$model->visitDate=date("Y-m-d H:i:s");
			$model->employeesID=Yii::app()->user->getState("ID");
			$appointmentsID=$model->appointmentsID;
			if($model->appointmentsID!="")
				$model->appointmentsID=$model->appointmentsID-$this->getParams("appointmentsplus");
				
			if($model->save())
				$this->redirect(array('view','id'=>$model->visitsID));
			else	
				$model->appointmentsID=$appointmentsID;
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$this->accessRules($model);
		if($model->cdtype==1){
				$modelCustomers=Customers::model()->cache($this->cache)->findByPk($model->customerdealerID);
			if(count($modelCustomers)>0)
				$model->customerdealer=$modelCustomers->name;
		}elseif($model->cdtype==2){
			$modelDealers=Dealers::model()->cache($this->cache)->findByPk($model->customerdealerID);
			if(count($modelDealers)>0)
				$model->customerdealer=$modelDealers->name;
		}
		
		$model->appointmentsID=$model->appointmentsID+$this->getParams("appointmentsplus");
		if(isset($_POST['Visits']))
		{
			$model->attributes=$_POST['Visits'];
			
			if($model->cdtype==1){
				$modelCustomers=Customers::model()->cache($this->cache)->findByPk($model->customerdealerID);
				if(count($modelCustomers)>0)
					$model->customerdealer=$modelCustomers->name;
			}elseif($model->cdtype==2){
				$modelDealers=Dealers::model()->cache($this->cache)->findByPk($model->customerdealerID);
				if(count($modelDealers)>0)
					$model->customerdealer=$modelDealers->name;
			}
			
			if($model->appointmentsID!="")
				$model->appointmentsID=$model->appointmentsID-$this->getParams("appointmentsplus");
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->visitsID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		
		$modelSalescompletecustomer=Salescompletecustomer::model()->find("visitsID=:visitsID",array(":visitsID"=>$model->visitsID));
		if(count($modelSalescompletecustomer)==0)
			$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		 $this->redirect(array("admin"));
	}

	/**
	 * Manages all models.
	 */
	public function actionCustomersadmin()
	{
		$model=new Visits('search');
		$model->unsetAttributes();  // clear any default values
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->deleted=1;
		$model->cdtype=1;
		if(isset($_GET['Visits'])){
			$model->attributes=$_GET['Visits'];
			if($model->visitDate !=""){
				$date=new DateTime($model->visitDate);
				$model->visitDate = $date->format('Y-m-d H:i:s');
			}
			
		}
		$this->render('customersadmin',array(
			'model'=>$model,
		));
	}
	
	public function actionDealersadmin()
	{
		$model=new Visits('search');
		$model->unsetAttributes();  // clear any default values
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->deleted=1;
		$model->cdtype=2;
		if(isset($_GET['Visits'])){
			$model->attributes=$_GET['Visits'];
			if($model->visitDate !=""){
				$date=new DateTime($model->visitDate);
				$model->visitDate = $date->format('Y-m-d H:i:s');
			}
			
		}

		$this->render('dealersadmin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Visits the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Visits::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Visits $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='visits-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
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
	
	public static function getDateTimeFormat($dateTime){
		$controller=new Sitecontroller;
		return $controller->getDateTimeFormat($dateTime);
	}
	public static function getCustomerDealer($id,$cdtype){
		if($cdtype==1){
			$modelCustomers=Customers::model()->cache($this->cache)->findByPk($id);
			if(count($modelCustomers)>0){
				return $modelCustomers->name;
				
			}
		}else{
			
			$modelDealers=Dealers::model()->cache($this->cache)->findByPk($id);
			if(count($modelDealers)>0){
				
				return $modelDealers->name;
				
			}
		}
	}
	
	public function getEmployeesName($id){
		$model=Employees::model()->cache($this->cache)->findByPk($id);
		if(count($model)>0)
			return $model->name;
	}
	
	
}

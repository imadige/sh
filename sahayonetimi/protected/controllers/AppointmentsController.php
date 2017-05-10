<?php

class AppointmentsController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','create2','update','getcustomerdealer'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('customersadmin','dealersadmin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
	
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Appointments;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Appointments']))
		{
			$model->attributes=$_POST['Appointments'];
			if($model->cdtype==1){
				$modelCustomers=Customers::model()->cache($this->cache)->findByPk($model->customerdealersID);
				if(count($modelCustomers)>0)
					$model->customerdealer=$modelCustomers->name;
			}elseif($model->cdtype==2){
				$modelDealers=Dealers::model()->cache($this->cache)->findByPk($model->customerdealersID);
				if(count($modelDealers)>0)
					$model->customerdealer=$modelDealers->name;
			}
			
			$model->dateAdd=date("Y-m-d H:i:s");
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->deleted=1;
			$model->worldID=Yii::app()->user->getState("worldID");
			
			$date=new DateTime($model->appointmentDate);
			$model->appointmentDate=$date->format("Y-m-d H:i:s");
			if($model->save())
				$this->redirect(array('view','id'=>$model->appointmentsID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionCreate2($id)
	{
		$model=new Appointments;
		
		if(isset($_GET["cdtype"])){
			$cdtype=$_GET["cdtype"];
		}else{
			$this->redirect(array('create'));
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if($cdtype==1){
			$modelCustomers=Customers::model()->cache($this->cache)->findByPk($id);
			if(count($modelCustomers)>0){
				$model->customerdealer=$modelCustomers->name;
				$model->customerdealersID=$modelCustomers->customerID;
				
			}
		}else{
			
			$modelDealers=Dealers::model()->cache($this->cache)->findByPk($id);
			if(count($modelDealers)>0){
				
				$model->customerdealer=$modelDealers->name;
				$model->customerdealersID=$modelDealers->dealersID;
			}
		}
			
		$model->cdtype=$cdtype;
		if(isset($_POST['Appointments']))
		{
			$model->attributes=$_POST['Appointments'];
			
			
			$model->dateAdd=date("Y-m-d H:i:s");
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->deleted=1;
			$model->worldID=Yii::app()->user->getState("worldID");
			
			$date=new DateTime($model->appointmentDate);
			$model->appointmentDate=$date->format("Y-m-d H:i:s");
			if($model->save())
				$this->redirect(array('view','id'=>$model->appointmentsID));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$modelCustomers=Customers::model()->cache($this->cache)->findByPk($model->customerID);
		if(count($modelCustomers)>0){
			$model->customerID=$modelCustomers->customerID;
		}
			
		if(isset($_POST['Appointments']))
		{
			$model->attributes=$_POST['Appointments'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->appointmentsID));
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
		$this->loadModel($id)->delete();

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
		$model=new Appointments('search');
		$model->unsetAttributes();  // clear any default values
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->deleted=1;
		$model->cdtype=1;
		if(isset($_GET['Appointments'])){
			$model->attributes=$_GET['Appointments'];
			if($model->appointmentDate !=""){
				$date=new DateTime($model->appointmentDate);
				$model->appointmentDate = $date->format('Y-m-d H:i:s');
			}
			
		}

		$this->render('customersadmin',array(
			'model'=>$model,
		));
	}
	
	public function actionDealersadmin()
	{
		$model=new Appointments('search');
		$model->unsetAttributes();  // clear any default values
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->deleted=1;
		$model->cdtype=2;
		if(isset($_GET['Appointments'])){
			$model->attributes=$_GET['Appointments'];
			if($model->dateAdd !=""){
				$date=new DateTime($model->dateAdd);
				$model->dateAdd = $date->format('Y-m-d H:i:s');
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
	 * @return Appointments the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Appointments::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Appointments $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='appointments-form')
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
	
	public function getDateTimeFormat($dateTime){
		$controller=new Sitecontroller;
		return $controller->getDateTimeFormat($dateTime);
	}
	
	public function getCustomerName($id){
		
		$model=Employees::model()->cache($this->cache)->findByPk($id);
		if(count($model)>0)
			return $model->name;
	
	}
	
	public function getCustomerDealer($id,$cdtype){
		
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
}

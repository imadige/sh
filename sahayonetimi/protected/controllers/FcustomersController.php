<?php

class FcustomersController extends Controller
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		
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
		$model=new Customers;
		$city="";
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Customers']))
		{
			$model->attributes=$_POST['Customers'];
			$city=$model->city;
			$model->deleted=1;
			$model->dateAdd=date("Y-m-d H:i:s");
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->opportunity=1;
			$model->addEmployeesID=Yii::app()->user->getState("ID");
			$model->worldID=Yii::app()->user->getState("worldID");
			if($model->save())
				$this->redirect(array('view','id'=>$model->customerID));
		}

		$this->render('create',array(
			'model'=>$model,
			'city'=>$city,
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
		$this->accsesControl($model);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if($model->city=="")
			$city="";
		else
			$city=$model->city;
		if(isset($_POST['Customers']))
		{
			$model->attributes=$_POST['Customers'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->customerID));
		}

		$this->render('update',array(
			'model'=>$model,
			'city'=>$city,
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
		$model->deleted=0;
		$model->update();
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
	public function actionAdmin()
	{
		$model=new Customers('search');
		$model->unsetAttributes();  // clear any default values
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->opportunity=1;
		$model->deleted=1;
		if(isset($_GET['Customers'])){
			$model->attributes=$_GET['Customers'];
			
			if($model->city!=""){
				$modelCity=City::model()->findByPk($model->city);
				
				if(count($modelCity)>0)
					$model->city=$modelCity->name;
			
			}
			if($model->country!=""){
				$modelCountry=Country::model()->findByPk($model->country);
				
				if(count($modelCountry)>0)
					$model->country=$modelCountry->name;
			
			}
			if($model->dateAdd !=""){
				$date=new DateTime($model->dateAdd);
				$model->dateAdd = $date->format('Y-m-d H:i:s');
			}
			
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Customers the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Customers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Customers $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customers-form')
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
	
	
	public function getCg($id){
		$modelCustomergroups=Customergroups::model()->findByPk($id);
		if(count($modelCustomergroups)>0)
			return $modelCustomergroups->name;
		else
			return "-";
	}
	
	public function getCgList(){
		$array=array();
		$modelCustomergroups=Customergroups::model()->findAll();
		foreach($modelCustomergroups as $key=>$value)
			 $array[$value->customerGroupsID]=$value->name;
		return $array;
	}
	
	
	public function getEmployeesName($id){
		$model=Employees::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
	}
	
	public function getCity($id){
		$model=City::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
	}
	
	public function getCountry($id){
		$model=Country::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
	}
	
	public function getDateTimeFormat($dateTime){
		$controller=new Sitecontroller;
		return $controller->getDateTimeFormat($dateTime);
	}
	
	public function getCustomerLogo30($file,$id){
		$controller=new Sitecontroller;
		return $controller->getCustomerLogo30($file,$id);
	}
}

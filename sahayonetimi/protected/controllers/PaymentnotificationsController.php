<?php

class PaymentnotificationsController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('getcustomerdealer'),
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
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		if(isset($_POST['Paymentnotifications']))
		{
			$model->attributes=$_POST['Paymentnotifications'];
			
			$model->update();
			
		}
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
		$model=new Paymentnotifications;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Paymentnotifications']))
		{
			$model->attributes=$_POST['Paymentnotifications'];
			
			$model->dateAdd=date("Y-m-d H:i:s");
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->employeesID=Yii::app()->user->getState("ID");
			$model->worldID=Yii::app()->user->getState("worldID");
			$model->paymentStatus=0;
			if($model->save())
				$this->redirect(array('view','id'=>$model->paymentnotificationsID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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
		$model=new Paymentnotifications('search');
		$model->unsetAttributes();  // clear any default values
		
		$model->companyID=Yii::app()->user->getState("companyID");	
		$model->worldID=Yii::app()->user->getState("worldID");
		if(isset($_GET['Paymentnotifications'])){
			$model->attributes=$_GET['Paymentnotifications'];
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
	 * @return Paymentnotifications the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Paymentnotifications::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Paymentnotifications $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='paymentnotifications-form')
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
	public static  function getEmployeesName($id){
		$model=Employees::model()->cache($this->cache)->findByPk($id);
		if(count($model)>0)
			return $model->name;
	}
	public static  function getDateTimeFormat($dateTime){
		$controller=new Sitecontroller;
		return $controller->getDateTimeFormat($dateTime);
	}
}

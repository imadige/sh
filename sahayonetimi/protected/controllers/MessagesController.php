<?php

class MessagesController extends Controller
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
	private function accsesControl2($model){
		$controller= new Sitecontroller;
		$return=$controller->accsesControl2($model);
		if($return==true)
			$this->redirect(array("//site"));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
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
		$criteria=new CDbCriteria;
		$criteria->select='*,e.name as name,t.dateAdd as dateAdd';
		$criteria->condition='t.messagesID=:messagesID';
		$criteria->params=array(':messagesID'=>$id);
		$criteria->join = 'left join employees e on(e.employeesID=t.employeesID)';
		$model=Messages::model()->find($criteria);
		$this->accsesControl2($model);

		$model2= new Messagesanswer;
		if(isset($_POST['Messagesanswer']))
		{
			$model2->attributes=$_POST['Messagesanswer'];
			$model2->messagesID=$id;
			$model2->dateAdd=date("Y-m-d H:i:s");
			$model2->employeesID=Yii::app()->user->getState("ID");
			if($model2->save()){
				
			
				$model->updateDate=date("Y-m-d H:i:s");
				$model->update();
				$this->redirect(array("view","id"=>$id));
			}
		}

		$criteria=new CDbCriteria;
		$criteria->select='*,e.name as name,t.dateAdd as dateAdd';
		$criteria->condition='t.messagesID=:messagesID';
		$criteria->params=array(':messagesID'=>$id);
		$criteria->join = 'left join employees e on(e.employeesID=t.employeesID)';
		$modelAnswer=Messagesanswer::model()->findAll($criteria);

			$criteria=new CDbCriteria;
			$criteria->select='*';
			$criteria->condition='messagesID=:messagesID  AND employeesID=:employeesID';
			$criteria->params=array(':messagesID'=>$id,':employeesID'=>Yii::app()->user->getState("ID"));
			$modelMessagesread=Messagesread::model()->find($criteria);
			
			if(count($modelMessagesread)>0){
				if($modelMessagesread->readd!=1){
					$modelMessagesread->readd=1;
					$modelMessagesread->update();
				}
			}else{
				$modelMessagesread = new Messagesread;
				$modelMessagesread->employeesID=Yii::app()->user->getState("ID");
				$modelMessagesread->messagesID=$id;
				$modelMessagesread->readd=1;
				$modelMessagesread->save();
			}
		$this->render('view',array(
			'model'=>$model,
			'model2'=>$model2,
			'modelAnswer'=>$modelAnswer
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Messages;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Messages']))
		{
			$model->attributes=$_POST['Messages'];
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->employeesID=Yii::app()->user->getState("ID");
			$model->dateAdd=date("Y-m-d H:i:s");
			$model->updateDate=date("Y-m-d H:i:s");
			if($model->save()){
				
				if($model->whomID!=""){
					$model->whomID.=Yii::app()->user->getState("ID").":a";
					$datab=explode(",",$model->whomID);
				
					foreach($datab as $key=>$value){
						$value=explode(":",$value);
						$modelMessagesusers = new Messagesusers;
						$modelMessagesusers->employeesID=$value[0];
						$modelMessagesusers->messagesID=$model->messagesID;
						$modelMessagesusers->save();
					}

					foreach($datab as $key=>$value){
						$value=explode(":",$value);
						$modelMessagesread = new Messagesread;
						$modelMessagesread->employeesID=$value[0];
						$modelMessagesread->messagesID=$model->messagesID;
						$modelMessagesread->read=0;
						$modelMessagesread->save();
					}
				}
				$this->redirect(array('view','id'=>$model->messagesID));

			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	
	
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Messages('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Messages']))
			$model->attributes=$_GET['Messages'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Messages the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Messages::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Messages $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='messages-form')
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
}

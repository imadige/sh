<?php

class ProductgroupsController extends Controller
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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','gettax'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('deletegroup'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionDeletegroup($id){
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		$id=$model->productgroupsID;
		if($model->delete())
			$this->deletegroup($id);
		
		$this->redirect(array('productgroups/index'));
	}
	
	
	public function deletegroup($id){
		$model=Productgroups::model()->find("pgID=:pgID",array(":pgID"=>$id));
		if(isset($model)){
			$ids=$model->productgroupsID;
			$model->delete();
			$this->deletegroup($ids);
		}
	}
	
	public function actionGettax(){
		$model=Productgroups::model()->cache($this->cache)->findByPk($_POST["id"]);
		
		$data["tax"]=$model->tax;
		
		echo json_encode($data);
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Productgroups;
		
		
		
		
		
		$model->tx2="00";

		if(isset($_POST['Productgroups']))
		{
			$model->attributes=$_POST['Productgroups'];
			
			if(!empty($model->tx1) && !empty($model->tx2)){
				$model->tax=$model->tx1.".".$model->tx2;
			}
			
			if(!empty($model->reduce1) && !empty($model->reduce2)){
				$model->dealersreduction=$model->reduce1.".".$model->reduce2;
			}
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->worldID=Yii::app()->user->getState("worldID");
			$model->deleted=1;
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	
	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		$model->updates=true;
		
		
		if(!empty($model->tax)){
			$dt=explode(".",$model->tax);
			$model->tx1=$dt[0];
			
			if(isset($dt[1]))
				$model->tx2=$dt[1];
			else
				$model->tx2="00";
		}
		
		if(!empty($model->dealersreduction)){
			$dt=explode(".",$model->dealersreduction);
			$model->reduce1=$dt[0];
			
			if(isset($dt[1]))
				$model->reduce2=$dt[1];
			else
				$model->reduce2="00";
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Productgroups']))
		{
			$model->attributes=$_POST['Productgroups'];
			
			if(!empty($model->tx1) && !empty($model->tx2)){
				$model->tax=$model->tx1.".".$model->tx2;
			}
			
			if(!empty($model->reduce1) && !empty($model->reduce2)){
				$model->dealersreduction=$model->reduce1.".".$model->reduce2;
			}
			if($model->save())
				$this->redirect(array('index'));
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
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
		$this->render('index');
	}

	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Productgroups the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Productgroups::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Productgroups $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='productgroups-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function getProductgroups_($type=3){
		$controller= new Sitecontroller;
		$array=$controller->getProductgroups_($type);
		
		return $array;
	}
	
	/*
	
	public function getProductgroups(){
		 $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1 and pgID=0",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")),
             'order'=>'name asc',
             ));
			 $list =array();
			foreach($modelCustomergroups as $key=>$value){
				$onek=1;
				$list[$value->productgroupsID]="_".$value->name;
				$list=$this->katListele($value->productgroupsID,$onek,$list);
			}
			
			return $list;
	}
	
	private function katListele($katid, $onek, &$list)
	{
		$onek2=$onek;
		 $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1 AND pgID=:pgID",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID"),':pgID'=>$katid),
             'order'=>'name asc',
             ));
		foreach($modelCustomergroups as $key=>$value){
			
			$list[$value->productgroupsID]=str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $onek).$value->name;
			
			$onek++;
			$list=$this->katListele($value->productgroupsID,$onek,$list);
			$onek=$onek2;
		}
		
		return $list;
	}
	
	*/
}

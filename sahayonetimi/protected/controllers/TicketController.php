<?php

class TicketController extends Controller
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
		$criteria->condition='t.ticketID=:ticketID';
		$criteria->params=array(':ticketID'=>$id);
		$criteria->join = 'left join employees e on(e.employeesID=t.employeesID)';
		$model=Ticket::model()->find($criteria);
		$this->accsesControl2($model);

		$model2= new Ticketanswer;
		if(isset($_POST['Ticketanswer']))
		{
			$model2->attributes=$_POST['Ticketanswer'];
			$model2->ticketID=$id;
			$model2->dateAdd=date("Y-m-d H:i:s");
			$model2->employeesID=Yii::app()->user->getState("ID");
			$model2->images1=CUploadedFile::getInstance($model,'images1');
			$model2->images2=CUploadedFile::getInstance($model,'images2');
			$model2->images3=CUploadedFile::getInstance($model,'images3');
			$model2->images4=CUploadedFile::getInstance($model,'images4');
			if($model2->save()){
				if($model2->images1!=""){
					 
						if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID) === false)
							mkdir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID, 0777);
							$uzanti=explode('.',$model2->images1);
							$this->logoAdd($model2,$uzanti,"images1");
					}
					if($model2->images2!=""){
					 
						if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID) === false)
							mkdir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID, 0777);
							$uzanti=explode('.',$model2->images2);
							$this->logoAdd($model2,$uzanti,"images2");
					}

					if($model2->images3!=""){
					 
						if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID) === false)
							mkdir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID, 0777);
							$uzanti=explode('.',$model2->images2);
							$this->logoAdd($model2,$uzanti,"images3");
					}


					if($model2->images4!=""){
					 
						if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/ticketanswer/'.$model->ticketID) === false)
							mkdir(Yii::getPathOfAlias('webroot').'/resimler/answer/'.$model->ticketID, 0777);
							$uzanti=explode('.',$model2->images2);
							$this->logoAdd($model2,$uzanti,"images4");
					}
				$model->cevap=0;
				$model->updateDate=date("Y-m-d H:i:s");
				$model->update();
				$this->redirect(array("view","id"=>$id));
			}
		}

		$criteria=new CDbCriteria;
		$criteria->select='*,e.name as name,t.dateAdd as dateAdd';
		$criteria->condition='t.ticketID=:ticketID';
		$criteria->params=array(':ticketID'=>$id);
		$criteria->join = 'left join employees e on(e.employeesID=t.employeesID)';
		$modelAnswer=Ticketanswer::model()->findAll($criteria);
		
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
		$model=new Ticket;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ticket']))
		{
			$model->attributes=$_POST['Ticket'];
		
			$model->cevap=0;
			$model->dateAdd=date("Y-m-d H:i:s");
			$model->updateDate=date("Y-m-d H:i:s");
			$model->employeesID=Yii::app()->user->getState("ID");
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->images1=CUploadedFile::getInstance($model,'images1');
			$model->images2=CUploadedFile::getInstance($model,'images2');
			$model->images3=CUploadedFile::getInstance($model,'images3');
			$model->images4=CUploadedFile::getInstance($model,'images4');
			
				
		
				if($model->save()){
					if($model->images1!=""){
					 
						if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID) === false)
							mkdir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID, 0777);
							$uzanti=explode('.',$model->images1);
							$this->logoAdd($model,$uzanti,"images1");
					}
					if($model->images2!=""){
					 
						if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID) === false)
							mkdir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID, 0777);
							$uzanti=explode('.',$model->images2);
							$this->logoAdd($model,$uzanti,"images2");
					}

					if($model->images3!=""){
					 
						if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID) === false)
							mkdir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID, 0777);
							$uzanti=explode('.',$model->images2);
							$this->logoAdd($model,$uzanti,"images3");
					}


					if($model->images4!=""){
					 
						if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID) === false)
							mkdir(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID, 0777);
							$uzanti=explode('.',$model->images2);
							$this->logoAdd($model,$uzanti,"images4");
					}
					
					$this->redirect(array('view','id'=>$model->ticketID));
				}
			
		}


		$this->render('create',array(
			'model'=>$model,
		));
	}

	private function randfunc(){
		$controller= new Sitecontroller;
		return $controller->randfunc();
	}
	private function logoAdd($model,$uzanti,$images){
		
		if($model->$images->saveAs(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID.'/'.$model->ticketID.'.'.$uzanti[1])){
			
			$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID.'/'.$model->ticketID.'.'.$uzanti[1]);
			$data = getimagesize(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID.'/'.$model->ticketID.'.'.$uzanti[1]);
			
			$password= $this->randfunc();
			$thumb->resize($data[0]);
			
			unlink(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID.'/'.$model->ticketID.'.'.$uzanti[1]);
			$thumb->save(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID.'/'.$password.'.'.$uzanti[1]);

			$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID.'/'.$password.'.'.$uzanti[1]);
			
			
			$thumb->resize(80);
			
			
			$thumb->save(Yii::getPathOfAlias('webroot').'/resimler/ticket/'.$model->ticketID.'/_'.$password.'.'.$uzanti[1]);
			
			$model->$images=$password.'.'.$uzanti[1];
			if($model->update()){
			
				return 1;
			}else
				return 0;
		}else
			return 0;
						
	}
	
	

	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ticket('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ticket'])){
			$model->attributes=$_GET['Ticket'];
			if(!empty($model->dateAdd)){
				$date=new DateTime($model->dateAdd);
				$model->dateAdd=$date->format("Y-m-d H:i:s");
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
	 * @return Ticket the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ticket::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ticket $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ticket-form')
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
}

<?php

class DealersController extends Controller
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
				'actions'=>array('index','view','viewp'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','addlogo','resize','deletelogo'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('getdealer'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	
	public function actionGetdealer(){
		$arr = array();
		  $term = Yii::app()->getRequest()->getParam('term', false);
		  if ($term)
		  {
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
		
		$this->render('view',array(
			'model'=>$model,
		));
	}
	
	public function actionViewp($id)
	{
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		
		$this->renderPartial('viewp',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Dealers;
		$city="";
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Dealers']))
		{
			$model->attributes=$_POST['Dealers'];
			$city=$model->city;
			$model->deleted=1;
			$model->dateAdd=date("Y-m-d H:i:s");
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->addEmployeesID=Yii::app()->user->getState("ID");
			$model->worldID=Yii::app()->user->getState("worldID");
			if($model->save())
				$this->redirect(array('addlogo','id'=>$model->dealersID));
				
		}

		$this->render('create',array(
			'model'=>$model,
			'city'=>$city,
		));
	}
	
	public function actionResize($id){
		$this->layout="panelno";
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		$unlinklogo=$model->logo;
		if(isset($_POST['Dealers'])){
						
							$modelCustomer=$this->loadModel($model->dealersID);

							$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$model->dealersID.'/'.$modelCustomer->logo);
							$thumb->crop($_POST['Dealers']["cropX"],$_POST['Dealers']["cropY"],$_POST['Dealers']["cropW"],$_POST['Dealers']["cropH"]);
							if($thumb->save(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$modelCustomer->dealersID.'/'.$modelCustomer->logo)){
								$password= $this->randfunc();
								
								$uzanti=explode('.',$model->logo);
								$model->logo=$password.'.'.$uzanti[1];
								
								$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$modelCustomer->dealersID.'/'.$modelCustomer->logo);
		
								$thumb->resize(200);
								$thumb->save(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$modelCustomer->dealersID.'/'.$password.'.'.$uzanti[1]);
								
								
								if($model->update()){
									unlink(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$modelCustomer->dealersID.'/'.$unlinklogo);
									$this->redirect(array('view','id'=>$model->dealersID));
								}
							}
							
						
					}
					
			$this->render('resize',array(
				'model'=>$model,
				
			));
	}

	public function actionAddlogo($id){
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		
			if($model->companyID==yii::app()->user->getState('companyID')){
			
				if(isset($_POST['Dealers']))
				{
					$model->attributes=$_POST['Dealers'];
					$model->logo=CUploadedFile::getInstance($model,'logo');
					if($model->validate()){
					
					
					if($model->logo!=""){
					 
						if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$model->dealersID) === false)
							mkdir(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$model->dealersID, 0777);
							$uzanti=explode('.',$model->logo);
							$tamam=$this->logoAdd($model,$uzanti);
							$model->logoLogo=$model->logo;
						
							$this->redirect(array('resize','id'=>$model->dealersID));
					}
				}
			}
			$this->render('addlogo',array(
				'model'=>$model,
				
			));
				
		}else
			$this->redirect(array('//site/index'));
	}
	
	private function randfunc(){
		$controller= new Sitecontroller;
		return $controller->randfunc();
	}
	private function logoAdd($model,$uzanti){
		
		if($model->logo->saveAs(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$model->dealersID.'/'.$model->dealersID.'.'.$uzanti[1])){
			
			$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$model->dealersID.'/'.$model->dealersID.'.'.$uzanti[1]);
			$data = getimagesize(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$model->dealersID.'/'.$model->dealersID.'.'.$uzanti[1]);
			
			$password= $this->randfunc();
			$thumb->resize($data[0]);
			
			unlink(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$model->dealersID.'/'.$model->dealersID.'.'.$uzanti[1]);
			$thumb->save(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$model->dealersID.'/'.$password.'.'.$uzanti[1]);
			
			$model->logo=$password.'.'.$uzanti[1];
			if($model->update()){
			
				return 1;
			}else
				return 0;
		}else
			return 0;
						
	}
	
	public function actionDeletelogo($id){
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		
		if(file_exists(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$model->dealersID.'/'.$model->logo)){
			if(unlink(Yii::getPathOfAlias('webroot').'/resimler/dealers/'.$model->dealersID.'/'.$model->logo)){
				$model->logo="-";
				$model->update();
			}
		}
		
		$this->redirect(array('view','id'=>$model->dealersID));
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
		if(isset($_POST['Dealers']))
		{
			$model->attributes=$_POST['Dealers'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->dealersID));
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
		$this->accsesControl($model);
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
		$model=new Dealers('search');
		$model->unsetAttributes();  // clear any default values
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->deleted=1;
		if(isset($_GET['Dealers'])){
			$model->attributes=$_GET['Dealers'];
			
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
	 * @return Dealers the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Dealers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Dealers $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dealers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public static function getCity($id){
		$model=City::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
	}
	
	public static function getCountry($id){
		$model=Country::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
	}
	
	public static function getDateTimeFormat($dateTime){
		$controller=new Sitecontroller;
		return $controller->getDateTimeFormat($dateTime);
	}
	
	public static function getEmployeesName($id){
		$model=Employees::model()->cache($this->cache)->findByPk($id);
		if(count($model)>0)
			return $model->name;
	}
	
	public  static function getParams($param){
		$params = new Params;
		return $params->get($param);
	}
	
	public static function getParams_($param,$id){
		$params = new Params;
		$array=$params->get($param);
		return $array[$id];
	}
	
	public static function getDealerLogo30($file,$id){
		$controller=new Sitecontroller;
		return $controller->getDealerLogo30($file,$id);
	}
	
	public static function getDealerLogo120($file,$id){
		$controller=new Sitecontroller;
		return $controller->getDealerLogo120($file,$id);
	}
	
}

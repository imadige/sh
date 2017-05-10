<?php

class EmployeesController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','worldemployees','worldemployeesedit', 'worldemployeesupdate'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('accountview'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('addlogo','resize','deletelogo'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('addlogo2','resize2','deletelogo2','update2','passwordchange'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('getemployees'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionGetemployees(){
		$arr = array();
		  $term = Yii::app()->getRequest()->getParam('term', false);
		  if ($term)
		  {
			  	 $sql = 'SELECT employeesID, name FROM employees where companyID='.Yii::app()->user->getState("companyID").'  AND LCASE(name) LIKE :name AND deleted=1';
				 $cmd = Yii::app()->db->createCommand($sql);
				 $cmd->bindValue(":name","%".strtolower($term)."%", PDO::PARAM_STR);
				 $res = $cmd->queryAll();
				 foreach($res as $model)
				 {
					 $model=(object)$model;
					$arr[] = array(
					  'label'=>$model->name,  // label for dropdown list
					  'value'=>$model->name,  // value for input field
					  'id'=>$model->employeesID,            // return value from autocomplete
					);
				 }
			
		  }
		  
		  
		  echo CJSON::encode($arr);
		  Yii::app()->end();
	}

	public function actionWorldemployeesupdate(){
		if($_POST["type"]==1) {
			$model=Worldemployees::model()->find("employeesID=:employeesID AND worldID=:worldID",array(":employeesID"=>$_POST["employeesID"],"worldID"=>$_POST["worldID"]));
			if(count($model)<1){	
				$model=new Worldemployees;
				$model->employeesID=$_POST["employeesID"];
				$model->worldID=$_POST["worldID"];
				$model->deleted=1;

				if($model->save())
					$data["sonuc"]=1;
				else
					$data["sonuc"]=0;
			}else{

				$model->deleted=1;

				if($model->update())
					$data["sonuc"]=1;
				else
					$data["sonuc"]=0;
			}

		}else{
			$model=Worldemployees::model()->find("employeesID=:employeesID AND worldID=:worldID",array(":employeesID"=>$_POST["employeesID"],"worldID"=>$_POST["worldID"]));
			$model->deleted=0;

			if($model->update())
				$data["sonuc"]=1;
			else
				$data["sonuc"]=0;

		}
		
		echo json_encode($data);

	}

	public function actionWorldemployeesedit($id){
		$model=$this->loadModel($id);
		$this->accsesControl2($model);

		$modelWorldemployees=Worldemployees::model()->findAll("employeesID=:employeesID",array("employeesID"=>$model->employeesID));

		$modelWorld=World::model()->findAll("companyID=:companyID",array("companyID"=>Yii::app()->user->getState("companyID")));

		$this->render("worldemployeesedit",array(
				'model'=>$model,
				'modelWorldemployees'=>$modelWorldemployees,
				'modelWorld'=>$modelWorld,
			));
	}

	public function actionDeletelogo($id){
		$model=$this->loadModel($id);
		$this->accsesControl2($model);
		
		
		if(file_exists(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$model->avatar)){
			if(unlink(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$model->avatar)){
				$model->avatar="-";
				$model->update();
			}
		}
		
		$this->redirect(array('view','id'=>$model->employeesID));
	}
	
	public function actionDeletelogo2(){
		$model=$this->loadModel(Yii::app()->user->getState("ID"));
		$this->accsesControl2($model);
		
		
		if(file_exists(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$model->avatar)){
			if(unlink(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$model->avatar)){
				$model->avatar="-";
				$model->update();
			}
		}
		
		$this->redirect(array('accountview'));
	}


	public function actionResize($id){
		$this->layout="panelno";
		$model=$this->loadModel($id);
		$this->accsesControl2($model);
		$unlinklogo=$model->avatar;
		if(isset($_POST['Employees'])){
						
							$modelEmployees=$this->loadModel($model->employeesID);

							$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$modelEmployees->avatar);
							$thumb->crop($_POST['Employees']["cropX"],$_POST['Employees']["cropY"],$_POST['Employees']["cropW"],$_POST['Employees']["cropH"]);
							if($thumb->save(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$modelEmployees->employeesID.'/'.$modelEmployees->avatar)){
								$password= $this->randfunc();
								
								$uzanti=explode('.',$model->avatar);
								$model->avatar=$password.'.'.$uzanti[1];
								
								$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$modelEmployees->employeesID.'/'.$modelEmployees->avatar);
		
								$thumb->resize(200);
								$thumb->save(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$modelEmployees->employeesID.'/'.$password.'.'.$uzanti[1]);
								
								
								if($model->update()){
									unlink(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$modelEmployees->employeesID.'/'.$unlinklogo);
										$this->redirect(array('view','id'=>$model->employeesID));
									
								}
							}
							
						
					}
					
			$this->render('resize',array(
				'model'=>$model,
				
			));
	}

	public function actionAddlogo($id){
		$model=$this->loadModel($id);
		$this->accsesControl2($model);
		
		
		if(isset($_POST['Employees']))
		{
			$model->attributes=$_POST['Employees'];
			$model->avatar=CUploadedFile::getInstance($model,'avatar');
			$model->update2=true;
			if($model->validate()){
				if($model->avatar!=""){
				 
					if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID) === false)
						mkdir(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID, 0777);
						$uzanti=explode('.',$model->avatar);
						$tamam=$this->logoAdd($model,$uzanti);
						$model->logoLogo=$model->avatar;
					
						$this->redirect(array('resize','id'=>$model->employeesID));
				}
			}
		}
		
		$this->render('addlogo',array(
			'model'=>$model,
			
		));
		
	}
	
	
	public function actionResize2(){
		$this->layout="panelno";
		$model=$this->loadModel(Yii::app()->user->getState("ID"));
		$this->accsesControl2($model);
		$unlinklogo=$model->avatar;
		if(isset($_POST['Employees'])){
						
							$modelEmployees=$this->loadModel($model->employeesID);

							$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$modelEmployees->avatar);
							$thumb->crop($_POST['Employees']["cropX"],$_POST['Employees']["cropY"],$_POST['Employees']["cropW"],$_POST['Employees']["cropH"]);
							if($thumb->save(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$modelEmployees->employeesID.'/'.$modelEmployees->avatar)){
								$password= $this->randfunc();
								
								$uzanti=explode('.',$model->avatar);
								$model->avatar=$password.'.'.$uzanti[1];
								
								$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$modelEmployees->employeesID.'/'.$modelEmployees->avatar);
		
								$thumb->resize(200);
								$thumb->save(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$modelEmployees->employeesID.'/'.$password.'.'.$uzanti[1]);
								
								
								if($model->update()){
									unlink(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$modelEmployees->employeesID.'/'.$unlinklogo);
									
										$this->redirect(array('accountview'));
								}
							}
							
						
					}
					
			$this->render('resize',array(
				'model'=>$model,
				
			));
	}

	public function actionAddlogo2(){
		$model=$this->loadModel(Yii::app()->user->getState("ID"));
		$this->accsesControl2($model);
		
		
		if(isset($_POST['Employees']))
		{
			$model->attributes=$_POST['Employees'];
			$model->update2=true;
			$model->avatar=CUploadedFile::getInstance($model,'avatar');

			if($model->validate()){
				
				if($model->avatar!=""){
				 
					if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID) === false)
						mkdir(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID, 0777);
						$uzanti=explode('.',$model->avatar);
						$tamam=$this->logoAdd($model,$uzanti);
						$model->logoLogo=$model->avatar;
					
						$this->redirect(array('resize2'));
				}
			}
		}
		
		$this->render('addlogo',array(
			'model'=>$model,
			
		));
	}
	
	
	private function randfunc(){
		$controller= new Sitecontroller;
		return $controller->randfunc();
	}
	private function logoAdd($model,$uzanti){
		
		if($model->avatar->saveAs(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$model->employeesID.'.'.$uzanti[1])){
			
			$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$model->employeesID.'.'.$uzanti[1]);
			$data = getimagesize(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$model->employeesID.'.'.$uzanti[1]);
			
			$password= $this->randfunc();
			$thumb->resize($data[0]);
			
			unlink(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$model->employeesID.'.'.$uzanti[1]);
			$thumb->save(Yii::getPathOfAlias('webroot').'/resimler/employees/'.$model->employeesID.'/'.$password.'.'.$uzanti[1]);
			
			$model->avatar=$password.'.'.$uzanti[1];
			if($model->update()){
			
				return 1;
			}else
				return 0;
		}else
			return 0;
						
	}
	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	 
	public function actionAccountview()
	{
		$this->render('accountview',array(
			'model'=>$this->loadModel(Yii::app()->user->getState("ID")),
		));
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
		$model=new Employees;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employees']))
		{
			$controller=new Sitecontroller;

			$model->attributes=$_POST['Employees'];
			$model->deleted=1;
			$model->status=1;
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->dateAdd=date("Y-m-d H:i:s");
			$model->admins=0;
			$password=$controller->randfunc();
			$model->password=md5(sha1(md5(base64_encode(md5(sha1(md5($password1)))))));
			
			if($model->save()){
				$EmailIdentity = new EmailIdentity;
				
				$EmailIdentity->sendMailpassword($modelEmployees,$password);
				$this->redirect(array('view','id'=>$model->employeesID));
			}
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

		if(isset($_POST['Employees']))
		{

			$model->attributes=$_POST['Employees'];
			$model->update2=true;
			if($model->save())
				$this->redirect(array('view','id'=>$model->employeesID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	
	public function actionUpdate2()
	{
		$model=$this->loadModel(Yii::app()->user->getState("ID"));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employees']))
		{
			$model->attributes=$_POST['Employees'];
			$model->update2=2;

			if($model->save())
				$this->redirect(array('accountview'));
		}

		$this->render('update2',array(
			'model'=>$model,
		));
	}
	
	
	public function actionPasswordchange()
	{
		$model=$this->loadModel(Yii::app()->user->getState("ID"));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employees']))
		{
			$model->attributes=$_POST['Employees'];
			$model->passwordchange=true;
			$model->password=md5(sha1(md5(base64_encode(md5(sha1(md5($model->password1)))))));
			if($model->save())
				$this->redirect(array('accountview'));
		}

		$this->render('passwordchange',array(
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
		if($model->admins!=1){

			$model->deleted=0;
			$model->update();
		}
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
		$model=new Employees('search');
		$model->unsetAttributes();  // clear any default values
		$model->admins=0;
		$model->deleted=1;
		if(isset($_GET['Employees']))
			$model->attributes=$_GET['Employees'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionWorldemployees()
	{
		$model=new Employees('search');
		$model->unsetAttributes();  // clear any default values
		$model->admins=0;
		$model->deleted=1;
		if(isset($_GET['Employees']))
			$model->attributes=$_GET['Employees'];

		$this->render('worldemployees',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Employees the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Employees::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Employees $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employees-form')
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
	
	public static function getEmployeesLogo120($file,$id){
		$controller=new Sitecontroller;
		return $controller->getEmployeesLogo120($file,$id);
	}
	
	public static function getEmployeesLogo30($file,$id){
		$controller=new Sitecontroller;
		return $controller->getEmployeesLogo30($file,$id);
	}
}

<?php

class ProblematicproductsController extends Controller
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
		);
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
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','dealersadmin','customersadmin','delete'),
				'users'=>array('*'),
			),
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('showbarcode','showqrbarcode','qrbarcodeprints','barcodeprints'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionBarcodeprints(){
		$this->layout="barcode";
		$model=$this->loadModel($_GET["id"]);
		$this->render("barcodeprint",array(
			'model'=>$model,
			'param'=>$_GET["param"],
		));
	}
	
	public function actionQrbarcodeprints(){
		$this->layout="barcode";
		$model=$this->loadModel($_GET["id"]);
		$this->render("qrbarcodeprint",array(
			'model'=>$model,
			'param'=>$_GET["param"],
		));
	}

	public function actionShowbarcode($id){
		$model=$this->loadModel($id);
		
		$this->renderPartial("barcode",array(
			'model'=>$model,
		));
	}
	
	public function actionShowqrbarcode($id){
		$model=$this->loadModel($id);
		
		$this->renderPartial("qrbarcode",array(
			'model'=>$model,
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
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
		$model=new Problematicproducts;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Problematicproducts']))
		{
			$model->attributes=$_POST['Problematicproducts'];
			$model->dateAdd=date("Y-m-d H:i:s");
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->worldID=Yii::app()->user->getState("worldID");
			$model->deleted=1;
			$model->problematicStatus=0;
			if($model->save())
				$this->redirect(array('view','id'=>$model->problematicproductsID));
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

		if(isset($_POST['Problematicproducts']))
		{
			$model->attributes=$_POST['Problematicproducts'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->problematicproductsID));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
		$model=new Problematicproducts('search');
		$model->unsetAttributes();  // clear any default values
		
		$model->deleted=1;
		$model->worldID=Yii::app()->user->getState("worldID");
		if(isset($_GET['Problematicproducts']))
			$model->attributes=$_GET['Problematicproducts'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionCustomersadmin()
	{
		$model=new Problematicproducts('search');
		$model->unsetAttributes();  // clear any default values
		$model->cdtype=1;
		$model->deleted=1;
		$model->worldID=Yii::app()->user->getState("worldID");
		if(isset($_GET['Problematicproducts']))
			$model->attributes=$_GET['Problematicproducts'];

		$this->render('customersadmin',array(
			'model'=>$model,
		));
	}
	
	public function actionDealersadmin()
	{
		$model=new Problematicproducts('search');
		$model->unsetAttributes();  // clear any default values
		$model->cdtype=2;
		$model->deleted=1;
		$model->worldID=Yii::app()->user->getState("worldID");
		if(isset($_GET['Problematicproducts']))
			$model->attributes=$_GET['Problematicproducts'];

		$this->render('dealersadmin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Problematicproducts::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='problematicproducts-form')
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
	
	public function getProduct($id){
		$modelProducts=Products::model()->findByPk($id);
		
		if(count($modelProducts)>0)
			return $modelProducts->name." - ".$modelProducts->brand." - ".$modelProducts->model;
		else
			return "-";
	}
	
	public function getCustomerDealer($id, $cdtype){
		if($cdtype==1){
			$modelCustomers=Customers::model()->findByPk($id);
			
			if(count($modelCustomers)>0)
				return $modelCustomers->name;
			else
				return "-";
		}else{
			$modelDealers=Dealers::model()->findByPk($id);
			
			if(count($modelDealers)>0)
				return $modelDealers->name;
			else
				return "-";
		}
	}
	
	
	public function getBarcode($id){
		return '<a  href="'.Yii::app()->createUrl("problematicproducts/showbarcode").'/'.$id.'" class="barcode"><img src="'.Yii::app()->baseUrl.'/images/barcode.png" title="'.Yii::t('trans','Barkod').'/'.$id.'" /></a> <a  href="'.Yii::app()->createUrl("problematicproducts/showqrbarcode").'/'.$id.'" class="barcode"><img src="'.Yii::app()->baseUrl.'/images/qrbarcode.png" title="'.Yii::t('trans','QR Barkod').'" /></a>   <span class="help_"><img src="'.Yii::app()->baseUrl.'/images/help.png" id="help_" />
        <div class="text">'.Yii::t('trans','Sorunlu ürüne barkod etiketi yapıştırınız. Servis elemanları bu sorunlu ürünün takibini <b>Servis Programı</b> ile yapsınlar.').'</div>
        </span>'; 
	}
}

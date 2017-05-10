<?php

class SalescargoController extends Controller
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','update2'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionUpdate2(){
		$modelsalescargo=Salescargo::model()->findByPk($_POST["id"]);
		if(@$_POST["cargoname"]!="")
			$modelsalescargo->name=$_POST["cargoname"];
		
		if(@$_POST["cargopaymenttype"]!="")
			$modelsalescargo->payment=$_POST["cargopaymenttype"];
		
		if(@$_POST["cargofallownumber"]!="")
			$modelsalescargo->follownumber=$_POST["cargofallownumber"];
		
		
		if(@$_POST["charge1"]!=""){
			
			if(@$_POST["charge2"]!="")
				$modelsalescargo->charge=$_POST["charge1"].".".$_POST["charge2"];
			else
				$modelsalescargo->charge=$_POST["charge1"];
		}
		
		if(@$_POST["chargecur"]!="")
			$modelsalescargo->chargeCur=$_POST["chargecur"];
		
	
		if($modelsalescargo->update()){
			$data["sonuc"]=1;
			$data["name"]=$modelsalescargo->name;
			$data["payment"]=$modelsalescargo->payment;
			$data["follownumber"]=$modelsalescargo->follownumber;
			if($modelsalescargo->type!=0)
				$data["charge"]=number_format($modelsalescargo->charge,2)." ".@SalescargoController::getParams_("currency",$modelsalescargo->chargeCur);
			$data["salescargoID"]=$modelsalescargo->salescargoID;
		}else
			$data["sonuc"]=0;
		
		echo json_encode($data);
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		
		if($model->charge!=""){
			$charge=explode(".",$model->charge);
			if(@$charge[0]!="")
				$model->charge1=$charge[0];
			if(@$charge[1]!="")
				$model->charge2=str_pad($charge[1], 2, "0", STR_PAD_RIGHT);
			else
				$model->charge2="00";
		}
		if(isset($_POST['Salescargo']))
		{
			$model->attributes=$_POST['Salescargo'];
			if($model->payment==1){
				$model->charge=@$model->charge1.".".@$model->charge2;
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->salescargoID));
		}

		$this->renderPartial('update',array(
			'model'=>$model,
		));
	}

	
	
	public function loadModel($id)
	{
		$model=Salescargo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Salescargo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='salescargo-form')
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
}

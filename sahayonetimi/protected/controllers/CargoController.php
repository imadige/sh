<?php

class CargoController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function actionDetail(){
		if(Yii::app()->user->getState("salescompleteID")=="")
			$this->redirect(array("cargo/index"));
		
		$this->layout="cargo";
		$modelSalescompletecustomer=Salescompletecustomer::model()->findByPk(Yii::app()->user->getState("salescompleteID"));
		
		$modelSalescargo=Salescargo::model()->find("salescompleteID=:salescompleteID",array(":salescompleteID"=>Yii::app()->user->getState("salescompleteID")));
		
		$this->render("detail",array(
			"model"=>$modelSalescompletecustomer,
			'modelSalescargo'=>$modelSalescargo
			)
		);
	}
	public function actionIndex(){
		$this->layout="cargo";
		$data["sonuc"]=1;
		if(@!empty($_POST["filo"]) && @!empty($_POST["musteri"])){
			
			$modelSalescompletecustomer=Salescompletecustomer::model()->find("salescompleteID=:salescompleteID",array(":salescompleteID"=>trim($_POST["filo"])-$this->getParams("defultfiloplus")));
			if(count($modelSalescompletecustomer)>0){
				
				if($modelSalescompletecustomer->customerdealerID==trim($_POST["musteri"])-$this->getParams("dealercustomerplus") || $modelSalescompletecustomer->customerdealerID==trim($_POST["musteri"])-$this->getParams("dealerplus")){
					Yii::app()->user->setState("salescompleteID",$modelSalescompletecustomer->salescompleteID);
					$this->redirect(array("cargo/detail"));
				}else
					$data["sonuc"]=0;
			}else
				$data["sonuc"]=0;
		}
		$this->render("cargo",array('sonuc'=>$data["sonuc"]));
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
	
	public function getCustomerName($id){
		$model=Customers::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
		else
			return "-";
	}
	
	
	public function getDealerName($id){
		$model=Dealers::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
		else
			return "-";
	}
}

?>
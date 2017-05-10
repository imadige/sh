<?php

class ReportsqueryController extends Controller
{
	
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
				'actions'=>array('index','report1','report2','report3','report4'),
				'users'=>array('*'),
			),

			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){

		$this->render("index");
	}

	public function actionReport4(){
		$dateDay=date("Y-m-d",strtotime("-".$_POST["dates"],strtotime(date("Y-m-d"))))." 00:00:00";
			$criteria=new CDbCriteria;
			$criteria->select='sum(t.salesPrice*t.number) as salesPrice,t.salesCur,s.customerdealerID,s.cdtype,s.dateAdd,s.salesEs,s.salescompleteID';
			$criteria->condition='s.companyID=:companyID AND s.worldID=:worldID AND s.employeesID=:employeesID  AND  salesEs!=0 AND  salesEs!=5 AND s.dateAdd>=:dateDay';
			$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),
				":employeesID"=>$_POST["id"],':dateDay'=>$dateDay);
			$criteria->join="inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID)";
			$criteria->group="t.salesCur";
			$criteria->order="s.salescompleteID Desc";
			$model=Salesdetail::model()->findAll($criteria);

		$i=0;	
		$str='<table>';

		foreach($model as $key=>$value){
			$i++;
			$date=new DateTime($value->dateAdd);
			$str.="<tr><td><b>".ReportsqueryController::getName($value->customerdealerID,$value->cdtype)."</b></td><td>".number_format($value->salesPrice,2)." ".ReportsqueryController::getParams_("currency",$value->salesCur)."</td><td>".ReportsqueryController::getParams_("salesEs",$value->salesEs)."</td><td>".$date->format("d-m-Y H:i:s").'</td><td><a target="_blank" href="'.Yii::app()->createUrl("salescompletecustomer/view",array("id"=>$value->salescompleteID)).'"><img src="'.Yii::app()->baseUrl.'/images/eye.png"</a></td></tr>';
		}

		$str.="</table>";
		if($i>0)
			$data["sonuc"]=$str;
		else
			$data["sonuc"]='<div style="text-align:center">'.Yii::t('trans','Hiç bir satış yapılmamış').'</div>';	
		echo json_encode($data);
	}

	public function getName($customerdealerID,$cdtype){
		if($cdtype==1){
			$model=Customers::model()->findByPk($customerdealerID);
			return @$model->name;
		}else{
			$model=Dealers::model()->findByPk($customerdealerID);
			return @$model->name;
		}


	}


	public function actionReport3(){
		$dateDay=date("Y-m-d",strtotime("-".$_POST["dates"],strtotime(date("Y-m-d"))))." 00:00:00";
		if($_POST["reports"]==0){
			$criteria=new CDbCriteria;
			$criteria->select='sum(t.salesPrice*t.number) as salesPrice,t.salesCur';
			$criteria->condition='s.companyID=:companyID AND s.worldID=:worldID AND s.employeesID=:employeesID  AND  salesEs!=0 AND  salesEs!=5 AND dateAdd>=:dateDay';
			$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),
				":employeesID"=>$_POST["id"],':dateDay'=>$dateDay);
			$criteria->join="inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID)";
			$criteria->group="t.salesCur";
			$model=Salesdetail::model()->findAll($criteria);
		
		$criteria=new CDbCriteria;
		$criteria->select='sum(salesreturnPrice*t.number) as salesPrice,s.salesCur';
		$criteria->condition='t.deleted=1 AND t.dateAdd>=:dateDay AND t.companyID=:companyID AND t.worldID=:worldID AND sa.employeesID=:employeesID  ';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),
				":employeesID"=>$_POST["id"],':dateDay'=>$dateDay);
		$criteria->join="Inner join salesdetail s on (s.salesdetailID=t.salesdetailID)  inner join salescompletecustomer sa on (sa.salescompleteID=t.salescompleteID)";
		$criteria->group="s.salesCur";
		$model2=Salesreturn::model()->findAll($criteria);
		

		}elseif($_POST["reports"]==1){
			$criteria=new CDbCriteria;
			$criteria->select='sum(t.salesPrice*t.number)-sum(purchasePrice*number) as salesPrice,t.salesCur';
			$criteria->condition='s.companyID=:companyID AND s.worldID=:worldID AND s.employeesID=:employeesID AND  salesEs!=0 AND  salesEs!=5 AND dateAdd>=:dateDay';
			$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),
				":employeesID"=>$_POST["id"],':dateDay'=>$dateDay);
			$criteria->join="Inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID)";
			$criteria->group="t.salesCur";
			$model=Salesdetail::model()->findAll($criteria);

			$criteria=new CDbCriteria;
			$criteria->select='sum((salesPrice-purchasePrice)*t.number) as salesPrice,s.salesCur';
			$criteria->condition='t.deleted=1 AND t.dateAdd>=:dateDay AND t.companyID=:companyID AND t.worldID=:worldID AND sa.employeesID=:employeesID ';
			$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),
					":employeesID"=>$_POST["id"],':dateDay'=>$dateDay);
			$criteria->join="Inner join salesdetail s on (s.salesdetailID=t.salesdetailID)  inner join salescompletecustomer sa on (sa.salescompleteID=t.salescompleteID)";
			$criteria->group="s.salesCur";
			$model2=Salesreturn::model()->findAll($criteria);
		
		}

		$array=array();

		foreach($this->getParams("currency") as $key=>$value){
			$array[$key]=0;
		}
		foreach($model2 as $key=>$value){
			$array[$value->salesCur]=-$value->salesPrice;
		}
		foreach($model as $key=>$value){
			$array[$value->salesCur]=$array[$value->salesCur]+$value->salesPrice;
		}

		$str='<table style="width:200px">';

		foreach($array as $key=>$value){
			$str.="<tr><td>".ReportsqueryController::getParams_("currency",$key)."</td><td>".$value."</td></tr>";
		}

		$str.="</table>";
		
		$data["sonuc"]=$str;
		echo json_encode($data);
	}

	public function actionReport2(){
		$dateDay=date("Y-m-d",strtotime("-".$_POST["dates"],strtotime(date("Y-m-d"))))." 00:00:00";
			$criteria=new CDbCriteria;
			$criteria->select='sum(t.salesPrice*t.number) as salesPrice,t.salesCur,c.name,s.dateAdd,s.salesEs,s.salescompleteID';
			$criteria->condition='s.companyID=:companyID AND s.worldID=:worldID AND s.customerdealerID=:customerdealerID AND cdtype=:cdtype AND  salesEs!=0 AND  salesEs!=5 AND s.dateAdd>=:dateDay';
			$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),
				":customerdealerID"=>$_POST["id"],':cdtype'=>$_POST["cdtype"],':dateDay'=>$dateDay);
			$criteria->join="inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID) left join ".($_POST["cdtype"]==1?"customers":"dealers")." c on(".($_POST["cdtype"]==1?"c.customerID":"c.dealersID")."=s.customerdealerID)";
			$criteria->group="t.salesCur";
			$criteria->order="s.salescompleteID Desc";
			$model=Salesdetail::model()->findAll($criteria);

		$i=0;	
		$str='<table>';

		foreach($model as $key=>$value){
			$i++;
			$date=new DateTime($value->dateAdd);
			$str.="<tr><td><b>".$value->name."</b></td><td>".number_format($value->salesPrice,2)." ".ReportsqueryController::getParams_("currency",$value->salesCur)."</td><td>".ReportsqueryController::getParams_("salesEs",$value->salesEs)."</td><td>".$date->format("d-m-Y H:i:s").'</td><td><a target="_blank" href="'.Yii::app()->createUrl("salescompletecustomer/view",array("id"=>$value->salescompleteID)).'"><img src="'.Yii::app()->baseUrl.'/images/eye.png"</a></td></tr>';
		}

		$str.="</table>";
		if($i>0)
			$data["sonuc"]=$str;
		else
			$data["sonuc"]='<div style="text-align:center">'.Yii::t('trans','Hiç bir satış yapılmamış').'</div>';	
		echo json_encode($data);
	}

	public function actionReport1(){
		$dateDay=date("Y-m-d",strtotime("-".$_POST["dates"],strtotime(date("Y-m-d"))))." 00:00:00";
		if($_POST["reports"]==0){
			$criteria=new CDbCriteria;
			$criteria->select='sum(t.salesPrice*t.number) as salesPrice,t.salesCur';
			$criteria->condition='s.companyID=:companyID AND s.worldID=:worldID AND s.customerdealerID=:customerdealerID AND cdtype=:cdtype AND  salesEs!=0 AND  salesEs!=5 AND dateAdd>=:dateDay';
			$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),
				":customerdealerID"=>$_POST["id"],':cdtype'=>$_POST["cdtype"],':dateDay'=>$dateDay);
			$criteria->join="inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID)";
			$criteria->group="t.salesCur";
			$model=Salesdetail::model()->findAll($criteria);
		
		$criteria=new CDbCriteria;
		$criteria->select='sum(salesreturnPrice*t.number) as salesPrice,s.salesCur';
		$criteria->condition='t.deleted=1 AND t.dateAdd>=:dateDay AND t.companyID=:companyID AND t.worldID=:worldID AND sa.customerdealerID=:customerdealerID AND cdtype=:cdtype ';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),
				":customerdealerID"=>$_POST["id"],':cdtype'=>$_POST["cdtype"],':dateDay'=>$dateDay);
		$criteria->join="Inner join salesdetail s on (s.salesdetailID=t.salesdetailID)  inner join salescompletecustomer sa on (sa.salescompleteID=t.salescompleteID)";
		$criteria->group="s.salesCur";
		$model2=Salesreturn::model()->findAll($criteria);
		

		}elseif($_POST["reports"]==1){
			$criteria=new CDbCriteria;
			$criteria->select='sum(t.salesPrice*t.number)-sum(purchasePrice*number) as salesPrice,t.salesCur';
			$criteria->condition='s.companyID=:companyID AND s.worldID=:worldID AND s.customerdealerID=:customerdealerID AND cdtype=:cdtype AND  salesEs!=0 AND  salesEs!=5 AND dateAdd>=:dateDay';
			$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),
				":customerdealerID"=>$_POST["id"],':cdtype'=>$_POST["cdtype"],':dateDay'=>$dateDay);
			$criteria->join="Inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID)";
			$criteria->group="t.salesCur";
			$model=Salesdetail::model()->findAll($criteria);

			$criteria=new CDbCriteria;
			$criteria->select='sum((salesPrice-purchasePrice)*t.number) as salesPrice,s.salesCur';
			$criteria->condition='t.deleted=1 AND t.dateAdd>=:dateDay AND t.companyID=:companyID AND t.worldID=:worldID AND sa.customerdealerID=:customerdealerID AND cdtype=:cdtype ';
			$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),
					":customerdealerID"=>$_POST["id"],':cdtype'=>$_POST["cdtype"],':dateDay'=>$dateDay);
			$criteria->join="Inner join salesdetail s on (s.salesdetailID=t.salesdetailID)  inner join salescompletecustomer sa on (sa.salescompleteID=t.salescompleteID)";
			$criteria->group="s.salesCur";
			$model2=Salesreturn::model()->findAll($criteria);
		
		}

		$array=array();

		foreach($this->getParams("currency") as $key=>$value){
			$array[$key]=0;
		}
		foreach($model2 as $key=>$value){
			$array[$value->salesCur]=-$value->salesPrice;
		}
		foreach($model as $key=>$value){
			$array[$value->salesCur]=$array[$value->salesCur]+$value->salesPrice;
		}

		$str='<table style="width:200px">';

		foreach($array as $key=>$value){
			$str.="<tr><td>".ReportsqueryController::getParams_("currency",$key)."</td><td>".$value."</td></tr>";
		}

		$str.="</table>";
		
		$data["sonuc"]=$str;
		echo json_encode($data);
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
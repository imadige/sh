<?php

class SalesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/productgroups';

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
				'actions'=>array('index','basket','view','getsearchname','getsearchbrand','getsearchmodel','salescomplete','salescomplete_','stockcontrol'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('fastcustomer','customer'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('fastdealer','dealer'),
				'users'=>array('*'),
			),
		);
	}
	
	public function actionStockcontrol(){
		$data=$this->stok_control($_POST["id"],$_POST["productbottomsID"]);
		echo json_encode($data);
	}
	
	public function stok_control($productsID,$productbottomsID){
		 $data=array();
			$modelProductbottoms=Productbottoms::model()->findByPk($productbottomsID);
			$totalstock=0;
			if(count($modelProductbottoms)>0){
				
				$modelWarehousebottomstok=Warehousebottomstok::model()->findAll("productbottomsID=:productbottomsID",array(":productbottomsID"=>$productbottomsID));
				foreach($modelWarehousebottomstok as $key=>$value)
					$totalstock+=$value->stok;
				
			}
			
			$modelProductbasket=Productbasket::model()->findAll("productsID=:productsID AND productbottomsID=:productbottomsID",array(":productsID"=>$productsID,":productbottomsID"=>$productbottomsID));
			$basket=0;
			
			foreach($modelProductbasket as $key=>$value)
				$basket+=$value->number;
			
			$islem=0;
			
				$criteria=new CDbCriteria;
				$criteria->select='t.number';
				$criteria->condition='t.productsID=:productsID AND t.productbottomsID=:productbottomsID';
				
				$criteria->params=array(
					':productsID'=>$productsID,
					':productbottomsID'=>$productbottomsID,
			
			  	 );
				 $criteria->join="inner join  salescompletecustomer s on(s.salescompleteID=t.salescompleteID AND s.salesEs<4)";
				$modelSalesdetail=Salesdetail::model()->findAll($criteria);
				
				foreach($modelSalesdetail as $key=>$value)
					$islem+=$value->number;
				
			
				$data["total"]=$totalstock;
				$data["islem"]=$islem;
				$data["kalan"]=$totalstock-$basket-$islem;
				$data["basket"]=$basket;
			
		return $data;
	}
	
	public function actionSalescomplete_(){
		$this->layout="panel";
		Yii::app()->user->setFlash('success', Yii::t('trans','Satış işlemi başarılı gerçekleşmiştir.'));
		$this->render("salescomplete_");
	}
	
	public function actionSalescomplete(){
		$this->layout='//layouts/panel';

		if(!Yii::app()->user->getState("salesType"))
			Yii::app()->user->setState("salesType","customer");
			
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='t.worldID=:worldID AND t.companyID=:companyID AND t.employeesID=:employeesID';
		
		$criteria->params=array(
			':companyID'=>yii::app()->user->getState('companyID'),
			':worldID'=>yii::app()->user->getState('worldID'),
			':employeesID'=>yii::app()->user->getState('ID'),
		);
	
		$modelProductbasket=Productbasket::model()->findAll($criteria);
		
		$model=new Salescompletecustomer;
		if(isset($_POST['Salescompletecustomer']))
		{
			$model->attributes=$_POST['Salescompletecustomer'];
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->employeesID=Yii::app()->user->getState("ID");
			$model->worldID=Yii::app()->user->getState("worldID");
			$model->salesEsDate=date("Y-m-d H:i:s");
			$model->dateAdd=date("Y-m-d H:i:s");
			if($model->visitsID!="")
				$model->visitsID=$model->visitsID-$this->getParams("visitsplus");
				
			if($model->salesStatus==0)
				$model->salesEs=0;
			else
				$model->salesEs=1;
				
			if(Yii::app()->user->getState("salesType")=="customer")
				$model->cdtype=1;
			else
				$model->cdtype=2;
			if($model->save()){
				if(!empty($model->received1) && !empty($model->received2)){
					$modelSalesmoneyreceived=new Salesmoneyreceived;
					$modelSalesmoneyreceived->salescompleteID=$model->salescompleteID;
					$modelSalesmoneyreceived->receivedPrice=$model->received1.".".$model->received2;
					$modelSalesmoneyreceived->receivedCur=$model->receivedCur;
					$modelSalesmoneyreceived->dateAdd=date("Y-m-d H:i:s");
					$modelSalesmoneyreceived->unpayment=0;
					$modelSalesmoneyreceived->deleted=1;
					$modelSalesmoneyreceived->save();
				}
			
				
				foreach($modelProductbasket as $key=>$value){
					$modelSalesdetail=new Salesdetail;
					$modelSalesdetail->productsID=$value->productsID;
					$modelSalesdetail->productbottomsID=$value->productbottomsID;
					$modelSalesdetail->number=$value->number;
					$modelSalesdetail->salesPrice=$value->salesPrice;
					$modelSalesdetail->salesCur=$value->salesCur;
					$modelSalesdetail->salescompleteID=$model->salescompleteID;
					$modelSalesdetail->unitPrice=$value->unitPrice;
					$modelSalesdetail->unitCur=$value->unitCur;
					$modelSalesdetail->purchasePrice=$value->purchasePrice;
					$modelSalesdetail->purchaseCur=$value->purchaseCur;
					$modelSalesdetail->deleted=1;
					$modelSalesdetail->save();
				}
				
				$modelProductbasket=Productbasket::model()->deleteAll("employeesID=:employeesID AND worldID=:worldID AND companyID=:companyID",array(":employeesID"=>Yii::app()->user->getState("ID"),":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")));
				
				$this->redirect(array('salescomplete_'));
			}
		}
		
		
		$this->render("salescomplete",array(
			'model'=>$model,
			'modelProductbasket'=>$modelProductbasket,
		));
	}
	
	public function actionFastcustomer()
	{
		$this->layout="panel";
		Yii::app()->user->setState("salesType","customer");
			
		$model=new Products('search');
		$model->unsetAttributes();  // clear any default values
		
		$model->deleted=1;
		
		$model->worldID=Yii::app()->user->getState("worldID");
		if(isset($_GET['Products'])){
			$model->attributes=$_GET['Products'];
			
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionFastdealer()
	{
		$this->layout="panel";
		Yii::app()->user->setState("salesType","dealer");
			
		$model=new Products('search');
		$model->unsetAttributes();  // clear any default values
		
		$model->deleted=1;
	
		$model->worldID=Yii::app()->user->getState("worldID");
		if(isset($_GET['Products'])){
			$model->attributes=$_GET['Products'];
			
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionSearch(){
		
		if(isset($_GET['Products'])){
			$model= new Products;
			$model->attributes=$_GET['Products'];
			
			$criteria=new CDbCriteria;
			$criteria->select='*,p.images as images';
			$criteria->condition='pd.deleted=1  AND pd.worldID=:worldID';
			
			$criteria->params=array(
				':worldID'=>yii::app()->user->getState('worldID'),
			
			);
			
			if($model->name!=""){
				
				$criteria->compare('name',trim($model->name),true);
			
			}
			
			if($model->brand!=""){
				$criteria->compare('brand',trim($model->brand),true);
			}
			
			if($model->model!=""){
				$criteria->compare('model',trim($model->model),true);
			}
			
			
			if($model->productgroupsID!=""){
			
				$txt=$this->getProductgroups2($model->productgroupsID);
				$criteria->condition.=" AND productgroupsID IN (".substr($txt,0,strlen($txt)-1).")";
				
			}	
			
			
			if($model->nameorder=="1"){
				$criteria->order="LCASE(t.name) asc";
			}
			if($model->nameorder=="2"){
				$criteria->order="LCASE(t.name) desc";
			}
			
			if($model->brandorder=="1"){
				$criteria->order="t.brand asc";
			}
			if($model->brandorder=="2"){
				$criteria->order="t.brand desc";
			}
			
			if($model->modelorder=="1"){
				$criteria->order="t.model asc";
			}
			if($model->modelorder=="2"){
				$criteria->order="t.model desc";
			}
			
			
			if($model->saleorder=="1"){
				
				if(Yii::app()->user->getState("salesType")=="customer"){
					if($model->reducedPrice!="")
						$criteria->order="pd.reducedPrice asc";
					else
						$criteria->order="pd.salePrice asc";
				}elseif(Yii::app()->user->getState("salesType")=="dealer"){
					
					if($model->dealerPrice!=""){
						
						$criteria->order="pd.dealerPrice asc";
					}else{
						
						if($model->reducedPrice!="")
							$criteria->order="pd.reducedPrice asc";
						else
							$criteria->order="pd.salePrice asc";
					}
				}
				
			}
			if($model->saleorder=="2"){
				if(Yii::app()->user->getState("salesType")=="customer"){
					if($model->reducedPrice!="")
						$criteria->order="pd.reducedPrice desc";
					else
						$criteria->order="pd.salePrice desc";
				}elseif(Yii::app()->user->getState("salesType")=="dealer"){
					
					if($model->dealerPrice!=""){
						
						$criteria->order="pd.dealerPrice desc";
					}else{
						
						if($model->reducedPrice!="")
							$criteria->order="pd.reducedPrice desc";
						else
							$criteria->order="pd.salePrice desc";
					}
				}
			}
			
			
			 
			
			$criteria->join= "left join productimages p on (p.productID=t.productsID AND mainimages=1) left join productdetail pd on (t.productsID=pd.productsID)";
			$count=Products::model()->cache($this->cache2)->count($criteria);
			$pages=new CPagination($count);
			$pages->pageSize=24;
			$pages->applyLimit($criteria);
			$modelProducts=Products::model()->cache($this->cache2)->findAll($criteria);
			
			$this->render('index',array(
				'modelProducts'=>$modelProducts,
				'pages'=>$pages,
				'model'=>$model,
			));
		}else{
			$this->actionIndex();
		}
	}
	
	
	
	public function actionView($id){
		
		$criteria=new CDbCriteria;
		$criteria->select='*, pg.tax as tax, pg.name as pgname, t.name as name';
		$criteria->condition='t.productsID=:productsID';
		$criteria->params=array(':productsID'=>$id);
		$criteria->join = 'left join productgroups pg on t.productgroupsID=pg.productgroupsID left join productdetail pd on (t.productsID=pd.productsID)';
		$model=Products::model()->find($criteria);
		
		$this->accsesControl($model);
		
		$kapakimage=Productimages::model()->find("productID=:productID AND mainimages=:mainimages",array(":productID"=>$id,":mainimages"=>1));
		
		$images=Productimages::model()->findAll("productID=:productID",array(":productID"=>$id));
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='productsID=:productsID  AND worldID=:worldID AND companyID=:companyID';
		
		$criteria->params=array(
			':companyID'=>yii::app()->user->getState('companyID'),
			':worldID'=>yii::app()->user->getState('worldID'),
			':productsID'=>$model->productsID,
		);
		$modelProductbot=Productbottoms::model()->findAll($criteria);
		
		$criteria=new CDbCriteria;
		$criteria->select='*,w.name as wname';
		$criteria->condition='t.productsID=:productsID  AND t.worldID=:worldID AND t.companyID=:companyID';
		$criteria->join="left join warehouse w on (t.warehouseID=w.warehouseID)";
		$criteria->order="w.name asc";
		$criteria->params=array(
			':companyID'=>yii::app()->user->getState('companyID'),
			':worldID'=>yii::app()->user->getState('worldID'),
			':productsID'=>$model->productsID,
		);
		$modelWarehousebottomstok=Warehousebottomstok::model()->findAll($criteria);
		
		$this->render('view',array(
			'model'=>$model,
			'imagelist'=>$images,
			'kapakimage'=>$kapakimage,
			'modelProductbot'=>$modelProductbot,
			'modelWarehousebottomstok'=>$modelWarehousebottomstok,
		));
	}
	
	public function actionCustomer(){
		Yii::app()->user->setState("salesType","customer");
		$this->actionIndex();
	}
	
	public function actionDealer(){
		Yii::app()->user->setState("salesType","dealer");
		$this->actionIndex();
	}
	
	public function actionBasketdelete(){
		$model=Productbasket::model()->findByPk(substr($_POST["id"],1,strlen($_POST["id"])));
		if($model->delete()){
			$data["sonuc"]=1;
			$data["totalbasket"]=number_format($this->getTotalBasket(),2);
			
			$criteria=new CDbCriteria;
			$criteria->select='*';
			$criteria->condition='t.worldID=:worldID AND t.companyID=:companyID AND t.employeesID=:employeesID';
			
			
			$criteria->params=array(
				':companyID'=>yii::app()->user->getState('companyID'),
				':worldID'=>yii::app()->user->getState('worldID'),
				':employeesID'=>yii::app()->user->getState('ID'),
			);
			$modelProductbasketcount=Productbasket::model()->count($criteria);
			
			$data["count"]=$modelProductbasketcount;
		}else{
			$data["sonuc"]=0;
		}
		
		echo json_encode($data);
	}
	public function actionBasketadd(){
		$data=$this->stok_control($_POST["id"],$_POST["productbottomsID"]);
		if($data["kalan"]<$_POST["number"]){
			$data["sonuc"]=0;
			echo json_encode($data);
			exit;
		}
		$model= new Productbasket;
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->employeesID=Yii::app()->user->getState("ID");
		$model->productsID=$_POST["id"];
		$model->number=$_POST["number"];
		$model->productbottomsID=$_POST["productbottomsID"];
		$model->dateAdd=date("Y-m-d H:i:s");
		$model->salesPrice=floatval(trim($_POST["birim1"]).".".trim($_POST["birim2"]));
		$total=0;
		
		$criteria=new CDbCriteria;
		$criteria->select='*, pg.tax as tax, pg.name as pgname, t.name as name';
		$criteria->condition='t.productsID=:productsID';
		$criteria->params=array(':productsID'=>$_POST["id"]);
		$criteria->join = 'left join productgroups pg on t.productgroupsID=pg.productgroupsID left join productdetail pd on (t.productsID=pd.productsID)';
		$modelProducts=Products::model()->find($criteria);
		
		if(Yii::app()->user->getState("salesType")=="customer"){
				if($modelProducts->reducedPrice!=""){
					$unitPrice= $modelProducts->reducedPrice+(($modelProducts->tax*$modelProducts->reducedPrice)/100);
					$cur=$modelProducts->reduceCur;
				}else{
					$unitPrice= $modelProducts->salePrice+(($modelProducts->tax*$modelProducts->salePrice)/100);
					$cur=$modelProducts->saleCur;
					
				}
					
			}elseif(Yii::app()->user->getState("salesType")=="dealer"){
				
				if($modelProducts->dealerPrice!=""){
					
					$unitPrice= $modelProducts->dealerPrice+(($modelProducts->tax*$modelProducts->dealerPrice)/100);
					$cur=$modelProducts->dealerCur;
				}else{
					
					if($modelProducts->reducedPrice!=""){
					$unitPrice= $modelProducts->reducedPrice+(($modelProducts->tax*$modelProducts->reducedPrice)/100);
					$cur=$modelProducts->reduceCur;
					
				}else{
					$unitPrice= $modelProducts->salePrice+(($modelProducts->tax*$modelProducts->salePrice)/100);
					$cur=$modelProducts->saleCur;
					
					}
				}
			}
			
		
		$total=number_format($model->salesPrice*$model->number,2).' '.$this->getParams_("currency",$cur);
		
		$model->salesCur=$cur;
		$model->unitPrice=$unitPrice;
		$model->unitCur=$cur;
		
		$model->purchasePrice=$modelProducts->purchasePrice+(($modelProducts->tax*$modelProducts->purchasePrice)/100);
		$model->purchaseCur=$modelProducts->purchaseCur;
		if($model->save()){
			$data["sonuc"]=1;
			$data["total"]=$total;
			$data["id"]=$model->productbasketID;
		    $data["bottom"]=$this->getBottom($model->productbottomsID);
			$data["totalbasket"]=number_format($this->getTotalBasket(),2);
			
			$criteria=new CDbCriteria;
			$criteria->select='*';
			$criteria->condition='t.worldID=:worldID AND t.companyID=:companyID AND t.employeesID=:employeesID';
			
			
			$criteria->params=array(
				':companyID'=>yii::app()->user->getState('companyID'),
				':worldID'=>yii::app()->user->getState('worldID'),
				':employeesID'=>yii::app()->user->getState('ID'),
			);
			$modelProductbasketcount=Productbasket::model()->count($criteria);
			
			$data["count"]=$modelProductbasketcount;
		}
		echo json_encode($data);
		
	}

	public function actionBasket($id=0){
		$this->layout="none";
		
		if(!Yii::app()->user->getState("salesType"))
			Yii::app()->user->setState("salesType","customer");
		
		 if(Yii::app()->user->getState("salesType")=="customer")
			$basket="customer";
		 else
			$basket="dealer";
		
		if(Yii::app()->user->getState("basketselect")=="")
			Yii::app()->user->setState("basketselect",1);
			
		$select=Yii::app()->user->getState("basketselect");
		
		$criteria=new CDbCriteria;
		$criteria->select='*, p.name as name';
		$criteria->condition='t.worldID=:worldID AND t.employeesID=:employeesID ';
		
		$criteria->join="left join products p on (p.productsID=t.productsID) left join productdetail pd on (t.productsID=pd.productsID)";
		$criteria->params=array(
			
			':worldID'=>yii::app()->user->getState('worldID'),
			':employeesID'=>yii::app()->user->getState('ID'),
		);

		$modelProductbasket=Productbasket::model()->findAll($criteria);
		
		
		$criteria=new CDbCriteria;
		$criteria->select='*, pg.tax as tax, pg.name as pgname, t.name as name';
		$criteria->condition='t.productsID=:productsID';
		$criteria->params=array(':productsID'=>$id);
		$criteria->join = 'left join productgroups pg on t.productgroupsID=pg.productgroupsID left join productdetail pd on (t.productsID=pd.productsID)';
		$modelProducts=Products::model()->find($criteria);
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='productsID=:productsID  AND worldID=:worldID AND companyID=:companyID';
		
		$criteria->params=array(
			':companyID'=>yii::app()->user->getState('companyID'),
			':worldID'=>yii::app()->user->getState('worldID'),
			':productsID'=>$id,
		);
		$modelProductbot=Productbottoms::model()->findAll($criteria);
		
		$bottom=array();
		
		foreach($modelProductbot as $key=>$value){
			$STR="";
			if($value->bottomvalue1!="")
				$STR.=$this->getParams_("color",$value->bottomvalue1);
			
			if($value->bottomvalue2!="")
				$STR.=" ".$value->bottomvalue2;
			
			if($value->bottomvalue3!="")
				$STR.=" ".$value->bottomvalue3;
				
			if($value->bottomvalue4!="")
				$STR.=" ".$value->bottomvalue4;
				
			if($value->bottomvalue5!="")
				$STR.=" ".$value->bottomvalue5;
				
			if($value->bottomvalue6!="")
				$STR.=" ".$value->bottomvalue6;
				
			if($value->bottomvalue7!="")
				$STR.=" ".$value->bottomvalue7;
				
		
				
			$bottom[$value->productbottomsID]=$STR;
		}
			
		$this->render('basket',array(
			'model'=>$modelProductbasket,
			'select'=>$select,
			'modelProducts'=>$modelProducts,
			'id'=>$id,
			'basket'=>$basket,
			'bottom'=>$bottom,
		));
	}
	
	public function actionIndex()
	{
		$model= new Products;
		
		$criteria=new CDbCriteria;
		$criteria->select='*,p.images as images,pg.tax,t.name as name';
		$criteria->condition='pd.deleted=1  AND pd.worldID=:worldID';
		
		$criteria->params=array(
			
			':worldID'=>yii::app()->user->getState('worldID'),
		
		);
		$criteria->join= "left join productimages p on (p.productID=t.productsID AND mainimages=1) left join productdetail pd on (t.productsID=pd.productsID) left join productgroups pg on (pg.productgroupsID=t.productgroupsID)";
		$criteria->limit=12;
		$modelProducts=Products::model()->cache($this->cache2)->findAll($criteria);
		
		$this->render('index',array(
			'modelProducts'=>$modelProducts,
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Products::model()->cache($this->cache)->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
	
	public function curAccount($id, $cur){
		$controller= new Sitecontroller;
		return $controller->curAccount($id, $cur);
	}
	
	
	public function getBottom($id){
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='productbottomsID=:productbottomsID  AND worldID=:worldID AND companyID=:companyID';
		
		$criteria->params=array(
			':companyID'=>yii::app()->user->getState('companyID'),
			':worldID'=>yii::app()->user->getState('worldID'),
			':productbottomsID'=>$id,
		);
		$modelProductbot=Productbottoms::model()->find($criteria);
		
		
		$STR="";
	
		if(count($modelProductbot)>0){
			if($modelProductbot->bottomvalue1!="")
				$STR.=$this->getParams_("color",$modelProductbot->bottomvalue1);
					
			if($modelProductbot->bottomvalue2!="")
				$STR.=" ".$modelProductbot->bottomvalue2;
			
			if($modelProductbot->bottomvalue3!="")
				$STR.=" ".$modelProductbot->bottomvalue3;
				
			if($modelProductbot->bottomvalue4!="")
				$STR.=" ".$modelProductbot->bottomvalue4;
				
			if($modelProductbot->bottomvalue5!="")
				$STR.=" ".$modelProductbot->bottomvalue5;
				
			if($modelProductbot->bottomvalue6!="")
				$STR.=" ".$modelProductbot->bottomvalue6;
				
			if($modelProductbot->bottomvalue7!="")
				$STR.=" ".$modelProductbot->bottomvalue7;
			
		}
			
		return mb_substr($STR,0,42,"UTF-8");
	}
	
	
	public function getTotalBasket(){
			$totalbasket=0;
		
			$criteria=new CDbCriteria;
			$criteria->select='*';
			$criteria->condition='t.worldID=:worldID AND t.companyID=:companyID AND t.employeesID=:employeesID';
			
			$criteria->params=array(
				':companyID'=>yii::app()->user->getState('companyID'),
				':worldID'=>yii::app()->user->getState('worldID'),
				':employeesID'=>yii::app()->user->getState('ID'),
			);
			$modelProductbasket=Productbasket::model()->findAll($criteria);
			
			foreach($modelProductbasket as $key=>$value)
          		$totalbasket+=$this->curAccount($value->salesCur,$value->salesPrice)*$value->number;
			
		
		 
		 
		 return $totalbasket;
	}
	
	public function actionGetsearchname(){
		$arr = array();
		  $term = Yii::app()->getRequest()->getParam('term', false);
		  if ($term)
		  {
			  	 $sql = 'SELECT DISTINCT name FROM products where companyID='.Yii::app()->user->getState("companyID").' AND worldID='.Yii::app()->user->getState("worldID").' AND LCASE(name) LIKE :name AND deleted=1';
				 $cmd = Yii::app()->db->createCommand($sql);
				 $cmd->bindValue(":name","%".strtolower($term)."%", PDO::PARAM_STR);
				 $res = $cmd->queryAll();
				 foreach($res as $model)
				 {
					 $model=(object)$model;
					$arr[] = array(
					  'label'=>$model->name,  // label for dropdown list
					  'value'=>$model->name,  // value for input field
					         
					);
				 }
			
		  }
		  
		  
		  echo CJSON::encode($arr);
		  Yii::app()->end();
	}
	
	public function actionGetsearchbrand(){
		$arr = array();
		  $term = Yii::app()->getRequest()->getParam('term', false);
		  if ($term)
		  {
			  	 $sql = 'SELECT DISTINCT brand FROM products where companyID='.Yii::app()->user->getState("companyID").' AND worldID='.Yii::app()->user->getState("worldID").' AND LCASE(brand) LIKE :name AND deleted=1';
				 $cmd = Yii::app()->db->createCommand($sql);
				 $cmd->bindValue(":name","%".strtolower($term)."%", PDO::PARAM_STR);
				 $res = $cmd->queryAll();
				 foreach($res as $model)
				 {
					 $model=(object)$model;
					$arr[] = array(
					  'label'=>$model->brand,  // label for dropdown list
					  'value'=>$model->brand,  // value for input field
					         
					);
				 }
			
		  }
		  
		  
		  echo CJSON::encode($arr);
		  Yii::app()->end();
	}
	
	public function actionGetsearchmodel(){
		$arr = array();
		  $term = Yii::app()->getRequest()->getParam('term', false);
		  if ($term)
		  {
			  	 $sql = 'SELECT DISTINCT model FROM products where companyID='.Yii::app()->user->getState("companyID").' AND worldID='.Yii::app()->user->getState("worldID").' AND LCASE(model) LIKE :name AND deleted=1';
				 $cmd = Yii::app()->db->createCommand($sql);
				 $cmd->bindValue(":name","%".strtolower($term)."%", PDO::PARAM_STR);
				 $res = $cmd->queryAll();
				 foreach($res as $model)
				 {
					 $model=(object)$model;
					$arr[] = array(
					  'label'=>$model->model,  // label for dropdown list
					  'value'=>$model->model,  // value for input field
					         
					);
				 }
			
		  }
		  
		  
		  echo CJSON::encode($arr);
		  Yii::app()->end();
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
	
	
	public function getProductgroups_($type=3){
		$controller= new Sitecontroller;
		$array=$controller->getProductgroups_($type);
		
		return $array;
	}
	
	
	
	
	public function getProductgroups2($id){
		 $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1 and productgroupsID=:productgroupsID",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID"),':productgroupsID'=>$id),
             'order'=>'name asc',
             ));
			 $list ="";
			foreach($modelCustomergroups as $key=>$value){
				
				$list.=$value->productgroupsID.",";
				$list=$this->katListele2($value->productgroupsID,$list);
			}
			
			return $list;
	}
	
	private function katListele2($katid, &$list)
	{
		
		 $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1 AND pgID=:pgID",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID"),':pgID'=>$katid),
             'order'=>'name asc',
             ));
		foreach($modelCustomergroups as $key=>$value){
			
			
			$list.=$value->productgroupsID.",";
			$list=$this->katListele2($value->productgroupsID,$list);
		}
		
		return $list;
	}
	

	
	
	public function getProductgroupsArray(){
		 $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")),
             'order'=>'name asc',
             ));
			 
			return $modelCustomergroups;
	}
	
	public function getFastSalePrice($id){
		
		
		$criteria=new CDbCriteria;
		$criteria->select='*, pg.tax as tax, pg.name as pgname, t.name as name';
		$criteria->condition='t.productsID=:productsID';
		$criteria->params=array(':productsID'=>$id);
		$criteria->join = 'left join productgroups pg on t.productgroupsID=pg.productgroupsID left join productdetail pd on (t.productsID=pd.productsID)';
		$modelProducts=Products::model()->find($criteria);
		
		$x='<font color="#4A8BF4"><b>';
		if(Yii::app()->user->getState("salesType")=="customer"){
			if($modelProducts->reducedPrice!=""){
				$x.=number_format($modelProducts->reducedPrice,2);
				$x.=" ".SalesController::getParams_("currency",$modelProducts->reduceCur);
				
			}else{
				$x.= number_format($modelProducts->salePrice,2);
				$x.=" ".SalesController::getParams_("currency",$modelProducts->saleCur);
				
				
			}
					
		}elseif(Yii::app()->user->getState("salesType")=="dealer"){
			
			if($modelProducts->dealerPrice!=""){
				
				$x.= number_format($modelProducts->dealerPrice,2);
				$x.=" ".SalesController::getParams_("currency",$modelProducts->dealerCur);
				
			}else{
				
				if($modelProducts->reducedPrice!=""){
					$x.= number_format($modelProducts->reducedPrice,2);
					$x.=" ".SalesController::getParams_("currency",$modelProducts->reduceCur);
					
				
			}else{
					$x.= number_format($modelProducts->salePrice,2);
					$x.=" ".SalesController::getParams_("currency",$modelProducts->saleCur);
					
				
				}
			}
		}
		
		$x.='</b> + '.Yii::t('trans','KDV').'</font><span class="ids" style="display:none">'.$modelProducts->productsID.'</span>';
		return $x;
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


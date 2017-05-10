<?php

class ProductsController extends Controller
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
	
	
	
	private function dataControl(){
		$controller= new SiteController;
		$return=$controller->dataControl();
		
		if($return==false)
			$this->redirect(array("//site/datacontrol"));
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','bottomproduct','getgroupautoList','bottomadd','bottomdelete','imageslist','imageresize','imageadd','imagedelete','viewp','kapakchange'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('excelreader','excelreaderadd','excelreaderlist','exceldatadb','xmlreader','xmlreaderadd','xmldatadb'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('getproducts'),
				'users'=>array('*'),
			),
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('stockadmin','stockupdate','stockupdateval','stockwarehouseupdate','bottomwarehouseupdate'),
				'users'=>array('*'),
			),
			
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionBottomwarehouseupdate(){
		$model=Warehousebottomstok::model()->findByPk($_POST["warehousebottomstokID"]);
		$model->stok=$_POST["stock"];
		
		if($model->update()){
			$data["sonuc"]=1;
			
			$model2=Warehousebottomstok::model()->findAll("productbottomsID=:productbottomsID",array(":productbottomsID"=>$model->productbottomsID));
			$stok=0;
			foreach($model2 as $key2=>$value2){
				$stok+=$value2->stok;
			}
			
			$data["tstock"]= $stok;
			$data["productbottomsID"]= $model->productbottomsID;
			
		}else
			$data["sonuc"]=0;
			
		echo json_encode($data);
	}
	public function actionStockwarehouseupdate(){
		
		$model=Warehousebottomstok::model()->findByPk($_POST["id"]);
		
		$this->renderPartial("stockwarehouseupdate",array('model'=>$model));
	}
	public function actionStockupdateval(){
		$modelProductbot=Productbottoms::model()->findByPk(substr($_POST["id"],1,strlen($_POST["id"])));
		$modelProductbot->stok=$_POST["value"];
		if($modelProductbot->update())
			$data["sonuc"]=1;
		else
			$data["sonuc"]=0;
		
		echo json_encode($data);
	}
	
	
	
	public function actionStockupdate($id){
		
		$criteria=new CDbCriteria;
		$criteria->select='t.productsID,t.brand,t.model,t.name, pd.worldID as worldID';
		$criteria->condition='t.productsID=:productsID';
		$criteria->params=array(':productsID'=>$id);
		$criteria->join = 'left join productdetail pd on (t.productsID=pd.productsID)';
		$model=Products::model()->find($criteria);
		
		$this->accsesControl($model);
		
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
		
		
		$this->render('stockupdate',array(
			'model'=>$model,
			'modelProductbot'=>$modelProductbot,
			'modelWarehousebottomstok'=>$modelWarehousebottomstok,
		));
	}
	
	public function actionStockadmin(){
		$model=new Products('search');
		$model->unsetAttributes();  // clear any default values
		
		$model->deleted=1;
		$model->worldID=Yii::app()->user->getState("worldID");
		if(isset($_GET['Products'])){
			$model->attributes=$_GET['Products'];
			
		}

		$this->render('stockadmin',array(
			'model'=>$model,
		));
	}
	
	
	public function actionGetproducts(){
		$arr = array();
		  $term = Yii::app()->getRequest()->getParam('term', false);
		  if ($term)
		  {
			  	 $sql = 'SELECT t.productsID, t.brand, t.model, t.name FROM products as t left join productdetail pd on (t.productsID=pd.productsID) where  pd.worldID='.Yii::app()->user->getState("worldID").' AND LCASE(t.name) LIKE :name or LCASE(t.brand) LIKE :name or LCASE(t.model) LIKE :name AND deleted=1';
				 $cmd = Yii::app()->db->createCommand($sql);
				 $cmd->bindValue(":name","%".strtolower($term)."%", PDO::PARAM_STR);
				 $res = $cmd->queryAll();
				 foreach($res as $model)
				 {
					 $model=(object)$model;
					$arr[] = array(
					  'label'=>$model->name." - ".$model->brand." - ".$model->model,  // label for dropdown list
					  'value'=>$model->name,  // value for input field
					  'id'=>$model->productsID,            // return value from autocomplete
					);
				 }
			
		  }
		  
		  
		  echo CJSON::encode($arr);
		  Yii::app()->end();
	}
	
	
	public function actionXmldatadb(){
		
		$this->dataControl();
		
		if(isset($_GET["data"])){
			$data=json_decode($_GET["data"]);
			 if(@$getRss  = simplexml_load_file($data->url)){
				 		
							
			$xmlItemCount = count($getRss->item);
			
			$check=array(
				"0"=>true,
				"1"=>true,
				"2"=>true,
				"3"=>true,
				"4"=>true,
				"5"=>true,
				"6"=>true,
				"7"=>true,
			);
			
			$error=0;
			$warning=0;
			
			$count=0;
			
			if($xmlItemCount-$data->rows>29)
				$max=$data->rows+30;
			else
				$max=$xmlItemCount;
				
			for ($row = $data->rows; $row < $max; $row++) {
				$count++;
				$renk="green";
				
				$items[0]  = $getRss->item[$row]->name;
				$items[1]  = $getRss->item[$row]->brand;
				$items[2]  = $getRss->item[$row]->model;
				$items[3]  = $getRss->item[$row]->purchaseprice;
				$items[4]  = $getRss->item[$row]->saleprice;
				$items[5]  = $getRss->item[$row]->reducedprice;
				$items[6]  = $getRss->item[$row]->dealerprice;
				$items[7]  = $getRss->item[$row]->group;	
				
				if($items[0]==""){
					 $renk="red";
					 $check[0]=false;
				}
			
				if($items[1] ==""){
					 $renk="red";
					 $check[1]=false;
				}
					 
				if($items[2] ==""){
					 $renk="red";
					  $check[2]=false;
				}
				
				if($items[3] ==""){
					 $renk="red";
					  $check[3]=false;
				}
				
				if($items[4] ==""){
					 $renk="red";
					 $check[4]=false;
				}
				
					 
				if($items[7] ==""){
					 $renk="red";
					 $check[7]=false;
				}
				
				
				if($items[3] !=""){
					$value=$items[3] ;
					$value=explode(" ",$value);
					
					if(@ProductsController::getParams_("currencyValue",$value[1])){
						
					}else{
						$renk="red";
						$check[3]=false;
					}
						
					
				}
				
				if($items[4] !=""){
					$value=$items[4] ;
					$value=explode(" ",$value);
					
					if(@ProductsController::getParams_("currencyValue",$value[1])){
						
					}else{
						$renk="red";
						$check[4]=false;
					}
					
					
				}
				
				if($items[5] !=""){
					$value=$items[5] ;
					$value=explode(" ",$value);
					
					
						if(@ProductsController::getParams_("currencyValue",$value[1])){
							
						}else{
							$renk="red";
							$check[5]=false;
						}
					
						
					
				}
				
				if($items[6] !=""){
					$value=$items[6] ;
					$value=explode(" ",$value);
					
					
						if(@ProductsController::getParams_("currencyValue",$value[1])){
							
						}else{
							$renk="red";
							$check[6]=false;
						}
					
				}
				
				
				
				if($items[0]!=""){
					if(strlen($items[0])>75){
						$renk="red";
						$check[0]=false;
					}
				}
				
				if($items[1] !=""){
					if(strlen($items[1] )>30){
						$renk="red";
						$check[1]=false;
					}
				}
				
				if($items[2] !=""){
					if(strlen($items[2] )>30){
						$renk="red";
						$check[2]=false;
					}
				}
				
				if($items[7] !=""){
					if(!ProductsController::getProductgroupsCheck($items[7] )){
						$renk="red";
						$check[7]=false;
					}
				}
				
				
				if($items[0]!=""){
					if(ProductsController::getProductNameCheck($items[0])){
						$renk="yellow";
						$warning++;
					}
					
				}
						
						
						
						
						if($renk=="red")
							$error++;
						
						
									
					
					
					if($renk=="green"){
						
						$modelProducts= new Products;
						
						$modelProducts->name=$items[0];
						$modelProducts->brand=$items[1];
						$modelProducts->model=$items[2];
						
						$purchasePrice=$items[3];
						
						$purchasePrice=explode(" ",$purchasePrice);
						
						$modelProducts->purchasePrice=$purchasePrice[0];
						$modelProducts->purchaseCur=$this->getParams_("currencyNumber",$purchasePrice[1]);
						
						$salePrice=$items[4];
						$salePrice=explode(" ",$salePrice);
						
						$modelProducts->salePrice=$salePrice[0];
						$modelProducts->saleCur=$this->getParams_("currencyNumber",$salePrice[1]);
						
						if($items[5]!=""){
							$reducedPrice=$items[5];
							$reducedPrice=explode(" ",$reducedPrice);
							
							if(@$reducedPrice[0]!="")
								$modelProducts->reducedPrice=$reducedPrice[0];
							
							if(@$reducedPrice[1])
								$modelProducts->reduceCur=@$this->getParams_("currencyNumber",$reducedPrice[1]);
							
						}
						
						if($items[6]!=""){
							$dealerPrice=$items[6];
							$dealerPrice=explode(" ",$dealerPrice);
							
							if(@$dealerPrice[0]!="")
								$modelProducts->dealerPrice=$dealerPrice[0];
							
							if(@$reducedPrice[1])
								$modelProducts->dealerCur=@$this->getParams_("currencyNumber",$dealerPrice[1]);
							
						}
						
						
						
						
						$modelProducts->productgroupsID=$this->getProductgroups($items[7]);
						
						$modelProductdetail=new Productdetail;
		
						$modelProductdetail->dealerPrice=$modelProducts->dealerPrice;
						$modelProductdetail->reducedPrice=$modelProducts->reducedPrice;
						$modelProductdetail->salePrice=$modelProducts->salePrice;
						$modelProductdetail->purchasePrice=$modelProducts->purchasePrice;
						
						$modelProductdetail->dateAdd=date("Y-m-d H:i:s");
						$modelProductdetail->deleted=1;
						$modelProductdetail->worldID=Yii::app()->user->getState("worldID");
						$modelProductdetail->companyID=Yii::app()->user->getState("companyID");
						
						$modelProductdetail->purchaseCur=$modelProducts->purchaseCur;
						$modelProductdetail->reduceCur=$modelProducts->reduceCur;
						$modelProductdetail->dealerCur=$modelProducts->dealerCur;
						$modelProductdetail->saleCur=$modelProducts->saleCur;
						
						$modelProducts->satis1=0;
						$modelProducts->satis2=0;
						$modelProducts->alis1=0;
						$modelProducts->alis2=0;
						$modelProducts->text="-";
						
						if($modelProducts->save()){
							$modelProductdetail->productsID=$modelProducts->productsID;
							$modelProductdetail->text=$modelProducts->text;
							$modelProductdetail->save();
						
							Yii::app()->user->setState('XMLDataAdd',1);
						}else{
							Yii::app()->user->setState('XMLlDataAdd',2);
						}
					}
			
				}
			 }
			 
			 $data=json_decode($_GET["data"]);
			 $data->rows=$data->rows+30;
			 $this->redirect(array("//products/xmlreaderadd?data=".json_encode($data)));
			
		}else
			$this->redirect(array("//site"));
	}
	
	public function actionXmlreaderadd(){
		
		$this->dataControl();
		
		$model= new Xml;
		
		$rows=0;
		$kontrol=false;
		$highestRow=29;
		if(empty($model->url)){
			if(isset($_POST['Xml']))
			{
				$model->attributes=$_POST['Xml'];
				
				if($model->validate()){
					
					
					$kontrol=true;
						
				}
				
			}
		}else{
			
			$kontrol=true;
			$rows=0;
			
		}
		
		
		$success_=false;
		$error_=false;
		
		if(isset($_GET["data"])){
			$data=json_decode($_GET["data"]);
			$kontrol=true;
			$rows=$data->rows;
			$model->url=$data->url;
			
			
			if(Yii::app()->user->getState('ExcelDataAdd')==1){
				Yii::app()->user->setFlash('success', Yii::t('trans','Veriler başarılı birşekilde aktarilmıştır.'));
				$success_=true;
				Yii::app()->user->setState('ExcelDataAdd',3);
			}elseif(Yii::app()->user->getState('ExcelDataAdd')==2){
				Yii::app()->user->setFlash('error', Yii::t('trans','Veriler aktarılamadı. Lütfen irtibata geçiniz.'));
				$error_=true;
				Yii::app()->user->setState('ExcelDataAdd',3);
			}
		}
		
		
		$this->render("xmlreaderadd",array(
			'model'=>$model,
			'kontrol'=>$kontrol,
			'rows'=>$rows,
			'highestRow'=>$highestRow,
			'error_'=>$error_,
			'success_'=>$success_,
		));
	}
	
	
	
	public function actionXmlreader(){
		$this->render("xmlreader");
	}

	
	public function actionExceldatadb($id){
		
		$this->dataControl();
		
		Yii::import('application.data.excel.PHPExcel',true);
		
		$objPHPExcel = PHPExcel_IOFactory::load(Yii::getPathOfAlias('webroot').'/data/excel/'.yii::app()->user->getState('companyID')."/".yii::app()->user->getState('worldID').".xls");
		
		
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$highestRow = $objWorksheet->getHighestRow();
		
			$check=array(
				"0"=>true,
				"1"=>true,
				"2"=>true,
				"3"=>true,
				"4"=>true,
				"5"=>true,
				"6"=>true,
				"7"=>true,
			);
			
			$error=0;
			$warning=0;
			$row=$id;
			for($row; $row <= $highestRow; $row++)
     	    {
				$renk="green";
				
				if($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()==""){
					 $renk="red";
					 $check[0]=false;
				}
			
				if($objWorksheet->getCellByColumnAndRow(1, $row)->getValue()==""){
					 $renk="red";
					 $check[1]=false;
				}
					 
				if($objWorksheet->getCellByColumnAndRow(2, $row)->getValue()==""){
					 $renk="red";
					  $check[2]=false;
				}
				
				if($objWorksheet->getCellByColumnAndRow(3, $row)->getValue()==""){
					 $renk="red";
					  $check[3]=false;
				}
				
				if($objWorksheet->getCellByColumnAndRow(4, $row)->getValue()==""){
					 $renk="red";
					 $check[4]=false;
				}
				
					
				
				if($objWorksheet->getCellByColumnAndRow(7, $row)->getValue()==""){
					 $renk="red";
					 $check[7]=false;
				}
				
				
				if($objWorksheet->getCellByColumnAndRow(3, $row)->getValue()!=""){
					$value=$objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
					$value=explode(" ",$value);
					
					if(@ProductsController::getParams_("currencyValue",$value[1])){
						
					}else{
						$renk="red";
						$check[3]=false;
					}
						
					
				}
				
				if($objWorksheet->getCellByColumnAndRow(4, $row)->getValue()!=""){
					$value=$objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
					$value=explode(" ",$value);
					
					if(@ProductsController::getParams_("currencyValue",$value[1])){
						
					}else{
						$renk="red";
						$check[4]=false;
					}
					
					
				}
				
				if($objWorksheet->getCellByColumnAndRow(5, $row)->getValue()!=""){
					$value=$objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
					$value=explode(" ",$value);
					
			
					if(@ProductsController::getParams_("currencyValue",$value[1])){
						
					}else{
						$renk="red";
						$check[5]=false;
					}
					
						
					
				}
				
				
				if($objWorksheet->getCellByColumnAndRow(6, $row)->getValue()!=""){
					$value=$objWorksheet->getCellByColumnAndRow(6, $row)->getValue();
					$value=explode(" ",$value);
					
					
					if(@ProductsController::getParams_("currencyValue",$value[1])){
						
					}else{
						$renk="red";
						$check[6]=false;
					}
					
						
					
				}
				
				
				if($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()!=""){
					if(strlen($objWorksheet->getCellByColumnAndRow(0, $row)->getValue())>75){
						$renk="red";
						$check[0]=false;
					}
				}
				
				if($objWorksheet->getCellByColumnAndRow(1, $row)->getValue()!=""){
					if(strlen($objWorksheet->getCellByColumnAndRow(1, $row)->getValue())>30){
						$renk="red";
						$check[1]=false;
					}
				}
				
				if($objWorksheet->getCellByColumnAndRow(2, $row)->getValue()!=""){
					if(strlen($objWorksheet->getCellByColumnAndRow(2, $row)->getValue())>30){
						$renk="red";
						$check[2]=false;
					}
				}
				
				if($objWorksheet->getCellByColumnAndRow(7, $row)->getValue()!=""){
					if(!ProductsController::getProductgroupsCheck($objWorksheet->getCellByColumnAndRow(7, $row)->getValue())){
						$renk="red";
						$check[7]=false;
					}
				}
				
				
				if($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()!=""){
					if(ProductsController::getProductNameCheck($objWorksheet->getCellByColumnAndRow(0, $row)->getValue())){
						$renk="yellow";
						$warning++;
					}
					
				}
				
				
				if($renk=="red")
					$error++;
					
				$modelProducts=new Products();
				for ($col = 0; $col <= 7; ++$col)
      			{
					
					if($renk=="green"){
						
						if($col==0)
							$modelProducts->name=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
						elseif($col==1)
							$modelProducts->brand=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
						elseif($col==2)
							$modelProducts->model=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
						elseif($col==3){
							$purchasePrice=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
							
							$purchasePrice=explode(" ",$purchasePrice);
							
							$modelProducts->purchasePrice=$purchasePrice[0];
							$modelProducts->purchaseCur=$this->getParams_("currencyNumber",$purchasePrice[1]);
						}elseif($col==4){
							$salePrice=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
							$salePrice=explode(" ",$salePrice);
							
							$modelProducts->salePrice=$salePrice[0];
							$modelProducts->saleCur=$this->getParams_("currencyNumber",$salePrice[1]);
						}elseif($col==5){
							
							if($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()!=""){
								$reducedPrice=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
								$reducedPrice=explode(" ",$reducedPrice);
								if(@$reducedPrice[0]!="")
									$modelProducts->reducedPrice=$reducedPrice[0];
									
								if(@$reducedPrice[1]!="")
									$modelProducts->reduceCur=@$this->getParams_("currencyNumber",$reducedPrice[1]);
								
							}
						}elseif($col==6){
							
							if($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()!=""){
								$dealerPrice=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
								$dealerPrice=explode(" ",$dealerPrice);
								if(@$dealerPrice[0]!="")
									$modelProducts->dealerPrice=$dealerPrice[0];
									
								if(@$reducedPrice[1]!="")
									$modelProducts->dealerCur=@$this->getParams_("currencyNumber",$dealerPrice[1]);
								
							}
						}elseif($col==7){
							
							$modelProducts->productgroupsID=$this->getProductgroups($objWorksheet->getCellByColumnAndRow($col, $row)->getValue());
						}
						
						
						
						
						
					}
					
					
						
				}
				
				echo $renk;
				
				if($renk=="green"){
						$modelProductdetail=new Productdetail;
		
						$modelProductdetail->dealerPrice=$modelProducts->dealerPrice;
						$modelProductdetail->reducedPrice=$modelProducts->reducedPrice;
						$modelProductdetail->salePrice=$modelProducts->salePrice;
						$modelProductdetail->purchasePrice=$modelProducts->purchasePrice;
						
						$modelProductdetail->dateAdd=date("Y-m-d H:i:s");
						$modelProductdetail->deleted=1;
						$modelProductdetail->worldID=Yii::app()->user->getState("worldID");
						$modelProductdetail->companyID=Yii::app()->user->getState("companyID");
						
						$modelProductdetail->purchaseCur=$modelProducts->purchaseCur;
						$modelProductdetail->reduceCur=$modelProducts->reduceCur;
						$modelProductdetail->dealerCur=$modelProducts->dealerCur;
						$modelProductdetail->saleCur=$modelProducts->saleCur;
						
						$modelProducts->satis1=0;
						$modelProducts->satis2=0;
						$modelProducts->alis1=0;
						$modelProducts->alis2=0;
						$modelProducts->text="-";
						
						if($modelProducts->save()){
							$modelProductdetail->productsID=$modelProducts->productsID;
							$modelProductdetail->text=$modelProducts->text;
							$modelProductdetail->save();
							Yii::app()->user->setState('ExcelDataAdd',1);
						}else{
							 Yii::app()->user->setState('ExcelDataAdd',2);
						}
						
					}
			}
			
			
		$this->redirect(array("products/excelreaderlist","rows"=>$id+30));
		
			
	}
	
	public function actionExcelreaderlist($rows=1){
		
		$this->dataControl();
		
		Yii::import('application.data.excel.PHPExcel',true);
		
		$objPHPExcel = PHPExcel_IOFactory::load(Yii::getPathOfAlias('webroot').'/data/excel/'.yii::app()->user->getState('companyID')."/".yii::app()->user->getState('worldID').".xls");
		
		$success_=false;
		$error_=false;
		if(Yii::app()->user->getState('ExcelDataAdd')==1){
			Yii::app()->user->setFlash('success', Yii::t('trans','Veriler başarılı birşekilde aktarilmıştır.'));
			$success_=true;
			Yii::app()->user->setState('ExcelDataAdd',3);
		}elseif(Yii::app()->user->getState('ExcelDataAdd')==2){
			Yii::app()->user->setFlash('error', Yii::t('trans','Veriler aktarılamadı. Lütfen irtibata geçiniz.'));
			$error_=true;
			Yii::app()->user->setState('ExcelDataAdd',3);
		}

		$objWorksheet = $objPHPExcel->getActiveSheet();
		$highestRow = $objWorksheet->getHighestRow();
		$highestRow2=$highestRow;
		
		
			$highestRow=30;
		
			
		if(isset($_GET["data"])){
			$data=json_decode($_GET["data"]);
			$rows=$data->rows;
			if($highestRow2-$data->rows<29)
				$highestRow=$highestRow2;
			else
				$highestRow=$data->rows+29;
			
		}
		
		$this->render("excelreaderlist",array(
			'objWorksheet'=>$objWorksheet,
			'highestRow'=>$highestRow,
			'highestRow2'=>$highestRow2,
			"rows"=>$rows,
			'error_'=>$error_,
			'success_'=>$success_,
		));
		
		
	}
	
	
	public function actionExcelreaderadd(){
		$model= new Excel;
		
		if(isset($_POST['Excel']))
		{
			$model->attributes=$_POST['Excel'];
			
			if($model->validate()){
				
				$model->excel=CUploadedFile::getInstance($model,'excel');
			
				if (is_dir(Yii::getPathOfAlias('webroot').'/data/excel/'.yii::app()->user->getState('companyID')) === false)
						mkdir(Yii::getPathOfAlias('webroot').'/data/excel/'.yii::app()->user->getState('companyID'), 0777);
				$uzanti=explode('.',$model->excel);
				$model->excel->saveAs(Yii::getPathOfAlias('webroot').'/data/excel/'.yii::app()->user->getState('companyID')."/".yii::app()->user->getState('worldID').".".$uzanti[1]);
					
				$this->redirect(array("products/excelreaderlist"));
					
			}
			
		}
		$this->render("excelreaderadd",array(
			'model'=>$model,
	
		));
	}
	
	public function actionExcelreader(){
		$this->render("excelreader");
	}
	
	public function actionKapakchange($id){
		$modelPi=Productimages::model()->findbyPk($id);
		
		$model=$this->loadModel($modelPi->productID);
		$this->accsesControl($model);
		
		
		Productimages::model()->updateAll(array('mainimages'=>0),'productID='.$modelPi->productID);
		
		$modelPi->mainimages=1;
		if($modelPi->update())
			$this->redirect(array("products/imageslist","id"=>$modelPi->productID));
	}
	
	public function actionViewp($id){
		
		
		$criteria=new CDbCriteria;
		$criteria->select='*, pg.tax as tax, pg.name as pgname, t.name as name';
		$criteria->condition='t.productsID=:productsID';
		$criteria->params=array(':productsID'=>$id);
		$criteria->join = 'left join productgroups pg on (t.productgroupsID=pg.productgroupsID) left join productdetail pd on (t.productsID=pd.productsID)';
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
		
		$this->render('viewp',array(
			'model'=>$model,
			'imagelist'=>$images,
			'kapakimage'=>$kapakimage,
			'modelProductbot'=>$modelProductbot,
			'modelWarehousebottomstok'=>$modelWarehousebottomstok
		));
	}
	
	public function actionImagedelete(){
		$modelProductimages=Productimages::model()->findByPk(substr($_POST["id"],1,strlen($_POST["id"])));
		$images=$modelProductimages->images;
		$productID=$modelProductimages->productID;
		$mainimages=$modelProductimages->mainimages;
		
		if($modelProductimages->delete()){
			$data["sonuc"]=1;
			unlink(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$productID.'/thumb_'.$images);
			unlink(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$productID.'/'.$images);
			
			$model=Productimages::model()->find("productID=:productID",array(":productID"=>$productID));
			if(isset($model)){
				$model->mainimages=1;
				$model->update();
				$data["id"]=$model->productimagesID;
			}else
				$data["id"]=0;
		}else
			$data["sonuc"]=0;
			
		echo json_encode($data);
		
	}
	
	
	public function actionImageresize($id){
		$this->layout="panelno";
		$model=Productimages::model()->findByPk($id);
		$modelProduct=$this->loadModel($model->productID);
		
		$this->accsesControl($model);
		
		if(isset($_POST['Productimages'])){
						
					
						$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$model->productID.'/'.$model->images);
						$thumb->crop($_POST['Productimages']["cropX"],$_POST['Productimages']["cropY"],$_POST['Productimages']["cropW"],$_POST['Productimages']["cropH"]);
						if($thumb->save(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$model->productID.'/'.$model->images)){$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$model->productID.'/'.$model->images);
	
							$thumb->resize(300);
							$thumb->save(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$model->productID.'/thumb_'.$model->images);
							
							
								
							$this->redirect(array('imageslist','id'=>$model->productID));
							
						}
							
						
			}
					
			$this->render('resize',array(
				'model'=>$model,
				'modelProduct'=>$modelProduct,
			));
	}
	
	public function actionImageadd($id){
		$imagesCount=Productimages::model()->count("productID=:productID",array(":productID"=>$id));
		if($imagesCount>12)
				$this->redirect(array('imageslist','id'=>$id));	
				
		$modelProduct=$this->loadModel($id);
		
		$model= new Productimages;
		
		if(isset($_POST['Productimages']))
		{
			$model->attributes=$_POST['Productimages'];
			$model->productID=$id;
			
			$model->images=CUploadedFile::getInstance($model,'images');
			$model->companyID=Yii::app()->user->getState("companyID");
			$model->worldID=Yii::app()->user->getState("worldID");
			
			if($model->validate()){
				
				if (is_dir(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$id) === false)
						mkdir(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$id, 0777);
				$uzanti=explode('.',$model->images);
				
				$random=$this->randfunc();
				
				if($this->imageAdd($model,$uzanti,$random,$id)){
					$model->images=$random.'.'.$uzanti[1];	
					
					if($model->mainimages==1){
						$modelProductimages=Productimages::model()->findAll("productID=:productID AND mainimages=:mainimages",array(":productID"=>$id,":mainimages"=>1));
						
						Productimages::model()->updateAll(array('mainimages'=>0),'productID='.$model->productID);
					}
					$modelProductimages=Productimages::model()->find("productID=:productID AND mainimages=:mainimages",array(":productID"=>$id,":mainimages"=>1));
					if(count($modelProductimages)<1)
						$model->mainimages=1;
						
					if($model->save())
						$this->redirect(array('imageresize','id'=>$model->productimagesID));	
				}
			}
				
		}
		
		$this->render('imageadd',array(
			'model'=>$model,
			'modelProductimages'=>$modelProduct,
		));
	}
	
	private function randfunc(){
		$controller= new Sitecontroller;
		return $controller->randfunc();
	}
	
	private function imageAdd($model,$uzanti,$random,$id){
		
			
		if($model->images->saveAs(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$id.'/'.$random.'.'.$uzanti[1])){
			
			$thumb=Yii::app()->phpThumb->create(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$id.'/'.$random.'.'.$uzanti[1]);
			$data = getimagesize(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$id.'/'.$random.'.'.$uzanti[1]);
			
			
			$thumb->resize($data[0]);
			
			if($thumb->save(Yii::getPathOfAlias('webroot').'/resimler/productimages/'.$id.'/'.$random.'.'.$uzanti[1]))
			return true;
		else
			return false;	
		}else
			return false;	
						
	}
	
	public function actionImageslist($id){
		$model=$this->loadModel($id);
		$kapakimage=Productimages::model()->find("productID=:productID AND mainimages=:mainimages",array(":productID"=>$id,":mainimages"=>1));
		
		$images=Productimages::model()->findAll("productID=:productID AND mainimages=:mainimages",array(":productID"=>$id,":mainimages"=>0));
		
		$imagesCount=Productimages::model()->count("productID=:productID",array(":productID"=>$id));
		
		$this->render('imageslist',array(
			'model'=>$model,
			'kapakimage'=>$kapakimage,
			'imagelist'=>$images,
			'imagesCount'=>$imagesCount,
		));
	}
	
	public function actionBottomdelete(){
		if(isset($_POST))
		{
			$model=Warehousebottomstok::model()->findByPk($_POST["warehousebottomstokID"]);
			$productbottomsID=$model->productbottomsID;
			if($model->delete()){
				$data["sonuc"]=1;
				
				$criteria=new CDbCriteria;
				$criteria->select='*';
				$criteria->condition='productbottomsID=:productbottomsID  AND worldID=:worldID AND companyID=:companyID';
				$criteria->params=array(
					':companyID'=>yii::app()->user->getState('companyID'),
					':worldID'=>yii::app()->user->getState('worldID'),
					':productbottomsID'=>$productbottomsID,
				);
				$modelWarehousebottomstok=Warehousebottomstok::model()->findAll($criteria);
				
				 $stok=0;
				foreach($modelWarehousebottomstok as $key2=>$value2)
						$stok+=$value2->stok;
				$data["stok"]=$stok;
			}else
				$data["sonuc"]=0;
				
			echo json_encode($data);
		}
	}
	
	public function actionBottomadd(){
		if(isset($_POST))
		{
			$modelProductbottoms=new Productbottoms;
			$modelProductbottoms->productsID=(int)$_POST["productsID"];
			
			$STR="";
			if(isset($_POST["bottomvalue1"])){
				$modelProductbottoms->bottomvalue1= trim($_POST["bottomvalue1"]);
				$STR.=$modelProductbottoms->bottomvalue1;
			}
			if(isset($_POST["bottomvalue2a"])){
				$modelProductbottoms->bottomvalue2= $_POST["bottomvalue2a"].' X '.$_POST["bottomvalue2b"].' '.$_POST["bottombirim2"];
				$STR.=$modelProductbottoms->bottomvalue2;
			}
			if(isset($_POST["bottomvalue3"])){
				$modelProductbottoms->bottomvalue3= $_POST["bottomvalue3"];
				$STR.=$modelProductbottoms->bottomvalue3;
			}
			if(isset($_POST["bottomvalue4"])){
				$modelProductbottoms->bottomvalue4= $_POST["bottomvalue4"];
				$STR.=$modelProductbottoms->bottomvalue4;
			}
			if(isset($_POST["bottomvalue5"])){
				$modelProductbottoms->bottomvalue5= $_POST["bottomvalue5"].' '.$_POST["bottombirim5"];
				$STR.=$modelProductbottoms->bottomvalue5;
			}
			if(isset($_POST["bottomvalue6"])){
				$modelProductbottoms->bottomvalue6= $_POST["bottomvalue6"].' '.$_POST["bottombirim6"];
				$STR.=$modelProductbottoms->bottomvalue6;
			}
			if(isset($_POST["bottomvalue7"])){
				$modelProductbottoms->bottomvalue7= $_POST["bottomvalue7"];
				$STR.=$modelProductbottoms->bottomvalue7;
			}
			
				$modelProductbottoms->stok=(int) $_POST["stok"];
				$modelProductbottoms->warehouseID= (int)$_POST["warehouseID"];
				$modelProductbottoms->companyID=Yii::app()->user->getState("companyID");
				$modelProductbottoms->worldID=Yii::app()->user->getState("worldID");
			$data["sonuc"]=0;
			
			
			$control=$this->bottomsControl($STR,$modelProductbottoms->productsID);
			
			$data["sonuc"]=$control;
			
			if($control==false){
			
				if($modelProductbottoms->save()){
					$data["sonuc"]=1;
					$data["id"]=$modelProductbottoms->productbottomsID;
					$data["stok"]=$modelProductbottoms->stok;
					$modelWarehouse=Warehouse::model()->findByPk($_POST["warehouseID"]);
					$data["warehouse"]=$modelWarehouse->name;
					
					if(isset($_POST["bottomvalue1"]))
						$data["bottomvalue1"]=$modelProductbottoms->bottomvalue1;
					if(isset($_POST["bottomvalue2a"]))
						$data["bottomvalue2"]=$modelProductbottoms->bottomvalue2;
					if(isset($_POST["bottomvalue3"]))
						$data["bottomvalue3"]=$modelProductbottoms->bottomvalue3;
					if(isset($_POST["bottomvalue4"]))
						$data["bottomvalue4"]=$modelProductbottoms->bottomvalue4;
					if(isset($_POST["bottomvalue5"]))
						$data["bottomvalue5"]=$modelProductbottoms->bottomvalue5;
					if(isset($_POST["bottomvalue6"]))
						$data["bottomvalue6"]=$modelProductbottoms->bottomvalue6;
					if(isset($_POST["bottomvalue7"]))
						$data["bottomvalue7"]=$modelProductbottoms->bottomvalue7;
						
					$modelWarehousebottomstok= new Warehousebottomstok;
					$modelWarehousebottomstok->warehouseID=$modelProductbottoms->warehouseID;
					$modelWarehousebottomstok->productbottomsID=$modelProductbottoms->productbottomsID;
					$modelWarehousebottomstok->stok=$modelProductbottoms->stok;
					$modelWarehousebottomstok->productsID=$modelProductbottoms->productsID;
					$modelWarehousebottomstok->companyID=Yii::app()->user->getState("companyID");
					$modelWarehousebottomstok->worldID=Yii::app()->user->getState("worldID");
					$modelWarehousebottomstok->save();
					
					$data["warehousebottomstokID"]=$modelWarehousebottomstok->warehousebottomstokID;

				}
				else
					$data["sonuc"]=0;	

			}else{
				$modelWarehousebottomstok=Warehousebottomstok::model()->find("productbottomsID=:productbottomsID AND warehouseID=:warehouseID",array(":warehouseID"=>$modelProductbottoms->warehouseID,':productbottomsID'=>$control));
				if(count($modelWarehousebottomstok)>0)
					$data["sonuc"]=2;
				else{
					$modelWarehousebottomstok= new Warehousebottomstok;
					$modelWarehousebottomstok->warehouseID=$modelProductbottoms->warehouseID;
					$modelWarehousebottomstok->productbottomsID=$control;
					$modelWarehousebottomstok->stok=$modelProductbottoms->stok;
					$modelWarehousebottomstok->productsID=$modelProductbottoms->productsID;
					$modelWarehousebottomstok->companyID=Yii::app()->user->getState("companyID");
					$modelWarehousebottomstok->worldID=Yii::app()->user->getState("worldID");
					if($modelWarehousebottomstok->save()){
						$data["sonuc"]=3;
						$modelWarehouse=Warehouse::model()->findByPk($_POST["warehouseID"]);
						$data["warehouse"]=$modelWarehouse->name;
						$data["id"]=$control;
						$data["warehousebottomstokID"]=$modelWarehousebottomstok->warehousebottomstokID;
							$criteria=new CDbCriteria;
							$criteria->select='*';
							$criteria->condition='productbottomsID=:productbottomsID  AND worldID=:worldID AND companyID=:companyID';
							$criteria->params=array(
								':companyID'=>yii::app()->user->getState('companyID'),
								':worldID'=>yii::app()->user->getState('worldID'),
								':productbottomsID'=>$control,
							);
							$modelWarehousebottomstok=Warehousebottomstok::model()->findAll($criteria);
							
							 $stok=0;
							foreach($modelWarehousebottomstok as $key2=>$value2){
							
							
									$stok+=$value2->stok;
								
							}
						
						$data["stok"]=$stok;	
					}else
						$data["sonuc"]=0;
				}
			}
			
			echo json_encode($data);
		}
	}
	
	private function bottomsControl($STR2,$productsID){
		
		
		$modelProductbot=Productbottoms::model()->findAll("productsID=:productsID",array(":productsID"=>$productsID));
		
		$bottom=array();
		
		foreach($modelProductbot as $key=>$value){
			$STR="";
			if($value->bottomvalue1!="")
				$STR.=$value->bottomvalue1;
			
			if($value->bottomvalue2!="")
				$STR.=$value->bottomvalue2;
			
			if($value->bottomvalue3!="")
				$STR.=$value->bottomvalue3;
				
			if($value->bottomvalue4!="")
				$STR.=$value->bottomvalue4;
				
			if($value->bottomvalue5!="")
				$STR.=$value->bottomvalue5;
				
			if($value->bottomvalue6!="")
				$STR.=$value->bottomvalue6;
				
			if($value->bottomvalue7!="")
				$STR.=$value->bottomvalue7;
				
			$bottom[$STR]=array("STR"=>$STR,'id'=>$value->productbottomsID);
		}
		if(@$bottom[$STR2])
			return $bottom[$STR2]["id"];
		else 
			return false;
		
	}
	
	public function actionGetgroupautolist(){
		$arr = array();
		  $term = Yii::app()->getRequest()->getParam('term', false);
		  if ($term)
		  {
			  	 $sql = 'SELECT productgroupsID, name FROM productgroups where companyID='.Yii::app()->user->getState("companyID").' AND worldID='.Yii::app()->user->getState("worldID").' AND LCASE(name) LIKE :name AND deleted=1';
				 $cmd = Yii::app()->db->createCommand($sql);
				 $cmd->bindValue(":name","%".strtolower($term)."%", PDO::PARAM_STR);
				 $res = $cmd->queryAll();
				 foreach($res as $model)
				 {
					 $model=(object)$model;
					$arr[] = array(
					  'label'=>$model->name,  // label for dropdown list
					  'value'=>$model->name,  // value for input field
					  'id'=>$model->productgroupsID,            // return value from autocomplete
					);
				 }
			
		  }
		  
		  
		  echo CJSON::encode($arr);
		  Yii::app()->end();
	}
	
	public function actionBottomproduct($id){
		$model=$this->loadModel($id);
		
		$modelProductbottoms=new Productbottoms;
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='t.productsID=:productsID  AND t.worldID=:worldID AND t.companyID=:companyID';
		$criteria->params=array(
			':companyID'=>yii::app()->user->getState('companyID'),
			':worldID'=>yii::app()->user->getState('worldID'),
			':productsID'=>$model->productsID,
		);
		$modelProductbot=Productbottoms::model()->findAll($criteria);
		
		$modelWarehouse=Warehouse::model()->findAll("worldID=:worldID AND companyID=:companyID",array(':companyID'=>yii::app()->user->getState('companyID'),':worldID'=>yii::app()->user->getState('worldID')));
		
		
		
		$modelProductbottoms=new Productbottoms;
		
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
		
		$this->render('bottomproduct',array(
			'model'=>$model,
			'modelProductbottoms'=>$modelProductbottoms,
			'modelProductbot'=>$modelProductbot,
			'modelWarehouse'=>$modelWarehouse,
			'modelWarehousebottomstok'=>$modelWarehousebottomstok,
		));
	}
	public function actionView($id)
	{
		
		
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Products;

		
		$model->satis2="00";
		$model->alis2="00";
		
		
		if(isset($_POST['Products']))
		{
			$model->attributes=$_POST['Products'];
			$modelProductdetail=new Productdetail;
			
			if($model->alis1!="" && $model->alis2!=""){
				
				$modelProductdetail->purchasePrice=$model->alis1.".".$model->alis2;
			}
			
			if($model->satis1!="" && $model->satis2!=""){
				$modelProductdetail->salePrice=$model->satis1.".".$model->satis2;
			}
			
			if($model->reduce1!="" && $model->reduce2!=""){
				$modelProductdetail->reducedPrice=$model->reduce1.".".$model->reduce2;
			}else{
				$modelProductdetail->reducedPrice="";
			}
			
			if(!$model->dealer1!="" && $model->dealer2!=""){
				$modelProductdetail->dealerPrice=$model->dealer1.".".$model->dealer2;
			}else{
				$modelProductdetail->dealerPrice="";
			}
			
			$productgroupsID=substr($model->productgroupsID,1,strlen($model->productgroupsID));
			$oldProductgroupsID=$model->productgroupsID;
			$model->productgroupsID=$productgroupsID;
			$modelProductdetail->text=strip_tags($model->text, '<p><a><font><table><tr><td><tbody><br><br /><span><hr><ul><li><b><h5><h4><h3><h2><h1><sup><img>');
			
			
			$modelProductdetail->dateAdd=date("Y-m-d H:i:s");
			$modelProductdetail->deleted=1;
			$modelProductdetail->worldID=Yii::app()->user->getState("worldID");
			$modelProductdetail->companyID=Yii::app()->user->getState("companyID");
			
			$modelProductdetail->purchaseCur=$model->purchaseCur;
			$modelProductdetail->reduceCur=$model->reduceCur;
			$modelProductdetail->dealerCur=$model->dealerCur;
			$modelProductdetail->saleCur=$model->saleCur;
			if($model->save()){
				$modelProductdetail->productsID=$model->productsID;

				if($modelProductdetail->save())
				{
					$this->redirect(array('bottomproduct','id'=>$model->productsID));
				}
			}else{
				if(!empty($model->productgroupsID)){
					
					$modelProductgroups=Productgroups::model()->findByPk($productgroupsID);
					
					if(count($modelProductgroups)>0){
						if($modelProductgroups->companyID==Yii::app()->user->getState("companyID")){
							$model->productsGroupName=$modelProductgroups->name;
						}
					}
					
					$model->productgroupsID=$oldProductgroupsID;
				}
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	
	public function actionUpdate($id)
	{
		
		$model=$this->loadModel($id);
		$modelProductdetail=Productdetail::model()->find("productsID=:productsID",array("productsID"=>$model->productsID));

		if(isset($_POST['Products']))
		{
			$model->attributes=$_POST['Products'];
			
			if(!empty($model->alis1) && !empty($model->alis2)){
				$modelProductdetail->purchasePrice=$model->alis1.".".$model->alis2;
			}
			
			if(!empty($model->satis1) && !empty($model->satis2)){
				$modelProductdetail->salePrice=$model->satis1.".".$model->satis2;
			}
			
			if(!empty($model->reduce1) && !empty($model->reduce2)){
				$modelProductdetail->reducedPrice=$model->reduce1.".".$model->reduce2;
			}else{
				$modelProductdetail->reducedPrice="";
			}
			
			if(!empty($model->dealer1) && !empty($model->dealer2)){
				$modelProductdetail->dealerPrice=$model->dealer1.".".$model->dealer2;
			}else{
				$modelProductdetail->dealerPrice="";
			}
			
			$productgroupsID=substr($model->productgroupsID,1,strlen($model->productgroupsID));
			$oldProductgroupsID=$model->productgroupsID;
			$model->productgroupsID=$productgroupsID;
			$modelProductdetail->text=strip_tags($model->text, '<p><a><font><table><tr><td><tbody><br><br /><span><hr><ul><li><b><h5><h4><h3><h2><h1><sup><img>');
			
			
			$modelProductdetail->purchaseCur=$model->purchaseCur;
			$modelProductdetail->reduceCur=$model->reduceCur;
			$modelProductdetail->dealerCur=$model->dealerCur;
			$modelProductdetail->saleCur=$model->saleCur;
			if($model->save()){
				$modelProductdetail->productsID=$model->productsID;
				$modelProductdetail->update();
					$this->redirect(array('bottomproduct','id'=>$model->productsID));
					
					
			}else{
				if(!empty($model->productgroupsID)){
					
					$modelProductgroups=Productgroups::model()->findByPk($productgroupsID);
					
					if(count($modelProductgroups)>0){
						if($modelProductgroups->companyID==Yii::app()->user->getState("companyID")){
							$model->productsGroupName=$modelProductgroups->name;
						}
					}
					
					$model->productgroupsID=$oldProductgroupsID;
				}
				
				
				
			}
				
		}else{
			
			
			$this->accsesControl($modelProductdetail);

			$model->text=$modelProductdetail->text;
			$model->purchaseCur=$modelProductdetail->purchaseCur;
			$model->reduceCur=$modelProductdetail->reduceCur;
			$model->dealerCur=$modelProductdetail->dealerCur;
			$model->saleCur=$modelProductdetail->saleCur;
			
			if(!empty($modelProductdetail->purchasePrice)){
				$dt=explode(".",$modelProductdetail->purchasePrice);
				$model->alis1=$dt[0];
				if(isset($dt[1]))
					$model->alis2=str_pad($dt[1], 2, "0", STR_PAD_RIGHT);
				else
					$model->alis2="00";
			}
			if(!empty($modelProductdetail->salePrice)){
				$dt=explode(".",$modelProductdetail->salePrice);
				$model->satis1=$dt[0];
				
				if(isset($dt[1]))
					$model->satis2=str_pad($dt[1], 2, "0", STR_PAD_RIGHT);
				else
					$model->satis2="00";
			}
			
			
			if(!empty($modelProductdetail->reducedPrice)){
				$dt=explode(".",$modelProductdetail->reducedPrice);
				$model->reduce1=$dt[0];
				
				if(isset($dt[1]))
					$model->reduce2=str_pad($dt[1], 2, "0", STR_PAD_RIGHT);
				else
					$model->reduce2="00";
			}
			
			if(!empty($modelProductdetail->dealerPrice)){
				$dt=explode(".",$modelProductdetail->dealerPrice);
				$model->dealer1=$dt[0];
				
				if(isset($dt[1]))
					$model->dealer2=str_pad($dt[1], 2, "0", STR_PAD_RIGHT);
				else
					$model->dealer2="00";
			}
			
			if(!empty($model->productgroupsID)){
					
					$modelProductgroups=Productgroups::model()->findByPk($model->productgroupsID);
					
					if(count($modelProductgroups)>0){
						if($modelProductgroups->companyID==Yii::app()->user->getState("companyID")){
							$model->productsGroupName=$modelProductgroups->name;
						}
					}
					
					$model->productgroupsID="a".$model->productgroupsID;
			}
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
		$modelProductdetail=Productdetail::model()->find("productsID=:productsID",array(":productsID"=>$id ));
		$this->accsesControl($modelProductdetail);

		$modelProductdetail->deleted=0;
		$modelProductdetail->update();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
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

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Products the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Products::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Products $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='products-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	
	
	public function getProductgroupsCheck($name){
		$modelProductgroups=Productgroups::model()->find("name=:name AND worldID=:worldID AND companyID=:companyID",array(":name"=>$name,":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")));
		
		if(count($modelProductgroups)>0)
			return true;
	}
	
	public function getProductgroups($name){
		$modelProductgroups=Productgroups::model()->find("name=:name AND worldID=:worldID AND companyID=:companyID",array(":name"=>$name,":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")));
		
		return $modelProductgroups->productgroupsID;
	}
	
	
	public function getProductNameCheck($name){
		
		
		 $sql = 'SELECT name FROM Products as t left JOIN productdetail AS pd ON (pd.productsID = t.productsID AND pd.worldID='.Yii::app()->user->getState("worldID").') where  LCASE(t.name) LIKE :name';
		 $cmd = Yii::app()->db->createCommand($sql);
		 $cmd->bindValue(":name","%".trim($name)."%", PDO::PARAM_STR);
		 $res = $cmd->queryAll();
		
		 
		if(count($res)>0)
			return true;
			
	}
	
	
	public function getProductgroups3(){
		 $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1 and pgID=0",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")),
             'order'=>'name asc',
             ));
			 $list =array();
			foreach($modelCustomergroups as $key=>$value){
				$onek=1;
				$list[$value->productgroupsID]=$value->name;
				$list=$this->katListele3($value->productgroupsID,$onek,$list);
			}
			
			return $list;
	}
	
	private function katListele3($katid, $onek, &$list)
	{
		$onek2=$onek;
		 $modelCustomergroups=Productgroups::model()->findAll(
            array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1 AND pgID=:pgID",
             'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID"),':pgID'=>$katid),
             'order'=>'name asc',
             ));
		foreach($modelCustomergroups as $key=>$value){
			
			$list[$value->productgroupsID]=str_repeat('___', $onek).$value->name;
			
			$onek++;
			$list=$this->katListele3($value->productgroupsID,$onek,$list);
			$onek=$onek2;
		}
		
		return $list;
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

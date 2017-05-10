<?php

class SalescompletecustomerController extends Controller
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
				'actions'=>array('view','excel','pdf'),
				'users'=>array('*'),
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('customer'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('dealer'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('checkmoney'),
				'users'=>array('*'),
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('salesreturncheck'),
				'users'=>array('*'),
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('salesdelete'),
				'users'=>array('*'),
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('warehousecustomeradmin','warehouseadjustment'),
				'users'=>array('*'),
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('warehousedealeradmin'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('warehousedealeradmin'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('warehouseadjustment','warehouseadjustmentupdate','warehouseadjustmentok'),
				'users'=>array('*'),
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('getnumber','getsalesdetailsalesprice'),
				'users'=>array('*'),
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('warehouse','warehousesales','cargoadd','cargodelete'),
				'users'=>array('*'),
			),
			
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionPdf($id,$type=1){
		$criteria=new CDbCriteria;
		$criteria->select='*,t.dateAdd as dateAdd,c.name as name';
		$criteria->condition='t.salescompleteID=:salescompleteID';
		$criteria->params=array(":salescompleteID"=>$id-SalescompletecustomerController::getParams("defultfiloplus"));
		$criteria->join = 'left join customers c on (c.customerID=t.customerdealerID)';
		$model=Salescompletecustomer::model()->find($criteria);
		
		
		
		$criteria=new CDbCriteria;
		$criteria->select='*, p.name as name';
		$criteria->condition='t.salescompleteID=:salescompleteID AND t.deleted=1';
		$criteria->params=array(":salescompleteID"=>$id-SalescompletecustomerController::getParams("defultfiloplus"));
		$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
		
		$modelSalesdetail=Salesdetail::model()->findAll($criteria);
		
		$this->accsesControl($model);
		
		
		$mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		
		
	    $mPDF1->WriteHTML($this->renderPartial('pdf', array('model'=>$model,'modelSalesdetail'=>$modelSalesdetail), true));
 
     	
        # Outputs ready PDF
		if($type==2)
       		$mPDF1->Output($id."_".$model->name.'.pdf',EYiiPdf::OUTPUT_TO_BROWSER);
		else
 			$mPDF1->Output($id."_".$model->name.'.pdf', EYiiPdf::OUTPUT_TO_DOWNLOAD);
	}
	
	public function actionExcel($id){
		$criteria=new CDbCriteria;
		$criteria->select='*,t.dateAdd as dateAdd,c.name as name';
		$criteria->condition='t.salescompleteID=:salescompleteID';
		$criteria->params=array(":salescompleteID"=>$id-SalescompletecustomerController::getParams("defultfiloplus"));
		$criteria->join = 'left join customers c on (c.customerID=t.customerdealerID)';
		$model=Salescompletecustomer::model()->find($criteria);
		
		
		
		$criteria=new CDbCriteria;
		$criteria->select='*, p.name as name';
		$criteria->condition='t.salescompleteID=:salescompleteID AND t.deleted=1';
		$criteria->params=array(":salescompleteID"=>$id-SalescompletecustomerController::getParams("defultfiloplus"));
		$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
		
		$modelSalesdetail=Salesdetail::model()->findAll($criteria);
		
		$this->accsesControl($model);
		
		$controller=new Sitecontroller;
		Yii::import('application.data.excel.PHPExcel',true);
		$phpExcel = new PHPExcel();
		$styleArray = array(
				'font' => array(
				'bold' => true,
				
				)
		);
		
		$styleArray2 = array(
				'font' => array(
				'bold' => true,
				),
				'fill' => array(
            		'type' => PHPExcel_Style_Fill::FILL_SOLID,
           			'color' => array('rgb' => '999999')
        		)
		);
		
		$styleArray3 = array(
				
				'fill' => array(
            		'type' => PHPExcel_Style_Fill::FILL_SOLID,
           			'color' => array('rgb' => 'EFEFEF')
        		)
		
		);
		

		$title=$model;
		$foo = $phpExcel->getActiveSheet();
		$foo->setTitle(mb_substr($id."_".$model->name,0,31,'UTF-8'));
		$foo->getColumnDimension('A')->setWidth(20);
		$foo->getColumnDimension('B')->setWidth(40);
		$foo->getColumnDimension('C')->setWidth(20);
		$foo->getColumnDimension('D')->setWidth(20);
		$foo->getColumnDimension('E')->setWidth(20);
		$foo->getColumnDimension('F')->setWidth(20);
		$foo->setCellValue("A2", Yii::t('trans','Unvanı'))
		->setCellValue("A3", Yii::t('trans','Telefon'))
		->setCellValue("A4", Yii::t('trans','Cep Telefon'))
		->setCellValue("A5", Yii::t('trans','Fax'))
		->setCellValue("A6", Yii::t('trans','E-Posta'))
		->setCellValue("A8", Yii::t('trans','Vergi Numarası'))
		->setCellValue("A9", Yii::t('trans','Vergi Dairesi'))
		->setCellValue("A10", Yii::t('trans','Ülke'))
		->setCellValue("A11", Yii::t('trans','Şehir'))
		->setCellValue("A12", Yii::t('trans','Adres'))
		->setCellValue("A14", Yii::t('trans','Satış Tarihi'))
		->getStyle("A2:A14")->applyFromArray($styleArray);
		
		$foo->setCellValue("B2", $model->name)
			->setCellValueExplicit("B3", $model->phone, PHPExcel_Cell_DataType::TYPE_STRING)
			->setCellValueExplicit("B4", $model->cphone, PHPExcel_Cell_DataType::TYPE_STRING)
			->setCellValueExplicit("B5", $model->fax, PHPExcel_Cell_DataType::TYPE_STRING)
			->setCellValue("B6", $model->email)
			->setCellValue("B8", SalescompletecustomerController::getParams_("taxnoType",$model->taxnotype)." ".$model->taxno)
			->setCellValue("B9", $model->taxoffice)
			->setCellValue("B10", @$controller->getCountry($model->country))
			->setCellValue("B11", @$controller->getCity($model->city))
			->setCellValue("B12", $model->adress)
			->setCellValue("B14", $this->getDateTimeFormat($model->dateAdd));
			
	
		$foo->setCellValue("A16", Yii::t('trans','Ürün ID'))
		->setCellValue("B16", Yii::t('trans','Ürün İsmi'))
		->setCellValue("C16", Yii::t('trans','Ürün Cinsi'))
		->setCellValue("D16", Yii::t('trans','Adet'))
		->setCellValue("E16", Yii::t('trans','Birim Fiyatı'))
		->setCellValue("F16", Yii::t('trans','Toplam Fiyat'))
		->getStyle("A16:F16")->applyFromArray($styleArray2);
		
		foreach($modelSalesdetail as $key=>$value){
			
			$foo->setCellValueExplicit("A".(17+$key), $value->productsID+SalescompletecustomerController::getParams("defultproductplus"),PHPExcel_Cell_DataType::TYPE_STRING)
			->setCellValue("B".(17+$key), $value->name)
			->setCellValue("C".(17+$key), $this->getBottom($value->productbottomsID))
			->setCellValueExplicit("D".(17+$key), $value->number,PHPExcel_Cell_DataType::TYPE_STRING)
			->setCellValue("E".(17+$key), number_format($value->salesPrice,2).' '.SalescompletecustomerController::getParams_("currency",$value->unitCur))
			->setCellValue("F".(17+$key), number_format($value->salesPrice*$value->number,2).' '.SalescompletecustomerController::getParams_("currency",$value->unitCur));
			if($key%2==0)
				$foo->getStyle("A".(17+$key).":F".(17+$key))->applyFromArray($styleArray3);
			
		}
		
		
		$phpExcel->setActiveSheetIndex(0);
		 
		
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"".$model->dateAdd."_".$id."_".$model->name."\"");
		header("Cache-Control: max-age=0");
		 
		$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
		$objWriter->save("php://output");
		exit;
		
	}
	public function actionCargodelete(){
		$modelSalescargo=Salescargo::model()->findByPk($_POST["id"]);
		$modelSalescargo->deleted=0;
		if($modelSalescargo->update())
			$data["sonuc"]=1;
		else
			$data["sonuc"]=0;
		
		echo json_encode($data);
	}
	
	public function actionCargoadd(){
		$modelsalescargo= new Salescargo;
		$modelsalescargo->type=$_POST["type"];
		if(@$_POST["cargoname"]!="")
			$modelsalescargo->name=$_POST["cargoname"];
		
		if(@$_POST["cargopaymenttype"]!="")
		$modelsalescargo->payment=$_POST["cargopaymenttype"];
		
		if(@$_POST["cargofallownumber"]!="")
		$modelsalescargo->follownumber=$_POST["cargofallownumber"];
		
		$modelsalescargo->deleted=1;
		$modelsalescargo->dateAdd=date("Y-m-d H:i:s");
		
		if(@$_POST["cargocharge1"]!=""){
			
			if(@$_POST["cargocharge2"]!="")
				$modelsalescargo->charge=$_POST["cargocharge1"].".".$_POST["cargocharge2"];
			else
				$modelsalescargo->charge=$_POST["cargocharge1"];
		}
		
		if(@$_POST["cargochargecur"]!="")
		$modelsalescargo->chargeCur=$_POST["cargochargecur"];
		
		$modelsalescargo->salescompleteID=$_POST["salescompleteID"];
		$modelsalescargo->companyID=Yii::app()->user->getState("companyID");
		$modelsalescargo->worldID=Yii::app()->user->getState("worldID");
		
		if($modelsalescargo->save()){
			$data["sonuc"]=1;
			$data["id"]=$modelsalescargo->salescargoID;
			if(@$_POST["cargocharge1"]!=""){
				
				if(@$_POST["cargocharge2"]!="")
					$data["charge"]=$_POST["cargocharge1"].".".$_POST["cargocharge2"]." ".SalescompletecustomerController::getParams_("currency",$modelsalescargo->chargeCur);
				else
					$data["charge"]=$_POST["cargocharge1"]." ".SalescompletecustomerController::getParams_("currency",$modelsalescargo->chargeCur);
			}else
				$data["charge"]="";
		}else
			$data["sonuc"]=0;
		
		echo json_encode($data);
	}
	public function actionWarehousesales($id){
		
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		
		if(@$_GET["warehouse"]){
			$modelWarehouse=Warehouse::model()->findByPk($_GET["warehouse"]);
			
			if(count($modelWarehouse)>0){
				$criteria=new CDbCriteria;
				$criteria->select='*, p.name as name,pg.name as pgname,wa.number as numbers';
				$criteria->condition='t.salescompleteID=:salescompleteID AND t.deleted=1';
				$criteria->params=array(":salescompleteID"=>$model->salescompleteID);
				$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID inner join warehouseadjustment wa on t.salesdetailID=wa.salesdetailID AND wa.warehouseID='.$_GET["warehouse"];
				$modelSalesdetail=Salesdetail::model()->findAll($criteria);
				if(count($modelSalesdetail)<1)
					$this->redirect(array("site/panel"));
				
				$salesEs=$model->salesEs;
				if(isset($_POST['Salescompletecustomer']))
				{
					$model->attributes=$_POST['Salescompletecustomer'];	
					if($model->salesEs==4){
						$modelCargocase=Cargocase::model()->find("salescompleteID=:salescompleteID AND warehouseID=:warehouseID",array(":salescompleteID"=>$model->salescompleteID,':warehouseID'=>$modelWarehouse->warehouseID));
						$modelCargocase->type=2;
						$modelCargocase->save();
						
						if($salesEs!=$model->salesEs){
							foreach($modelSalesdetail as $key=>$value){
								$modelWarehousebottomstok=Warehousebottomstok::model()->find("productbottomsID=:productbottomsID AND productsID=:productsID",array("productbottomsID"=>$value->productbottomsID,"productsID"=>$value->productsID));
								$modelWarehousebottomstok->stok=$modelWarehousebottomstok->stok-$value->number;
								$modelWarehousebottomstok->update();
							}
						}
						
						$modelCargocase=Cargocase::model()->findAll("salescompleteID=:salescompleteID",array(":salescompleteID"=>$model->salescompleteID));
						$i=0;
						$y=0;
						foreach($modelCargocase as $key=>$value){
							$i++;
							if($value->type==2)
								$y++;
						}
						
						
						if($i==$y){
							$model->salesEs=4;
							$model->salesEsDate=date("Y-m-d H:i:s");
							$model->update();
						}
					
					}elseif($model->salesEs==3){
						$model->salesEsDate=date("Y-m-d H:i:s");
						
						if($model->update()){
						
							if($salesEs==4){
								foreach($modelSalesdetail as $key=>$value){
									$modelWarehousebottomstok=Warehousebottomstok::model()->find("productbottomsID=:productbottomsID AND productsID=:productsID",array("productbottomsID"=>$value->productbottomsID,"productsID"=>$value->productsID));
									$modelWarehousebottomstok->stok=$modelWarehousebottomstok->stok+$value->number;
									$modelWarehousebottomstok->update();
								}
							}
							
							$modelCargocase=Cargocase::model()->find("salescompleteID=:salescompleteID AND warehouseID=:warehouseID",array(":salescompleteID"=>$model->salescompleteID,':warehouseID'=>$modelWarehouse->warehouseID));
							$modelCargocase->type=1;
							$modelCargocase->save();
							
							
						}
					}
					else{
						$model->salesEsDate=date("Y-m-d H:i:s");
						if($model->update()){
						
							if($salesEs==4){
								foreach($modelSalesdetail as $key=>$value){
									$modelWarehousebottomstok=Warehousebottomstok::model()->find("productbottomsID=:productbottomsID AND productsID=:productsID",array("productbottomsID"=>$value->productbottomsID,"productsID"=>$value->productsID));
									$modelWarehousebottomstok->stok=$modelWarehousebottomstok->stok+$value->number;
									$modelWarehousebottomstok->update();
								}
							}
							
							$modelCargocase=Cargocase::model()->find("salescompleteID=:salescompleteID AND warehouseID=:warehouseID",array(":salescompleteID"=>$model->salescompleteID,':warehouseID'=>$modelWarehouse->warehouseID));
							$modelCargocase->type=0;
							$modelCargocase->save();
						}
					}
					
				}
				
				
				$modelSalescargo=Salescargo::model()->findAll("salescompleteID=:salescompleteID AND companyID=:companyID AND worldID=:worldID and deleted=1",array(":salescompleteID"=>$model->salescompleteID,':companyID'=>$model->companyID=Yii::app()->user->getState("companyID"),':worldID'=>$model->worldID=Yii::app()->user->getState("worldID")));
				
				
				$this->render('warehousesales',array(
					'modelSalesdetail'=>$modelSalesdetail,
					'model'=>$model,
					'modelWarehouse'=>$modelWarehouse,
					'warehouseID'=>$_GET["warehouse"],
					'modelSalescargo'=>$modelSalescargo,
				));
			}
				
		}
			
		
	}
	
	public function actionWarehouse($id){
		$modelWarehouse=Warehouse::model()->findByPk($id);
		$this->accsesControl($modelWarehouse);
		
		$model=new Salescompletecustomer('search');
		$model->unsetAttributes();  // clear any default values
		$model->warehouseID=$id;
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->worldID=Yii::app()->user->getState("worldID");
		if(isset($_GET['Salescompletecustomer'])){
			$model->attributes=$_GET['Salescompletecustomer'];
			if($model->dateAdd !=""){
				$date=new DateTime($model->dateAdd);
				$model->dateAdd = $date->format('Y-m-d H:i:s');
			}
			if($model->salesEsDate !=""){
				$date=new DateTime($model->salesEsDate);
				$model->salesEsDate = $date->format('Y-m-d H:i:s');
			}
		}
		
		$this->render('warehouseadmin',array(
			'model'=>$model,
			'modelWarehouse'=>$modelWarehouse,
		));
	
	}
	public function actionWarehouseadjustmentok(){
		$modelSalesdetail=Salesdetail::model()->count("salescompleteID=:salescompleteID AND deleted=1",array(":salescompleteID"=>$_POST["id"]));
		
		$criteria=new CDbCriteria;
		$criteria->select="*";
		$criteria->condition='salescompleteID=:salescompleteID';
		$criteria->params=array(":salescompleteID"=>$_POST["id"]);
		$criteria->group="salesdetailID";
		$modelWarehouseadjustment=Warehouseadjustment::model()->count($criteria);
		
		if($modelWarehouseadjustment==$modelSalesdetail){
			$modelSalescompletecustomer=Salescompletecustomer::model()->findByPk($_POST["id"]);
			$modelSalescompletecustomer->salesEs=2;
			$modelSalescompletecustomer->update();
			$data["sonuc"]=1;
		}else{
			$data["sonuc"]=0;
		}
		
		echo json_encode($data);
	}
	
	public function actionWarehouseadjustmentupdate(){
	
		$modelWarehousebottomstok=Warehousebottomstok::model()->findAll("productbottomsID=:productbottomsID",array(":productbottomsID"=>$_POST["productbottomsID"]));
		$kontrol=true;
		foreach($modelWarehousebottomstok as $key=>$value){
			if(@$_POST["b".$value->warehouseID]>$value->stok){
			 $kontrol=false;
			}
		}
		if($kontrol==false){
			$data["sonuc"]=0;
		}else{
			
			$arrayCargo=array();
			foreach($modelWarehousebottomstok as $key=>$value){
				if(@$_POST["b".$value->warehouseID]){
					$modelWarehouseadjustment=Warehouseadjustment::model()->find("salesdetailID=:salesdetailID AND warehouseID=:warehouseID",array(":warehouseID"=>$value->warehouseID,":salesdetailID"=>$_POST["salesdetailID"]));
					if(count($modelWarehouseadjustment)>0){
						$modelWarehouseadjustment->number=$_POST["b".$value->warehouseID];
						$modelWarehouseadjustment->update();
					}else{
						$modelWarehouseadjustment=new Warehouseadjustment;
						$modelWarehouseadjustment->salesdetailID=$_POST["salesdetailID"];
						$modelWarehouseadjustment->warehouseID=$value->warehouseID;
						$modelWarehouseadjustment->number=$_POST["b".$value->warehouseID];
						$modelWarehouseadjustment->companyID=Yii::app()->user->getState("companyID");
						$modelWarehouseadjustment->worldID=Yii::app()->user->getState("worldID");
						$modelSalesdetail=Salesdetail::model()->findByPk($_POST["salesdetailID"]);
						$modelWarehouseadjustment->salescompleteID=$modelSalesdetail->salescompleteID;
						$modelWarehouseadjustment->save();
						
						if(@$arrayCargo[$value->warehouseID][$modelSalesdetail->salescompleteID]!=true){
							$modelCargocase=new Cargocase;
							$modelCargocase->companyID=Yii::app()->user->getState("companyID");
							$modelCargocase->worldID=Yii::app()->user->getState("worldID");
							$modelCargocase->type=0;
							$modelCargocase->warehouseID=$value->warehouseID;
							$modelCargocase->salescompleteID=$modelSalesdetail->salescompleteID;
							$modelCargocase->save();
							$arrayCargo[$value->warehouseID][$modelSalesdetail->salescompleteID]=true;
						}
					}
				}
			}
			
					
			$data["sonuc"]=1;
		}
		echo json_encode($data);
	}
	
	public function actionWarehouseadjustment($id){
		
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		
		$criteria=new CDbCriteria;
		$criteria->select='*, p.name as name';
		$criteria->condition='t.salescompleteID=:salescompleteID AND t.deleted=1';
		$criteria->params=array(":salescompleteID"=>$model->salescompleteID);
		$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
		
		$modelSalesdetail=Salesdetail::model()->findAll($criteria);
	
		
		$modelWarehouse=Warehouse::model()->findAll(
		array('condition'=>"companyID =:companyID AND worldID=:worldID AND deleted=1",
		 'params'=>array(":worldID"=>Yii::app()->user->getState("worldID"),":companyID"=>Yii::app()->user->getState("companyID")),
		 'order'=>'name asc',
		 ));
		
		$this->render('warehouseadjustment',array(
			
			'modelSalesdetail'=>$modelSalesdetail,
			'model'=>$model,
			'modelWarehouse'=>$modelWarehouse,
			'id'=>$id,
		));
	}
	
	public function actionSalesdelete(){
		$model=Salesdetail::model()->findByPk($_POST["id"]);
		$model->deleted=0;
		
		if($model->update()){
			$data["sonuc"]=1;
			$modelWarehouseadjustment=Warehouseadjustment::model()->find("salesdetailID=:salesdetailID",array(":salesdetailID"=>$_POST["id"]));
			
			$modelSalesdetailX=Salesdetail::model()->findByPk($_POST["id"]);
			
			$criteria=new CDbCriteria;
			$criteria->select='*, p.name as name';
			$criteria->condition='t.salescompleteID=:salescompleteID AND salesCur=:salesCur AND t.deleted=1';
			$criteria->params=array(":salescompleteID"=>$model->salescompleteID,":salesCur"=>$modelSalesdetailX->salesCur);
			$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
			
			$modelSalesdetail=Salesdetail::model()->findAll($criteria);
			$toplamAccount=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
		 	);
			
			foreach($modelSalesdetail as $key=>$value){
				$toplamAccount[$value->salesCur]+=$value->salesPrice*$value->number;
			}
			
			$toplam=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
		 	);
			
			$untoplam=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
		 	);
			
			$modelSalesmoneyreceived=Salesmoneyreceived::model()->findAll("salescompleteID=:salescompleteID and deleted=1",array(":salescompleteID"=>$model->salescompleteID));
			
			foreach($modelSalesmoneyreceived as $key=>$value){
				if($value->unpayment==0){
					$toplam[$value->receivedCur]+=$value->receivedPrice;
				}
			}
			
			foreach($modelSalesmoneyreceived as $key=>$value){
				 if($value->unpayment==1){
					$untoplam[$value->receivedCur]+=$value->receivedPrice;
				 }
			}
			
			
			
			
			$returntoplam=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
			);
			
			$criteria=new CDbCriteria;
			$criteria->select='*, p.name as name';
			$criteria->condition='t.salescompleteID=:salescompleteID AND t.deleted=1';
			$criteria->params=array(":salescompleteID"=>$model->salescompleteID);
			$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
			
			$modelSalesreturnList=Salesreturn::model()->findAll($criteria);
			
			foreach($modelSalesreturnList as $key=>$value){
					$returntoplam[$value->salesreturnCur]+=$value->salesreturnPrice*$value->number;
			}
			
			$data["toplam"]=$modelSalesdetailX->salesCur."_".number_format($toplamAccount[$modelSalesdetailX->salesCur]-$returntoplam[$modelSalesdetailX->salesCur],2)." ".SalescompletecustomerController::getParams_("currency",$modelSalesdetailX->salesCur);
			
			$data["total"]=$modelSalesdetailX->salesCur."_".number_format($toplamAccount[$modelSalesdetailX->salesCur]-$returntoplam[$modelSalesdetailX->salesCur]-$toplam[$modelSalesdetailX->salesCur]+$untoplam[$modelSalesdetailX->salesCur],2)." ".SalescompletecustomerController::getParams_("currency",$modelSalesdetailX->salesCur);
				
		}
		
			echo json_encode($data);
	}

	
	public function actionSalesreturncheck(){
		$model=Salesreturn::model()->findByPk($_POST["id"]);
		$model->deleted=0;
		$model->deletedEmployeesID=Yii::app()->user->getState("ID");
		$model->deletedDateAdd=date("Y-m-d H:i:s");
		if($model->update()){
			$data["sonuc"]=1;
			
			$modelSalesdetailX=Salesdetail::model()->find("salescompleteID=:salescompleteID AND productsID=:productsID",array(":salescompleteID"=>$model->salescompleteID,":productsID"=>$_POST["productsID"]));
			
			$criteria=new CDbCriteria;
			$criteria->select='*, p.name as name';
			$criteria->condition='t.salescompleteID=:salescompleteID AND salesCur=:salesCur AND t.deleted=1';
			$criteria->params=array(":salescompleteID"=>$model->salescompleteID,":salesCur"=>$modelSalesdetailX->salesCur);
			$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
			
			$modelSalesdetail=Salesdetail::model()->findAll($criteria);
			$toplamAccount=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
		 	);
			
			foreach($modelSalesdetail as $key=>$value){
				$toplamAccount[$value->salesCur]+=$value->salesPrice*$value->number;
			}
			
			$toplam=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
		 	);
			
			$untoplam=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
		 	);
			
			$modelSalesmoneyreceived=Salesmoneyreceived::model()->findAll("salescompleteID=:salescompleteID and deleted=1",array(":salescompleteID"=>$model->salescompleteID));
			
			foreach($modelSalesmoneyreceived as $key=>$value){
				if($value->unpayment==0){
					$toplam[$value->receivedCur]+=$value->receivedPrice;
				}
			}
			
			foreach($modelSalesmoneyreceived as $key=>$value){
				 if($value->unpayment==1){
					$untoplam[$value->receivedCur]+=$value->receivedPrice;
				 }
			}
			
			
			
			
			$returntoplam=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
			);
			
			$criteria=new CDbCriteria;
			$criteria->select='*, p.name as name';
			$criteria->condition='t.salescompleteID=:salescompleteID AND t.deleted=1';
			$criteria->params=array(":salescompleteID"=>$model->salescompleteID);
			$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
			
			$modelSalesreturnList=Salesreturn::model()->findAll($criteria);
			
			foreach($modelSalesreturnList as $key=>$value){
					$returntoplam[$value->salesreturnCur]+=$value->salesreturnPrice*$value->number;
			}
			
			$data["toplam"]=$modelSalesdetailX->salesCur."_".number_format($toplamAccount[$modelSalesdetailX->salesCur]-$returntoplam[$modelSalesdetailX->salesCur],2)." ".SalescompletecustomerController::getParams_("currency",$modelSalesdetailX->salesCur);
			
			$data["total"]=$modelSalesdetailX->salesCur."_".number_format($toplamAccount[$modelSalesdetailX->salesCur]-$returntoplam[$modelSalesdetailX->salesCur]-$toplam[$modelSalesdetailX->salesCur]+$untoplam[$modelSalesdetailX->salesCur],2)." ".SalescompletecustomerController::getParams_("currency",$modelSalesdetailX->salesCur);
				
		}
		
			echo json_encode($data);
	}

	public function actionCheckmoney(){
		$model=Salesmoneyreceived::model()->findByPk($_POST["id"]);
		$model->deleted=0;
		$model->deletedEmployeesID=Yii::app()->user->getState("ID");
		$model->deletedDateAdd=date("Y-m-d H:i:s");
		
		if($model->update()){
			$data["sonuc"]=1;
			
			$criteria=new CDbCriteria;
			$criteria->select='*, p.name as name';
			$criteria->condition='t.salescompleteID=:salescompleteID AND salesCur=:salesCur AND t.deleted=1';
			$criteria->params=array(":salescompleteID"=>$model->salescompleteID,":salesCur"=>$model->receivedCur);
			$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
			
			$modelSalesdetail=Salesdetail::model()->findAll($criteria);
			$toplamAccount=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
		 	);
			
			foreach($modelSalesdetail as $key=>$value){
				$toplamAccount[$value->salesCur]+=$value->salesPrice*$value->number;
			}
			
			$toplam=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
		 	);
			
			$untoplam=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
		 	);
			
			$modelSalesmoneyreceived=Salesmoneyreceived::model()->findAll("salescompleteID=:salescompleteID and deleted=1",array(":salescompleteID"=>$model->salescompleteID));
			
			foreach($modelSalesmoneyreceived as $key=>$value){
				if($value->unpayment==0){
					$toplam[$value->receivedCur]+=$value->receivedPrice;
				}
			}
			
			foreach($modelSalesmoneyreceived as $key=>$value){
				 if($value->unpayment==1){
					$untoplam[$value->receivedCur]+=$value->receivedPrice;
				 }
			}
			
			
			
			
			$returntoplam=array(
				'0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0,
				'5'=>0,
				'6'=>0,
				'7'=>0,
				'8'=>0,
				'9'=>0,
				'10'=>0,
				'11'=>0,
			);
			
			$criteria=new CDbCriteria;
			$criteria->select='*, p.name as name';
			$criteria->condition='t.salescompleteID=:salescompleteID AND t.deleted=1';
			$criteria->params=array(":salescompleteID"=>$model->salescompleteID);
			$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
			
			$modelSalesreturnList=Salesreturn::model()->findAll($criteria);
			
			foreach($modelSalesreturnList as $key=>$value){
					$returntoplam[$value->salesreturnCur]+=$value->salesreturnPrice*$value->number;
			}
			
			if($model->unpayment==0){
				$data["hesap"]="X_b";
				$data["toplam"]=$model->receivedCur."_".number_format($toplam[$model->receivedCur],2)." ".SalescompletecustomerController::getParams_("currency",$model->receivedCur);
				
				
			}else{
				$data["hesap"]="X_c";
				$data["toplam"]=$model->receivedCur."_".number_format($untoplam[$model->receivedCur],2)." ".SalescompletecustomerController::getParams_("currency",$model->receivedCur);
				
				
			}
			$data["total"]=$model->receivedCur."_".number_format($toplamAccount[$model->receivedCur]-$returntoplam[$model->receivedCur]-$toplam[$model->receivedCur]+$untoplam[$model->receivedCur],2)." ".SalescompletecustomerController::getParams_("currency",$model->receivedCur);
				
			
			
		}else
			$data["sonuc"]=0;
			
		echo json_encode($data);
	}
	
	public function actionView($id)
	{
		
		$model=$this->loadModel($id);
		$this->accsesControl($model);
		
		$criteria=new CDbCriteria;
		$criteria->select='*, p.name as name';
		$criteria->condition='t.salescompleteID=:salescompleteID AND t.deleted=1';
		$criteria->params=array(":salescompleteID"=>$model->salescompleteID);
		$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
		
		$modelSalesdetail=Salesdetail::model()->findAll($criteria);
		
		if(isset($_POST['Salescompletecustomer']))
		{
			$model->attributes=$_POST['Salescompletecustomer'];	
			$model->salesEsDate=date("Y-m-d H:i:s");
			$model->update();
		}
		
		$modelSalesmoneyreceivedNew = new Salesmoneyreceived;
		
		if(isset($_POST['Salesmoneyreceived']))
		{
			
			$modelSalesmoneyreceivedNew->attributes=$_POST['Salesmoneyreceived'];	
			$modelSalesmoneyreceivedNew->deleted=1;
		
			if($modelSalesmoneyreceivedNew->dateAdd!=""){
				$date=new DateTime($modelSalesmoneyreceivedNew->dateAdd);
				$modelSalesmoneyreceivedNew->dateAdd=$date->format("Y-m-d H:i:s");
			}
			$modelSalesmoneyreceivedNew->salescompleteID=$model->salescompleteID;
			if(!empty($modelSalesmoneyreceivedNew->received1) && !empty($modelSalesmoneyreceivedNew->received2))
			
				if($modelSalesmoneyreceivedNew->receivedCur==$modelSalesmoneyreceivedNew->account)
					$modelSalesmoneyreceivedNew->receivedPrice=$modelSalesmoneyreceivedNew->received1.".".$modelSalesmoneyreceivedNew->received2;
				else{
					$modelSalesmoneyreceivedNew->receivedPrice=SalescompletecustomerController::curAccount2($modelSalesmoneyreceivedNew->receivedCur,$modelSalesmoneyreceivedNew->received1.".".$modelSalesmoneyreceivedNew->received2,$modelSalesmoneyreceivedNew->account);
					$modelSalesmoneyreceivedNew->receivedCur=$modelSalesmoneyreceivedNew->account;
				}
					
			
			if($modelSalesmoneyreceivedNew->save()){
				
				$this->redirect(array("salescompletecustomer/view","id"=>$model->salescompleteID));
			}
		}
		
			$modelSalesmoneyreceived=Salesmoneyreceived::model()->findAll("salescompleteID=:salescompleteID",array(":salescompleteID"=>$model->salescompleteID));
			
		$modelSalesreturn=new Salesreturn;
		if(isset($_POST['Salesreturn']))
		{
			$modelSalesreturn->attributes=$_POST['Salesreturn'];	
			$modelSalesreturn->companyID=Yii::app()->user->getState("companyID");
			$modelSalesreturn->worldID=Yii::app()->user->getState("worldID");
			$modelSalesreturn->employeesID=Yii::app()->user->getState("ID");
			$modelSalesreturn->deleted=1;
			if($modelSalesreturn->dateAdd!=""){
				$date=new DateTime($modelSalesreturn->dateAdd);
				$modelSalesreturn->dateAdd=$date->format("Y-m-d H:i:s");
			}
			
			$modelGetSalesdetail=Salesdetail::model()->findByPk($modelSalesreturn->salesdetailID);
	
			if(count($modelGetSalesdetail)>0){
				$modelSalesreturn->productbottomsID=$modelGetSalesdetail->productbottomsID;
				$modelSalesreturn->productsID=$modelGetSalesdetail->productsID;
				$modelSalesreturn->salescompleteID=$modelGetSalesdetail->salescompleteID;
				
				$modelSalesreturn->salesreturnPrice=$modelGetSalesdetail->salesPrice;
				$modelSalesreturn->salesreturnCur=$modelGetSalesdetail->salesCur;
			}else{
				$modelSalesreturn->productbottomsID=0;
				$modelSalesreturn->productsID=0;
				$modelSalesreturn->salescompleteID=0;
				
				$modelSalesreturn->salesreturnPrice=0;
				$modelSalesreturn->salesreturnCur=0;
			}
			
			if($modelSalesreturn->save()){
				
				$this->redirect(array("salescompletecustomer/view","id"=>$model->salescompleteID));
		    }	
		}
		
		$criteria=new CDbCriteria;
		$criteria->select='*, p.name as name, t.deleted as deleted';
		$criteria->condition='t.salescompleteID=:salescompleteID';
		$criteria->params=array(":salescompleteID"=>$model->salescompleteID);
		$criteria->join = 'left join products p on t.productsID=p.productsID left join productgroups pg on p.productgroupsID=pg.productgroupsID';
		
		$modelSalesreturnList=Salesreturn::model()->findAll($criteria);
			
		$this->render('view',array(
			'model'=>$model,
			'modelSalesmoneyreceived'=>$modelSalesmoneyreceived,
			'modelSalesdetail'=>$modelSalesdetail,
			'modelSalesmoneyreceivedNew'=>$modelSalesmoneyreceivedNew,
			'modelSalesreturn'=>$modelSalesreturn,
			'modelSalesreturnList'=>$modelSalesreturnList,
		));
	}



	/**
	 * Manages all models.
	 */
	 
	 
	public function actionWarehousecustomeradmin()
	{
		$model=new Salescompletecustomer('search');
		$model->unsetAttributes();  // clear any default values
		
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->cdtype=1;
		$model->Warehouse=true;
		if(isset($_GET['Salescompletecustomer'])){
			$model->attributes=$_GET['Salescompletecustomer'];
			if($model->dateAdd !=""){
				$date=new DateTime($model->dateAdd);
				$model->dateAdd = $date->format('Y-m-d H:i:s');
			}
			if($model->salesEsDate !=""){
				$date=new DateTime($model->salesEsDate);
				$model->salesEsDate = $date->format('Y-m-d H:i:s');
			}
		}
		$this->render('warehousecustomeradmin',array(
			'model'=>$model,
		));
	}
	
	
	
	public function actionWarehousedealeradmin()
	{
		$model=new Salescompletecustomer('search');
		$model->unsetAttributes();  // clear any default values
		
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->cdtype=2;
		$model->Warehouse=true;
		if(isset($_GET['Salescompletecustomer'])){
			$model->attributes=$_GET['Salescompletecustomer'];
			if($model->dateAdd !=""){
				$date=new DateTime($model->dateAdd);
				$model->dateAdd = $date->format('Y-m-d H:i:s');
			}
			if($model->salesEsDate !=""){
				$date=new DateTime($model->salesEsDate);
				$model->salesEsDate = $date->format('Y-m-d H:i:s');
			}
		}
		$this->render('warehousedealeradmin',array(
			'model'=>$model,
		));
	}
	
	public function actionCustomer()
	{
		$model=new Salescompletecustomer('search');
		$model->unsetAttributes();  // clear any default values
		
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->cdtype=1;
		if(isset($_GET['Salescompletecustomer'])){
			$model->attributes=$_GET['Salescompletecustomer'];
			if($model->dateAdd !=""){
				$date=new DateTime($model->dateAdd);
				$model->dateAdd = $date->format('Y-m-d H:i:s');
			}
			if($model->salesEsDate !=""){
				$date=new DateTime($model->salesEsDate);
				$model->salesEsDate = $date->format('Y-m-d H:i:s');
			}
		}
		$this->render('customeradmin',array(
			'model'=>$model,
		));
	}
	
	public function actionDealer()
	{
		$model=new Salescompletecustomer('search');
		$model->unsetAttributes();  // clear any default values
		
		$model->companyID=Yii::app()->user->getState("companyID");
		$model->worldID=Yii::app()->user->getState("worldID");
		$model->cdtype=2;
		if(isset($_GET['Salescompletecustomer'])){
			$model->attributes=$_GET['Salescompletecustomer'];
			if($model->dateAdd !=""){
				$date=new DateTime($model->dateAdd);
				$model->dateAdd = $date->format('Y-m-d H:i:s');
			}
			
			if($model->salesEsDate !=""){
				$date=new DateTime($model->salesEsDate);
				$model->salesEsDate = $date->format('Y-m-d H:i:s');
			}
		}

		$this->render('dealeradmin',array(
			'model'=>$model,
		));
	}

	
	public function loadModel($id)
	{
		$model=Salescompletecustomer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Salescompletecustomer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='salescompletecustomer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public static function getsalesEs($id,$ids){
		
		$STR="";
		
		if($id==0)
			$STR='<img src="'.Yii::app()->baseUrl.'/images/circle_red.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",0).'" />';
		else
			$STR='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",0).'" />';
		
		if($id==1)
			$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_orange.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",1).'" />';
		else
		 	$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",1).'" />';	
		
		
		if($id==2)
			$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_mor.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",2).'" />';
		else
		 	$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",2).'" />';
		$data=array();	
		if($id>=3){
			
			$modelCargocase=Cargocase::model()->findAll("salescompleteID=:salescompleteID",array(":salescompleteID"=>$ids));
		
			
			foreach($modelCargocase as $key=>$value){
				if($value->type==1){
					$data[SalescompletecustomerController::getSWarehouse($value->warehouseID)]=array("c"=>1);
				}elseif($value->type==2){
					$data[SalescompletecustomerController::getSWarehouse($value->warehouseID)]=array("c"=>2);
				}elseif($value->type==0){
					$data[SalescompletecustomerController::getSWarehouse($value->warehouseID)]=array("c"=>0);
				}
				
			}
			
		}
		
		
		if($id>=3){
			$str="";
			foreach($data as $key=>$value){
				if($value["c"]==1)
					$str.=Yii::t('trans','{a} deposunda ürünler hazırlanıyor.',array("{a}"=>$key))."<br>";
				elseif($value["c"]==0)
					$str.=Yii::t('trans','{a} deposu beklemede.',array("{a}"=>$key))."<br>";
			}
			if($str!="")
				$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_yellow.png" style="margin-left:15px;"  title="'.$str.'" />';
			else
				$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;" title="'.SalescompletecustomerController::getParams_("salesEs",4).'" />';
		}else
		 	$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",3).'" />';	
			
		if($id>=3){
			$str="";
			foreach($data as $key=>$value){
				if($value["c"]==2)
					$str.=Yii::t('trans','{a} deposunda ürünler kargoya verildi.',array("{a}"=>$key))."<br>";
			}
			if($str!="")
				$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_green.png" style="margin-left:15px;"  title="'.$str.'" />';
			else
				$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;" title="'.SalescompletecustomerController::getParams_("salesEs",4).'" />';
		}
		else
		 	$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;" title="'.SalescompletecustomerController::getParams_("salesEs",4).'" />';
			
	
		return $STR;
	}
	
	public static function getSWarehouse($id){
		$model=Warehouse::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
		else
			return "-";
	}
	
	public static function getsalesEsWarehous($id,$ids){
		
		$STR="";
		
		
		if($id==1)
			$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_orange.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",1).'" />';
		else
		 	$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",1).'" />';	
			
		if($id==2)
			$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_mor.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",2).'" />';
		else
		 	$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",2).'" />';
			
	
		return $STR;
	}
	
	public static function getsalesEsWarehous2($id,$ids,$warehouseID){
		
		$STR="";
		
		if($id==2)
			$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_mor.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",2).'" />';
		else
		 	$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",2).'" />';
			
		$modelCargocase=Cargocase::model()->find("salescompleteID=:salescompleteID AND warehouseID=:warehouseID",array(":salescompleteID"=>$ids,':warehouseID'=>$warehouseID));
	
		if($modelCargocase->type==1)
			$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_yellow.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",3).'" />';
		else
		 	$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",3).'" />';
		
		
		if($modelCargocase->type==2)
			$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_green.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",4).'" />';
		else
		 	$STR.='<img src="'.Yii::app()->baseUrl.'/images/circle_gri.png" style="margin-left:15px;"  title="'.SalescompletecustomerController::getParams_("salesEs",4).'" />';
			
		return $STR;
	}
	
	public static function getsalesStatus($id){
		
		if($id==0)
			$STR='<img src="'.Yii::app()->baseUrl.'/images/square_0.png" />';
		elseif($id==1)
		 	$STR='<img src="'.Yii::app()->baseUrl.'/images/square_1.png" />';	
		elseif($id==2)
		 	$STR='<img src="'.Yii::app()->baseUrl.'/images/square_2.png" />';	
		elseif($id==3)
		 	$STR='<img src="'.Yii::app()->baseUrl.'/images/square_3.png" />';
		elseif($id==4)
		 	$STR='<img src="'.Yii::app()->baseUrl.'/images/square_4.png" />';		
		
		return $STR;
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
	
	public static function getCustomerName($id){
		$model=Customers::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
		else
			return "-";
	}
	public static function getCustomerEmail($id){
		$model=Customers::model()->findByPk($id);
		if(count($model)>0)
			return $model->email;
		else
			return "-";
	}
	public static function getCustomerPhone($id){
		$model=Customers::model()->findByPk($id);
		if(count($model)>0)
			return $model->phone;
		else
			return "-";
	}
	public static function getCustomerCphone($id){
		$model=Customers::model()->findByPk($id);
		if(count($model)>0)
			return $model->cphone;
		else
			return "-";
	}
	public static function getCustomerAdress($id){
		$model=Customers::model()->findByPk($id);
		if(count($model)>0)
			return $model->adress;
		else
			return "-";
	}
	
	public static function getTaxOffice($cdtype,$id){
		if($cdtype==1){
			$model=Customers::model()->findByPk($id);
			if(count($model)>0)
				return $model->taxoffice;
			else
				return "-";
		}else{
			$model=Dealers::model()->findByPk($id);
			if(count($model)>0)
				return $model->taxoffice;
			else
				return "-";
		}
	}
	
	public static function getTaxno($cdtype,$id){
		if($cdtype==1){
			$model=Customers::model()->findByPk($id);
			if(count($model)>0)
				return SalescompletecustomerController::getParams_("taxnoType",$model->taxnotype)." : ".$model->taxno;
			else
				return "-";
		}else{
			$model=Dealers::model()->findByPk($id);
			if(count($model)>0)
				return SalescompletecustomerController::getParams_("taxnoType",$model->taxnotype)." : ".$model->taxno;
			else
				return "-";
		}
	}
	
	public  static function getCustomerCountry($id){
		$model=Customers::model()->findByPk($id);
		if(count($model)>0){
			$modelCountry=Country::model()->find("code=:code",array(":code"=>$model->country));
			if(count($modelCountry)>0)
				return $modelCountry->name;
			else
				return "-";
		}else
			return "-";
	}
	
	public static function getCustomerCity($id){
		$model=Customers::model()->findByPk($id);
		if(count($model)>0){
			$modelCity=City::model()->findByPk($model->city);
			if(count($modelCity)>0)
				return $modelCity->name;
			else
				return "-";
		}else
			return "-";
	}
	
	public static function getCustomerCounty($id){
		$model=Customers::model()->findByPk($id);
		if(count($model)>0)
			return $model->county;
		else
			return "-";
	}
	
	
	public static function getDealerName($id){
		$model=Dealers::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
		else
			return "-";
	}
	public static function getDealerEmail($id){
		$model=Dealers::model()->findByPk($id);
		if(count($model)>0)
			return $model->email;
		else
			return "-";
	}
	public static function getDealerPhone($id){
		$model=Dealers::model()->findByPk($id);
		if(count($model)>0)
			return $model->phone;
		else
			return "-";
	}
	public static function getDealerCphone($id){
		$model=Dealers::model()->findByPk($id);
		if(count($model)>0)
			return $model->cphone;
		else
			return "-";
	}
	public static function getDealerAdress($id){
		$model=Dealers::model()->findByPk($id);
		if(count($model)>0)
			return $model->adres;
		else
			return "-";
	}
	
	public static function getDealerCountry($id){
		$model=Dealers::model()->findByPk($id);
		if(count($model)>0){
			$modelCountry=Country::model()->find("code=:code",array(":code"=>$model->country));
			if(count($modelCountry)>0)
				return $modelCountry->Name;
			else
				return "-";
		}else
			return "-";
	}
	
	public static function getDealerCity($id){
		$model=Dealers::model()->findByPk($id);
		if(count($model)>0){
			$modelCity=City::model()->findByPk($model->city);
			if(count($modelCity)>0)
				return $modelCity->Name;
			else
				return "-";
		}else
			return "-";
	}
	
	public static function getDealerCounty($id){
		$model=Dealers::model()->findByPk($id);
		if(count($model)>0)
			return $model->county;
		else
			return "-";
	}
	
	public static function getEmployeesName($id){
		$model=Employees::model()->findByPk($id);
		if(count($model)>0)
			return $model->name;
		else
			return "-";
	}
	
	public static function curAccount($id, $cur){
		$controller= new Sitecontroller;
		return $controller->curAccount($id, $cur);
	}
	
	public static function curAccount2($id, $cur,$ecur){
		$controller= new Sitecontroller;
		return $controller->curAccount2($id, $cur,$ecur);
	}
	
	public static function getBottom($id){
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
				$STR.=SalescompletecustomerController::getParams_("color",$modelProductbot->bottomvalue1);
					
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
	
	
	public static function actionGetnumber(){
		
		$modelSalesdetail=Salesdetail::model()->findByPk($_POST["id"]);
		$strNumber="";
		$number=$modelSalesdetail->number;
		
		$modelSalesreturn=Salesreturn::model()->findAll("salesdetailID=:salesdetailID",array(":salesdetailID"=>$_POST["id"]));
		
		foreach($modelSalesreturn as $key =>$value){
			$number-=$value->number;
		}
		for($i=1;$i<=$number;$i++)
			$strNumber.=$i.",";
		$data["list"]= substr($strNumber,0,strlen($strNumber)-1);
		echo json_encode($data);
	}
	
	public static function actionGetsalesdetailsalesprice(){
		$modelSalesdetail=Salesdetail::model()->findByPk($_POST["id"]);
		
		$data["price"]=number_format($modelSalesdetail->salesPrice,2)." ".SalescompletecustomerController::getParams_("currency",$modelSalesdetail->salesCur);
		
		echo json_encode($data);
	}
	
	public static function warehouseControl($warehouseID,$productbottomsID,$salesdetailID){
		$modelWarehousebottomstok=Warehousebottomstok::model()->find("warehouseID=:warehouseID AND  productbottomsID=:productbottomsID AND stok>0",array(":productbottomsID"=>$productbottomsID,":warehouseID"=>$warehouseID));
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='t.warehouseID=:warehouseID  AND s.productbottomsID=:productbottomsID AND sc.salesEs>0 AND sc.salesEs<4';
		$criteria->params=array(":warehouseID"=>$warehouseID,":productbottomsID"=>$productbottomsID);
		$criteria->join = 'left join salesdetail s on (s.salesdetailID=t.salesdetailID) left join salescompletecustomer sc on (sc.salescompleteID=t.salescompleteID)';
		$model=Warehouseadjustment::model()->findAll($criteria);

		if(count($modelWarehousebottomstok)>0)
			$count=$modelWarehousebottomstok->stok;
		else
			$count=0;
		
		foreach($model as $key=>$value)
			$count-=$value->number;

		if($count>0)
			return $count;
		else
			return 0;
			
	}
	
	public static function getWarehouseadjustmentNumber($warehouseID,$salesdetailID){
		$modelWarehouseadjustment=Warehouseadjustment::model()->find("warehouseID=:warehouseID AND  salesdetailID=:salesdetailID",array(":salesdetailID"=>$salesdetailID,":warehouseID"=>$warehouseID));
		
		if(count($modelWarehouseadjustment)>0)
			return $modelWarehouseadjustment->number;
		else
			return 0;
		
	}
	
	public static function salesReturnControl($salesdetailID,$number){
		$modelSalesreturn=Salesreturn::model()->find("salesdetailID=:salesdetailID",array(":salesdetailID"=>$salesdetailID));
		
		if(count($modelSalesreturn)>0){
			if($modelSalesreturn->number>=$number){
				return true;
			}else
				return false;
		}else
			return false;
	}
	
	public static function salesReturnControl2($salesdetailID){
		$modelSalesreturn=Salesreturn::model()->find("salesdetailID=:salesdetailID",array(":salesdetailID"=>$salesdetailID));
		
		if(count($modelSalesreturn)>0)
			return $modelSalesreturn->number;
		else
			return 0;
	}
}

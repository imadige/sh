<?php

class ReportsController extends Controller
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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('malitablo'),
				'users'=>array('*'),
			),
		
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('customers','dealers','employees','customergroups','productgroups'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionProductgroups(){
		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
			  
		}
		Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
		
		if($_POST){
			Yii::app()->user->setState('r_basTar',$_POST["basTar"]);
			Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);
			Yii::app()->user->setState('r_raporlamacd',$_POST["raporlamacd"]);
			Yii::app()->user->setState('r_allcustomers',@$_POST["allcustomers"]);
			
			$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
			$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			$bt=0;
		}else{
		
		
			if(Yii::app()->user->getState('r_basTar') !=""){
				$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
				$basTar=$basTar." 00:00:00";
			}
			
			
			if(Yii::app()->user->getState('r_bitTar') !="")	{
				$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
				$bitTar=$bitTar." 23:59:59";
			}
			
			if(Yii::app()->user->getState('r_raporlamacd') !="" && Yii::app()->user->getState('r_raporlamacd')<5) 	
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				
			
			
		}
		
		if(Yii::app()->user->getState('r_desc') !="")	
				$desc=Yii::app()->user->getState('r_desc');
		
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');
		
		$command=$this->cdCommandHesap3(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$desc,1,$bt,$st,false);
			
		$count=$this->cdCommandHesap3(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$desc,1,$bt,$st,true);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->render("productgroups",array(
		
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}

	private function cdCommandHesap3($companyID,$worldID,$cur,$basTar,$bitTar,$raporlamacd,$desc,$cdtype,$bt,$st,$count){
		
		if($desc==0)
			$desc="cg.name ASC";
		elseif($desc==1)
			$desc="cg.name DESC";
		elseif($desc==2)
			$desc="price ASC";
		elseif($desc==3)
			$desc="price DESC";
			
		$connection=Yii::app()->db; 
		
		
				if($raporlamacd==0)
					$command = $connection->createCommand('SELECT count(*) as count,c.productgroupsID, cg.name as name,sum(salesPrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join products c on(c.productsID=s.productsID) inner join productgroups cg on (cg.productgroupsID=c.productgroupsID)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  c.productgroupsID,salesCur ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
					
				
				elseif($raporlamacd==2)
					$command = $connection->createCommand('SELECT count(*) as count,c.productgroupsID, cg.name as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID)  left join products c on(c.productsID=s.productsID) inner join productgroups cg on (cg.productgroupsID=c.productgroupsID)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  c.productgroupsID,salesCur ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');	
				elseif($raporlamacd==3)
					$command = $connection->createCommand('SELECT count(*) as count,c.productgroupsID, cg.name as name,-sum(salesreturnPrice*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID)left join products c on(c.productsID=s.productsID) inner join productgroups cg on (cg.productgroupsID=c.productgroupsID) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').' GROUP BY  c.productgroupsID,salesreturnCur ORDER BY '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==4)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.productgroupsID, cg.name as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join products c on(c.productsID=s.productsID) inner join productgroups cg on (cg.productgroupsID=c.productgroupsID) WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  c.productgroupsID,salesreturnCur ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				
			
			if($count==true){
				$command=$command->execute();
				return $command;
			}else
				$command=$command->queryAll();		
			
		

		return $command;
	}
	

	public function actionCustomergroups(){
		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
		}
		Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			Yii::app()->user->setState('r_basTar',$_POST["basTar"]);
			Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);
			Yii::app()->user->setState('r_raporlamacd',$_POST["raporlamacd"]);
			Yii::app()->user->setState('r_allcustomers',@$_POST["allcustomers"]);
			
			$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
			$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			$bt=0;
		}else{
		
		
			if(Yii::app()->user->getState('r_basTar') !=""){
				$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
				$basTar=$basTar." 00:00:00";
			}
			
			
			if(Yii::app()->user->getState('r_bitTar') !="")	{
				$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
				$bitTar=$bitTar." 23:59:59";
			}
			
			if(Yii::app()->user->getState('r_raporlamacd') !="")	
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				
			if(Yii::app()->user->getState('r_allcustomers') !="")	
				$allcustomers=Yii::app()->user->getState('r_allcustomers');
				
			
		}
		
		if(Yii::app()->user->getState('r_desc') !="")	
				$desc=Yii::app()->user->getState('r_desc');
		
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');

		$command=$this->cdCommandHesap2(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,1,$bt,$st,false);
			
		$count=$this->cdCommandHesap2(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,1,$bt,$st,true);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->render("customergroups",array(
		
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}


	private function cdCommandHesap2($companyID,$worldID,$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,$cdtype,$bt,$st,$count){
		
		
		if($desc==0)
			$desc="cg.name ASC";
		elseif($desc==1)
			$desc="cg.name DESC";
		elseif($desc==2)
			$desc="price ASC";
		elseif($desc==3)
			$desc="price DESC";
			
		$connection=Yii::app()->db; 
		
		
				if($raporlamacd==0)
					$command = $connection->createCommand('SELECT count(*) as count,c.cgID, cg.name as name,sum(salesPrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join customers c on(sc.customerdealerID=c.customerID) inner join customergroups cg on (cg.customergroupsID=c.cgID)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  c.cgID,salesCur ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
					
				elseif($raporlamacd==1)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.cgID, cg.name as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join customers c on(sc.customerdealerID=c.customerID) inner join customergroups cg on (cg.customergroupsID=c.cgID)  WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY c.cgID, chargeCur ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==2)
					$command = $connection->createCommand('SELECT count(*) as count,c.cgID, cg.name as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join customers c on(sc.customerdealerID=c.customerID) inner join customergroups cg on (cg.customergroupsID=c.cgID)   WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  c.cgID,salesCur ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');	
				elseif($raporlamacd==3)
					$command = $connection->createCommand('SELECT count(*) as count,c.cgID, cg.name as name,-sum(salesreturnPrice*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join customers c on(sc.customerdealerID=c.customerID) inner join customergroups cg on (cg.customergroupsID=c.cgID)  WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').' GROUP BY  c.cgID,salesreturnCur  ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==4)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.cgID, cg.name as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join customers c on(sc.customerdealerID=c.customerID) inner join customergroups cg on (cg.customergroupsID=c.cgID)  WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  c.cgID,salesreturnCur ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==5)
					$command = $connection->createCommand('
					select count,cgID, name,sum(price) as price from (
					
					(
					SELECT count(*) as count,c.cgID, cg.name as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join customers c on(sc.customerdealerID=c.customerID) inner join customergroups cg on (cg.customergroupsID=c.cgID)  WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  c.cgID,chargeCur ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					) 
					union
					(
					SELECT count(*) as count,c.cgID, cg.name as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join customers c on(sc.customerdealerID=c.customerID) inner join customergroups cg on (cg.customergroupsID=c.cgID)  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').' GROUP BY  c.cgID,salesCur ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)
					
					union
					(
					SELECT count(*) as count,c.cgID, cg.name as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join customers c on(sc.customerdealerID=c.customerID) inner join customergroups cg on (cg.customergroupsID=c.cgID)  WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  c.cgID,salesreturnCur ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)) as ca group by cgID  
					
					');
				
				
			if($allcustomers==0){	
			
				if($count==true){
						$command=$command->execute();
						return $command;
					}else
						$command=$command->queryAll();	
			}else{
				
			 	
				$command2=array();
				
				$criteria=new CDbCriteria;
				$criteria->select='customergroupsID as cgID,name';
				$criteria->condition='worldID=:worldID AND companyID=:companyID AND deleted=1';
				$criteria->params=array(":worldID"=>Yii::app()->user->getState('worldID'),":companyID"=>Yii::app()->user->getState('companyID'));
				$criteria->order=$desc;
				
				if($count==false){
					$criteria->offset=$bt;
					$criteria->limit=$st;
				}
               
				
				$model=Customergroups::model()->findAll($criteria);
				
				if($count==true){
					$command=count($model);
					return $command;
				}else
					$command=$command->queryAll();
				
				
				foreach($model as $key=>$value){
					
					$command2[$value->cgID]=array("name"=>$value->name,"price"=>0);
				}
			
				foreach($command as $key=>$value){
					$value=(object)$value;
					
					if(count(@$command2[$value->cgID])>0){
						
						$command2[$value->cgID]["name"]=$value->name;
						$command2[$value->cgID]["price"]=$value->price;
					
					}
				}
				
				
				$command=$command2;
				
			}
		

		return $command;
	}
	
	public function actionCustomers(){
		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
			  
		}
		Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			Yii::app()->user->setState('r_basTar',$_POST["basTar"]);
			Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);
			Yii::app()->user->setState('r_raporlamacd',$_POST["raporlamacd"]);
			Yii::app()->user->setState('r_allcustomers',@$_POST["allcustomers"]);
			
			$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
			$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			$bt=0;
		}else{
		
		
			if(Yii::app()->user->getState('r_basTar') !=""){
				$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
				$basTar=$basTar." 00:00:00";
			}
			
			
			if(Yii::app()->user->getState('r_bitTar') !="")	{
				$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
				$bitTar=$bitTar." 23:59:59";
			}
			
			if(Yii::app()->user->getState('r_raporlamacd') !="")	
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				
			if(Yii::app()->user->getState('r_allcustomers') !="")	
				$allcustomers=Yii::app()->user->getState('r_allcustomers');
				
			
		}
		
		if(Yii::app()->user->getState('r_desc') !="")	
				$desc=Yii::app()->user->getState('r_desc');
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');
		
		$command=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,1,$bt,$st,false);
			
		$count=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,1,$bt,$st,true);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->render("customers",array(
		
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}
	
	
	public function actionDealers(){
		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
			  
		}
		Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			Yii::app()->user->setState('r_basTar',$_POST["basTar"]);
			Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);
			Yii::app()->user->setState('r_raporlamacd',$_POST["raporlamacd"]);
			Yii::app()->user->setState('r_allcustomers',@$_POST["allcustomers"]);
			
			$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
			$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			$bt=0;
		}else{
		
		
			if(Yii::app()->user->getState('r_basTar') !=""){
				$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
				$basTar=$basTar." 00:00:00";
			}
			
			
			if(Yii::app()->user->getState('r_bitTar') !="")	{
				$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
				$bitTar=$bitTar." 23:59:59";
			}
			
			if(Yii::app()->user->getState('r_raporlamacd') !="")	
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				
			if(Yii::app()->user->getState('r_allcustomers') !="")	
				$allcustomers=Yii::app()->user->getState('r_allcustomers');
				
			
		}
		
		if(Yii::app()->user->getState('r_desc') !="")	
				$desc=Yii::app()->user->getState('r_desc');
		
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');

		$command=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,2,$bt,$st,false);
			
		$count=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,2,$bt,$st,true);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->render("dealers",array(
		
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}
	
	
	public function actionEmployees(){
		$bt=0;
		$st=15;
		
		if(@(int)$_GET["bt"]!="")
			$bt=(int)$_GET["bt"];
	 
		$cur=0;
		
		$desc=0;
		
		if(@$_GET["desc"]==1){
			 $desc=1;
			  
		}elseif(@$_GET["desc"]==2){
			 $desc=2;
			  
		}elseif(@$_GET["desc"]==3){
			 $desc=3;
			  
		}
		Yii::app()->user->setState('r_desc',$desc);
		
		
		$raporlamacd=0;
		$allcustomers=0;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			Yii::app()->user->setState('r_basTar',$_POST["basTar"]);
			Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);
			Yii::app()->user->setState('r_raporlamacd',$_POST["raporlamacd"]);
			Yii::app()->user->setState('r_allcustomers',@$_POST["allcustomers"]);
			
			$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
			$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
			$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
			$allcustomers=Yii::app()->user->getState('r_allcustomers');
			$bt=0;
		}else{
		
		
			if(Yii::app()->user->getState('r_basTar') !=""){
				$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
				$basTar=$basTar." 00:00:00";
			}
			
			
			if(Yii::app()->user->getState('r_bitTar') !="")	{
				$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
				$bitTar=$bitTar." 23:59:59";
			}
			
			if(Yii::app()->user->getState('r_raporlamacd') !="")	
				$raporlamacd=Yii::app()->user->getState('r_raporlamacd');
				
			if(Yii::app()->user->getState('r_allcustomers') !="")	
				$allcustomers=Yii::app()->user->getState('r_allcustomers');
				
			
		}
		
		if(Yii::app()->user->getState('r_desc') !="")	
				$desc=Yii::app()->user->getState('r_desc');
		
		if(Yii::app()->user->getState('r_cur') !="")	
				$cur=Yii::app()->user->getState('r_cur');

		$command=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,3,$bt,$st,false);
			
		$count=$this->cdCommandHesap(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,3,$bt,$st,true);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->render("employees",array(
		
			'command'=>$command,
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlamacd'=>$raporlamacd,
			'allcustomers'=>$allcustomers,
			'bt'=>$bt,
			'st'=>$st,
			'count'=>$count,
		));	
	}
	
	private function cdCommandHesap($companyID,$worldID,$cur,$basTar,$bitTar,$raporlamacd,$allcustomers,$desc,$cdtype,$bt,$st,$count){
		
		if($desc==0){
			$desc="c.name ASC";
			$desc2="name DESC";
		}
		elseif($desc==1){
			$desc="c.name DESC";
			$desc2="name DESC";
		}
		elseif($desc==2)
			$desc="price ASC";
		elseif($desc==3)
			$desc="price DESC";
			
		$connection=Yii::app()->db; 
		if($cdtype==1){
			$params="customers";
			$params2="customerID";
			$params3="customerdealerID";
		}elseif($cdtype==2){
			$params="dealers";
			$params2="dealersID";
			$params3="customerdealerID";
		}else{
			$params="employees";
			$params2="employeesID";
			$params3="employeesID";
			$params4="t.employeesID";
		}
		
				if($raporlamacd==0)
					$command = $connection->createCommand('SELECT count(*) as count,c.'.$params2.', c.name as name,sum(salesPrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.')  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  salesCur, '.$params3.' ORDER BY '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
					
				elseif($raporlamacd==1)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.'.$params2.', c.name as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.')  WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  chargeCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==2)
					$command = $connection->createCommand('SELECT count(*) as count,c.'.$params2.', c.name as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.')  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  salesCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');	
				elseif($raporlamacd==3)
					$command = $connection->createCommand('SELECT count(*) as count,c.'.$params2.', c.name as name,-sum(salesreturnPrice*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').' GROUP BY  salesreturnCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==4)
				
					$command = $connection->createCommand('SELECT count(*) as count,c.'.$params2.', c.name as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  salesreturnCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' ');
				elseif($raporlamacd==5)
					$command = $connection->createCommand('
					select count,'.$params2.', name,sum(price) as price from (
					
					(
					SELECT count(*) as count,c.'.$params2.', c.name as name,-sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.')  WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  chargeCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					) 
					union
					(
					SELECT count(*) as count,c.'.$params2.', c.name as name,sum(salesPrice*number)-sum(purchasePrice*number) as price from  salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.')  WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND sc.companyID='.$companyID.' AND sc.worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5 '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').' GROUP BY  salesCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)
					
					union
					(
					SELECT count(*) as count,c.'.$params2.', c.name as name,-sum((salesPrice-purchasePrice)*t.number) as price from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) left join '.$params.' c on(sc.'.$params3.'=c.'.$params2.') WHERE t.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  t.companyID='.$companyID.' AND t.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  '.($cdtype!=3?'AND cdtype="'.$cdtype.'"':'').'  GROUP BY  salesreturnCur, '.$params3.' ORDER BY  '.$desc.'  '.($count==false?'LIMIT '.$bt.', '.$st.'':'').' 
					)) as ca group by '.$params2.'  
					
					');
				
				
			if($allcustomers==0){	
			
				if($count==true){
						$command=$command->execute();
						return $command;
					}else
						$command=$command->queryAll();	
			}else{
				
			 	
				$command2=array();
				
				$criteria=new CDbCriteria;

				$criteria->select=$params2.',name';
				$criteria->condition='worldID=:worldID AND companyID=:companyID AND t.deleted=1';
				$criteria->params=array(":worldID"=>Yii::app()->user->getState('worldID'),":companyID"=>Yii::app()->user->getState('companyID'));
				$criteria->order=$desc2;
				
				if($count==false){
					$criteria->offset=$bt;
					$criteria->limit=$st;
				}
               
				if($cdtype==1)
					$model=Customers::model()->findAll($criteria);
				elseif($cdtype==2)
					$model=Dealers::model()->findAll($criteria);
				else{
					$criteria->condition='(erights<3 || worldID=:worldID) AND companyID=:companyID AND t.deleted=1';
					$criteria->select=$params4.',name';
					$criteria->join="left join worldemployees as w on(t.employeesID=w.employeesID)";
					$model=Employees::model()->findAll($criteria);

				}
				
				if($count==true){
					$command=count($model);
					return $command;
				}else
					$command=$command->queryAll();
				
				
				foreach($model as $key=>$value){
					
					$command2[$value->$params2]=array("name"=>$value->name,"price"=>0);
				}
			
				foreach($command as $key=>$value){
					$value=(object)$value;
					
					if(count(@$command2[$value->$params2])>0){
						
						$command2[$value->$params2]["name"]=$value->name;
						$command2[$value->$params2]["price"]=$value->price;
					
					}
				}
				
				
				$command=$command2;
				
			}
		
		
		
		return $command;
	}
	
	public function actionMalitablo(){
		
		$cur=0;
		
		$raporlama=2;
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
	
		if($_POST){
			Yii::app()->user->setState('r_basTar',$_POST["basTar"]);
			Yii::app()->user->setState('r_bitTar',$_POST["bitTar"]);
			Yii::app()->user->setState('r_raporlama',$_POST["raporlama"]);
			
			$bitTar=date("Y-m-d H:i:s",strtotime($_POST["bitTar"]." ".date("H:i:s")));
			$basTar=date("Y-m-d",strtotime($_POST["basTar"]))." 00:00:00";
			$raporlama=$_POST["raporlama"];
		}else{
		
		
			if(Yii::app()->user->getState('r_basTar') !=""){
				$basTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_basTar')));
				$basTar=$basTar." 00:00:00";
			}
			
			
			if(Yii::app()->user->getState('r_bitTar') !="")	{
				$bitTar=date("Y-m-d",strtotime(Yii::app()->user->getState('r_bitTar')));
				$bitTar=$bitTar." 23:59:59";
			}
			
			if(Yii::app()->user->getState('r_raporlama') !="")	
				$raporlama=Yii::app()->user->getState('r_raporlama');
			
		}
			
			
		$command1=$this->generalCommandMonthTopssatis(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlama);
		
		$command2=$this->generalCommandMonthKar(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlama);
		
		$command3=$this->generalCommandMonthGider(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlama);
		
		$command4=$this->generalCommandMonthIade(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar,$raporlama);
		
		
		$command5=$this->generalCommandMonthTopssatisCD(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar);
		
		$command6=$this->generalCommandMonthKarCD(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar);
		
		$command7=$this->generalCommandMonthGiderCD(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar);
		
		$command8=$this->generalCommandMonthIadeCD(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar);
		
		
		$bitTar=new DateTime($bitTar);
		$bitTar=$bitTar->format("d-m-Y");
		
		$basTar=new DateTime($basTar);
		$basTar=$basTar->format("d-m-Y");
		
		$this->render("malitablo",array(
			'command1'=>$command1,
			'command2'=>$command2,
			'command3'=>$command3,
			'command4'=>$command4,
			
			'command5'=>$command5,
			'command6'=>$command6,
			'command7'=>$command7,
			'command8'=>$command8,
		
			'cur'=>$cur,
			'bitTar'=>$bitTar,
			'basTar'=>$basTar,
			'raporlama'=>$raporlama,
		));
	}

	
	
	public function actionIndex(){
		
		$cur=0;
		$reportsdate="0 day";
		
	
		if(isset($_POST["cur"])){
			$cur=$_POST["cur"];
			Yii::app()->user->setState('r_cur',$_POST["cur"]);
		}
		
		if(isset($_POST["reportsdate"])){
			$reportsdate=$_POST["reportsdate"];
		}
		
		$dateDay=date("Y-m-d",strtotime("-".$reportsdate,strtotime(date("Y-m-d"))))." 00:00:00";
		$bitTar=date("Y-m-d H:i:s");
		$basTar=date("Y-m-d",strtotime("-11 Month",strtotime(date("Y-m-d"))))." 00:00:00";
		
		$criteria=new CDbCriteria;
		$criteria->select='t.employeesID';
		$criteria->condition='t.companyID=:companyID';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"));
		$criteria->join = 'inner join employeesworld ew on (ew.employeesID=t.employeesID AND ew.worldID='.Yii::app()->user->getState("worldID").') inner join employeesstatus es on (es.employeesID=t.employeesID AND es.dateAdd>="'.date("Y-m-d H:i:s",strtotime('-10 minutes',strtotime(date("Y-m-d H:i:s")))).'")';
		$modelEmployees=Employees::model()->count($criteria);
		
		
		
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='companyID=:companyID AND worldID=:worldID AND dateAdd>="'.$dateDay.'"';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"));

		$modelCustomers=Customers::model()->count($criteria);
		
		/*********Blanço********/
		/***********************/
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='companyID=:companyID AND worldID=:worldID AND dateAdd>="'.$dateDay.'"';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"));
		
		$modelDealers=Dealers::model()->count($criteria);
		
		/*************************/
		
		$criteria=new CDbCriteria;
		$criteria->select='sum(t.salesPrice*t.number) as salesPrice';
		$criteria->condition='t.salesCur=:salesCur AND s.companyID=:companyID AND s.worldID=:worldID AND  salesEs!=0 AND  salesEs!=5 AND dateAdd>="'.$dateDay.'"';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),':salesCur'=>$cur);
		$criteria->join="Inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID)";
		$modelToplamSatis=Salesdetail::model()->find($criteria);
		
		/*************************/
		
		$criteria=new CDbCriteria;
		$criteria->select='sum(salesPrice*number)-sum(purchasePrice*number) as salesPrice ';
		$criteria->condition='t.salesCur=:salesCur AND s.companyID=:companyID AND s.worldID=:worldID AND  salesEs!=0 AND  salesEs!=5  AND s.dateAdd>="'.$dateDay.'" ';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),':salesCur'=>$cur);
		$criteria->join="Inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID)";
		$modelBrutKar=Salesdetail::model()->find($criteria);
		
		/*************************/
		
		
		$criteria=new CDbCriteria;
		$criteria->select='sum(charge) as charge';
		$criteria->condition='companyID=:companyID AND worldID=:worldID AND t.chargeCur=:chargeCur AND dateAdd>="'.$dateDay.'"';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),':chargeCur'=>$cur);
		
		$modelCargoGider=Salescargo::model()->find($criteria);
		
		/*************************/
		
		$criteria=new CDbCriteria;
		$criteria->select='sum(salesreturnPrice*t.number) as salesreturnPrice, sum((salesPrice-purchasePrice)*t.number) as bkar';
		$criteria->condition='salesreturnCur=:salesreturnCur AND t.deleted=1  AND dateAdd>="'.$dateDay.'" AND companyID=:companyID AND worldID=:worldID';
		$criteria->params=array(':salesreturnCur'=>$cur,':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"));
		$criteria->join="Inner join salesdetail s on (s.salesdetailID=t.salesdetailID)";
		$modelUIade=Salesreturn::model()->find($criteria);
		
		
		
		
		
		$criteria=new CDbCriteria;
		$criteria->select='sum(t.receivedPrice) as receivedPrice';
		$criteria->condition='t.receivedCur=:receivedCur AND s.companyID=:companyID AND s.worldID=:worldID AND unpayment=0 AND deleted=1 AND t.dateAdd>="'.$dateDay.'"';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),':receivedCur'=>$cur);
		$criteria->join="Inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID)";
		$modelKasayaGiren=Salesmoneyreceived::model()->find($criteria);
		
		/*************************/
		
		$criteria=new CDbCriteria;
		$criteria->select='sum(t.receivedPrice) as receivedPrice';
		$criteria->condition='t.receivedCur=:receivedCur AND s.companyID=:companyID AND s.worldID=:worldID AND unpayment=1 AND deleted=1 AND t.dateAdd>="'.$dateDay.'"';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"),':receivedCur'=>$cur);
		$criteria->join="Inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID)";
		$modelIadeEdilmis=Salesmoneyreceived::model()->find($criteria);
		
		
		
		
		/*************************/
		
		/**********ürünler***********/
		
		/*************************/
		
		
		$criteria=new CDbCriteria;
		$criteria->select='sum(t.number) as number';
		$criteria->condition='s.companyID=:companyID AND s.worldID=:worldID AND s.dateAdd>="'.$dateDay.'" ';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"));
		$criteria->join="Inner join salescompletecustomer s on (s.salescompleteID=t.salescompleteID)";
		$modelSatilanAdet=Salesdetail::model()->find($criteria);
		
		/*************************/
		
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='companyID=:companyID AND worldID=:worldID AND  dateAdd>="'.$dateDay.'" AND deleted=1 ';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"));
		$modelUEklenenAdet=Productdetail::model()->count($criteria);
		
		/*************************/
		
		
		$criteria=new CDbCriteria;
		$criteria->select='IF(sum(number)>0,sum(number),0) as number';
		$criteria->condition='companyID=:companyID AND worldID=:worldID AND  dateAdd>="'.$dateDay.'" AND deleted=1 ';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"));
		$modelUIadeAdet=Salesreturn::model()->find($criteria);
		
		
		/*************************/
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='companyID=:companyID AND worldID=:worldID AND  dateAdd>="'.$dateDay.'" AND deleted=1';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"));
		$modelUSorunluAdet=Problematicproducts::model()->count($criteria);
		
		/*************************/
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='companyID=:companyID AND worldID=:worldID AND  dateAdd>="'.$dateDay.'" AND deleted=1 AND problematicStatus=3 ';
		$criteria->params=array(':companyID'=>Yii::app()->user->getState("companyID"),':worldID'=>Yii::app()->user->getState("worldID"));
		$modelUOnarAdet=Problematicproducts::model()->count($criteria);
		
		/*************************/
		
		$command1=$this->generalCommandMonthTopssatis(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar);
		
		$command2=$this->generalCommandMonthKar(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar);
		
		$command3=$this->generalCommandMonthGider(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar);
		
		$command4=$this->generalCommandMonthIade(Yii::app()->user->getState("companyID"),Yii::app()->user->getState("worldID"),$cur,$basTar,$bitTar);
		
		$this->render("index",array(
			"modelEmployees"=>$modelEmployees,
			'modelCustomers'=>$modelCustomers,
			'modelDealers'=>$modelDealers,
			'command1'=>$command1,
			'command2'=>$command2,
			'command3'=>$command3,
			'command4'=>$command4,
			'modelToplamSatis'=>$modelToplamSatis,
			'modelBrutKar'=>$modelBrutKar,
			'modelCargoGider'=>$modelCargoGider,
			'modelUIade'=>$modelUIade,
			
			'modelSatilanAdet'=>$modelSatilanAdet,
			'modelUEklenenAdet'=>$modelUEklenenAdet,
			'modelUIadeAdet'=>$modelUIadeAdet,
			'modelUOnarAdet'=>$modelUOnarAdet,
			'modelUSorunluAdet'=>$modelUSorunluAdet,
			'modelIadeEdilmis'=>$modelIadeEdilmis,
			'modelKasayaGiren'=>$modelKasayaGiren,
			'cur'=>$cur,
			'reportsdate'=>$reportsdate,
		));
	}
	
	
		
	private function generalCommandMonthTopssatisCD($companyID,$worldID,$cur,$basTar,$bitTar){
		$connection=Yii::app()->db; 
		
		
			$command = $connection->createCommand('SELECT cdtype,sum(salesPrice*number) as price from salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5  GROUP BY  salesCur,cdtype ')->queryAll();
	
		
		
		$command2=array();
		$command2[1]=array("price"=>0);
		$command2[2]=array("price"=>0);
		
		foreach($command as $key=>$value){
			$value=(object)$value;
			$command2[$value->cdtype]=array("price"=>$value->price);
		}
		
		return $command2;
	}
	
	
	
	private function generalCommandMonthKarCD($companyID,$worldID,$cur,$basTar,$bitTar){
		$connection=Yii::app()->db; 
			$command = $connection->createCommand('SELECT sc.cdtype,sum(salesPrice*number)-sum(purchasePrice*number) as price from salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.'  AND salesCur='.$cur.' AND  salesEs!=0 AND  salesEs!=5  GROUP BY  salesCur,sc.cdtype ')->queryAll();
		
		
		$command2=array();
		$command2[1]=array("price"=>0);
		$command2[2]=array("price"=>0);
		
		foreach($command as $key=>$value){
			$value=(object)$value;
			$command2[$value->cdtype]=array("price"=>$value->price);
		}
		
		
		return $command2;
	}
	
	
	private function generalCommandMonthGiderCD($companyID,$worldID,$cur,$basTar,$bitTar){
		$connection=Yii::app()->db; 
		
		$command = $connection->createCommand('SELECT sc.cdtype,sum(charge) as price from salescargo s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE s.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND s.companyID='.$companyID.' AND s.worldID='.$worldID.'  AND chargeCur='.$cur.' GROUP BY sc.cdtype ')->queryAll();
		
		$command2=array();
		$command2[1]=array("price"=>0);
		$command2[2]=array("price"=>0);
		
		foreach($command as $key=>$value){
			$value=(object)$value;
			$command2[$value->cdtype]=array("price"=>-$value->price);
		}
		
		return $command2;
	}
	
	
	private function generalCommandMonthIadeCD($companyID,$worldID,$cur,$basTar,$bitTar){
		$connection=Yii::app()->db; 

		$command = $connection->createCommand('SELECT sc.cdtype,sum(salesreturnPrice*t.number) as price,sum((salesPrice-purchasePrice)*t.number) as bkar from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  sc.companyID='.$companyID.' AND sc.worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  GROUP BY sc.cdtype ')->queryAll();
		
		$command2=array();
		$command2[1]=array("price"=>0,'bkar'=>0);
		$command2[2]=array("price"=>0,'bkar'=>0);
		
		foreach($command as $key=>$value){
			$value=(object)$value;
			$command2[$value->cdtype]=array("price"=>-$value->price,'bkar'=>-$value->bkar);
		}
	
		return $command2;
	}
	

	
	
	/************************************************************************************************************
	****************************************************************************************
	******************************************************************************************/
	
	
	private function generalCommandMonthTopssatis($companyID,$worldID,$cur,$basTar,$bitTar,$raporlama=9){
		$connection=Yii::app()->db; 
		
		if($raporlama==9 || $raporlama==2){
			$command = $connection->createCommand('SELECT sum(salesPrice*number) as price, month( sc.dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( sc.dateAdd ) AS year from salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5  GROUP BY  salesCur,month(dateAdd) ')->queryAll();
		}elseif($raporlama==0){
			$command = $connection->createCommand('SELECT sum(salesPrice*number) as price, day( sc.dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( sc.dateAdd ) AS year from salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5  GROUP BY  salesCur,day(dateAdd) ')->queryAll();
		}elseif($raporlama==1){
			$command = $connection->createCommand('SELECT sum(salesPrice*number) as price, DAYOFWEEK( sc.dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( sc.dateAdd ) AS year from salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5  GROUP BY  salesCur,DAYOFWEEK(dateAdd) ')->queryAll();
		}elseif($raporlama==3){
			$command = $connection->createCommand('SELECT sum(salesPrice*number) as price, year( sc.dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month,year( sc.dateAdd ) AS year  from salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.' AND salesCur='.$cur.' AND salesEs!=0 AND  salesEs!=5  GROUP BY  salesCur,year(dateAdd) ')->queryAll();
		}
		
		
		$command2=array();
		$basTar2=strtotime($basTar);
		$bitTar2=strtotime($bitTar);
		
		$command2=$this->getCommand2($basTar2,$bitTar2,$raporlama);
		
		
		foreach($command as $key=>$value){
			$value=(object)$value;
			
			if($raporlama==9 || $raporlama==2){
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=$value->price;
			}elseif($raporlama==0){
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=$value->price;
			}elseif($raporlama==1){
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=$value->price;
			}elseif($raporlama==3){
				$command2[$value->year]["dates"]=$value->dates;
				$command2[$value->year]["year"]=$value->year;
				$command2[$value->year]["price"]=$value->price;
			}
			
			
		}
	
		return $command2;
	}
	
	
	
	
	
	
	private function generalCommandMonthKar($companyID,$worldID,$cur,$basTar,$bitTar,$raporlama=9){
		$connection=Yii::app()->db; 
		if($raporlama==9 || $raporlama==2){
			$command = $connection->createCommand('SELECT sum(salesPrice*number)-sum(purchasePrice*number) as price, month( sc.dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( sc.dateAdd ) AS year from salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.'  AND salesCur='.$cur.' AND  salesEs!=0 AND  salesEs!=5  GROUP BY  salesCur,month(dateAdd) ')->queryAll();
		}elseif($raporlama==0){
			$command = $connection->createCommand('SELECT sum(salesPrice*number)-sum(purchasePrice*number) as price, day( sc.dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( sc.dateAdd ) AS year from salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.'  AND salesCur='.$cur.' AND  salesEs!=0 AND  salesEs!=5  GROUP BY  salesCur,day(dateAdd) ')->queryAll();
		}elseif($raporlama==1){
			$command = $connection->createCommand('SELECT sum(salesPrice*number)-sum(purchasePrice*number) as price, DAYOFWEEK( sc.dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( sc.dateAdd ) AS year from salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.'  AND salesCur='.$cur.' AND  salesEs!=0 AND  salesEs!=5  GROUP BY  salesCur,DAYOFWEEK(dateAdd) ')->queryAll();
		}elseif($raporlama==3){
			$command = $connection->createCommand('SELECT sum(salesPrice*number)-sum(purchasePrice*number) as price, year( sc.dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( sc.dateAdd ) AS year from salesdetail s left join salescompletecustomer sc on ( sc.salescompleteID=s.salescompleteID) WHERE sc.dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.'  AND salesCur='.$cur.' AND  salesEs!=0 AND  salesEs!=5  GROUP BY  salesCur,year(dateAdd) ')->queryAll();
		}
		
		$command2=array();
		$basTar2=strtotime($basTar);
		$bitTar2=strtotime($bitTar);
		
		$command2=$this->getCommand2($basTar2,$bitTar2,$raporlama);
		
		
		
		foreach($command as $key=>$value){
			$value=(object)$value;
			
			if($raporlama==9 || $raporlama==2){
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=$value->price;
			}elseif($raporlama==0){
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=$value->price;
			}elseif($raporlama==1){
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=$value->price;
			}elseif($raporlama==3){
				$command2[$value->year]["dates"]=$value->dates;
				$command2[$value->year]["year"]=$value->year;
				$command2[$value->year]["price"]=$value->price;
			}
		}
		
		return $command2;
	}
	
	
	private function generalCommandMonthGider($companyID,$worldID,$cur,$basTar,$bitTar,$raporlama=9){
		$connection=Yii::app()->db; 
		
		if($raporlama==9|| $raporlama==2){
			$command = $connection->createCommand('SELECT sum(charge) as price, month( dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( dateAdd ) AS year from salescargo WHERE dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.'  AND chargeCur='.$cur.' GROUP BY  month(dateAdd) ')->queryAll();
		}elseif($raporlama==0){
			$command = $connection->createCommand('SELECT sum(charge) as price, day( dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( dateAdd ) AS year from salescargo WHERE dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.'  AND chargeCur='.$cur.' GROUP BY  day(dateAdd) ')->queryAll();
		}elseif($raporlama==1){
			$command = $connection->createCommand('SELECT sum(charge) as price, DAYOFWEEK( dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( dateAdd ) AS year from salescargo WHERE dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.'  AND chargeCur='.$cur.' GROUP BY  DAYOFWEEK(dateAdd) ')->queryAll();
		}elseif($raporlama==3){
			$command = $connection->createCommand('SELECT sum(charge) as price, year( dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year( dateAdd ) AS year from salescargo WHERE dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND companyID='.$companyID.' AND worldID='.$worldID.'  AND chargeCur='.$cur.' GROUP BY  year(dateAdd) ')->queryAll();
		}
		
		
		
		$basTar2=strtotime($basTar);
		$bitTar2=strtotime($bitTar);
		
		$command2=$this->getCommand2($basTar2,$bitTar2,$raporlama);
		
		
		
		foreach($command as $key=>$value){
			$value=(object)$value;
			
			
			if($raporlama==9 || $raporlama==2){
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=$value->price;
			}elseif($raporlama==0){
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=-$value->price;
			}elseif($raporlama==1){
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=-$value->price;
			}elseif($raporlama==3){
				$command2[$value->year]["dates"]=$value->dates;
				$command2[$value->year]["year"]=$value->year;
				$command2[$value->year]["price"]=-$value->price;
			}
		}
		
		return $command2;
	}
	
	
	private function generalCommandMonthIade($companyID,$worldID,$cur,$basTar,$bitTar,$raporlama=9){
		$connection=Yii::app()->db; 
		if($raporlama==9 || $raporlama==2){
			$command = $connection->createCommand('SELECT sum(salesreturnPrice*t.number) as price,sum((salesPrice-purchasePrice)*t.number) as bkar, month( dateAdd ) AS dates, day(dateAdd ) AS day, month(dateAdd ) AS month, year(dateAdd ) AS year from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) WHERE dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  companyID='.$companyID.' AND worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  GROUP BY  month(dateAdd) ')->queryAll();
		}elseif($raporlama==0){
			$command = $connection->createCommand('SELECT sum(salesreturnPrice*t.number) as price,sum((salesPrice-purchasePrice)*t.number) as bkar, day( dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year(dateAdd ) AS year from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) WHERE dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  companyID='.$companyID.' AND worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  GROUP BY  day(dateAdd) ')->queryAll();
		}elseif($raporlama==1){
			$command = $connection->createCommand('SELECT sum(salesreturnPrice*t.number) as price,sum((salesPrice-purchasePrice)*t.number) as bkar, DAYOFWEEK( dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year(dateAdd ) AS year from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) WHERE dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  companyID='.$companyID.' AND worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  GROUP BY  DAYOFWEEK(dateAdd) ')->queryAll();
		}elseif($raporlama==3){
			$command = $connection->createCommand('SELECT sum(salesreturnPrice*t.number) as price,sum((salesPrice-purchasePrice)*t.number) as bkar, year( dateAdd ) AS dates,day(dateAdd ) AS day, month(dateAdd ) AS month, year(dateAdd ) AS year from salesreturn t left join  salesdetail s on (t.salesdetailID= s.salesdetailID) WHERE dateAdd BETWEEN "'.$basTar.'" AND "'.$bitTar.'"  AND  companyID='.$companyID.' AND worldID='.$worldID.'  AND t.deleted=1 AND salesreturnCur='.$cur.'  GROUP BY  year(dateAdd) ')->queryAll();
		}
		
		$command2=array();
		$basTar2=strtotime($basTar);
		$bitTar2=strtotime($bitTar);
		
		$command2=$this->getCommand2($basTar2,$bitTar2,$raporlama);
		
		foreach($command as $key=>$value){
			$value=(object)$value;
			
			if($raporlama==9 || $raporlama==2){
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=-$value->price;
				$command2[str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["bkar"]=-$value->bkar;
			}elseif($raporlama==0){
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=-$value->price;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["bkar"]=-$value->bkar;
			}elseif($raporlama==1){
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["dates"]=$value->dates;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["year"]=$value->year;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["bkar"]=-$value->bkar;
				$command2[$value->day.str_pad($value->month,2,"0",STR_PAD_LEFT).$value->year]["price"]=-$value->price;
			}elseif($raporlama==3){
				$command2[$value->year]["dates"]=$value->dates;
				$command2[$value->year]["year"]=$value->year;
				$command2[$value->year]["price"]=-$value->price;
				$command2[$value->year]["bkar"]=-$value->bkar;
			}
		}
		
		return $command2;
	}
	
	public function getCommand2($basTar2,$bitTar2,$raporlama){
		$command2=array();
		$bitTar2=strtotime ( '+1 Day' ,$bitTar2) ;
		while($basTar2<$bitTar2){
			if($raporlama==9 || $raporlama==2){
				$command2[date("m",$basTar2).date("Y",$basTar2)]["price"]=0;
				$command2[date("m",$basTar2).date("Y",$basTar2)]["dates"]=date("m",$basTar2);
				$command2[date("m",$basTar2).date("Y",$basTar2)]["bkar"]=0;
			}elseif($raporlama==0){
				$command2[date("d",$basTar2).date("m",$basTar2).date("Y",$basTar2)]["price"]=0;
				$command2[date("d",$basTar2).date("m",$basTar2).date("Y",$basTar2)]["dates"]=date("d",$basTar2);
				$command2[date("d",$basTar2).date("m",$basTar2).date("Y",$basTar2)]["bkar"]=0;
			}elseif($raporlama==1){
				$command2[date("d",$basTar2).date("m",$basTar2).date("Y",$basTar2)]["price"]=0;
				$command2[date("d",$basTar2).date("m",$basTar2).date("Y",$basTar2)]["dates"]=date("W",$basTar2);
				$command2[date("d",$basTar2).date("m",$basTar2).date("Y",$basTar2)]["bkar"]=0;
			}elseif($raporlama==3){
				$command2[date("Y",$basTar2)]["price"]=0;
				$command2[date("Y",$basTar2)]["dates"]=date("Y",$basTar2);
				$command2[date("Y",$basTar2)]["bkar"]=0;
			}
				
			if($raporlama==9 || $raporlama==2)
				$basTar2=strtotime ( '+1 Month' ,$basTar2) ;
			elseif($raporlama==0)
				$basTar2=strtotime ( '+1 Day' ,$basTar2) ;
			elseif($raporlama==1)
				$basTar2=strtotime ( '+1 Week' ,$basTar2) ;
			elseif($raporlama==3)
				$basTar2=strtotime ( '+1 Year' ,$basTar2) ;
		}
		
		
		return $command2;
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

?>
<?php

class BarcodeController extends Controller
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
	
	
	public function actionGetbarcode(){
		$controller=new Sitecontroller;
		$controller->barcodeGenerator($_GET["number"],$_GET["size"]);
	}
	
	
	public function actionGetqrbarcode(){
		$controller=new Sitecontroller;
		$controller->qrbarcodeGenerator($_GET["id"],$_GET["number"],$_GET["size"]);
	
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
<?php


class EmailIdentity 
{
	
	public function sendMailonay($model,$link){
		$html=Yii::getPathOfAlias('webroot')."/mailsablons/mailonay.html";
		$controller= new Sitecontroller;
		
		$mailServer=Mailserver::model()->findByPk($controller->getServerMail());
		
		$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
		$mailer->Host  = $mailServer->mailserver;
		$mailer->Username =$mailServer->mailuser;
		$mailer->Password =$mailServer->mailparola;
		$mailer->IsSMTP(); // telling to send this mail using SMTP
		$mailer->CharSet = 'UTF-8';
		$mailer->AddAddress($model->email);
		$mailer->From =$mailServer->mailuser;
		$mailer->FromName=$this->getParams('mailtitle');
		$mailer->Subject = $this->getParams('mailtitle').' '.Yii::t('trans','Hoşgeldiniz');
		$controller= new Sitecontroller;
		$search  = array('[webadress]','[webadressUrl]','[facebookUrl]','[facebookimage]','[tweetUrl]','[tweetimage]','[contact]','[contactUrl]','[contactimage]','[web]','[link]',,'[welcome]');
		
		$strLink=Yii::t('trans','Hesabınızı onaylamak için <a href="[link]" target="_blank">bu linke tıklamanız</a> yeterli.',array('[link]'=>$link));
		$replace = array(
			$controller->getServerName,$controller->getLink(),
			$this->getParams("facebook"),Yii::app()->baseUrl."mailsablons/icons/facebook.png",
			$this->getParams("tweet"),Yii::app()->baseUrl."mailsablons/icons/tweet.png",
			Yii::t('trans','İletişim'),$controller->getContact(),Yii::app()->baseUrl."mailsablons/icons/message.png",
			$controller->getLink(),$strLink,$this->getParams("welcome")
		);
		$mailer->MsgHTML(str_replace($search, $replace, $html));
		$mailer->Send();
	}


	public function sendMailpassword($model,$password){
		$html=Yii::getPathOfAlias('webroot')."/mailsablons/mailonay.html";
		$controller= new Sitecontroller;
		
		$mailServer=Mailserver::model()->findByPk($controller->getServerMail());
		
		$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
		$mailer->Host  = $mailServer->mailserver;
		$mailer->Username =$mailServer->mailuser;
		$mailer->Password =$mailServer->mailparola;
		$mailer->IsSMTP(); // telling to send this mail using SMTP
		$mailer->CharSet = 'UTF-8';
		$mailer->AddAddress($model->email);
		$mailer->From =$mailServer->mailuser;
		$mailer->FromName=$this->getParams('mailtitle');
		$mailer->Subject = $this->getParams('mailtitle').' '.Yii::t('trans','Hoşgeldiniz');
		$controller= new Sitecontroller;
		$search  = array('[webadress]','[webadressUrl]','[facebookUrl]','[facebookimage]','[tweetUrl]','[tweetimage]','[contact]','[contactUrl]','[contactimage]','[web]','[password]','[email]','[welcome]');
		$replace = array(
			$controller->getServerName,$controller->getLink(),
			$this->getParams("facebook"),Yii::app()->baseUrl."mailsablons/icons/facebook.png",
			$this->getParams("tweet"),Yii::app()->baseUrl."mailsablons/icons/tweet.png",
			Yii::t('trans','İletişim'),$controller->getContact(),Yii::app()->baseUrl."mailsablons/icons/message.png",
			$controller->getLink(),Yii::t('trans','Parola').": ".$password,Yii::t('trans','Kullanıcı').': '.$model->email,$this->getParams("welcome")
		);
		$mailer->MsgHTML(str_replace($search, $replace, $html));
		$mailer->Send();
	}

	
		
	public function getParams($param){
		$params = new Params;
		return $params->get($param);
	}
	
	public function getParams_($param,$id){
		$params = new Params;
		$array=$params->get($param);
		return $array[$id];
	}
	
}
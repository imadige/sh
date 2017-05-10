<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		
		$modelEmployees=Employees::model()->find("email=:user and password=:password and deleted=1",array(":user"=>$this->username,":password"=>md5(sha1(md5(base64_encode(md5(sha1(md5($this->password)))))))));
		if(count($modelEmployees)>0){
			$modelCompanies=Companies::model()->findByPk($modelEmployees->companyID);
			
			if($modelCompanies->deleted==1){
				$this->loginSession($modelCompanies,$modelEmployees);
				$this->errorCode=self::ERROR_NONE;
			}else
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		
		else
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			
		return !$this->errorCode;
	}
	
	private function GetIP(){
		if(getenv("HTTP_CLIENT_IP")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
			if (strstr($ip, ',')) {
				$tmp = explode (',', $ip);
				$ip = trim($tmp[0]);
			}
		} else {
		$ip = getenv("REMOTE_ADDR");
		}
		return $ip;
	}
	
	private function loginSession($modelCompanies,$modelEmployees){
		$modelEmployeesstatus=new Employeesstatus;
		$modelEmployeesstatus->employeesID=$modelEmployees->employeesID;
		$modelEmployeesstatus->ip=$this->GetIP();
		$modelEmployeesstatus->dateAdd=date("Y-m-d H:i:s");
		$modelEmployeesstatus->save();
		$this->setState('ADMIN',$modelEmployees->erights);
		$this->setState('ID',$modelEmployees->employeesID);
		$this->setState('companyID',$modelCompanies->companyID);
		$this->setState('nameSurname',$modelEmployees->name);
		$this->setState('title',$modelEmployees->title);
		$this->setState('status',$modelEmployees->status);
		$this->setState('country',$modelCompanies->country);
		$modelWorld=World::model()->find("status=1 AND companyID=".$modelCompanies->companyID);
		$modelCompanysettings=Companysettings::model()->find("companyID=:companyID",array(":companyID"=>$modelCompanies->companyID));
		Yii::app()->user->setState('worldID',$modelWorld->worldID);
		Yii::app()->user->setState('companyCur',$modelCompanysettings->cur);
		Yii::app()->user->setState('companyCurText',$this->getParams_("currency",$modelCompanysettings->cur));
		
		
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
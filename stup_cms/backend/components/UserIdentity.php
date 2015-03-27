<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	const ERROR_EMAIL_INVALID=3;
	const ERROR_STATUS_NOTACTIV=4;
	const ERROR_STATUS_BAN=5;
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
		if (strpos($this->username,"@")) {
			$user=User::model()->notsafe()->findByAttributes(array('email'=>$this->username));
		} else {
			$user=User::model()->notsafe()->findByAttributes(array('username'=>$this->username));
		}
		if($user===null)
			if (strpos($this->username,"@")) {
				$this->errorCode=self::ERROR_EMAIL_INVALID;
			} else {
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			}
		else if(ApplicationConfig::encrypting($this->password)!==$user->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($user->status==0)
			$this->errorCode=self::ERROR_STATUS_NOTACTIV;
		else if($user->status==-1)
			$this->errorCode=self::ERROR_STATUS_BAN;
		else {
			$this->_id=$user->id;
			$this->username=$user->username;
			$this->setIdentity($user);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
    
    /**
    * @return integer the ID of the user record
    */
	public function getId()
	{
		return $this->_id;
	}
  	public function setIdentity($user)
    {
    	$session=new CHttpSession;
 		$session->open();
    	
        ApplicationSessions::run()->write('id', $user->id);
        ApplicationSessions::run()->write('role', $user->role);
        ApplicationSessions::run()->write('email', $user->email);
        
        $permission = array();
        $roles = explode(",", ApplicationSessions::run()->read('role'));
        foreach ($roles as $roleKey => $roleValue){
			$roleDetails = RolePermission::model()->getModel('ROLE-ID',array('roleID'=>$roleValue));
			$permission[] = $roleDetails->permissionName;
		} 
		//var_dump($permission);exit;
		ApplicationSessions::run()->write('permissions', $permission);
		ApplicationSessions::run()->write('usersessiontimeout', time()+60*60);
		//ApplicationConfig::app()->params['user']['permissions'] = $permission;
        return true;
    }
}
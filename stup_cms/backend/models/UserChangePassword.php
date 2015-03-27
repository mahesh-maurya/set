<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class UserChangePassword extends CFormModel {
	public $oldPassword;
	public $password;
	public $verifyPassword;
	const REGEX_SPECIAL_CHARS = '!@#$%&_';
	
	
	public function rules() {
		
		return Yii::app()->controller->id == 'recovery' ? array(
			array('password, verifyPassword', 'required'),
			array('password, verifyPassword', 'length', 'max'=>128, 'min' => 8,'message' => "Incorrect password (minimal length 8 symbols)."),
			array('password', 'passwordregexvalidation'),
			//array('password', 'match', 'pattern'=>$regularExpressionPattern, 'skipOnError'=>true, 'message'=>'Password must have at least one upper case Letter,one lower case letter, number and one special character out of set ['.self::REGEX_SPECIAL_CHARS.']'),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => "Retype Password is incorrect."),
		) : array(
			array('oldPassword, password, verifyPassword', 'required'),
			array('oldPassword, password, verifyPassword', 'length', 'max'=>128, 'min' => 8,'message' => "Incorrect password (minimal length 8 symbols)."),
			//array('password', 'match', 'pattern'=>$regularExpressionPattern, 'skipOnError'=>true, 'message'=>'Password must have at least one upper case Letter,one lower case letter, number and one special character out of set ['.self::REGEX_SPECIAL_CHARS.']'),
			array('password', 'passwordregexvalidation'),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => "Retype Password is incorrect."),
			array('oldPassword', 'verifyOldPassword'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	
	public function passwordregexvalidation($attribute,$params)
	{
		//$regularExpressionPattern = '/.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*['.(self::REGEX_SPECIAL_CHARS).']).*/';
		$cnt=0;
		$regularExpressionPattern1 = '/.*(?=.*[a-z]).*/';
		$regularExpressionPattern2 = '/.*(?=.*[A-Z]).*/';
		$regularExpressionPattern3 = '/.*(?=.*['.(self::REGEX_SPECIAL_CHARS).']).*/';
		$regularExpressionPattern4 = '/.*(?=.*\d).*/';
		
 		if(!preg_match($regularExpressionPattern1, $this->$attribute))
 		{
 			$cnt++;
 		}
		if(!preg_match($regularExpressionPattern2, $this->$attribute))
 		{
 			$cnt++;
 		} 
		if(!preg_match($regularExpressionPattern3, $this->$attribute))
 		{
 			$cnt++;
 		}
		if(!preg_match($regularExpressionPattern4, $this->$attribute))
 		{
 			$cnt++;
 		}
 		
 		if($cnt > 1)
 		{
    		$this->addError($attribute, 'Password must have at least one upper case Letter,one lower case letter, number and one special character out of set ['.self::REGEX_SPECIAL_CHARS.']');
 		}
	}
	public function attributeLabels()
	{
		return array(
			'oldPassword'=>"Old Password",
			'password'=>"password",
			'verifyPassword'=>"Retype Password",
		);
	}
	
	/**
	 * Verify Old Password
	 */
	 public function verifyOldPassword($attribute, $params)
	 {
		 if (User::model()->notsafe()->findByPk(Yii::app()->user->id)->password != ApplicationConfig::encrypting($this->$attribute))
			 $this->addError($attribute, "Old Password is incorrect.");
	 }
}
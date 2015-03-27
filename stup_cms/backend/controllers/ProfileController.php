<?php

class ProfileController extends Controller
{
	public $defaultAction = 'profile';
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	/**
	 * Shows a particular model.
	 */
	public function accessRules()
	{
		return Yii::app()->GetAccessRule->get();
	}
	public function actionProfile()
	{
		$model = $this->loadUser();
	    $this->render('profile',array(
	    	'model'=>$model,
			'profile'=>$model->profile,
	    ));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		$model = $this->loadUser();
		$profile=$model->profile;
		
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}
		
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$model->save();
				$profile->save();
                Yii::app()->user->updateSession();
				Yii::app()->user->setFlash('profileMessage',"Changes is saved.");
				$this->redirect(array('/profile'));
			} else $profile->validate();
		}

		$this->render('edit',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}
	
	/**
	 * Change password
	 */
	public function actionChangepassword() {
		
		$flag = 0;
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
						//print_r($model);exit;
						
						$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
						$new_password->password = ApplicationConfig::encrypting($model->password);
						$new_password->activkey=ApplicationConfig::encrypting(microtime().$model->password);
						
						$chkhistory=Passwordhistory::model()->findAll(array('condition'=>'user_id='.Yii::app()->user->id));
						
						//print_r($chkhistory[0]);exit;
						
						foreach($chkhistory as $k => $v)
						{
							if($v->password == $new_password->password)
							{
								$flag = 1;break;
							}
						}
						
						$flag = 0;
						if($flag == 0)
						{
							if($new_password->save())
							{
								$historycnt=Passwordhistory::model()->count(array('condition'=>'user_id='.Yii::app()->user->id));
								if($historycnt < 12)
								{
									$history=new Passwordhistory;
								}
								else 
								{
									$history = Passwordhistory::model()->find(array('order'=>"created_at asc",'condition'=>'user_id='.Yii::app()->user->id));
								}
								
								$history->user_id=$new_password->id;
								$history->password=$new_password->password;
								$history->created_at=date('Y-m-d H:i:s');
								$history->save();
								
								if($_SESSION['role']!=15)
								{
									Yii::app()->user->setFlash('profileMessage',"New password is saved.");
									$this->redirect(array("profile"));
								}
								else
								{
									Yii::app()->user->setFlash('profileMessage',"New password is saved.");
									$this->render('changepassword',array('model'=>$model,'flag'=>$flag));
								}
							}
							else 
							{
							 	print_r($new_password->getErrors()); exit;
							}
						}
						
					}
			}
			$this->render('changepassword',array('model'=>$model,'flag'=>$flag));
	    }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id)
			{
				$ob = new User();
				$this->_model= $ob->getModel('BYID',array('id'=>Yii::app()->user->id));
			}	
			if($this->_model===null)
				$this->redirect(Yii::app()->createAbsoluteUrl( '/site/index', array(), 'http' ));
		}
		return $this->_model;
	}
}
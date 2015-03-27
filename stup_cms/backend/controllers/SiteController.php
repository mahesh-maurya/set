<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/24/12
 * Time: 1:21 AM
 */

class SiteController extends Controller
{
	/**
	 * @return array list of action filters (See CController::filter)
	 */
	public function filters()
	{
		return array('accessControl');
	}

	/**
	 * @return array rules for the "accessControl" filter.
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login'),
				'users'=>array('*'),
			),
			
		);
	}

	/**
	 *
	 * @return array actions
	 */
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
				'foreColor' => 0x0099CC,
			),
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	/**
	 * Renders index page
	 */
	public function actionIndex()
	{
		if (Yii::app()->user->isGuest) 
		{
			$this->redirect(Yii::app()->createAbsoluteUrl( '/site/login', array(), 'http' ));
		}
		else
		{
			if($_SESSION['role']=='15')
			{
				$this->redirect(Yii::app()->createAbsoluteUrl( '/frontpagesliderimage/admin', array(), 'http' ));
			}
			else
			{
				$this->render('index');
			}	
		}		
	}

	/**
	 * Renders contact page
	 * todo: does nothing but rendering, proper functionality to be created
	 */
	

	/**
	 * Action to render the error
	 * todo: design proper error page
	 */
	public function actionError()
	{
		if ($error = app()->errorHandler->error)
		{
			if (app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Action to render login form or handle user's login
	 * and redirection
	 */
	public function actionLogin()
	{
		
				
		$d = new DateTime(date('Y-m-d H:i:s'));
		$d->setTimezone( new DateTimeZone('Asia/Kolkata'));
		$tsp1 = $d->getTimestamp();
						
		if(!isset(Yii::app()->user->login_attempt_time) || Yii::app()->user->login_attempt_time == '')
		Yii::app()->user->setState('login_attempt_time',$tsp1 + 15*60 + 10);
				
		if(!isset(Yii::app()->user->login_attempt) || Yii::app()->user->login_attempt == '')
		Yii::app()->user->setState('login_attempt',0);
				
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			
			if(isset($_POST['UserLogin']))
			{
				//if(Yii::app()->user->login_attempt >=4)
				//Yii::app()->user->setState('login_attempt',0);
				
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
					if($model->validate()) 
					{
						Yii::app()->user->setState('login_attempt',0);
						Yii::app()->user->setState('login_attempt_time',$tsp1 + 1*60 + 10);
						
						$historycont = Passwordhistory::model()->count(array('order'=>"created_at desc",'condition'=>'user_id='.Yii::app()->user->id));
						if($historycont == 0)
						{
							$udata = User::model()->notsafe()->findByPk(Yii::app()->user->id);
								
							$history=new Passwordhistory;
							$history->user_id = Yii::app()->user->id;
							$history->password = $udata->password;
							$history->created_at = $udata->create_at;
							$history->save();
						}
							
						
						$history = Passwordhistory::model()->find(array('order'=>"created_at desc",'condition'=>'user_id='.Yii::app()->user->id));
						$d = new DateTime($history->created_at);
						$d->setTimezone( new DateTimeZone('Asia/Kolkata'));
						$tsp2 = $d->getTimestamp();
						/*if(($tsp1-$tsp2) >= 45*24*60*60 ) 
						{
							ApplicationSessions::run()->delete('permissions');
							$this->render('passwordexp');exit;
						}
						else 
						{
							
							$this->lastViset();
							if (Yii::app()->user->returnUrl=='/index.php')
								$this->redirect(Yii::app()->createAbsoluteUrl( '/site/index', array(), 'http' ));
							else
								$this->redirect(Yii::app()->createAbsoluteUrl( '/site/index', array(), 'http' ));
						}*/
						$this->lastViset();
							if (Yii::app()->user->returnUrl=='/index.php')
								$this->redirect(Yii::app()->createAbsoluteUrl( '/site/index', array(), 'http' ));
							else
								$this->redirect(Yii::app()->createAbsoluteUrl( '/site/index', array(), 'http' ));
					}
					else 
					{
						Yii::app()->user->setState('login_attempt',Yii::app()->user->login_attempt+1);
						$d = new DateTime(date('Y-m-d H:i:s'));
						$d->setTimezone( new DateTimeZone('Asia/Kolkata'));
						$tsp = $d->getTimestamp();
						
						Yii::app()->user->setState('login_attempt_time',$tsp);
					}
					
				
			}
			// display the login form
			
				
			if(Yii::app()->user->login_attempt <= 2)
			{
				
				$this->render('login',array('model'=>$model));exit;
				
			}
			else 
			{		//echo ($tsp1 - Yii::app()->user->login_attempt_time);
					//echo '</br>'.Yii::app()->user->login_attempt;exit;
					// && 
					if(($tsp1 - Yii::app()->user->login_attempt_time) < 15*60)
					{
						$this->render('loginlastattemp');exit;
					}
					else 
					{
						$this->render('login',array('model'=>$model));exit;
					}
			}
		
		}
		else
		{
				
				$history = Passwordhistory::model()->find(array('order'=>"created_at desc",'condition'=>'user_id='.Yii::app()->user->id));
				$d = new DateTime($history->created_at);
				$d->setTimezone( new DateTimeZone('Asia/Kolkata'));
				$tsp2 = $d->getTimestamp();
				/*if(($tsp1-$tsp2) >= 45*24*60*60 ) 
				{
					ApplicationSessions::run()->delete('permissions');
      				$this->render('passwordexp');exit;
				}
				else 
				{
					$this->redirect(Yii::app()->createAbsoluteUrl( '/site/index', array(), 'http' ));
				}*/
				$this->redirect(Yii::app()->createAbsoluteUrl( '/site/index', array(), 'http' ));	
		}	
		
		
		/*$model = new LoginForm();

		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate($model, array('username', 'password', 'verifyCode'));
			Yii::app()->end();
		}

		if (isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			if ($model->validate(array('username', 'password', 'verifyCode')) && $model->login())
				$this->redirect(user()->returnUrl);
		}

		$sent = r()->getParam('sent', 0);
		$this->render('login', array(
			'model' => $model,
			'sent' => $sent,
		)); */
	}

	/**
	 * This is the action that handles user's logout
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		Yii::app()->user->setState('login_attempt',0);
		
		$d = new DateTime(date('Y-m-d H:i:s'));
		$d->setTimezone( new DateTimeZone('Asia/Kolkata'));
		$tsp1 = $d->getTimestamp();
		Yii::app()->user->setState('login_attempt_time',$tsp1 + 1*60 + 10);
		$this->redirect(Yii::app()->createAbsoluteUrl( '/site/login', array(), 'http' ));
	}

	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}
	
	public function actionClearassets($filename = 'ALL')
	{
    	if ($filename == 'ALL')
		{
    		ApplicationConfig::deleteDir($dirPath = YiiBase::getPathOfAlias('webroot.assets') . '/');
    		echo "success";
    	}
    	else
    	{
    		//var_dump($filename);exit;
    		ApplicationConfig::deleteFile($dirPath = YiiBase::getPathOfAlias('webroot.assets') . '/',$filename);
    	}
	}
	
	public function actionClearcache($filename = 'ALL')
	{
     	Yii::app()->cache->flush();
     	echo "success";
	}
	
	public function actionDbbackup()
	{
     	$this->redirect(ApplicationConfig::getURL('backup', '', ''));
	}
	
}
<?php

class AdminController extends Controller
{
	public $defaultAction = 'admin';
	public $layout='//layouts/column2';
	
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
public function accessRules()
	{
		return Yii::app()->GetAccessRule->get();
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('index',array(
            'model'=>$model,
        ));
		/*$dataProvider=new CActiveDataProvider('User', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));//*/
	}


	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		
		$profile=new Profile;
		$history=new Passwordhistory;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if (!empty($_POST['User']['role']))
			$model->role = implode(",", $_POST['User']['role']);
			else 
			$model->role = "";
			
			if($model->password !="")
			$model->activkey=ApplicationConfig::encrypting(microtime().$model->password);
			
			$profile->attributes=$_POST['Profile'];
			$profile->user_id=0;
			$history->user_id=0;
			
			if($model->validate() && $profile->validate() && $history->validate()) {
				
				$char = "!@#$%&_";
				$cnt=0;
				$regularExpressionPattern1 = '/.*(?=.*[a-z]).*/';
				$regularExpressionPattern2 = '/.*(?=.*[A-Z]).*/';
				$regularExpressionPattern3 = '/.*(?=.*['.($char).']).*/';
				$regularExpressionPattern4 = '/.*(?=.*\d).*/';
				
		 		if(!preg_match($regularExpressionPattern1, $model->password))
		 		{
		 			$cnt++;
		 		}
				if(!preg_match($regularExpressionPattern2, $model->password))
		 		{
		 			$cnt++;
		 		} 
				if(!preg_match($regularExpressionPattern3, $model->password))
		 		{
		 			$cnt++;
		 		}
				if(!preg_match($regularExpressionPattern4, $model->password))
		 		{
		 			$cnt++;
		 		}
		 		
		 		if($cnt > 1)
		 		{
		 			$model->addError('password','Password must have at least one upper case Letter,one lower case letter, number and one special character out of set ['.$char.']');
				
				}
				else 
				{
				
					$model->password=ApplicationConfig::encrypting($model->password);
					if($model->save()) {
						
						$profile->user_id=$model->id;
						$profile->save();
						
						$history->user_id=$model->id;
						$history->password=$model->password;
						$history->created_at=$model->create_at;
						$history->save();
					}
					$this->redirect(array('admin','id'=>$model->id));
				}
			} else $profile->validate();
		}

		$this->render('create',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		$profile=$model->profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if (!empty($_POST['User']['role']))
			$model->role = implode(",", $_POST['User']['role']);
			else 
			$model->role = "";
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$old_password = User::model()->notsafe()->findByPk($model->id);
				if ($old_password->password!=$model->password) {
					$model->password=ApplicationConfig::encrypting($model->password);
					$model->activkey=ApplicationConfig::encrypting(microtime().$model->password);
				}
				$model->save();
				$profile->save();
				$this->redirect(array('admin','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('update',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel();
			$profile = Profile::model()->findByPk($model->id);
			$profile->delete();
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->notsafe()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
}
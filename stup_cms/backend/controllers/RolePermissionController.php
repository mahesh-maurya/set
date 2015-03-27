<?php

class RolePermissionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return Yii::app()->GetAccessRule->get();
		return array();
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RolePermission;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RolePermission']))
		{
			$model->attributes=$_POST['RolePermission'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->rolePermissionID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RolePermission']))
		{
			$model->attributes=$_POST['RolePermission'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->rolePermissionID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
		$controllerList = array();
		$model_arr = array();
		$role = Role::getList('ALL',array());
		$permission_arr = array();
		$per_arr =array();
		
		//echo $per_arr[0][roleID];
		$module = '';
	    $controllervalue = Metadata::app()->getControllers();
		foreach ($controllervalue as $value)
	    {	
	       $controllerList[$value] = $value; 
	    }
	   	
        if(isset($_POST['yt0']))
        {		
        	//echo '<pre>'; print_r($_POST);exit;
        	if(!empty($_POST['role']))
        	{	
        		foreach($_POST['role'] as $key => $permvalue)
        		{	
        			$exists=RolePermission::model()->find('roleID=?',array($key));
        			if($exists){
        				$model = $this->loadModelbyrole($key);
        				$model->permissionName = implode(",",$permvalue);
						$model->save();
        			} else {
        				$model = new RolePermission();
        				$model->roleID = $key;
        				$model->permissionName = implode(",",$permvalue);
						$model->save();
        			}
        			
        		} 
        	}	
        }
		$rolepermission = RolePermission::getList('ALL',array());
		//print_r($rolepermission[0]->attributes);exit;
		foreach($rolepermission  as $rolepermissionKey => $rolepermissionValue){
			$permission_arr[$rolepermissionValue->roleID] = explode(",",$rolepermissionValue->permissionName);
			
		}
		
		$this->render('index',array(
			'module'=>$module,
			'controllerList'=>$controllerList,
			'role'=>$role,
			'rolepermission'=>$rolepermission,
			'permission_arr'=>$permission_arr,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RolePermission('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RolePermission']))
			$model->attributes=$_GET['RolePermission'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RolePermission the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RolePermission::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelbyrole($id)
	{
		$model=RolePermission::model()->find('roleID=:roleID',array(':roleID'=>$id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RolePermission $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='role-permission-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

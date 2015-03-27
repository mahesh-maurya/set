<?php

class MenusController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
		$model=new Menus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Menus']))
		{
			$model->attributes=$_POST['Menus'];
			$modelObject = CUploadedFile::getInstance($model, 'menu_image');
            $model->menu_image = $modelObject;
            $type = explode(".", $modelObject);
            //echo "<pre>";print_r($modelObject);exit;

            if(!empty($modelObject))
            {
            	$ext = explode("/", $modelObject->type);
				$image_n=md5($modelObject->name . time());
                $image_name = $image_n . '.' . $ext[1];
                $model->menu_image = $image_name;
                $modelObject->saveAs(ApplicationConfig::app()->params['folder_path']['MenuOriginal'] .
                    $image_name);
            }
		    if($model->save())
			{
				if($model->parentID == "")
				$model->parentID=0;
				
				$this->redirect(ApplicationConfig::getURL("user", "menus", "admin",array('id'=>$model->main_menuID,'pid'=>$model->parentID)));
			}
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
		$previouspic_name = $model->menu_image;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Menus']))
		{
			$model->attributes=$_POST['Menus'];
			$modelObject = CUploadedFile::getInstance($model, 'menu_image');
            $type = explode(".", $modelObject);

            if(!empty($modelObject))
            {
            	$ext = explode("/", $modelObject->type);
				$image_n=md5($modelObject->name . time());
                $image_name =  $image_n . '.' . $ext[1];
                $model->menu_image = $image_name;
                if (file_exists(ApplicationConfig::app()->params['folder_path']['MenuOriginal'] . $previouspic_name))
                	unlink(ApplicationConfig::app()->params['folder_path']['MenuOriginal'] . $previouspic_name);
                $modelObject->saveAs(ApplicationConfig::app()->params['folder_path']['MenuOriginal'] .
                    $image_name);               
            }
            else 
            {
            	 $model->menu_image = $previouspic_name;
            }
			if($model->save())
				$this->redirect(ApplicationConfig::getURL("user", "menus", "admin",array('id'=>$model->main_menuID,'pid'=>$model->parentID)));
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
		$model = $this->loadModel($id);
		$model->delete();
		

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ApplicationConfig::getURL("user", "menus", "admin",array('id'=>$model->main_menuID,'pid'=>$model->parentID)));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Menus');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Menus('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Menus']))
			$model->attributes=$_GET['Menus'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Menus the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Menus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Menus $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='menus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionSort()
	{
	    if (isset($_POST['items']) && is_array($_POST['items'])) {
	        $i = 0;
	        foreach ($_POST['items'] as $item) {
	            $menu = Menus::model()->findByPk($item);
	            $menu->sortOrder = $i;
	            $menu->save();
	            $i++;
	        }
	    }
	}
	
	public function actionSortitems()
	{
		    if(isset($_POST))
		    {
		        	$model = Menus::model()->findByPk($_POST['id']);
		            $model->sortOrder = $_POST['val'];
		            $model->save();
		           	        
		    }
	}
}

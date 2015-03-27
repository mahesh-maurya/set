<?php
date_default_timezone_set("Asia/Kolkata");

class PagemasterController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return Yii::app()->GetAccessRule->get(); 
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new PageMaster;

		if(isset($_POST['PageMaster']))
		{
			$model->attributes=$_POST['PageMaster'];
			
			$model->url=!empty($_POST['PageMaster']['url'])?$_POST['PageMaster']['url']:"";
			$model->meta_description=!empty($_POST['PageMaster']['meta_description'])?$_POST['PageMaster']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['PageMaster']['meta_keyword'])?$_POST['PageMaster']['meta_keyword']:"";
			
			$pagename = $_POST['PageMaster']['page_name'];
			$select = array('page_name','slug', 'page_id');
            $condition = array('page_name');
            $params = array('page_name' => $_POST['PageMaster']['page_name']);
            $arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
                'page_master', $condition, $params, $select);
			if ($arrResult != "NO-MATCH")
            {
                $model->slug = $arrResult;
            }
			else
            {

                $slug = SlugGenerate::getFormattedSlug($pagename);
                $model->slug = $slug;
            }
			
			$model->created_date=date('Y-m-d H:i:s');
			if($model->save())
				$this->redirect(array('pagemaster/admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$old=$model->page_name;
		
		if(isset($_POST['PageMaster']))
		{
			$model->attributes=$_POST['PageMaster'];
			
			$model->url=!empty($_POST['PageMaster']['url'])?$_POST['PageMaster']['url']:"";
			$model->meta_description=!empty($_POST['PageMaster']['meta_description'])?$_POST['PageMaster']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['PageMaster']['meta_keyword'])?$_POST['PageMaster']['meta_keyword']:"";
			
			if($_POST['PageMaster']['page_name'] != $old)
			{			
				$pagename = $_POST['PageMaster']['page_name'];
				$select = array('page_name','slug', 'page_id');
				$condition = array('page_name');
				$params = array('page_name' => $_POST['PageMaster']['page_name']);
				$arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
					'page_master', $condition, $params, $select);
				if ($arrResult != "NO-MATCH")
				{
					$model->slug = $arrResult;
				}
				else
				{

					$slug = SlugGenerate::getFormattedSlug($pagename);
					$model->slug = $slug;
				}
			}
			
			$model->updated_date=date('Y-m-d H:i:s');
			
			if($model->save())
				$this->redirect(array('pagemaster/admin'));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('pagemaster/admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PageMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PageMaster']))
			$model->attributes=$_GET['PageMaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PageMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='page-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMakeinactive()
	{
		$get_page_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_page_master', array('status'=>'0'),'page_id=:page_id',array(':page_id'=>$get_page_id));
		$this->redirect(array('pagemaster/admin'));				
	}
	
	public function actionMakeactive()
	{
		$get_page_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_page_master', array('status'=>'1'),'page_id=:page_id',array(':page_id'=>$get_page_id));
		$this->redirect(array('pagemaster/admin'));
	}
}

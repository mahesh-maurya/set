<?php
date_default_timezone_set("Asia/Kolkata");

class StaticpageblockController extends Controller
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new StaticPageBlock;
		
		$getallpages=PageMaster::model()->findAll(array('condition'=>'status="1"'));
		$allpages=array();
		if(!empty($getallpages))
		{
			foreach($getallpages as $key=>$val)
			{
				$allpages[$val['slug']]=$val['page_name'];
			}
		}
		
		
		if(isset($_POST['StaticPageBlock']))
		{
			$model->attributes=$_POST['StaticPageBlock'];
			
			$model->url=!empty($_POST['StaticPageBlock']['url'])?$_POST['StaticPageBlock']['url']:"";
			$model->meta_description=!empty($_POST['StaticPageBlock']['meta_description'])?$_POST['StaticPageBlock']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['StaticPageBlock']['meta_keyword'])?$_POST['StaticPageBlock']['meta_keyword']:"";
			
			$title = $_POST['StaticPageBlock']['title'];
            $select = array('title','slug', 'static_page_id');
            $condition = array('title');
			$params = array('title' => $_POST['StaticPageBlock']['title']);
            $arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
                'static_page_block', $condition, $params, $select);
			if ($arrResult != "NO-MATCH")
            {
                $model->slug = $arrResult;
            }
			else
            {
                $slug = SlugGenerate::getFormattedSlug($title);
                $model->slug = $slug;
            }
			
			$model->created_date=date('Y-m-d H:i:s');
			
			if($model->save())
				$this->redirect(array('staticpageblock/admin'));
		}

		$this->render('create',array(
			'model'=>$model,
			'allpages'=>$allpages,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$old=$model->title;
		
		$getallpages=PageMaster::model()->findAll(array('condition'=>'status="1"'));
		$allpages=array();
		if(!empty($getallpages))
		{
			foreach($getallpages as $key=>$val)
			{
				$allpages[$val['slug']]=$val['page_name'];
			}
		}

		if(isset($_POST['StaticPageBlock']))
		{
			$model->attributes=$_POST['StaticPageBlock'];
			
			$model->url=!empty($_POST['StaticPageBlock']['url'])?$_POST['StaticPageBlock']['url']:"";
			$model->meta_description=!empty($_POST['StaticPageBlock']['meta_description'])?$_POST['StaticPageBlock']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['StaticPageBlock']['meta_keyword'])?$_POST['StaticPageBlock']['meta_keyword']:"";
			
			if($_POST['StaticPageBlock']['title'] != $old)
			{
				$title = $_POST['StaticPageBlock']['title'];
				$select = array('title','slug', 'static_page_id');
				$condition = array('title');
				$params = array('title' => $_POST['StaticPageBlock']['title']);
				$arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
					'static_page_block', $condition, $params, $select);
				if ($arrResult != "NO-MATCH")
				{
					$model->slug = $arrResult;
				}
				else
				{

					$slug = SlugGenerate::getFormattedSlug($title);
					$model->slug = $slug;
				}
			}
			
			$model->updated_date=date('Y-m-d H:i:s');
			
			if($model->save())
				$this->redirect(array('staticpageblock/admin'));
		}

		$this->render('update',array(
			'model'=>$model,
			'allpages'=>$allpages,
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
		$this->redirect(array('staticpageblock/admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StaticPageBlock('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StaticPageBlock']))
			$model->attributes=$_GET['StaticPageBlock'];

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
		$model=StaticPageBlock::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='static-page-block-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMakeinactive()
	{
		$get_static_page_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_static_page_block', array('status'=>'0'),'static_page_id=:static_page_id',array(':static_page_id'=>$get_static_page_id));
		$this->redirect(array('staticpageblock/admin'));				
	}
	
	public function actionMakeactive()
	{
		$get_static_page_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_static_page_block', array('status'=>'1'),'static_page_id=:static_page_id',array(':static_page_id'=>$get_static_page_id));
		$this->redirect(array('staticpageblock/admin'));
	}
}

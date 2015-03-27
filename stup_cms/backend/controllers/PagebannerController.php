<?php
date_default_timezone_set("Asia/Kolkata");

class PagebannerController extends Controller
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
		$model=new Pagebanner;
		
		$getallpages=PageMaster::model()->findAll(array('condition'=>'status="1"'));
		$allpages=array();
		if(!empty($getallpages))
		{
			foreach($getallpages as $key=>$val)
			{
				$allpages[$val['slug']]=$val['page_name'];
			}
		}

		if(isset($_POST['Pagebanner']))
		{
			$model->attributes=$_POST['Pagebanner'];
			
			$model->url=!empty($_POST['Pagebanner']['url'])?$_POST['Pagebanner']['url']:"";
			$model->meta_description=!empty($_POST['Pagebanner']['meta_description'])?$_POST['Pagebanner']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Pagebanner']['meta_keyword'])?$_POST['Pagebanner']['meta_keyword']:"";
			
			$getimage=CUploadedFile::getInstance($model,'image');
			$type_array = array("jpg","gif","png");
			if(!empty($getimage))
			{
				$name=$getimage->getName();
				$extension = substr($name, strpos($name, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					$name=time().'.'.$extension;
					$model->image=$name;
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
					}
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['page_banners']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['page_banners']);
					}
					$getimage->saveAs(ApplicationConfig::app()->params['folder_path']['page_banners'] . '/'. $name );
				}
			}
			
			$title = $_POST['Pagebanner']['title'];
            $select = array('title','slug', 'page_banner_id');
            $condition = array('title');
			$params = array('title' => $_POST['Pagebanner']['title']);
            $arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
                'page_banner', $condition, $params, $select);
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
				$this->redirect(array('pagebanner/admin'));
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
		$previmage=$model->image;
		
		$getallpages=PageMaster::model()->findAll(array('condition'=>'status="1"'));
		$allpages=array();
		if(!empty($getallpages))
		{
			foreach($getallpages as $key=>$val)
			{
				$allpages[$val['slug']]=$val['page_name'];
			}
		}
		
		if(isset($_POST['Pagebanner']))
		{
			$model->attributes=$_POST['Pagebanner'];
			
			$model->url=!empty($_POST['Pagebanner']['url'])?$_POST['Pagebanner']['url']:"";
			$model->meta_description=!empty($_POST['Pagebanner']['meta_description'])?$_POST['Pagebanner']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Pagebanner']['meta_keyword'])?$_POST['Pagebanner']['meta_keyword']:"";
			
			$temp= CUploadedFile::getInstance($model,'image');
			$type_array = array("jpg","gif","png");
			if(!empty($temp))
			{
				$name=$temp->getName();
				$extension = substr($name, strpos($name, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					$name=time().'.'.$extension;
					$model->image=$name;
					if($previmage != "")
					{
						if(file_exists(ApplicationConfig::app()->params['folder_path']['page_banners'].'/'. $previmage))
						{
							unlink(ApplicationConfig::app()->params['folder_path']['page_banners'].'/'. $previmage);
						}
					}
					
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
					}
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['page_banners']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['page_banners']);
					}
					$temp->saveAs(ApplicationConfig::app()->params['folder_path']['page_banners'] . '/'. $name );
				}
			}
			else 
			{
				$model->image=$previmage;
			}
			
			if($_POST['Pagebanner']['title'] != $old)
			{
				$title = $_POST['Pagebanner']['title'];
				$select = array('title','slug', 'page_banner_id');
				$condition = array('title');
				$params = array('title' => $_POST['Pagebanner']['title']);
				$arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
					'page_banner', $condition, $params, $select);
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
				$this->redirect(array('pagebanner/admin'));
		}

		$this->render('update',array(
			'model'=>$model,
			'allpages'=>$allpages,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel($id);
			$previmage = $model->image;
			$model->delete();
			
			if($previmage != "")
		 	{
				if(file_exists(ApplicationConfig::app()->params['folder_path']['page_banners'].'/'. $previmage))
				{
					unlink(ApplicationConfig::app()->params['folder_path']['page_banners'].'/'. $previmage);
				}
			}

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$this->redirect(array('pagebanner/admin'));
	}

	public function actionAdmin()
	{
		$model=new Pagebanner('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pagebanner']))
			$model->attributes=$_GET['Pagebanner'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Pagebanner::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pagebanner-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMakeinactive()
	{
		$get_page_banner_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_page_banner', array('status'=>'0'),'page_banner_id=:page_banner_id',array(':page_banner_id'=>$get_page_banner_id));
		$this->redirect(array('pagebanner/admin'));				
	}
	
	public function actionMakeactive()
	{
		$get_page_banner_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_page_banner', array('status'=>'1'),'page_banner_id=:page_banner_id',array(':page_banner_id'=>$get_page_banner_id));
		$this->redirect(array('pagebanner/admin'));
	}
}

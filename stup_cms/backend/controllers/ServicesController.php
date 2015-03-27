<?php
date_default_timezone_set("Asia/Kolkata");

class ServicesController extends Controller
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
		$model=new Services;
		
		$sectors=array();
		$getallsectors=Sectors::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallsectors))
		{
			foreach($getallsectors as $key=>$val)
			{
				$sectors[$val['sector_id']]=$val['title'];
			}
		}
		
		
		if(isset($_POST['Services']))
		{
			$model->attributes=$_POST['Services'];
			
			$model->url=!empty($_POST['Services']['url'])?$_POST['Services']['url']:"";
			$model->meta_description=!empty($_POST['Services']['meta_description'])?$_POST['Services']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Services']['meta_keyword'])?$_POST['Services']['meta_keyword']:"";
			$model->service_position=!empty($_POST['Services']['service_position'])?$_POST['Services']['service_position']:"";
			
			$model->sector_id=!empty($_POST['Services']['sector_id'])?$_POST['Services']['sector_id']:"";
			
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
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['services']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['services']);
					}
					$getimage->saveAs(ApplicationConfig::app()->params['folder_path']['services'] . '/'. $name );
				}
			}
			
			$title = $_POST['Services']['title'];
            $select = array('title','slug', 'service_id');
            $condition = array('title');
			$params = array('title' => $_POST['Services']['title']);
            $arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
                'services', $condition, $params, $select);
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
			{
				$this->JsonServices();
				$this->redirect(array('services/admin'));
			}	
		}

		$this->render('create',array(
			'model'=>$model,
			'sectors'=>$sectors,
		));
	}

	public function actionUpdate($id)
	{
		$sectors=array();
		$getallsectors=Sectors::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallsectors))
		{
			foreach($getallsectors as $key=>$val)
			{
				$sectors[$val['sector_id']]=$val['title'];
			}
		}
		
		$model=$this->loadModel($id);
		$old=$model->title;
		$previmage=$model->image;
		
		if(isset($_POST['Services']))
		{
			$model->attributes=$_POST['Services'];
			
			$model->url=!empty($_POST['Services']['url'])?$_POST['Services']['url']:"";
			$model->meta_description=!empty($_POST['Services']['meta_description'])?$_POST['Services']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Services']['meta_keyword'])?$_POST['Services']['meta_keyword']:"";
			$model->service_position=!empty($_POST['Services']['service_position'])?$_POST['Services']['service_position']:"";
			
			$model->sector_id=!empty($_POST['Services']['sector_id'])?$_POST['Services']['sector_id']:"";
			
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
						if(file_exists(ApplicationConfig::app()->params['folder_path']['services'].'/'. $previmage))
						{
							unlink(ApplicationConfig::app()->params['folder_path']['services'].'/'. $previmage);
						}
					}
					
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
					}
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['services']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['services']);
					}
					$temp->saveAs(ApplicationConfig::app()->params['folder_path']['services'] . '/'. $name );
				}
			}
			else 
			{
				$model->image=$previmage;
			}
			
			if($_POST['Services']['title'] != $old)
			{
				$title = $_POST['Services']['title'];
				$select = array('title','slug', 'service_id');
				$condition = array('title');
				$params = array('title' => $_POST['Services']['title']);
				$arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
					'services', $condition, $params, $select);
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
			{
				$this->JsonServices();
				$this->redirect(array('services/admin'));
			}	
		}

		$this->render('update',array(
			'model'=>$model,
			'sectors'=>$sectors,
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
				if(file_exists(ApplicationConfig::app()->params['folder_path']['services'].'/'. $previmage))
				{
					unlink(ApplicationConfig::app()->params['folder_path']['services'].'/'. $previmage);
				}
			}
			
			$this->JsonServices();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$this->redirect(array('services/admin'));
	}

	public function actionAdmin()
	{
		$sectors=array();
		$getallsectors=Sectors::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallsectors))
		{
			foreach($getallsectors as $key=>$val)
			{
				$sectors[$val['sector_id']]=$val['title'];
			}
		}
		$sector_start=array(''=>'All');
		$sectors_merge=$sector_start+$sectors;
		
		$model=new Services('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Services']))
			$model->attributes=$_GET['Services'];

		$this->render('admin',array(
			'model'=>$model,
			'sectors_merge'=>$sectors_merge,
		));
	}

	public function loadModel($id)
	{
		$model=Services::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='services-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMakeinactive()
	{
		$get_service_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_services', array('status'=>'0'),'service_id=:service_id',array(':service_id'=>$get_service_id));
		$this->JsonServices();				
		$this->redirect(array('services/admin'));				
	}
	
	public function actionMakeactive()
	{
		$get_service_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_services', array('status'=>'1'),'service_id=:service_id',array(':service_id'=>$get_service_id));
		$this->JsonServices();				
		$this->redirect(array('services/admin'));
	}
	
	public function JsonServices()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$services=array();
		
		$getallservices=Services::model()->findAll(array('condition'=>'status="1"','order'=>'service_position ASC'));
		
		$services=array();
		if(!empty($getallservices))
		{
			foreach($getallservices as $key=>$val)
			{
				$image_full_path=ApplicationConfig::app()->params["url_path"]["services"];				
				$services[$key]['service_id']=!empty($val['service_id'])?$val['service_id']:"";	
				
				$getsectordetails=Sectors::model()->findByPk($val['sector_id']);
				$services[$key]['sector_id']=!empty($getsectordetails['sector_id'])?$getsectordetails['sector_id']:"";	
				$services[$key]['sector_slug']=!empty($getsectordetails['slug'])?$getsectordetails['slug']:"";	
				
				$services[$key]['title']=!empty($val['title'])?$val['title']:"";
				$services[$key]['description']=!empty($val['description'])?$val['description']:"";	
				$services[$key]['image']=!empty($val['image'])?$image_full_path.$val['image']:"";
				$services[$key]['slug']=!empty($val['slug'])?$val['slug']:"";					
				$services[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";					
				$services[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";					
				$services[$key]['status']=!empty($val['status'])?$val['status']:"";					
				$services[$key]['url']=!empty($val['url'])?$val['url']:"";					
				$services[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";					
				$services[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
				$services[$key]['service_position']=isset($val['service_position'])?$val['service_position']:"";					
			}
		}
		
		$prepare_json_encode=json_encode($services);
		$create_json_file=file_put_contents($json_creation_path.'/'.'services.json', $prepare_json_encode);
	}
}
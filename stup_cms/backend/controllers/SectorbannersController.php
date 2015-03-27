<?php
date_default_timezone_set("Asia/Kolkata");

class SectorbannersController extends Controller
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
		$model=new Sectorbanners;

		$getallsectors=Sectors::model()->findAll(array('condition'=>'status="1"'));
		$allsectors=array();
		if(!empty($getallsectors))
		{
			foreach($getallsectors as $key=>$val)
			{
				$allsectors[$val['sector_id']]=$val['title'];
			}
		}
			
		if(isset($_POST['Sectorbanners']))
		{
			$model->attributes=$_POST['Sectorbanners'];
			
			$model->url=!empty($_POST['Sectorbanners']['url'])?$_POST['Sectorbanners']['url']:"";
			$model->meta_description=!empty($_POST['Sectorbanners']['meta_description'])?$_POST['Sectorbanners']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Sectorbanners']['meta_keyword'])?$_POST['Sectorbanners']['meta_keyword']:"";
			
			$getsectorslug=!empty($_POST['Sectorbanners']['sector_id'])?$_POST['Sectorbanners']['sector_id']:"0";
			$getsectordetails=Sectors::model()->findByPk($getsectorslug);
			$model->sector_slug=!empty($getsectordetails['slug'])?$getsectordetails['slug']:"";
			
			$getimage=CUploadedFile::getInstance($model,'image');
			$type_array = array("jpg","gif","png");
			if(!empty($getimage))
			{
				$name=$getimage->getName();
				$extension = substr($name, strpos($name, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					list($width, $height, $type, $attr) = getimagesize($getimage->tempName);
					if($width==1200 && $height==276)
					{
						$name=time().'.'.$extension;
						$model->image=$name;
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['page_banners']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['sector_banners']);
						}
						$getimage->saveAs(ApplicationConfig::app()->params['folder_path']['sector_banners'] . '/'. $name );
					}
				}
			}
			
			$title = $_POST['Sectorbanners']['title'];
            $select = array('title','slug', 'sector_banner_id');
            $condition = array('title');
			$params = array('title' => $_POST['Sectorbanners']['title']);
            $arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
                'sector_banners', $condition, $params, $select);
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
				$this->Sectorbanners();	
				$this->JsonSectors();	
				$this->redirect(array('sectorbanners/admin'));
			}	
		}

		$this->render('create',array(
			'model'=>$model,
			'allsectors'=>$allsectors,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$old=$model->title;
		$previmage=$model->image;
		
		$getallsectors=Sectors::model()->findAll(array('condition'=>'status="1"'));
		$allsectors=array();
		if(!empty($getallsectors))
		{
			foreach($getallsectors as $key=>$val)
			{
				$allsectors[$val['sector_id']]=$val['title'];
			}
		}
		
		if(isset($_POST['Sectorbanners']))
		{
			$model->attributes=$_POST['Sectorbanners'];
			
			$model->url=!empty($_POST['Sectorbanners']['url'])?$_POST['Sectorbanners']['url']:"";
			$model->meta_description=!empty($_POST['Sectorbanners']['meta_description'])?$_POST['Sectorbanners']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Sectorbanners']['meta_keyword'])?$_POST['Sectorbanners']['meta_keyword']:"";
			
			$getsectorslug=!empty($_POST['Sectorbanners']['sector_id'])?$_POST['Sectorbanners']['sector_id']:"0";
			$getsectordetails=Sectors::model()->findByPk($getsectorslug);
			$model->sector_slug=!empty($getsectordetails['slug'])?$getsectordetails['slug']:"";
			
			$temp= CUploadedFile::getInstance($model,'image');
			$type_array = array("jpg","gif","png");
			if(!empty($temp))
			{
				$name=$temp->getName();
				$extension = substr($name, strpos($name, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					list($width, $height, $type, $attr) = getimagesize($temp->tempName);
					if($width==1200 && $height==276)
					{
						$name=time().'.'.$extension;
						$model->image=$name;
						if($previmage != "")
						{
							if(file_exists(ApplicationConfig::app()->params['folder_path']['sector_banners'].'/'. $previmage))
							{
								unlink(ApplicationConfig::app()->params['folder_path']['sector_banners'].'/'. $previmage);
							}
						}
						
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['sector_banners']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['sector_banners']);
						}
						$temp->saveAs(ApplicationConfig::app()->params['folder_path']['sector_banners'] . '/'. $name );
					}
				}
			}
			else 
			{
				$model->image=$previmage;
			}
			
			if($_POST['Sectorbanners']['title'] != $old)
			{
				$title = $_POST['Sectorbanners']['title'];
				$select = array('title','slug', 'sector_banner_id');
				$condition = array('title');
				$params = array('title' => $_POST['Sectorbanners']['title']);
				$arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
					'sector_banners', $condition, $params, $select);
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
				$this->Sectorbanners();
				$this->JsonSectors();		
				$this->redirect(array('sectorbanners/admin'));
			}	
		}

		$this->render('update',array(
			'model'=>$model,
			'allsectors'=>$allsectors,
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
				if(file_exists(ApplicationConfig::app()->params['folder_path']['sector_banners'].'/'. $previmage))
				{
					unlink(ApplicationConfig::app()->params['folder_path']['sector_banners'].'/'. $previmage);
				}
			}
			
			$this->Sectorbanners();	
			$this->JsonSectors();	

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$this->redirect(array('sectorbanners/admin'));
	}

	public function actionAdmin()
	{
		$getallsectors=Sectors::model()->findAll(array('condition'=>'status="1"'));
		$allsectors=array();
		if(!empty($getallsectors))
		{
			foreach($getallsectors as $key=>$val)
			{
				$allsectors[$val['sector_id']]=$val['title'];
			}
		}
		
		$sector_start=array('0'=>'All');
		//$sectors_merge=array_merge($sector_start,$allsectors);
		$sectors_merge=$sector_start+$allsectors;
		
		//echo "<pre>";print_r($sectors_merge);exit;
		
		$model=new Sectorbanners('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Sectorbanners']))
			$model->attributes=$_GET['Sectorbanners'];

		$this->render('admin',array(
			'model'=>$model,
			'sectors_merge'=>$sectors_merge,
		));
	}

	public function loadModel($id)
	{
		$model=Sectorbanners::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sectorbanners-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMakeinactive()
	{
		$get_sector_banner_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_sector_banners', array('status'=>'0'),'sector_banner_id=:sector_banner_id',array(':sector_banner_id'=>$get_sector_banner_id));
		$this->Sectorbanners();		
		$this->JsonSectors();				
		$this->redirect(array('sectorbanners/admin'));				
	}
	
	public function actionMakeactive()
	{
		$get_sector_banner_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_sector_banners', array('status'=>'1'),'sector_banner_id=:sector_banner_id',array(':sector_banner_id'=>$get_sector_banner_id));
		$this->Sectorbanners();	
		$this->JsonSectors();					
		$this->redirect(array('sectorbanners/admin'));
	}
	
	public function JsonSectors()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$sectors=array();
		
		$getallsectors=Sectors::model()->findAll(array('condition'=>'status="1"','order'=>'position ASC'));
		if(!empty($getallsectors))
		{
			foreach($getallsectors as $key=>$val)
			{
				$image_full_path_sectorbanner=ApplicationConfig::app()->params["url_path"]["sector_banners"];
				$image_full_path=ApplicationConfig::app()->params["url_path"]["sectors"];
				$image_full_path_small=ApplicationConfig::app()->params["url_path"]["sectors_small"];
				$sectors[$key]['sector_id']=!empty($val['sector_id'])?$val['sector_id']:"";
				
				$getsectorbanner=Sectorbanners::model()->findAll(array('condition'=>'sector_id="'.$val['sector_id'].'" AND status="1"'));
				$sectors[$key]['sector_banner']=!empty($getsectorbanner[0]['image'])?$image_full_path_sectorbanner.$getsectorbanner[0]['image']:"";
				
				$sectors[$key]['title']=!empty($val['title'])?$val['title']:"";
				$sectors[$key]['description']=!empty($val['description'])?$val['description']:"";
				$sectors[$key]['image']=!empty($val['image'])?$image_full_path.$val['image']:"";
				$sectors[$key]['image_small']=!empty($val['thumbnail_image'])?$image_full_path_small.$val['thumbnail_image']:"";
				$sectors[$key]['slug']=!empty($val['slug'])?$val['slug']:"";
				$sectors[$key]['slider_option']=!empty($val['slider_option'])?$val['slider_option']:"";
				$sectors[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";
				$sectors[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";
				$sectors[$key]['status']=!empty($val['status'])?$val['status']:"";
				$sectors[$key]['url']=!empty($val['url'])?$val['url']:"";
				$sectors[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";
				$sectors[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
				$sectors[$key]['position']=!empty($val['position'])?$val['position']:"";
			}
		}
		
		$prepare_json_encode=json_encode($sectors);
		$create_json_file=file_put_contents($json_creation_path.'/'.'sectors.json', $prepare_json_encode);
	}
	
	public function Sectorbanners()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$sectorbanners_array=array();
		
		$getallsectorbanners=Sectorbanners::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallsectorbanners))
		{
			foreach($getallsectorbanners as $key=>$val)
			{
				$image_full_path=ApplicationConfig::app()->params["url_path"]["sector_banners"];
				$sectorbanners_array[$key]['sector_banner_id']=!empty($val['sector_banner_id'])?$val['sector_banner_id']:"";
				$sectorbanners_array[$key]['sector_id']=!empty($val['sector_id'])?$val['sector_id']:"";
				$getallsectordetails=Sectors::model()->findByPk($val['sector_id']);
				$sectorbanners_array[$key]['sector_title']=!empty($getallsectordetails['title'])?$getallsectordetails['title']:"";
				$sectorbanners_array[$key]['sector_slug']=!empty($val['sector_slug'])?$val['sector_slug']:"";
				$sectorbanners_array[$key]['sector_banner_title']=!empty($val['title'])?$val['title']:"";
				$sectorbanners_array[$key]['sector_banner_link']=!empty($val['link'])?$val['link']:"";
				$sectorbanners_array[$key]['sector_banner_slug']=!empty($val['slug'])?$val['slug']:"";
				$sectorbanners_array[$key]['image']=!empty($val['image'])?$image_full_path.$val['image']:"";
				$sectorbanners_array[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";
				$sectorbanners_array[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";
				$sectorbanners_array[$key]['status']=!empty($val['status'])?$val['status']:"";
				$sectorbanners_array[$key]['url']=!empty($val['url'])?$val['url']:"";
				$sectorbanners_array[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";
				$sectorbanners_array[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
			}
		}
		
		$prepare_json_encode=json_encode($sectorbanners_array);
		$create_json_file=file_put_contents($json_creation_path.'/'.'sectorbanners.json', $prepare_json_encode);
	}
}
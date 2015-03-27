<?php
date_default_timezone_set("Asia/Kolkata");

class SectorsController extends Controller
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
		$model=new Sectors;

		if(isset($_POST['Sectors']))
		{
			$model->attributes=$_POST['Sectors'];
			
			$model->url=!empty($_POST['Sectors']['url'])?$_POST['Sectors']['url']:"";
			$model->meta_description=!empty($_POST['Sectors']['meta_description'])?$_POST['Sectors']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Sectors']['meta_keyword'])?$_POST['Sectors']['meta_keyword']:"";
			$model->position=!empty($_POST['Sectors']['position'])?$_POST['Sectors']['position']:"";
			
			$getimage=CUploadedFile::getInstance($model,'image');
			$type_array = array("jpg","gif","png");
			if(!empty($getimage))
			{
				$name=$getimage->getName();
				$extension = substr($name, strpos($name, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					list($width, $height, $type, $attr) = getimagesize($getimage->tempName);
					/*if($width==498 && $height==243)
					{*/
						$name=time().'.'.$extension;
						$model->image=$name;
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['sectors']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['sectors']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['sectors_small']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['sectors_small']);
						}
						$getimage->saveAs(ApplicationConfig::app()->params['folder_path']['sectors'] . '/'. $name );
						
					/*}*/
				}
			}
			
			$getimage_thumb=CUploadedFile::getInstance($model,'thumbnail_image');
			$type_array = array("jpg","gif","png");
			if(!empty($getimage_thumb))
			{
				$name_thumb=$getimage_thumb->getName();
				$extension = substr($name_thumb, strpos($name_thumb, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					list($width, $height, $type, $attr) = getimagesize($getimage_thumb->tempName);
					if($width==201 && $height==166)
					{
						$name_thumb=time().'.'.$extension;
						$model->thumbnail_image=$name_thumb;
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['sectors']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['sectors']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['sectors_small']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['sectors_small']);
						}
						$getimage_thumb->saveAs(ApplicationConfig::app()->params['folder_path']['sectors_small'] . '/'. $name_thumb);
					}
				}
			}
			
			$title = $_POST['Sectors']['title'];
            $select = array('title','slug', 'sector_id');
            $condition = array('title');
			$params = array('title' => $_POST['Sectors']['title']);
            $arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
                'sectors', $condition, $params, $select);
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
				$this->JsonSectors();
				$this->redirect(array('sectors/admin'));
			}	
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$old=$model->title;
		$previmage=$model->image;
		$previmage_thumb=$model->thumbnail_image;
		
		if(isset($_POST['Sectors']))
		{
			$model->attributes=$_POST['Sectors'];
			
			$model->url=!empty($_POST['Sectors']['url'])?$_POST['Sectors']['url']:"";
			$model->meta_description=!empty($_POST['Sectors']['meta_description'])?$_POST['Sectors']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Sectors']['meta_keyword'])?$_POST['Sectors']['meta_keyword']:"";
			$model->position=!empty($_POST['Sectors']['position'])?$_POST['Sectors']['position']:"";
			
			$temp= CUploadedFile::getInstance($model,'image');
			$type_array = array("jpg","gif","png");
			if(!empty($temp))
			{
				$name=$temp->getName();
				$extension = substr($name, strpos($name, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					list($width, $height, $type, $attr) = getimagesize($temp->tempName);
					/*if($width==498 && $height==243)
					{*/
						$name=time().'.'.$extension;
						$model->image=$name;
						if($previmage != "")
						{
							if(file_exists(ApplicationConfig::app()->params['folder_path']['sectors'].'/'. $previmage))
							{
								unlink(ApplicationConfig::app()->params['folder_path']['sectors'].'/'. $previmage);
							}
						}
						
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['sectors']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['sectors']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['sectors_small']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['sectors_small']);
						}
						$temp->saveAs(ApplicationConfig::app()->params['folder_path']['sectors'] . '/'. $name );
						
					/*}*/
				}				
			}
			else 
			{
				$model->image=$previmage;
			}
			
			$temp_thumb= CUploadedFile::getInstance($model,'thumbnail_image');
			$type_array = array("jpg","gif","png");
			if(!empty($temp_thumb))
			{
				$name_thumb=$temp_thumb->getName();
				$extension = substr($name_thumb, strpos($name_thumb, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					list($width, $height, $type, $attr) = getimagesize($temp_thumb->tempName);
					if($width==201 && $height==166)
					{
						$name_thumb=time().'.'.$extension;
						$model->thumbnail_image=$name_thumb;
						if($previmage_thumb!= "")
						{
							if(file_exists(ApplicationConfig::app()->params['folder_path']['sectors_small'].'/'. $previmage_thumb))
							{
								unlink(ApplicationConfig::app()->params['folder_path']['sectors_small'].'/'. $previmage_thumb);
							}
						}
						
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['sectors']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['sectors']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['sectors_small']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['sectors_small']);
						}
						$temp_thumb->saveAs(ApplicationConfig::app()->params['folder_path']['sectors_small'] . '/'. $name_thumb);
					}
				}				
			}
			else 
			{
				$model->thumbnail_image=$previmage_thumb;
			}
			
			if($_POST['Sectors']['title'] != $old)
			{
				$title = $_POST['Sectors']['title'];
				$select = array('title','slug', 'sector_id');
				$condition = array('title');
				$params = array('title' => $_POST['Sectors']['title']);
				$arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
					'sectors', $condition, $params, $select);
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
				$this->JsonSectors();
				$this->redirect(array('sectors/admin'));
			}	
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel($id);
			$previmage = $model->image;
			$previmage_thumb = $model->thumbnail_image;
			$model->delete();
			
			if($previmage != "")
		 	{
				if(file_exists(ApplicationConfig::app()->params['folder_path']['sectors'].'/'. $previmage))
				{
					unlink(ApplicationConfig::app()->params['folder_path']['sectors'].'/'. $previmage);
				}
			}
			
			if($previmage_thumb != "")
		 	{
				if(file_exists(ApplicationConfig::app()->params['folder_path']['sectors_small'].'/'. $previmage_thumb))
				{
					unlink(ApplicationConfig::app()->params['folder_path']['sectors_small'].'/'. $previmage_thumb);
				}
			}
			
			$this->JsonSectors();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$this->redirect(array('sectors/admin'));
	}

	public function actionAdmin()
	{
		$model=new Sectors('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Sectors']))
			$model->attributes=$_GET['Sectors'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Sectors::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sectors-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMakeinactive()
	{
		$get_sector_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_sectors', array('status'=>'0'),'sector_id=:sector_id',array(':sector_id'=>$get_sector_id));
		$this->JsonSectors();				
		$this->redirect(array('sectors/admin'));				
	}
	
	public function actionMakeactive()
	{
		$get_sector_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_sectors', array('status'=>'1'),'sector_id=:sector_id',array(':sector_id'=>$get_sector_id));
		$this->JsonSectors();				
		$this->redirect(array('sectors/admin'));
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
	
	
}
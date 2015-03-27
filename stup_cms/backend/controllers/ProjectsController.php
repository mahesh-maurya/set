<?php
date_default_timezone_set("Asia/Kolkata");

class ProjectsController extends Controller
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
		$model=new Projects;
		$getallpk=array();
		$sectors=array();
		$getallsectors=Sectors::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallsectors))
		{
			foreach($getallsectors as $key=>$val)
			{
				$sectors[$val['sector_id']]=$val['title'];
			}
		}

		if(isset($_POST['Projects']))
		{
			$model->attributes=$_POST['Projects'];
			
			$model->slideropt=!empty($_POST['Projects']['slideropt'])?$_POST['Projects']['slideropt']:"horizontal";	
			
			$model->url=!empty($_POST['Projects']['url'])?$_POST['Projects']['url']:"";
			$model->meta_description=!empty($_POST['Projects']['meta_description'])?$_POST['Projects']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Projects']['meta_keyword'])?$_POST['Projects']['meta_keyword']:"";
			$model->project_position=!empty($_POST['Projects']['project_position'])?$_POST['Projects']['project_position']:"";
			
			
			
			$model->sector_id=!empty($_POST['Projects']['sector_id'])?$_POST['Projects']['sector_id']:"";
			
			$getimage = CUploadedFile::getInstancesByName('Projects[image]');
			if (isset($getimage) && count($getimage) > 0)
			{ 
				foreach ($getimage as $img => $pic)
				{
					$name=$pic->name;
					$extension = substr($name, strpos($name, '.')+1);
					list($width, $height, $type, $attr) = getimagesize($pic->tempName);
					if($model->slideropt=="horizontal")
					{
						if($width==977 && $height==435)
						{
							$name=time().$img.'.'.$extension;
							$model->image=$name;
							if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
							{
								mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
							}
							if(!is_dir(ApplicationConfig::app()->params['folder_path']['projects']))
							{
								mkdir(ApplicationConfig::app()->params['folder_path']['projects']);
							}
							
							if ($pic->saveAs(ApplicationConfig::app()->params['folder_path']['projects']. '/'. $name))
							{
								$maxOrderNumber = Yii::app()->db->createCommand()
								  ->select('max(project_id) as max')
								  ->from('tbl_projects')
								  ->queryScalar();
								$project_pk = $maxOrderNumber + 1;
								$model_projimages=new ProjectImages;
								$model_projimages->project_id=$project_pk;
								$model_projimages->image=$name;
								$model_projimages->created_date=date('Y-m-d H:i:s');
								if($model_projimages->save())
								{
									$getallpk[]=$model_projimages->project_image_id;
								}
							}
							else
							{
								echo 'Cannot upload!';
							}
						}
					}
					else
					{
						if($width==534 && $height==535)
						{
							$name=time().$img.'.'.$extension;
							$model->image=$name;
							if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
							{
								mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
							}
							if(!is_dir(ApplicationConfig::app()->params['folder_path']['projects']))
							{
								mkdir(ApplicationConfig::app()->params['folder_path']['projects']);
							}
							
							if ($pic->saveAs(ApplicationConfig::app()->params['folder_path']['projects']. '/'. $name))
							{
								$maxOrderNumber = Yii::app()->db->createCommand()
								  ->select('max(project_id) as max')
								  ->from('tbl_projects')
								  ->queryScalar();
								$project_pk = $maxOrderNumber + 1;
								$model_projimages=new ProjectImages;
								$model_projimages->project_id=$project_pk;
								$model_projimages->image=$name;
								$model_projimages->created_date=date('Y-m-d H:i:s');
								if($model_projimages->save())
								{
									$getallpk[]=$model_projimages->project_image_id;
								}
							}
							else
							{
								echo 'Cannot upload!';
							}
						}
					}
				}
			}
			
			$title = $_POST['Projects']['title'];
            $select = array('title','slug', 'project_id');
            $condition = array('title');
			$params = array('title' => $_POST['Projects']['title']);
            $arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
                'projects', $condition, $params, $select);
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
				foreach($getallpk as $pk_key=>$pkval)
				{
					$update_query = Yii::app()->db->createCommand()
						->update('tbl_project_images', array('project_id'=>$model->project_id),'project_image_id=:project_image_id',array(':project_image_id'=>$pkval));
				}
				
				$this->JsonProjects();
				$this->redirect(array('projects/admin'));
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
		$allimgs=array();
		$getallprojimages=ProjectImages::model()->findAll(array('condition'=>'project_id='.$id));
		foreach($getallprojimages as $pikey=>$pival)
		{
			$allimgs[]=$pival['image'];
		}
		
		if(isset($_POST['Projects']))
		{
			$model->attributes=$_POST['Projects'];
			
			$model->url=!empty($_POST['Projects']['url'])?$_POST['Projects']['url']:"";
			$model->meta_description=!empty($_POST['Projects']['meta_description'])?$_POST['Projects']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Projects']['meta_keyword'])?$_POST['Projects']['meta_keyword']:"";
			
			$model->sector_id=!empty($_POST['Projects']['sector_id'])?$_POST['Projects']['sector_id']:"";
			
			$model->slideropt=!empty($_POST['Projects']['slideropt'])?$_POST['Projects']['slideropt']:"horizontal";	
			
			$model->project_position=!empty($_POST['Projects']['project_position'])?$_POST['Projects']['project_position']:"";
			
			$temp = CUploadedFile::getInstancesByName('Projects[image]');
			if (isset($temp) && count($temp) > 0)
			{
				ProjectImages::model()->deleteAll("project_id='".$id."'");
				foreach ($temp as $img => $pic)
				{
					$name=$pic->name;
					$extension = substr($name, strpos($name, '.')+1);
					list($width, $height, $type, $attr) = getimagesize($pic->tempName);
					if($model->slideropt=="horizontal")
					{
						if($width==977 && $height==435)
						{
							$name=time().$img.'.'.$extension;
							$model->image=$name;
							if($previmage != "")
							{
								if(file_exists(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $previmage))
								{
									unlink(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $previmage);
								}
								foreach($allimgs as $imgkey=>$imgval)
								{
									if(file_exists(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $imgval))
									{
										unlink(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $imgval);
									}
								}
							}
							
							if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
							{
								mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
							}
							if(!is_dir(ApplicationConfig::app()->params['folder_path']['projects']))
							{
								mkdir(ApplicationConfig::app()->params['folder_path']['projects']);
							}
							
							if ($pic->saveAs(ApplicationConfig::app()->params['folder_path']['projects']. '/'. $name))
							{
								$model_projimages=new ProjectImages;
								$model_projimages->project_id=$id;
								$model_projimages->image=$name;
								$model_projimages->created_date=date('Y-m-d H:i:s');
								$model_projimages->save();
							}
						}
					}
					else
					{
						if($width==534 && $height==535)
						{
							$name=time().$img.'.'.$extension;
							$model->image=$name;
							if($previmage != "")
							{
								if(file_exists(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $previmage))
								{
									unlink(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $previmage);
								}
								foreach($allimgs as $imgkey=>$imgval)
								{
									if(file_exists(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $imgval))
									{
										unlink(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $imgval);
									}
								}
							}
							
							if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
							{
								mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
							}
							if(!is_dir(ApplicationConfig::app()->params['folder_path']['projects']))
							{
								mkdir(ApplicationConfig::app()->params['folder_path']['projects']);
							}
							
							if ($pic->saveAs(ApplicationConfig::app()->params['folder_path']['projects']. '/'. $name))
							{
								$model_projimages=new ProjectImages;
								$model_projimages->project_id=$id;
								$model_projimages->image=$name;
								$model_projimages->created_date=date('Y-m-d H:i:s');
								$model_projimages->save();
							}
						}
					}
				}
			}
			else 
			{
				$model->image=$previmage;
			}
			
			if($_POST['Projects']['title'] != $old)
			{
				$title = $_POST['Projects']['title'];
				$select = array('title','slug', 'project_id');
				$condition = array('title');
				$params = array('title' => $_POST['Projects']['title']);
				$arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
					'projects', $condition, $params, $select);
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
				$this->JsonProjects();
				$this->redirect(array('projects/admin'));
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
			$imgs=array();
			$getallimgs=ProjectImages::model()->findAll(array('condition'=>'project_id='.$id));
			foreach($getallimgs as $key=>$val)
			{
				if(file_exists(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $val['image']))
				{
					unlink(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $val['image']);
				}
			}
			
			ProjectImages::model()->deleteAll("project_id='".$id."'");
			
			if($previmage != "")
		 	{
				if(file_exists(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $previmage))
				{
					unlink(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $previmage);
				}
			}
			
			
			$this->JsonProjects();
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$this->redirect(array('projects/admin'));
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
		
		$model=new Projects('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Projects']))
			$model->attributes=$_GET['Projects'];

		$this->render('admin',array(
			'model'=>$model,
			'sectors_merge'=>$sectors_merge,
		));
	}

	public function loadModel($id)
	{
		$model=Projects::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadImageModel($id)
	{
		$model=ProjectImages::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='projects-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMakeinactive()
	{
		$get_project_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_projects', array('status'=>'0'),'project_id=:project_id',array(':project_id'=>$get_project_id));
		
		ProjectImages::model()->updateAll(array('status'=>'0'),'project_id="'.$get_project_id.'"');				
		
		$this->JsonProjects();				
		$this->redirect(array('projects/admin'));				
	}
	
	public function actionMakeactive()
	{
		$get_project_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_projects', array('status'=>'1'),'project_id=:project_id',array(':project_id'=>$get_project_id));
		ProjectImages::model()->updateAll(array('status'=>'1'),'project_id="'.$get_project_id.'"');	
		$this->JsonProjects();				
		$this->redirect(array('projects/admin'));
	}
	
	public function actionDelete_projimage()
	{
		$get_projectimg_id=$_REQUEST['id'];
		$getproject_id=$_REQUEST['proj_id'];
		
		$model = $this->loadImageModel($get_projectimg_id);
		
		$previmage = $model->image;
		$model->delete();
		
		if($previmage != "")
	 	{
			if(file_exists(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $previmage))
			{
				unlink(ApplicationConfig::app()->params['folder_path']['projects'].'/'. $previmage);
			}
		}
			
		$this->JsonProjects();				
		$this->redirect(array('projects/viewallimages/'.$getproject_id));
	}
	
	public function JsonProjects()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$projects=array();
		
		$getallprojects=Projects::model()->findAll(array('condition'=>'status="1"','order'=>'project_position ASC'));
		if(!empty($getallprojects))
		{
			foreach($getallprojects as $key=>$val)
			{
				$image_full_path=ApplicationConfig::app()->params["url_path"]["projects"];
				$projects[$key]['project_id']=!empty($val['project_id'])?$val['project_id']:"";
				
				$getsectordetails=Sectors::model()->findByPk($val['sector_id']);
				$projects[$key]['sector_id']=!empty($getsectordetails['sector_id'])?$getsectordetails['sector_id']:"";	
				$projects[$key]['sector_slug']=!empty($getsectordetails['slug'])?$getsectordetails['slug']:"";
				
				$projects[$key]['title']=!empty($val['title'])?$val['title']:"";
				$projects[$key]['description']=!empty($val['description'])?$val['description']:"";
				
				$getallimages=ProjectImages::model()->findAll(array('condition'=>'project_id='.$val['project_id'].' AND status="1"','order'=>'sortorder ASC'));
				$imgs=array();
				foreach($getallimages as $getprojimagekey=>$getprojimageval)
				{
					$imgs[]=$image_full_path.$getprojimageval['image'];
				}
				
				$projects[$key]['image']=!empty($val['image'])?$image_full_path.$val['image']:"";
				$projects[$key]['project_images']=$imgs;
				$projects[$key]['slug']=!empty($val['slug'])?$val['slug']:"";
				$projects[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";
				$projects[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";
				$projects[$key]['status']=!empty($val['status'])?$val['status']:"";
				$projects[$key]['url']=!empty($val['url'])?$val['url']:"";
				$projects[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";
				$projects[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
				$projects[$key]['project_position']=isset($val['project_position'])?$val['project_position']:"";
			}
		}
		
		$prepare_json_encode=json_encode($projects);
		$create_json_file=file_put_contents($json_creation_path.'/'.'projects.json', $prepare_json_encode);
	}
	
	public function actionGetslideroption()
	{
		$fetch_sector_id=!empty($_REQUEST['Projects']['sector_id'])?$_REQUEST['Projects']['sector_id']:"";
		$getsectordetails=Sectors::model()->findByPk($fetch_sector_id);
		if($getsectordetails['slider_option']=="horizontal")
		{
			$sethiddenfield="<input type='hidden' name='Projects[slideropt]' id='slideropt' value='horizontal'>";
			echo "(Upload Image with 977*435 resolution)".$sethiddenfield;
		}
		else
		{
			$sethiddenfield="<input type='hidden' name='Projects[slideropt]' id='slideropt' value='vertical'>";
			echo "(Upload Image with 534*535 resolution)".$sethiddenfield;	
		}
	}
	
	public function actionViewallimages()
	{
		$project_id=!empty($_REQUEST['id'])?$_REQUEST['id']:"";
		
		$model=new ProjectImages;
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProjectImages']))
			$model->attributes=$_GET['ProjectImages'];
		
		$this->render('viewimages',array(
			'model'=>$model,
			'project_id'=>$project_id,
		));
	}
	
	public function actionSortitems()
	{
	    if(isset($_POST))
	    {
	            $model = ProjectImages::model()->findByPk($_POST['id']);
	            $model->sortorder = $_POST['val'];
	            $model->save();
	            $this->JsonProjects();	        
	    }
	}
	
	public function actionMakeinactive_projimage()
	{
		$get_project_image_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_project_images', array('status'=>'0'),'project_image_id=:project_image_id',array(':project_image_id'=>$get_project_image_id));
		$this->JsonProjects();
	}
	
	public function actionMakeactive_projimage()
	{
		$get_project_image_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_project_images', array('status'=>'1'),'project_image_id=:project_image_id',array(':project_image_id'=>$get_project_image_id));
		$this->JsonProjects();
	}
}
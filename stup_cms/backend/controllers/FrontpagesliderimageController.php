<?php
date_default_timezone_set("Asia/Kolkata");

class FrontpagesliderimageController extends Controller
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
		$model=new Frontpagesliderimage;

		if(isset($_POST['Frontpagesliderimage']))
		{
			$model->attributes=$_POST['Frontpagesliderimage'];
			
			$model->url=!empty($_POST['Frontpagesliderimage']['url'])?$_POST['Frontpagesliderimage']['url']:"";
			$model->meta_description=!empty($_POST['Frontpagesliderimage']['meta_description'])?$_POST['Frontpagesliderimage']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Frontpagesliderimage']['meta_keyword'])?$_POST['Frontpagesliderimage']['meta_keyword']:"";
			
			$getimage=CUploadedFile::getInstance($model,'image');
			$type_array = array("jpg","gif","png");
			if(!empty($getimage))
			{
				$name=$getimage->getName();
				$extension = substr($name, strpos($name, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					list($width, $height, $type, $attr) = getimagesize($getimage->tempName);
					if($width==1200 && $height==651)
					{
						$name=time().'.'.$extension;
						$model->image=$name;
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['homepage_banners']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['homepage_banners']);
						}
						$getimage->saveAs(ApplicationConfig::app()->params['folder_path']['homepage_banners'] . '/'. $name );
					}
				}
			}
			
			$title = $_POST['Frontpagesliderimage']['title'];
            $select = array('title','slug', 'frontpage_slider_image_id');
            $condition = array('title');
			$params = array('title' => $_POST['Frontpagesliderimage']['title']);
            $arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
                'frontpage_slider_image', $condition, $params, $select);
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
				$this->Homepageslider();
				$this->redirect(array('frontpagesliderimage/admin'));
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
		
		if(isset($_POST['Frontpagesliderimage']))
		{
			$model->attributes=$_POST['Frontpagesliderimage'];
			
			$model->url=!empty($_POST['Frontpagesliderimage']['url'])?$_POST['Frontpagesliderimage']['url']:"";
			$model->meta_description=!empty($_POST['Frontpagesliderimage']['meta_description'])?$_POST['Frontpagesliderimage']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Frontpagesliderimage']['meta_keyword'])?$_POST['Frontpagesliderimage']['meta_keyword']:"";
			
			$temp= CUploadedFile::getInstance($model,'image');
			$type_array = array("jpg","gif","png");
			if(!empty($temp))
			{
				$name=$temp->getName();
				$extension = substr($name, strpos($name, '.')+1);
				
				if(in_array(strtolower($extension),$type_array))
				{
					list($width, $height, $type, $attr) = getimagesize($temp->tempName);
					if($width==1200 && $height==651)
					{
						$name=time().'.'.$extension;
						$model->image=$name;
						if($previmage != "")
						{
							if(file_exists(ApplicationConfig::app()->params['folder_path']['homepage_banners'].'/'. $previmage))
							{
								unlink(ApplicationConfig::app()->params['folder_path']['homepage_banners'].'/'. $previmage);
							}
						}
						
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
						}
						if(!is_dir(ApplicationConfig::app()->params['folder_path']['homepage_banners']))
						{
							mkdir(ApplicationConfig::app()->params['folder_path']['homepage_banners']);
						}
						$temp->saveAs(ApplicationConfig::app()->params['folder_path']['homepage_banners'] . '/'. $name );	
					}
				}
			}
			else 
			{
				$model->image=$previmage;
			}
			
			if($_POST['Frontpagesliderimage']['title'] != $old)
			{
				$title = $_POST['Frontpagesliderimage']['title'];
				$select = array('title','slug', 'frontpage_slider_image_id');
				$condition = array('title');
				$params = array('title' => $_POST['Frontpagesliderimage']['title']);
				$arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
					'frontpage_slider_image', $condition, $params, $select);
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
				$this->Homepageslider();
				$this->redirect(array('frontpagesliderimage/admin'));
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
			$model->delete();
			
			if($previmage != "")
		 	{
				if(file_exists(ApplicationConfig::app()->params['folder_path']['homepage_banners'].'/'. $previmage))
				{
					unlink(ApplicationConfig::app()->params['folder_path']['homepage_banners'].'/'. $previmage);
				}
			}
			
			$this->Homepageslider();
			
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$this->redirect(array('frontpagesliderimage/admin'));
	}

	public function actionAdmin()
	{
		$model=new Frontpagesliderimage('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Frontpagesliderimage']))
			$model->attributes=$_GET['Frontpagesliderimage'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Frontpagesliderimage::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='frontpagesliderimage-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMakeinactive()
	{
		$get_sliderimage_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_frontpage_slider_image', array('status'=>'0'),'frontpage_slider_image_id=:frontpage_slider_image_id',array(':frontpage_slider_image_id'=>$get_sliderimage_id));
		$this->Homepageslider();					
		$this->redirect(array('frontpagesliderimage/admin'));				
	}
	
	public function actionMakeactive()
	{
		$get_sliderimage_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_frontpage_slider_image', array('status'=>'1'),'frontpage_slider_image_id=:frontpage_slider_image_id',array(':frontpage_slider_image_id'=>$get_sliderimage_id));
		$this->Homepageslider();					
		$this->redirect(array('frontpagesliderimage/admin'));
	}
	
	public function Homepageslider()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$homepagesliderimages=array();
		
		$getallhomepagebanners=Frontpagesliderimage::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallhomepagebanners))
		{
			foreach($getallhomepagebanners as $key=>$val)
			{
				$image_full_path=ApplicationConfig::app()->params["url_path"]["homepage_banners"];
				$homepagesliderimages[$key]['frontpage_slider_image_id']=!empty($val['frontpage_slider_image_id'])?$val['frontpage_slider_image_id']:"";
				$homepagesliderimages[$key]['title']=!empty($val['title'])?$val['title']:"";
				$homepagesliderimages[$key]['description']=!empty($val['description'])?$val['description']:"";
				$homepagesliderimages[$key]['link']=!empty($val['link'])?$val['link']:"";
				$homepagesliderimages[$key]['image']=!empty($val['image'])?$image_full_path.$val['image']:"";
				$homepagesliderimages[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";
				$homepagesliderimages[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";
				$homepagesliderimages[$key]['slug']=!empty($val['slug'])?$val['slug']:"";
				$homepagesliderimages[$key]['status']=!empty($val['status'])?$val['status']:"";
				$homepagesliderimages[$key]['url']=!empty($val['url'])?$val['url']:"";
				$homepagesliderimages[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";
				$homepagesliderimages[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
			}
		}
		
		$prepare_json_encode=json_encode($homepagesliderimages);
		$create_json_file=file_put_contents($json_creation_path.'/'.'homepageslider.json', $prepare_json_encode);
	}
}
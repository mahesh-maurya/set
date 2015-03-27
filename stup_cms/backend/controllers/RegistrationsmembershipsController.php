<?php
date_default_timezone_set("Asia/Kolkata");

class RegistrationsmembershipsController extends Controller
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
		$model=new RegistrationsMemberships;

		if(isset($_POST['RegistrationsMemberships']))
		{
			$model->attributes=$_POST['RegistrationsMemberships'];
			
			$model->url=!empty($_POST['RegistrationsMemberships']['url'])?$_POST['RegistrationsMemberships']['url']:"";
			$model->meta_description=!empty($_POST['RegistrationsMemberships']['meta_description'])?$_POST['RegistrationsMemberships']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['RegistrationsMemberships']['meta_keyword'])?$_POST['RegistrationsMemberships']['meta_keyword']:"";
			
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
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['registration_memberships']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['registration_memberships']);
					}
					$getimage->saveAs(ApplicationConfig::app()->params['folder_path']['registration_memberships'] . '/'. $name );
				}
			}
			
			$title = $_POST['RegistrationsMemberships']['title'];
            $select = array('title','slug', 'reg_prof_membership_id');
            $condition = array('title');
			$params = array('title' => $_POST['RegistrationsMemberships']['title']);
            $arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
                'registrations_memberships', $condition, $params, $select);
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
				$this->JsonRegistrationsmemberships();
				$this->redirect(array('registrationsmemberships/admin'));
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
		
		if(isset($_POST['RegistrationsMemberships']))
		{
			$model->attributes=$_POST['RegistrationsMemberships'];
			
			$model->url=!empty($_POST['RegistrationsMemberships']['url'])?$_POST['RegistrationsMemberships']['url']:"";
			$model->meta_description=!empty($_POST['RegistrationsMemberships']['meta_description'])?$_POST['RegistrationsMemberships']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['RegistrationsMemberships']['meta_keyword'])?$_POST['RegistrationsMemberships']['meta_keyword']:"";
			
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
						if(file_exists(ApplicationConfig::app()->params['folder_path']['registration_memberships'].'/'. $previmage))
						{
							unlink(ApplicationConfig::app()->params['folder_path']['registration_memberships'].'/'. $previmage);
						}
					}
					
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
					}
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['registration_memberships']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['registration_memberships']);
					}
					$temp->saveAs(ApplicationConfig::app()->params['folder_path']['registration_memberships'] . '/'. $name );
				}
			}
			else 
			{
				$model->image=$previmage;
			}
			
			if($_POST['RegistrationsMemberships']['title'] != $old)
			{
				$title = $_POST['RegistrationsMemberships']['title'];
				$select = array('title','slug', 'reg_prof_membership_id');
				$condition = array('title');
				$params = array('title' => $_POST['RegistrationsMemberships']['title']);
				$arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
					'registrations_memberships', $condition, $params, $select);
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
				$this->JsonRegistrationsmemberships();
				$this->redirect(array('registrationsmemberships/admin'));
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
				if(file_exists(ApplicationConfig::app()->params['folder_path']['registration_memberships'].'/'. $previmage))
				{
					unlink(ApplicationConfig::app()->params['folder_path']['registration_memberships'].'/'. $previmage);
				}
			}
			
			$this->JsonRegistrationsmemberships();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$this->redirect(array('registrationsmemberships/admin'));
	}

	public function actionAdmin()
	{
		$model=new RegistrationsMemberships('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RegistrationsMemberships']))
			$model->attributes=$_GET['RegistrationsMemberships'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=RegistrationsMemberships::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='registrations-memberships-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMakeinactive()
	{
		$get_reg_prof_membership_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_registrations_memberships', array('status'=>'0'),'reg_prof_membership_id=:reg_prof_membership_id',array(':reg_prof_membership_id'=>$get_reg_prof_membership_id));
		$this->JsonRegistrationsmemberships();				
		$this->redirect(array('registrationsmemberships/admin'));				
	}
	
	public function actionMakeactive()
	{
		$get_reg_prof_membership_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_registrations_memberships', array('status'=>'1'),'reg_prof_membership_id=:reg_prof_membership_id',array(':reg_prof_membership_id'=>$get_reg_prof_membership_id));
		$this->JsonRegistrationsmemberships();					
		$this->redirect(array('registrationsmemberships/admin'));
	}
	
	public function JsonRegistrationsmemberships()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$reg_memberships_array=array();
		
		$getallregmemberships=RegistrationsMemberships::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallregmemberships))
		{
			foreach($getallregmemberships as $key=>$val)
			{
				$image_full_path=ApplicationConfig::app()->params["url_path"]["registration_memberships"];	
				$reg_memberships_array[$key]['reg_prof_membership_id']=!empty($val['reg_prof_membership_id'])?$val['reg_prof_membership_id']:"";	
				$reg_memberships_array[$key]['title']=!empty($val['title'])?$val['title']:"";	
				$reg_memberships_array[$key]['image']=!empty($val['image'])?$image_full_path.$val['image']:"";	
				$reg_memberships_array[$key]['slug']=!empty($val['slug'])?$val['slug']:"";	
				$reg_memberships_array[$key]['link']=!empty($val['link'])?$val['link']:"";	
				$reg_memberships_array[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";	
				$reg_memberships_array[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";	
				$reg_memberships_array[$key]['status']=!empty($val['status'])?$val['status']:"";	
				$reg_memberships_array[$key]['url']=!empty($val['url'])?$val['url']:"";	
				$reg_memberships_array[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";	
				$reg_memberships_array[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";	
			}
		}
		
		$prepare_json_encode=json_encode($reg_memberships_array);
		$create_json_file=file_put_contents($json_creation_path.'/'.'registrationsmemberships.json', $prepare_json_encode);
	}
}
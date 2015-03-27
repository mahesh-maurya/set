<?php
date_default_timezone_set("Asia/Kolkata");

class ClientsController extends Controller
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
		$model=new Clients;

		if(isset($_POST['Clients']))
		{
			$model->attributes=$_POST['Clients'];
			
			$model->url=!empty($_POST['Clients']['url'])?$_POST['Clients']['url']:"";
			$model->meta_description=!empty($_POST['Clients']['meta_description'])?$_POST['Clients']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Clients']['meta_keyword'])?$_POST['Clients']['meta_keyword']:"";
			
			$getimage=CUploadedFile::getInstance($model,'image');
			$type_array = array("jpg","gif","png");
			if(!empty($getimage))
			{
				$name=$getimage->getName();
				$extension = substr($name, strpos($name, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					list($width, $height, $type, $attr) = getimagesize($getimage->tempName);
					$name=time().'.'.$extension;
					$model->image=$name;
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
					}	
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['clients']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['clients']);
					}
					$getimage->saveAs(ApplicationConfig::app()->params['folder_path']['clients'] . '/'. $name );
				}
			}
			
			$title = $_POST['Clients']['title'];
            $select = array('title','slug', 'client_id');
            $condition = array('title');
			$params = array('title' => $_POST['Clients']['title']);
            $arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
                'clients', $condition, $params, $select);
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
				$this->JsonClients();
				$this->redirect(array('clients/admin'));
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

		if(isset($_POST['Clients']))
		{
			$model->attributes=$_POST['Clients'];
			
			$model->url=!empty($_POST['Clients']['url'])?$_POST['Clients']['url']:"";
			$model->meta_description=!empty($_POST['Clients']['meta_description'])?$_POST['Clients']['meta_description']:"";
			$model->meta_keyword=!empty($_POST['Clients']['meta_keyword'])?$_POST['Clients']['meta_keyword']:"";
			
			$temp= CUploadedFile::getInstance($model,'image');
			$type_array = array("jpg","gif","png");
			if(!empty($temp))
			{
				$name=$temp->getName();
				$extension = substr($name, strpos($name, '.')+1);
				if(in_array(strtolower($extension),$type_array))
				{
					list($width, $height, $type, $attr) = getimagesize($temp->tempName);
					$name=time().'.'.$extension;
					$model->image=$name;
					if($previmage != "")
					{
						if(file_exists(ApplicationConfig::app()->params['folder_path']['clients'].'/'. $previmage))
						{
							unlink(ApplicationConfig::app()->params['folder_path']['clients'].'/'. $previmage);
						}
					}
					
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['uploads']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['uploads']);
					}
					if(!is_dir(ApplicationConfig::app()->params['folder_path']['clients']))
					{
						mkdir(ApplicationConfig::app()->params['folder_path']['clients']);
					}
					$temp->saveAs(ApplicationConfig::app()->params['folder_path']['clients'] . '/'. $name );
				}
			}
			else 
			{
				$model->image=$previmage;
			}
			
			if($_POST['Clients']['title'] != $old)
			{
				$title = $_POST['Clients']['title'];
				$select = array('title','slug', 'client_id');
				$condition = array('title');
				$params = array('title' => $_POST['Clients']['title']);
				$arrResult = SlugGenerate::getSlug(Yii::app()->params['tbl_prefix'] .
					'clients', $condition, $params, $select);
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
				$this->JsonClients();
				$this->redirect(array('clients/admin'));
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
				if(file_exists(ApplicationConfig::app()->params['folder_path']['clients'].'/'. $previmage))
				{
					unlink(ApplicationConfig::app()->params['folder_path']['clients'].'/'. $previmage);
				}
			}
			$this->JsonClients();	
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$this->redirect(array('clients/admin'));
	}

	public function actionAdmin()
	{
		$model=new Clients('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Clients']))
			$model->attributes=$_GET['Clients'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Clients::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='clients-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMakeinactive()
	{
		$get_client_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_clients', array('status'=>'0'),'client_id=:client_id',array(':client_id'=>$get_client_id));
		$this->JsonClients();
		$this->redirect(array('clients/admin'));				
	}
	
	public function actionMakeactive()
	{
		$get_client_id=$_REQUEST['id'];
		$update_query = Yii::app()->db->createCommand()
						->update('tbl_clients', array('status'=>'1'),'client_id=:client_id',array(':client_id'=>$get_client_id));
		$this->JsonClients();
		$this->redirect(array('clients/admin'));
	}
	
	public function JsonClients()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$clients=array();
		
		$getallclients=Clients::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallclients))
		{
			foreach($getallclients as $key=>$val)
			{
				$image_full_path_clients=ApplicationConfig::app()->params["url_path"]["clients"];
				
				$clients[$key]['client_id']=!empty($val['client_id'])?$val['client_id']:"";
				if($val['client_type']=='1')
				{
					$gettype="Funding Agencies";
				}
				else if($val['client_type']=='2')
				{
					$gettype="Government Bodies";
				}
				else if($val['client_type']=='3')
				{
					$gettype="Contractors & Developers";
				}
				else if($val['client_type']=='4')
				{
					$gettype="Corporations";
				}
				else
				{
					$gettype="";
				}
				$clients[$key]['client_type']=!empty($val['client_type'])?$gettype:"";
				$clients[$key]['title']=!empty($val['title'])?$val['title']:"";
				$clients[$key]['image']=!empty($val['image'])?$image_full_path_clients.$val['image']:"";
				$clients[$key]['slug']=!empty($val['slug'])?$val['slug']:"";
				$clients[$key]['link']=!empty($val['link'])?$val['link']:"";
				$clients[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";
				$clients[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";
				$clients[$key]['status']=!empty($val['status'])?$val['status']:"";
				$clients[$key]['url']=!empty($val['url'])?$val['url']:"";
				$clients[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";
				$clients[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
			}
		}
		
		$prepare_json_encode=json_encode($clients);
		$create_json_file=file_put_contents($json_creation_path.'/'.'clients.json', $prepare_json_encode);
	}
}

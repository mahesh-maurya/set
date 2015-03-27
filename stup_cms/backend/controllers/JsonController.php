<?php
date_default_timezone_set("Asia/Kolkata");

class JsonController extends Controller
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
	
	public function actionPages()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$pages=array();
		$getallpages=PageMaster::model()->findAll(array('condition'=>'status="1"'));
		
		if(!empty($getallpages))
		{
			foreach($getallpages as $key=>$val)
			{
				$pages[$key]['page_id']=!empty($val['page_id'])?$val['page_id']:"";
				$pages[$key]['page_name']=!empty($val['page_name'])?$val['page_name']:"";
				$pages[$key]['url']=!empty($val['url'])?$val['url']:"";
				$pages[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";
				$pages[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
				$pages[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";
				$pages[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";
				$pages[$key]['status']=!empty($val['status'])?$val['status']:"";
				$pages[$key]['slug']=!empty($val['slug'])?$val['slug']:"";
			}
		}
		$prepare_json_encode=json_encode($pages);
		$create_json_file=file_put_contents($json_creation_path.'/'.'pages.json', $prepare_json_encode);
		$msg="JSON File For Pages Created Successfully...";
		
		$this->render('result',array(
			'msg'=>$msg,
		));
	}
	
	public function actionServices()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$services=array();
		
		$getallservices=Services::model()->findAll(array('condition'=>'status="1"'));
		
		$services=array();
		if(!empty($getallservices))
		{
			foreach($getallservices as $key=>$val)
			{
				$image_full_path=ApplicationConfig::app()->params["url_path"]["services"];				
				$services[$key]['service_id']=!empty($val['service_id'])?$val['service_id']:"";	
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
			}
		}
		
		$prepare_json_encode=json_encode($services);
		$create_json_file=file_put_contents($json_creation_path.'/'.'services.json', $prepare_json_encode);
		$msg="JSON File For Services Created Successfully...";
		
		$this->render('result',array(
			'msg'=>$msg,
		));
	}
	
	public function actionSectors()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$sectors=array();
		
		$getallsectors=Sectors::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallsectors))
		{
			foreach($getallsectors as $key=>$val)
			{
				$image_full_path_sectorbanner=ApplicationConfig::app()->params["url_path"]["sector_banners"];
				$image_full_path=ApplicationConfig::app()->params["url_path"]["sectors"];
				$image_full_path_small=ApplicationConfig::app()->params["url_path"]["sectors_small"];
				$sectors[$key]['sector_id']=!empty($val['sector_id'])?$val['sector_id']:"";
				
				$getsectorbanner=Sectorbanners::model()->findAll(array('condition'=>'sector_id="'.$val['sector_id'].'" AND status="1"','order'=>'sector_banner_id DESC'));
				$sectors[$key]['sector_banner']=!empty($getsectorbanner[0]['image'])?$image_full_path_sectorbanner.$getsectorbanner[0]['image']:"";
				
				$sectors[$key]['title']=!empty($val['title'])?$val['title']:"";
				$sectors[$key]['description']=!empty($val['description'])?$val['description']:"";
				$sectors[$key]['image']=!empty($val['image'])?$image_full_path.$val['image']:"";
				$sectors[$key]['image_small']=!empty($val['image'])?$image_full_path_small.$val['image']:"";
				$sectors[$key]['slug']=!empty($val['slug'])?$val['slug']:"";
				$sectors[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";
				$sectors[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";
				$sectors[$key]['status']=!empty($val['status'])?$val['status']:"";
				$sectors[$key]['url']=!empty($val['url'])?$val['url']:"";
				$sectors[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";
				$sectors[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
			}
		}
		
		//echo "<pre>";print_r($sectors);exit;
		$prepare_json_encode=json_encode($sectors);
		$create_json_file=file_put_contents($json_creation_path.'/'.'sectors.json', $prepare_json_encode);
		$msg="JSON File For Sectors Created Successfully...";
		
		$this->render('result',array(
			'msg'=>$msg,
		));
	}
	
	public function actionProjects()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$projects=array();
		
		$getallprojects=Projects::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallprojects))
		{
			foreach($getallprojects as $key=>$val)
			{
				$image_full_path=ApplicationConfig::app()->params["url_path"]["projects"];
				$projects[$key]['project_id']=!empty($val['project_id'])?$val['project_id']:"";
				$projects[$key]['title']=!empty($val['title'])?$val['title']:"";
				$projects[$key]['description']=!empty($val['description'])?$val['description']:"";
				$projects[$key]['image']=!empty($val['image'])?$image_full_path.$val['image']:"";
				$projects[$key]['slug']=!empty($val['slug'])?$val['slug']:"";
				$projects[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";
				$projects[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";
				$projects[$key]['status']=!empty($val['status'])?$val['status']:"";
				$projects[$key]['url']=!empty($val['url'])?$val['url']:"";
				$projects[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";
				$projects[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
			}
		}
		
		$prepare_json_encode=json_encode($projects);
		$create_json_file=file_put_contents($json_creation_path.'/'.'projects.json', $prepare_json_encode);
		$msg="JSON File For Projects Created Successfully...";
		
		$this->render('result',array(
			'msg'=>$msg,
		));		
	}
	
	public function actionHomepageslider()
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
		$msg="JSON File For Home Page Slider Images Created Successfully...";
		
		$this->render('result',array(
			'msg'=>$msg,
		));	
	}
	
	public function actionSectorbanners()
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
		$msg="JSON File For Sector Banners Created Successfully...";
		 
		$this->render('result',array(
			'msg'=>$msg,
		));	
	}
	 
	public function actionPagebanners()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$pagebanners_array=array();
		
		$getallpagebanners=Pagebanner::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallpagebanners))
		{
			foreach($getallpagebanners as $key=>$val)
			{
				$image_full_path=ApplicationConfig::app()->params["url_path"]["page_banners"];	
				$pagebanners_array[$key]['page_banner_id']=!empty($val['page_banner_id'])?$val['page_banner_id']:"";
				$getpagedetails=PageMaster::model()->find(array('condition'=>'slug="'.$val['page_name'].'"'));
				$pagebanners_array[$key]['page_id']=!empty($getpagedetails['page_id'])?$getpagedetails['page_id']:"";
				$pagebanners_array[$key]['page_title']=!empty($getpagedetails['page_name'])?$getpagedetails['page_name']:"";
				$pagebanners_array[$key]['page_slug']=!empty($val['page_name'])?$val['page_name']:"";
				$pagebanners_array[$key]['page_banner_title']=!empty($val['title'])?$val['title']:"";
				$pagebanners_array[$key]['page_banner_link']=!empty($val['link'])?$val['link']:"";
				$pagebanners_array[$key]['page_banner_slug']=!empty($val['slug'])?$val['slug']:"";
				$pagebanners_array[$key]['image']=!empty($val['image'])?$image_full_path.$val['image']:"";
				$pagebanners_array[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";
				$pagebanners_array[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";
				$pagebanners_array[$key]['status']=!empty($val['status'])?$val['status']:"";
				$pagebanners_array[$key]['url']=!empty($val['url'])?$val['url']:"";
				$pagebanners_array[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";
				$pagebanners_array[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
			}
		}
		
		$prepare_json_encode=json_encode($pagebanners_array);
		$create_json_file=file_put_contents($json_creation_path.'/'.'pagebanners.json', $prepare_json_encode);
		$msg="JSON File For Page Banners Created Successfully...";
		
		$this->render('result',array(
			'msg'=>$msg,
		));	
	}
	
	public function actionStaticpageblock()
	{
		$json_creation_path=ApplicationConfig::app()->params["folder_path"]["json"];
		$staticpageblocks_array=array();
		
		$getallstaticpageblocks=StaticPageBlock::model()->findAll(array('condition'=>'status="1"'));
		if(!empty($getallstaticpageblocks))
		{
			foreach($getallstaticpageblocks as $key=>$val)
			{
				$staticpageblocks_array[$key]['static_page_id']=!empty($val['static_page_id'])?$val['static_page_id']:"";
				$getpagedetails=PageMaster::model()->find(array('condition'=>'slug="'.$val['page_menu'].'"'));	
				$staticpageblocks_array[$key]['page_id']=!empty($getpagedetails['page_id'])?$getpagedetails['page_id']:"";
				$staticpageblocks_array[$key]['page_name']=!empty($getpagedetails['page_name'])?$getpagedetails['page_name']:"";
				$staticpageblocks_array[$key]['page_slug']=!empty($getpagedetails['slug'])?$getpagedetails['slug']:"";
				$staticpageblocks_array[$key]['static_page_block_title']=!empty($val['title'])?$val['title']:"";
				$staticpageblocks_array[$key]['static_page_block_content']=!empty($val['content'])?$val['content']:"";
				$staticpageblocks_array[$key]['type']=!empty($val['type'])?$val['type']:"";
				$staticpageblocks_array[$key]['attachment']=!empty($val['attachment'])?$val['attachment']:"";
				$staticpageblocks_array[$key]['static_page_block_slug']=!empty($val['slug'])?$val['slug']:"";
				$staticpageblocks_array[$key]['created_date']=!empty($val['created_date'])?$val['created_date']:"";
				$staticpageblocks_array[$key]['updated_date']=!empty($val['updated_date'])?$val['updated_date']:"";
				$staticpageblocks_array[$key]['status']=!empty($val['status'])?$val['status']:"";
				$staticpageblocks_array[$key]['url']=!empty($val['url'])?$val['url']:"";
				$staticpageblocks_array[$key]['meta_description']=!empty($val['meta_description'])?$val['meta_description']:"";
				$staticpageblocks_array[$key]['meta_keyword']=!empty($val['meta_keyword'])?$val['meta_keyword']:"";
			}
		}
		
		$prepare_json_encode=json_encode($staticpageblocks_array);
		$create_json_file=file_put_contents($json_creation_path.'/'.'staticpageblocks.json', $prepare_json_encode);
		$msg="JSON File For Static Page Blocks Created Successfully...";
		
		$this->render('result',array(
			'msg'=>$msg,
		));	
	}
	
	public function actionRegistrationsmemberships()
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
		$msg="JSON File For Registrations Memberships Created Successfully...";
		
		$this->render('result',array(
			'msg'=>$msg,
		));	
	}
}	
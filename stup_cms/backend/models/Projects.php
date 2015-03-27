<?php
class Projects extends CActiveRecord
{
	public $slideropt;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{projects}}';
	}

	public function rules()
	{
		return array(
			array('sector_id, title, description, image', 'required'),
			array('image, slug', 'length', 'max'=>200),
			array('status', 'length', 'max'=>1),
			
			array('slideropt', 'ext.YiiConditionalValidator',
				'if' => array(
					array('slideropt', 'compare', 'compareValue'=>"horizontal"),
				),
				'then' => array(
					array('image','file','allowEmpty'=>true,'on'=>'update'),
					array('image', 'EImageValidator', 'types' => "gif, jpg, png", 'typesError' => 'Invalid File Type','width' => 977, 'height' => 435, 'dimensionError' => 'Upload Image with 977*435 dimension','allowEmpty'=>true,'on'=>'update'),
				),
			),
			
			array('slideropt', 'ext.YiiConditionalValidator',
				'if' => array(
					array('slideropt', 'compare', 'compareValue'=>"vertical"),
				),
				'then' => array(
					array('image','file','allowEmpty'=>true,'on'=>'update'),
					array('image', 'EImageValidator', 'types' => "gif, jpg, png", 'typesError' => 'Invalid File Type','width' => 534, 'height' => 535, 'dimensionError' => 'Upload Image with 534*535 dimension','allowEmpty'=>true,'on'=>'update'),
				),
			),
				
			array('created_date, updated_date', 'safe'),
			array('project_id, sector_id, title, description, image, slug, created_date, updated_date, status, url, meta_description, meta_keyword,slideropt,project_position', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'project_id' => 'Project ID',
			'sector_id' => 'Sector',
			'title' => 'Title',
			'description' => 'Description',
			'image' => 'Image',
			'slug' => 'Slug',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'status' => 'Status',
			'url' => 'Meta URL',
			'meta_description' => 'Meta Description',
			'meta_keyword' => 'Meta Keyword',
			'project_position'=>'Position',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('sector_id',$this->sector_id);
		$criteria->compare('title',$this->title);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keyword',$this->meta_keyword,true);
		$criteria->compare('project_position',$this->project_position,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function showimage($image)
	{
		$getimagepath=ApplicationConfig::app()->params["url_path"]["projects"].$image;
		return "<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='200' height='200'></a>";
	}
	
	public static function showimageNew($project_id)
	{
		$getallimages=ProjectImages::model()->findAll(array('condition'=>'project_id='.$project_id));
		$showfullimg="";
		foreach($getallimages as $imgkey=>$imgval)
		{
			$getimagepath=ApplicationConfig::app()->params["url_path"]["projects"].$imgval['image'];
			$showfullimg.="<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='200' height='200'></a>&nbsp;";	
		}
		return $showfullimg;
	}
	
	public static function showimageNewadmin($project_id)
	{
		$getallimages=ProjectImages::model()->findAll(array('condition'=>'project_id='.$project_id));
		$showfullimg="";
		
		$fetch_image=!empty($getallimages[0]['image'])?$getallimages[0]['image']:"";
		$getimagepath=ApplicationConfig::app()->params["url_path"]["projects"].$fetch_image;
		$showfullimg.="<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='200' height='200'></a>&nbsp;";	
		
		return $showfullimg;
	}
	
	public static function showcontent($content)
	{
		if(strlen($content) > 100)
		{
			$show_content = substr($content, 0, 100)."..";
		}
		else
		{
			$show_content=$content;
		}
		return $show_content;
	}
	
	public static function showSectorDetail($sector_id)
	{
		$getsectordetail=Sectors::model()->findByPk($sector_id);
		return !empty($getsectordetail['title'])?$getsectordetail['title']:"";
	}
	
	public static function showprojdetails($project_id)
	{
		$getprojectdetail=Projects::model()->findByPk($project_id);
		return !empty($getprojectdetail['title'])?$getprojectdetail['title']:"";
	}
}
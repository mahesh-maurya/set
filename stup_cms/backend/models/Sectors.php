<?php
class Sectors extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{sectors}}';
	}

	public function rules()
	{
		return array(
			array('title, description, image, thumbnail_image,slider_option', 'required'),
			array('title', 'length', 'max'=>150),
			array('status', 'length', 'max'=>1),
			
			array('image','file','allowEmpty'=>true,'on'=>'update'),
			/*array('image', 'EImageValidator', 'types' => "gif, jpg, png", 'typesError' => 'Invalid File Type','width' => 498, 'height' => 243, 'dimensionError' => 'Upload Image with 498*243 dimension','allowEmpty'=>true,'on'=>'update'),*/
			array('image', 'EImageValidator', 'types' => "gif, jpg, png", 'typesError' => 'Invalid File Type','allowEmpty'=>true,'on'=>'update'),
			
			array('thumbnail_image','file','allowEmpty'=>true,'on'=>'update'),
			array('image', 'EImageValidator', 'types' => "gif, jpg, png", 'typesError' => 'Invalid File Type','width' => 201, 'height' => 166, 'dimensionError' => 'Upload Image with 201*166 dimension','allowEmpty'=>true,'on'=>'update'),
				
			array('created_date, updated_date', 'safe'),
			array('sector_id, title, description, image, slug, created_date, updated_date, status, url, meta_description, meta_keyword, thumbnail_image,slider_option,position', 'safe', 'on'=>'search'),
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
			'sector_id' => 'Sector ID',
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
			'thumbnail_image'=>'Thumbnail Image',
			'slider_option'=>'Slider Option',
			'position'=>'Position',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('sector_id',$this->sector_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('thumbnail_image',$this->thumbnail_image,true);
		$criteria->compare('slider_option',$this->slider_option,true);
		$criteria->compare('slug',$this->slug);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keyword',$this->meta_keyword,true);
		$criteria->compare('position',$this->position,true);
			
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array(
				'defaultOrder' => 'position ASC', 
			),
			'pagination'=>array(
				'pageSize'=>12,
			),
		));
	}
	
	public static function showimage($image)
	{
		$getimagepath=ApplicationConfig::app()->params["url_path"]["sectors"].$image;
		return "<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='200' height='200'></a>";
	}
	
	public static function showthumbimage($image)
	{
		$getimagepath=ApplicationConfig::app()->params["url_path"]["sectors_small"].$image;
		return "<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='200' height='200'></a>";
	}
	
	public static function showsectordata($sectorid)
	{
		$getalldetails=Sectors::model()->find(array("condition"=>"sector_id=".$sectorid));
		return !empty($getalldetails['title'])?$getalldetails['title']:""; 	
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
}
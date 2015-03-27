<?php
class Frontpagesliderimage extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{frontpage_slider_image}}';
	}

	public function rules()
	{
		return array(
			array('title, image', 'required'),
			array('title, slug', 'length', 'max'=>150),
			
			array('image','file','allowEmpty'=>true,'on'=>'update'),
			array(
				'image', 'EImageValidator', 'types' => "gif, jpg, png", 'typesError' => 'Invalid File Type','width' => 1200, 'height' => 651, 'dimensionError' => 'Upload Image with 1200*651 dimension','allowEmpty'=>true,'on'=>'update'),
			
			array('status', 'length', 'max'=>1),
			array('description, created_date, updated_date', 'safe'),

			array('frontpage_slider_image_id, title, description, link, image, created_date, updated_date, slug, status, url, meta_description, meta_keyword', 'safe', 'on'=>'search'),
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
			'frontpage_slider_image_id' => 'Frontpage Slider Image ID',
			'title' => 'Title',
			'description' => 'Description',
			'link' => 'Link',
			'image' => 'Image',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'slug' => 'Slug',
			'status' => 'Status',
			'url' => 'Meta URL',
			'meta_description' => 'Meta Description',
			'meta_keyword' => 'Meta Keyword',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('frontpage_slider_image_id',$this->frontpage_slider_image_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keyword',$this->meta_keyword,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function showimage($image)
	{
		$getimagepath=ApplicationConfig::app()->params["url_path"]["homepage_banners"].$image;
		return "<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='200' height='200'></a>";
	}
}
<?php
class Pagebanner extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{page_banner}}';
	}

	public function rules()
	{
		return array(
			array('page_name, title, image', 'required'),
			array('page_name', 'length', 'max'=>150),
			array('title, slug', 'length', 'max'=>200),
			array('link, image', 'length', 'max'=>250),
			
			array('image','file','allowEmpty'=>true,'on'=>'update'),
			array('image', 'EImageValidator', 'types' => "gif, jpg, png", 'typesError' => 'Invalid File Type','allowEmpty'=>true,'on'=>'update'),
				
			array('status', 'length', 'max'=>1),
			array('created_date, updated_date', 'safe'),
			array('page_banner_id, page_name, title, link, slug, image, created_date, updated_date, status, url, meta_description, meta_keyword', 'safe', 'on'=>'search'),
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
			'page_banner_id' => 'Page Banner ID',
			'page_name' => 'Page Name',
			'title' => 'Title',
			'link' => 'Link',
			'slug' => 'Slug',
			'image' => 'Image',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'status' => 'Status',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('page_banner_id',$this->page_banner_id);
		$criteria->compare('page_name',$this->page_name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
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
		$getimagepath=ApplicationConfig::app()->params["url_path"]["page_banners"].$image;
		return "<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='200' height='200'></a>";
	}
}
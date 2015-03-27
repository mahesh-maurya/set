<?php
class Services extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{services}}';
	}

	public function rules()
	{
		return array(
			array('sector_id, title', 'required'),
			array('title, image', 'length', 'max'=>150),
			array('slug', 'length', 'max'=>250),
			array('status', 'length', 'max'=>1),
			
			array('image','file','allowEmpty'=>true),
			array('image', 'EImageValidator', 'types' => "gif, jpg, png", 'typesError' => 'Invalid File Type','allowEmpty'=>true),
			
			array('description, created_date, updated_date', 'safe'),
			array('service_id, sector_id, title, description, image, slug, created_date, updated_date, status, url, meta_description, meta_keyword, service_position', 'safe', 'on'=>'search'),
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
			'service_id' => 'Service ID',
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
			'service_position'=>'Position',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('sector_id',$this->sector_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keyword',$this->meta_keyword,true);
		$criteria->compare('service_position',$this->service_position,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
	
	public static function showimage($image)
	{
		$getimagepath=ApplicationConfig::app()->params["url_path"]["services"].$image;
		return "<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='200' height='200'></a>";
	}
	
	public static function showSectorDetail($sector_id)
	{
		$getsectordetail=Sectors::model()->findByPk($sector_id);
		return !empty($getsectordetail['title'])?$getsectordetail['title']:"";
	}
}
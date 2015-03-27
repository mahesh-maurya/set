<?php
class RegistrationsMemberships extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{registrations_memberships}}';
	}

	public function rules()
	{
		return array(
			array('title, image', 'required'),
			array('title, image, slug', 'length', 'max'=>150),
			array('link', 'length', 'max'=>250),
			array('status', 'length', 'max'=>1),
			
			array('image','file','allowEmpty'=>true,'on'=>'update'),
			array('image', 'EImageValidator', 'types' => "gif, jpg, png", 'typesError' => 'Invalid File Type','allowEmpty'=>true,'on'=>'update'),				
			
			array('created_date, updated_date', 'safe'),
			array('reg_prof_membership_id, title, image, slug, link, created_date, updated_date, status, url, meta_description, meta_keyword', 'safe', 'on'=>'search'),
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
			'reg_prof_membership_id' => 'Registration Membership ID',
			'title' => 'Title',
			'image' => 'Image',
			'slug' => 'Slug',
			'link' => 'Link',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'status' => 'Status',
			'url' => 'Meta URL',
			'meta_description' => 'Meta Description',
			'meta_keyword' => 'Meta Keyword',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('reg_prof_membership_id',$this->reg_prof_membership_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('link',$this->link,true);
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
		$getimagepath=ApplicationConfig::app()->params["url_path"]["registration_memberships"].$image;
		return "<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='50' height='50'></a>";
	}
	
	public static function showlogoimage($image)
	{
		$getimagepath=ApplicationConfig::app()->params["url_path"]["registration_memberships"].$image;
		return "<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='120' height='120'></a>";
	}
}
<?php
class Sectorbanners extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{sector_banners}}';
	}

	public function rules()
	{
		return array(
			array('sector_id, title, image', 'required'),
			array('title, link, slug, image', 'length', 'max'=>150),
			array('status', 'length', 'max'=>1),
			
			array('image','file','allowEmpty'=>true,'on'=>'update'),
			array('image', 'EImageValidator', 'types' => "gif, jpg, png", 'typesError' => 'Invalid File Type','width' => 1200, 'height' => 276, 'dimensionError' => 'Upload Image with 1200*276 dimension','allowEmpty'=>true,'on'=>'update'),
			
			array('created_date, updated_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sector_banner_id, sector_id,sector_slug, title, link, slug, image, created_date, updated_date, status, url, meta_description, meta_keyword', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sector_banner_id' => 'Sector Banner ID',
			'sector_id' => 'Sector',
			'sector_slug' => 'Sector Slug',
			'title' => 'Title',
			'link' => 'Link',
			'slug' => 'Slug',
			'image' => 'Image',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'status' => 'Status',
			'url' => 'Meta URL',
			'meta_description' => 'Meta Description',
			'meta_keyword' => 'Meta Keyword',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		
		if($this->sector_id=='0')
		{
			$criteria->addInCondition('status', array('0', '1'));
			$criteria->compare('status',$this->status,true);
		} 
		else
		{
			$criteria->compare('sector_banner_id',$this->sector_banner_id);
			$criteria->compare('sector_id',$this->sector_id);
			$criteria->compare('sector_slug',$this->sector_slug);
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
		}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=>'10',
			),
		));
	}
	
	public static function showimage($image)
	{
		$getimagepath=ApplicationConfig::app()->params["url_path"]["sector_banners"].$image;
		return "<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='200' height='200'></a>";
	}
}
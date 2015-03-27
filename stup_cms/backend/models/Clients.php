<?php

/**
 * This is the model class for table "{{clients}}".
 *
 * The followings are the available columns in table '{{clients}}':
 * @property integer $client_id
 * @property integer $client_type
 * @property string $title
 * @property string $image
 * @property integer $slug
 * @property string $link
 * @property string $created_date
 * @property string $updated_date
 * @property string $status
 * @property string $url
 * @property string $meta_description
 * @property string $meta_keyword
 */
class Clients extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Clients the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{clients}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_type, title, image', 'required'),
			array('client_type', 'numerical', 'integerOnly'=>true),
			array('title, url, meta_keyword', 'length', 'max'=>200),
			array('image, link', 'length', 'max'=>250),
			
			array('image','file','types' => "gif, jpg, png",'allowEmpty'=>true,'on'=>'update'),
			
			array('status', 'length', 'max'=>1),
			array('created_date, updated_date, meta_description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('client_id, client_type, title, image, slug, link, created_date, updated_date, status, url, meta_description, meta_keyword', 'safe', 'on'=>'search'),
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
			'client_id' => 'Client ID',
			'client_type' => 'Client Type',
			'title' => 'Title',
			'image' => 'Image',
			'slug' => 'Slug',
			'link' => 'Link',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'status' => 'Status',
			'url' => 'Meta Url',
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

		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('client_type',$this->client_type);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('slug',$this->slug);
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
		$getimagepath=ApplicationConfig::app()->params["url_path"]["clients"].$image;
		return "<a target='_blank' href='".$getimagepath."'><img src='".$getimagepath."' width='50' height='50'></a>";
	}
	
	public static function showClientType($cltype)
	{
		if($cltype=='1')
		{
			return "Funding Agencies";
		}
		else if($cltype=='2')
		{
			return "Government Bodies";
		}
		else if($cltype=='3')
		{
			return "Contractors & Developers";
		}
		else if($cltype=='4')
		{
			return "Corporations";
		}
		else
		{
			return "";
		}
	}
}
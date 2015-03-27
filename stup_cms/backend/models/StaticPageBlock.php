<?php

/**
 * This is the model class for table "{{static_page_block}}".
 *
 * The followings are the available columns in table '{{static_page_block}}':
 * @property integer $static_page_id
 * @property string $page_menu
 * @property string $title
 * @property string $content
 * @property string $type
 * @property string $attachment
 * @property string $slug
 * @property string $created_date
 * @property string $updated_date
 * @property string $status
 */
class StaticPageBlock extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StaticPageBlock the static model class
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
		return '{{static_page_block}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_menu, title, content', 'required'),
			array('page_menu, title, type, slug', 'length', 'max'=>100),
			array('attachment', 'length', 'max'=>500),
			array('status', 'length', 'max'=>1),
			array('created_date, updated_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('static_page_id, page_menu, title, content, type, attachment, slug, created_date, updated_date, status, meta_description, meta_keyword, url', 'safe', 'on'=>'search'),
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
			'static_page_id' => 'Static Page ID',
			'page_menu' => 'Page Menu',
			'title' => 'Title',
			'content' => 'Content',
			'type' => 'Type',
			'attachment' => 'Attachment',
			'slug' => 'Slug',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'status' => 'Status',
			'meta_description' => 'Meta Description',
			'meta_keyword' => 'Meta Keyword',
			'url' => 'Meta URL',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('static_page_id',$this->static_page_id);
		$criteria->compare('page_menu',$this->page_menu,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('attachment',$this->attachment,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keyword',$this->meta_keyword,true);
		$criteria->compare('url',$this->url,true);

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
}
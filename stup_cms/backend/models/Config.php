<?php

/**
 * This is the model class for table "{{config}}".
 *
 * The followings are the available columns in table '{{config}}':
 * @property integer $configID
 * @property string $site_name
 * @property string $site_email
 * @property string $logo
 * @property string $created
 * @property string $modified
 */
class Config extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Config the static model class
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
		return '{{config}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_name,site_email', 'required'),
			array('site_name', 'length', 'max'=>300),
			array('site_email', 'length', 'max'=>400),
			array('logo', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('configID, site_name, site_email, logo, created, modified,', 'safe', 'on'=>'search'),
			
			array('site_name, site_email', 'filter', 'filter' => 'strip_tags'),
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
			'configID' => 'Config',
			'site_name' => 'Site Name',
			'site_email' => 'Site Email',
			'logo' => 'Logo',
			'created' => 'Created',
			'modified' => 'Modified',
			'voting_start_time' => 'Voting Start Time',
			'voting_end_time' => 'Voting Close Time',
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

		$criteria->compare('configID',$this->configID);
		$criteria->compare('site_name',$this->site_name,true);
		$criteria->compare('site_email',$this->site_email,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('voting_end_time',$this->voting_end_time,true);
		$criteria->compare('voting_start_time',$this->voting_start_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getTime($type)
	    {
	        switch ($type)
	        {
			case 'START':
			$t = Config::model()->findAll();
			return $t[0]->voting_start_time;
			
			case 'CLOSE':
			$t = Config::model()->findAll();
			return $t[0]->voting_end_time;
			
			}
		}	
			
		public static function getModel($type, $arrParams = array())
	    {
	        switch ($type)
	        {
	            case 'CONFIG-ID':
	                return Config::model()->findByPk($arrParams['configID']);
	                break;
	             
	            case 'VIDEO-CAROUSEL':
	               $t = Config::model()->findAll();
	               if (!empty($t[0]->video_carousel))
				   return Terms::model()->getModel("TERM-ID",array('termID'=>$t[0]->video_carousel));
				   else 
				   return Terms::model()->getModel("SLUG",array('slug'=>'auditions'));
	                break;
	
	        }
	    }
}
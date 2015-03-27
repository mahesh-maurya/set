<?php

/**
 * This is the model class for table "{{project_images}}".
 *
 * The followings are the available columns in table '{{project_images}}':
 * @property integer $project_image_id
 * @property integer $project_id
 * @property string $image
 * @property string $created_date
 * @property string $updated_date
 * @property string $status
 */
class ProjectImages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjectImages the static model class
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
		return '{{project_images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, image', 'required'),
			array('project_id', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>150),
			array('status', 'length', 'max'=>1),
			array('created_date, updated_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('project_image_id, project_id, image, created_date, updated_date, status,sortorder', 'safe', 'on'=>'search'),
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
			'project_image_id' => 'Project Image',
			'project_id' => 'Project',
			'image' => 'Image',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'status' => 'Status',
			'sortorder'=>'Sort Order',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($param = array())
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria($param);

		$criteria->compare('project_image_id',$this->project_image_id);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('sortorder',$this->sortorder,true);
		$criteria->addInCondition('status', array ('0','1'));
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>10,
			),
			'sort'=>array(
				'defaultOrder'=>'sortorder ASC',
			),
		));
	}
}
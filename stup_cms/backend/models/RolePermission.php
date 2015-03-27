<?php

/**
 * This is the model class for table "{{role_permission}}".
 *
 * The followings are the available columns in table '{{role_permission}}':
 * @property integer $rolePermissionID
 * @property integer $roleID
 * @property string $permissionName
 * @property string $created
 */
class RolePermission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RolePermission the static model class
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
		return '{{role_permission}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('roleID', 'numerical', 'integerOnly'=>true),
			array('permissionName, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rolePermissionID, roleID, permissionName, created', 'safe', 'on'=>'search'),
			array('created',
            'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' =>
            'insert'), 
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
			'rolePermissionID' => 'Role Permission',
			'roleID' => 'Role',
			'permissionName' => 'Permission Name',
			'created' => 'Created',
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

		$criteria->compare('rolePermissionID',$this->rolePermissionID);
		$criteria->compare('roleID',$this->roleID);
		$criteria->compare('permissionName',$this->permissionName,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getModel($type, $arrParams = array())
    {
        switch ($type)
        {
        	case 'ROLE-ID':
        		return RolePermission::model()->find('roleID=?',array($arrParams['roleID']));
        }
    }
    
      public static function getList($type, $arrParams = array())
     {
        switch ($type)
        {
        	case 'ALL':
        		return RolePermission::model()->findAll();
        		break;
        }
    }
}
<?php

/**
 * This is the model class for table "{{role}}".
 *
 * The followings are the available columns in table '{{role}}':
 * @property string $id
 * @property string $name
 * @property string $status
 * @property string $created
 * @property string $modified
 */
class Role extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Role the static model class
     */
    public static function model($className = __class__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{role}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(array('name,status', 'required'), array('name', 'unique'), array('name',
            'length', 'max' => 55), array('status', 'length', 'max' => 8), array('modified',
            'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' =>
            'update'), array('created,modified', 'default', 'value' => new CDbExpression('NOW()'),
            'setOnEmpty' => false, 'on' => 'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
        array('id, name, status, description,created, modified', 'safe', 'on' => 'search'), array('modified',
            'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' =>
            'update'), array('created,modified', 'default', 'value' => new CDbExpression('NOW()'),
            'setOnEmpty' => false, 'on' => 'insert'), );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array('id' => 'ID', 'name' => 'Role Name', 'status' => 'Role Description',
            'status' => 'Status', 'created' => 'Created', 'modified' => 'Modified', );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
    public static function getList($type, $arrParams = null)
    {
        switch ($type)
        {
            case 'ROLE-ID':
                $arrList = Role::model()->findAll();
                foreach ($arrList as $List)
                {
                    $AllList[$List->id] = $List->name;
                }
                //echo '<pre>';print_r($AllList);exit;
                $arrData = $AllList;
                return $arrData;
                break;
                
                case 'ALL':
                	return Role::model()->findAll();
                	break;
        }
    }
    public function getModel($type, $arrParams = null)
    {
        switch ($type)
        {
            case 'ROLE-ID':

                return Role::model()->find('id=?', $arrParams['id']);
                break;
        }
    }
 public function getUserRoles($type, $arrParams = null)
    {
        switch ($type)
        {
            case 'ROLE-IDS':
				$arrRoles = explode(",", $arrParams['id']);
				$roleNames = "";
				if (!empty($arrRoles))
				foreach ($arrRoles as $role){
                	
					$roleObj =  Role::model()->find('id=?', array($role));
					
					if (!empty($roleNames))
                	$roleNames .=", ". $roleObj->name;
                	else  
                	$roleNames .="". $roleObj->name;
				}
				return $roleNames;
                break;
        }
    }
}

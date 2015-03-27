<?php

/**
 * This is the model class for table "{{menus}}".
 *
 * The followings are the available columns in table '{{menus}}':
 * @property integer $menuID
 * @property string $menu_name
 * @property integer $parentID
 * @property string $created
 * @property string $modified
 */
class Menus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menus the static model class
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
		return '{{menus}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('main_menuID, menu_name, system_url, menu_description,active', 'required'),
			array('parentID', 'numerical', 'integerOnly'=>true),
			array('sortOrder', 'numerical', 'integerOnly'=>true),
			array('active', 'numerical', 'integerOnly'=>true),
			array('menu_name', 'length', 'max'=>300),
			array('modified', 'default', 'value' => new CDbExpression('NOW()'),'setOnEmpty' => false, 'on' => 'update'),
         	array('modified,created', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert'), 
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('menuID, menu_name, parentID, created, modified, system_url,active', 'safe', 'on'=>'search'),
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
			'menuID' => 'Menu Item',
			'menu_name' => 'Menu Item Name',
			'menu_image' => 'Menu Item Image',
			'parentID' => 'Parent Menu Item',
			'system_url'=>'System Url',
			'created' => 'Created',
			'modified' => 'Modified',
			'main_menuID' =>'Menu Name'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id = null , $pid = null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('menuID',$this->menuID);
		
		if (!empty($id))
		$criteria->compare('main_menuID',$id,true);
		else 
		$criteria->compare('main_menuID',$this->main_menuID,true);
		
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('parentID',$pid);
		$criteria->compare('system_url',$this->system_url);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->order = 'sortOrder ASC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
   public static function getList($type, $arrParams = array())
    {
        switch ($type)
        {
            case 'PARENT-LIST':
                return Menus::model()->findAll(array('condition'=>'active=1 AND main_menuID='.$arrParams['main_menuID']));
                break;
				
				case 'ALL':
                return Menus::model()->findAll();
                break;
                
                case 'BACKEND':
                return Menus::model()->findAll(array('order'=>'sortOrder ASC','condition'=>'active=1 AND main_menuID='.$arrParams['main_menuID']));
                break;
                
                case 'FRONTEND':
                return Menus::model()->findAll(array('condition'=> 'active=1 AND main_menuID = 3'));
                break;
                
                case 'MAIN-MENU':
                return Menus::model()->findAll(array('condition'=> 'main_menuID = '.$arrParams['id']));
                break;
                
                case 'FRONTEND-CHILD':
                //return Menus::model()->findAll('parentID = ?',array($arrParams['parentID']));
                return Menus::model()->findAll(array('condition'=>'active=1 AND parentID = '.$arrParams['parentID']));
                break;
                
        }
    }
    
 public function getModel($type, $arrParams = array())
    {
        switch ($type)
        {
            case 'MENU-ID':
                $a= Menus::model()->findByPk($arrParams['menuID']);
				echo '<pre>'; print_r($a->getAttributes('menu_name'));
                break;
				
			case 'MENU-ID-NAME':
                $a= Menus::model()->findByPk($arrParams['menuID']);
				if(!empty($a))
				return $a->getAttribute('menu_name');
				else
				return '';
                break;	

        }
    }
}
<?php

/**
 * This is the model class for table "{{main_menu}}".
 *
 * The followings are the available columns in table '{{main_menu}}':
 * @property integer $main_menuID
 * @property string $menu_name
 * @property integer $position
 * @property string $created
 * @property string $modified
 */
class MainMenu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MainMenu the static model class
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
		return '{{main_menu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_name, menu_description,position', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('menu_name', 'length', 'max'=>300),
			array('modified', 'default', 'value' => new CDbExpression('NOW()'),'setOnEmpty' => false, 'on' => 'update'),
         	array('modified,created', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert'), 
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('main_menuID, menu_name, position, created, modified', 'safe', 'on'=>'search'),
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
			'main_menuID' => 'Main Menu',
			'menu_name' => 'Menu Name',
			'position' => 'Position',
			'created' => 'Created',
			'modified' => 'Modified',
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

		$criteria->compare('main_menuID',$this->main_menuID);
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function getList($type, $arrParams = array())
	    {
	        switch ($type)
	        {
	            case 'MENU-LIST':
	                return MainMenu::model()->findAll(array('order' => 'created'));
	                break;
	
	        }
	    }
	public function getModel($type, $arrParams = array())
	    {
	        switch ($type)
	        {
	            case 'MENU-ID':
	                return MainMenu::model()->findByPk($arrParams['main_menuID']);
	                break;
	                
	            case 'SUBMENU-ID':
	                return Menus::model()->findByPk($arrParams['main_menuID']);
	                break;    
	
	        }
	    }
	    
}
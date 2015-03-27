<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BackendApplicationConfig
{

    private static $instance;

    private function __construct()
    {
    }

    public static function app()
    {
        if (!isset(self::$instance))
        {
            $c = __class__;
            self::$instance = new $c;
            //var_dump(self::$instance);exit;
            self::$instance->setParams();
            
            //Yii::app()->components('clientscript', array('class'=>'ext.minScript.components.ExtMinScript'));
            
        }

        return self::$instance;
    }

    public function setParams()
    {
    	    	
    	$array['menus'] = array(
    	'position' => array('1'=>'Header','2'=>'Left','3'=>'Footer')
    	);

    	$array['user'] = array(
    	'permissions' => array()
    	);
    	
    	$array['module'] = array('backup' => 'backup');
    	
    	$array['theme'] = array(
    	'jsUrl' => Yii::app()->theme->baseUrl .'/js/',
    	'cssUrl' => Yii::app()->theme->baseUrl .'/css/', 
    	'imageUrl' => Yii::app()->theme->baseUrl .'/images/',
    	);
    	 
    	$array['folder_path'] = array(
    	'applicationLogo' => YiiBase::getPathOfAlias('common.images') . '/',
    	);
		
    	$array['url_path'] = array(
    	'applicationLogo' => Yii::app()->baseUrl.'/images/',
    	);
    	
    	$array['scaling_params'] = array( 
    	);
    	
		
    	$this->params = $array;
    }

    public static function getImagedimensions($type)
    {
        switch ($type)
        {
            case 'large':
                return array('scale' => 99);
                break;

            case 'mid':
                return array('width' => 220, 'height' => 140);
                break;

            case 'small':
                return array('width' => 120, 'height' => 80);
                break;
        }
    }

    public static function mulltiSelect($selected, $list, $arrParams = array())
    {
        $cnt = 0;
        echo CHtml::tag('option', array('value' => ''), CHtml::encode($arrParams['empty']), true);
        foreach ($list as $id => $value)
        {
            if (count($selected) > $cnt && $selected[$cnt] == $id)
            {
                //                    echo $cityID[$cnt]."...".$id;exit;
                echo CHtml::tag('option', array('value' => $id, 'selected' => 'selected'), CHtml::
                    encode($value), true);
                $cnt++;
            } else
            {
                echo CHtml::tag('option', array('value' => $id), CHtml::encode($value), true);
            }
        }
    }



}
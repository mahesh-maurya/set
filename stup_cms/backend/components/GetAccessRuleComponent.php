<?php
/*
 * if you want to access this just use the below code in accessRules() function of any controller
 *     return Yii::app()->GetAccessRule->get();
 * */
class GetAccessRuleComponent extends CApplicationComponent
{
    public function init()
    {
    }

    public function get($arrViewAction = null, $arrUpdateAction = null)
    {
		//$userDetails = User::model()->getModel('BYID',array('id'=>Yii::app()->user->id));
		$roles = explode(",", ApplicationSessions::run()->read('role'));
		
		$result_arr = array();
		$permission = ApplicationSessions::run()->read('permissions');
		$access_arr = array();
		//var_dump($permission);exit;
		$moduleName = '' ; 
		$controllerName = 	Yii::app()->controller->id;	
		if(!empty($permission))
		{
		foreach($permission as $permissionKey => $permissionValue){
				$permissionValueArr = explode(',',$permissionValue); 
				
				foreach($permissionValueArr as $permissionValueArrKey => $permissionValueArrValue)
				{
					$array_of_permission = explode(".", $permissionValueArrValue);
						foreach ($array_of_permission as $key1 => $link)
						{
						    if ($array_of_permission[$key1] == '')
						    {
						        unset($array_of_permission[$key1]);
						    }
						}
						$array_of_permission = array_values($array_of_permission);
						//echo '<pre>'; print_r($array_of_permission);exit;
					if(strtoupper($array_of_permission[0])==strtoupper($controllerName)){
						$access_arr[] = $array_of_permission[1];
					} 
				}
				
		}
		//echo '<pre>'; print_r($access_arr);exit;
		if(!empty($access_arr)){
			  $result_arr = array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array_unique($access_arr),
					'users'=>array('@'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
    	} else {
    		 $result_arr = array(
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
    	}
    	//var_dump($result_arr);exit;
    	return $result_arr;
		}
		else
		{
		Yii::app()->controller->redirect(array('/site/login'));
		//CController.redirect(array('user/login'));
		}
    }


}

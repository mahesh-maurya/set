<?php
/**
 * Controller.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:55 AM
 */
class Controller extends CController {

	public $breadcrumbs = array();
	public $menu = array();
	
	protected function beforeAction($event)
    {
       // print_r($event);exit;
		  $usersessiontimeout = ApplicationSessions::run()->read('usersessiontimeout');
			if ( !empty($usersessiontimeout) && ($usersessiontimeout < time()) ) 
			{
                    Yii::app()->user->logout();
                    ApplicationSessions::run()->delete('id');
			        ApplicationSessions::run()->delete('role');
			        ApplicationSessions::run()->delete('email');
					ApplicationSessions::run()->delete('permissions');
					ApplicationSessions::run()->delete('usersessiontimeout');
					return false;
           }
           else 
           {
           		ApplicationSessions::run()->write('usersessiontimeout', time()+60*60);
				return true;
           }
               
			
    }

}

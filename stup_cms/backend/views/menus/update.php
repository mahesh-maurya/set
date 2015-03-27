<?php
/* @var $this MenusController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menu Item List'=>ApplicationConfig::getURL("", "menus", "admin",array('id'=>$model->main_menuID,'pid'=>$model->parentID)),
	'Update',
);


$this->menu=array(
array('label'=>'Create Menu Item', 'url'=>ApplicationConfig::getURL("", "menus", "create",array('id'=>$model->main_menuID,'pid'=>$model->parentID))),
array('label'=>'List Menu Items', 'url'=>ApplicationConfig::getURL("", "menus", "admin",array('id'=>$model->main_menuID,'pid'=>$model->parentID))),
);
?>

<?php 
if(isset($model->parentID) && $model->parentID == 0)
{
	if (isset($model->main_menuID))
	{
		$mainMenuObj = MainMenu::model()->getModel("MENU-ID",array("main_menuID"=>$model->main_menuID));
		$menuName =  $mainMenuObj->menu_name;
	}
	else 
	$menuName = "";
	
}	
else 
{
	if (isset($model->parentID))
	{
		$mainMenuObj = MainMenu::model()->getModel("SUBMENU-ID",array("main_menuID"=>$model->parentID));
		$menuName = $mainMenuObj->menu_name;
	}
	else 
	$menuName = "";
}
?>

<h3>Update Menu Item <?php echo $menuName; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this MenusController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menu Item List'=>ApplicationConfig::getURL("", "menus", "admin",array('id'=>$_GET['id'],'pid'=>$_GET['pid'])),
	'Create',
);


$this->menu=array(
array('label'=>'Create Menu Item', 'url'=>ApplicationConfig::getURL("", "menus", "create",array('id'=>$_GET['id'],'pid'=>$_GET['pid']))),
 	array('label'=>'List Menu Items', 'url'=>ApplicationConfig::getURL("", "menus", "admin",array('id'=>$_GET['id'],'pid'=>$_GET['pid']))),
);

?>
<?php 
if(isset($_GET['pid']) && $_GET['pid'] == 0)
{
	if (isset($_GET['id']))
	{
		$mainMenuObj = MainMenu::model()->getModel("MENU-ID",array("main_menuID"=>$_GET['id']));
		$menuName =  $mainMenuObj->menu_name;
	}
	else 
	$menuName = "";
	
}	
else 
{
	if (isset($_GET['pid']))
	{
		$mainMenuObj = MainMenu::model()->getModel("SUBMENU-ID",array("main_menuID"=>$_GET['pid']));
		$menuName = $mainMenuObj->menu_name;
	}
	else 
	$menuName = "";
}
?>
<h3>Create Sub Menu For <?php echo $menuName;?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model,'main_menuID'=>$_GET['id'], 'parentID'=>$_GET['pid'])); ?>
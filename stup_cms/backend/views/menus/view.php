<?php
/* @var $this MenusController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menu Item List'=>ApplicationConfig::getURL("user", "menus", "admin",array('id'=>$model->main_menuID)),
	$model->menu_name,
);

 $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>true, // whether this is a stacked menu
	'htmlOptions'=>array('style'=>'width:25%'),
    'items'=>array(
 	array('label'=>'Create Menu Item', 'url'=>ApplicationConfig::getURL("user", "menus", "create",array('id'=>$model->main_menuID))),
 	array('label'=>'List Menu Items', 'url'=>ApplicationConfig::getURL("user", "menus", "admin",array('id'=>$model->main_menuID))),
   
 ),
)); 
?>

<h1>View Menu Item #<?php echo $model->menuID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'menuID',
		'menu_name',
		'parentID',
		'created',
		'modified',
	),
)); ?>

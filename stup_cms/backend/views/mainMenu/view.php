<?php
/* @var $this MainMenuController */
/* @var $model MainMenu */

$this->breadcrumbs=array(
	'Menu List'=>array('admin'),
	$model->main_menuID,
);

 $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>true, // whether this is a stacked menu
	'htmlOptions'=>array('style'=>'width:25%'),
    'items'=>array(
 	array('label'=>'Create Menu', 'url'=>array('create')),
    array('label'=>'Manage Menus', 'url'=>array('admin')),
 ),
)); 
?>

<h1>View Menu #<?php echo $model->menu_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'main_menuID',
		'menu_name',
		'position',
		'created',
		'modified',
	),
)); ?>

<?php
/* @var $this MainMenuController */
/* @var $model MainMenu */

$this->breadcrumbs=array(
	'Menu List'=>array('admin'),
	$model->menu_name=>array('view','id'=>$model->main_menuID),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Menu', 'url'=>array('create')),
    array('label'=>'Manage Menus', 'url'=>array('admin')),
);
?>

<h3>Update Menu <?php echo $model->menu_name; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
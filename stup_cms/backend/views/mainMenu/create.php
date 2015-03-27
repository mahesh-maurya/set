<?php
/* @var $this MainMenuController */
/* @var $model MainMenu */

$this->breadcrumbs=array(
	'Menu List'=>array('admin'),
	'Create',
);

$this->menu=array(
 	array('label'=>'Create Menu', 'url'=>array('create')),
    array('label'=>'Manage Menus', 'url'=>array('admin')),
);
?>

<h3>Create Menu</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
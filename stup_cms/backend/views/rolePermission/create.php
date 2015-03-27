<?php
/* @var $this RolePermissionController */
/* @var $model RolePermission */

$this->breadcrumbs=array(
	'Role Permissions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RolePermission', 'url'=>array('index')),
	array('label'=>'Manage RolePermission', 'url'=>array('admin')),
);
?>

<h1>Create RolePermission</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
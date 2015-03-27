<?php
/* @var $this RolePermissionController */
/* @var $model RolePermission */

$this->breadcrumbs=array(
	'Role Permissions'=>array('index'),
	$model->rolePermissionID=>array('view','id'=>$model->rolePermissionID),
	'Update',
);

$this->menu=array(
	array('label'=>'List RolePermission', 'url'=>array('index')),
	array('label'=>'Create RolePermission', 'url'=>array('create')),
	array('label'=>'View RolePermission', 'url'=>array('view', 'id'=>$model->rolePermissionID)),
	array('label'=>'Manage RolePermission', 'url'=>array('admin')),
);
?>

<h1>Update RolePermission <?php echo $model->rolePermissionID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
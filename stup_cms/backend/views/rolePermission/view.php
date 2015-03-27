<?php
/* @var $this RolePermissionController */
/* @var $model RolePermission */

$this->breadcrumbs=array(
	'Role Permissions'=>array('index'),
	$model->rolePermissionID,
);

$this->menu=array(
	array('label'=>'List RolePermission', 'url'=>array('index')),
	array('label'=>'Create RolePermission', 'url'=>array('create')),
	array('label'=>'Update RolePermission', 'url'=>array('update', 'id'=>$model->rolePermissionID)),
	array('label'=>'Delete RolePermission', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rolePermissionID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RolePermission', 'url'=>array('admin')),
);
?>

<h1>View RolePermission #<?php echo $model->rolePermissionID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rolePermissionID',
		'roleID',
		'permissionName',
		'created',
	),
)); ?>

<?php
$this->breadcrumbs=array(
		'role',
		'update'
	);
?>
<div class="admin_table">
<?php 
$this->menu=array(
	array('label'=>'Create Role', 'url'=>array('role/create')),
    array('label'=>'Manage Roles', 'url'=>array('role/manageRole')),
    array('label'=>'Manage Permissions', 'url'=>array('rolePermission/index')),
);
?>
<h3>Update Role #<?php echo $model->name; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
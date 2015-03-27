<?php
$this->breadcrumbs=array(
		'access',
		'role',
		'create'
	);
?>
<div class="">
<?php 


$this->menu=array(
	array('label'=>'Create Role', 'url'=>array('role/create')),
    array('label'=>'Manage Roles', 'url'=>array('role/manageRole')),
    array('label'=>'Manage Permissions', 'url'=>array('rolePermission/index')),
);

?>
<h3>Create New Role </h3>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
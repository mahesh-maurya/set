<?php
/* @var $this RolePermissionController */
/* @var $data RolePermission */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rolePermissionID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rolePermissionID), array('view', 'id'=>$data->rolePermissionID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('roleID')); ?>:</b>
	<?php echo CHtml::encode($data->roleID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permissionName')); ?>:</b>
	<?php echo CHtml::encode($data->permissionName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


</div>
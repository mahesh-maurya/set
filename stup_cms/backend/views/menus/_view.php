<?php
/* @var $this MenusController */
/* @var $data Menus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('menuID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->menuID), array('view', 'id'=>$data->menuID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_name')); ?>:</b>
	<?php echo CHtml::encode($data->menu_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parentID')); ?>:</b>
	<?php echo CHtml::encode($data->parentID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />


</div>
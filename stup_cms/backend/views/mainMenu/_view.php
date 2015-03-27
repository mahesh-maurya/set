<?php
/* @var $this MainMenuController */
/* @var $data MainMenu */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('main_menuID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->main_menuID), array('view', 'id'=>$data->main_menuID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_name')); ?>:</b>
	<?php echo CHtml::encode($data->menu_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />


</div>
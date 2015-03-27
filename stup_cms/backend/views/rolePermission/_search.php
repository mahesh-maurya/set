<?php
/* @var $this RolePermissionController */
/* @var $model RolePermission */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'rolePermissionID'); ?>
		<?php echo $form->textField($model,'rolePermissionID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'roleID'); ?>
		<?php echo $form->textField($model,'roleID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permissionName'); ?>
		<?php echo $form->textArea($model,'permissionName',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php
/* @var $this RolePermissionController */
/* @var $model RolePermission */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'role-permission-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'roleID'); ?>
		<?php echo $form->textField($model,'roleID'); ?>
		<?php echo $form->error($model,'roleID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'permissionName'); ?>
		<?php echo $form->textArea($model,'permissionName',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'permissionName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
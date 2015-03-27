<?php
/* @var $this MainMenuController */
/* @var $model MainMenu */
/* @var $form CActiveForm */
?>

<div class="form ml34" >

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'main-menu-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">Fields with <span class="required">*</span> are required.</div>

	<div class="row">
	<?php echo $form->errorSummary($model); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'menu_name'); ?>
		<?php echo $form->textField($model,'menu_name',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'menu_name'); ?>
	</div>
	<div class="row">
			<?php echo $form->labelEx($model,'menu_description'); ?>
			<?php echo $form->textArea($model,'menu_description',array()); ?>
			<?php echo $form->error($model,'menu_description'); ?>
		</div>
	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->dropDownList($model,'position', ApplicationConfig::app()->params['menus']['position'],array('empty'=>'Select Position')); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-primary')); ?>
		<?php echo CHtml::button('Cancel', array('submit' => array('admin'),'class' => 'btn btn-primary')); ?>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
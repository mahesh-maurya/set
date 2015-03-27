<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'static-page-block-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'type'=>'horizontal',
	'htmlOptions' => array(
		'class'=>'well',
        'enctype' => 'multipart/form-data',
		),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'page_menu',$allpages,array('empty'=>'Select Page'));?>

	<?php echo $form->textFieldRow($model,'title'); ?>

	
	<div class="control-group ">
		<label for="StaticPageBlock_content" class="control-label error required">Content <span class="required">*</span></label>
		<div class="controls">
			<?php 
				$this->widget('application.extensions.ckeditor.CKEditor', array(
					'model'=>$model,
					'attribute'=>'content',
					'language'=>'en',
					'editorTemplate'=>'full',
					)); 
			?>
		</div>
	</div>
	
	<?php echo $form->textFieldRow($model,'url'); ?>

	<div class="control-group ">
		<label for="StaticPageBlock_content" class="control-label required">Meta Description </label>
		<div class="controls">
			<?php 
				$this->widget('application.extensions.ckeditor.CKEditor', array(
					'model'=>$model,
					'attribute'=>'meta_description',
					'language'=>'en',
					'editorTemplate'=>'full',
					)); 
			?>
		</div>
	</div>

	<?php echo $form->textFieldRow($model,'meta_keyword'); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

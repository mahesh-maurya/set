<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'frontpagesliderimage-form',
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

	<?php echo $form->textFieldRow($model,'title'); ?>

	<?php echo $form->textAreaRow($model,'description'); ?>

	<?php echo $form->textFieldRow($model,'link'); ?>

	<?php echo $form->fileFieldRow($model, 'image'); ?>
	
	<div style="margin-left:181px;">(Upload Image with 1200*651 resolution)</div>
	
	<br/>
	
	<?php
	if(!$model->isNewRecord)
	{
		$getfullpath=ApplicationConfig::app()->params["url_path"]["homepage_banners"].$model->image;
	?>
		<div class="control-group">
			<div class="controls">
				<img src='<?php echo $getfullpath;?>'>	
			</div>
		</div>
	<?php
	}
	?>
	
	<?php echo $form->textFieldRow($model,'url'); ?>

	<div class="control-group ">
		<label for="StaticPageBlock_content" class="control-label">Meta Description </label>
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

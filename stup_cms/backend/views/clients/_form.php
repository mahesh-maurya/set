<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'clients-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'type'=>'horizontal',
	'htmlOptions' => array(
		'class'=>'well',
        'enctype' => 'multipart/form-data',
		),
)); ?>

	<?php $clints_types = array('1'=>'Funding Agencies', '2'=>'Government Bodies', '3'=>'Contractors & Developers', '4'=>'Corporations');?>
	
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'client_type',$clints_types,array('empty'=>'Select Client'));?>

	<?php echo $form->textFieldRow($model,'title'); ?>

	<?php echo $form->fileFieldRow($model, 'image'); ?>
	
	<?php
	if(!$model->isNewRecord)
	{
		$getfullpath=ApplicationConfig::app()->params["url_path"]["clients"].$model->image;
	?>
		<div class="control-group">
			<div class="controls">
				<img src='<?php echo $getfullpath;?>'>	
			</div>
		</div>
	<?php
	}
	?>

	<?php echo $form->textFieldRow($model,'link'); ?>

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

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'sectors-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'type'=>'horizontal',
	'htmlOptions' => array(
		'class'=>'well',
        'enctype' => 'multipart/form-data',
		),
)); ?>
	
	<?php
	$sector_positions = array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12);
	?>
	
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title'); ?>

	<div class="control-group ">
		<label for="StaticPageBlock_content" class="control-label required">Description <span class="required">*</span></label>
		<div class="controls">
			<?php 
				$this->widget('application.extensions.ckeditor.CKEditor', array(
					'model'=>$model,
					'attribute'=>'description',
					'language'=>'en',
					'editorTemplate'=>'full',
					)); 
			?>
		</div>
	</div>

	<?php echo $form->radioButtonListInlineRow($model,'slider_option',array('horizontal'=>'horizontal', 'vertical'=>'vertical')); ?>

	<?php echo $form->fileFieldRow($model, 'image'); ?>
	
	<!--<div style="margin-left:181px;">(Upload Image with 498*243 resolution)</div>-->
	
	<br/>
	
	<?php
	if(!$model->isNewRecord)
	{
		$getfullpath=ApplicationConfig::app()->params["url_path"]["sectors"].$model->image;
	?>
		<div class="control-group">
			<div class="controls">
				<img src='<?php echo $getfullpath;?>'>	
			</div>
		</div>
	<?php
	}
	?>
	
	<?php echo $form->fileFieldRow($model, 'thumbnail_image'); ?>
	
	<div style="margin-left:181px;">(Upload Image with 201*166 resolution)</div>
	
	<br/>
	
	<?php
	if(!$model->isNewRecord)
	{
		$getfullpath_small=ApplicationConfig::app()->params["url_path"]["sectors_small"].$model->thumbnail_image;
	?>
		<div class="control-group">
			<div class="controls">
				<img src='<?php echo $getfullpath_small;?>'>	
			</div>
		</div>
	<?php
	}
	?>
	
	<?php echo $form->textFieldRow($model,'url'); ?>

	<div class="control-group ">
		<label for="StaticPageBlock_content" class="control-label required">Description </label>
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
	
	<?php echo $form->dropDownListRow($model,'position',$sector_positions); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
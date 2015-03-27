<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'projects-form',
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
	
	<?php echo $form->dropDownListRow($model,'sector_id',$sectors,array('empty'=>'Select Sector',
		'ajax'=>array(
			'type'=>'POST',
			'url'=>ApplicationConfig::getURL("", "projects", "getslideroption",array()),
			'update'=>'#showresolution',
			)));?>

	<?php 
	if(!empty($model->slideropt))
	{
		echo $form->hiddenField($model,'slideropt',array('value'=>$model->slideropt));
	}
	else
	{
		if(!$model->isNewRecord)
		{
			if(!empty($model->sector_id))
			{
				$getsectordetail=Sectors::model()->findByPk($model->sector_id);
				echo $form->hiddenField($model,'slideropt',array('value'=>$getsectordetail['slider_option']));
			}
			else
			{
				echo $form->hiddenField($model,'slideropt',array('value'=>'horizontal'));
			}
		}
		else
		{
			echo $form->hiddenField($model,'slideropt',array('value'=>'horizontal'));
		}
	}
	?>
	
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

	<?php //echo $form->fileFieldRow($model, 'image'); ?>
	
	<div class="control-group ">
		<label for="Projects_image" class="control-label required">Image </label>
		<div class="controls">
			<?php 
				$this->widget('CMultiFileUpload', array(
				'model'=>$model,
				'attribute'=>'image',
				'accept'=>'jpg|gif|png',
				'options'=>array(
				),
				'denied'=>'File is not allowed',
				'max'=>10, // max 10 files
				));
			?>
			<span style="display: none" id="Projects_image_em_" class="help-inline error"></span>
		</div>
	</div>
	
	<div id="showresolution" style="margin-left:181px;">
	<?php
	if(!empty($model->slideropt))
	{
		if($model->slideropt=="horizontal")
		{
			$showfield=$form->hiddenField($model,'slideropt',array('value'=>'horizontal'));
			echo "(Upload Image with 977*435 resolution)".$showfield;
		}
		else
		{
			$showfield=$form->hiddenField($model,'slideropt',array('value'=>$model->slideropt));
			echo "(Upload Image with 534*535 resolution)".$showfield;
		}
	}
	else
	{
		if(!$model->isNewRecord)
		{
			if(!empty($model->sector_id))
			{
				$getsectordetail=Sectors::model()->findByPk($model->sector_id);
				if($getsectordetail['slider_option']=="horizontal")
				{
					$showfield=$form->hiddenField($model,'slideropt',array('value'=>'horizontal'));
					echo "(Upload Image with 977*435 resolution)".$showfield;
				}
				else
				{
					$showfield=$form->hiddenField($model,'slideropt',array('value'=>'vertical'));
					echo "(Upload Image with 534*535 resolution)".$showfield;
				}
			}
		}
		else
		{
			$showfield=$form->hiddenField($model,'slideropt',array('value'=>'horizontal'));
			echo "(Upload Image with 977*435 resolution)".$showfield;
		}
	}
	?>	
	</div>
	
	<br/>
	
	<?php
	if(!$model->isNewRecord)
	{
		$get_all_project_images=ProjectImages::model()->findAll(array('condition'=>'project_id='.$model->project_id.' AND status="1"'));
		echo "<div class='control-group'><div class='controls'>";
		foreach($get_all_project_images as $key=>$val)
		{
			$getfullpath=ApplicationConfig::app()->params["url_path"]["projects"].$val['image'];
			?>
				<img src='<?php echo $getfullpath;?>'><br/><br/>
			<?php
		}
		echo "</div></div>";
	}
	?>

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
	
	<?php echo $form->textFieldRow($model,'project_position'); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
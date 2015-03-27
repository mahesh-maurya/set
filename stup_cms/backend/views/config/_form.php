<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'config-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'site_name',array('class'=>'span5','maxlength'=>300)); ?>

	<?php echo $form->textFieldRow($model,'site_email',array('class'=>'span5','maxlength'=>400)); ?></br>
	
	

	<?php if (!empty($model->logo)){?>
		<img src="<?php echo BackendApplicationConfig::app()->params['url_path']['applicationLogo'].$model->logo; ?>" alt="logo" style="width: 400px;"/>
	<?php }?>

	<?php echo $form->fileFieldRow($model,'logo',array()); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Save' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<style>

.ui-datepicker {z-index:9999 !important;}
</style>

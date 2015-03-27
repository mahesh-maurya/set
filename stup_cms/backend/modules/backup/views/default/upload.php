<?php
$this->breadcrumbs=array(
	'backup'=>array('backup'),
	'Upload',
);?>
<h3><?php echo "Upload backup file"; ?></h3>

<div class="ml34 form">


<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'install-form',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
		<div class="row">
		<?php echo $form->labelEx($model,'upload_file'); ?>
		<?php echo $form->fileField($model,'upload_file'); ?>
		<?php echo $form->error($model,'upload_file'); ?>
		</div><!-- row -->	

		<div class="row form-actions">
		<?php
		echo CHtml::submitButton(Yii::t('app', 'Save'),array('class' => 'btn btn-primary'));
		?>
		</div>
		<?php $this->endWidget();
	
		?>
</div><!-- form -->
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'configID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'site_name',array('class'=>'span5','maxlength'=>300)); ?>

	<?php echo $form->textFieldRow($model,'site_email',array('class'=>'span5','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'logo',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'modified',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

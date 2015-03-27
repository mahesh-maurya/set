<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'page_banner_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'page_name',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'slug',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'image',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'created_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'updated_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>1)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

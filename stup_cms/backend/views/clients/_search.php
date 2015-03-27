<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'client_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'client_type',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'image',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'slug',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'created_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'updated_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textAreaRow($model,'meta_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'meta_keyword',array('class'=>'span5','maxlength'=>200)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

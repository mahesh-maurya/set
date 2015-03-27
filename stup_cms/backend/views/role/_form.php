<style type="text/css">
	#Role_status_0,#Role_status_1{ width:auto;}
	.row label{font-weight:bold;min-width:100px;display: inline-block;	}
</style>

<div class="form ml34">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'role-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">Fields with <span class="required">*</span> are required.</div>

	<div class="row">
	<?php echo $form->errorSummary($model); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description',array('style'=>'float:left;')); ?>
		<?php echo $form->textArea($model,'description',array('style'=>'float:left;')); ?>
		<?php echo $form->error($model,'description'); ?>
		<div class="clr"></div>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->radioButtonList($model,'status',array('active'=>"Enable",'inactive'=>"Disable",), array('separator'=>' ','labelOptions'=>array('style'=>'display:inline'))); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	<div class="clr">&nbsp;</div>
	<div class="row form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-primary')); ?>
		<?php echo CHtml::button('Cancel', array('submit' => array('manageRole'),'class' => 'btn btn-primary')); ?>
		
	</div>
    
    <div class="clear">&nbsp;</div><br />
    <?php /*?><span class="link">
        <?php echo CHtml::link('Back to List',ApplicationConfig::getURL("admin", "role", "manageRole"),array()); ?>
    </span><?php */?>
<?php $this->endWidget(); ?>
</div>
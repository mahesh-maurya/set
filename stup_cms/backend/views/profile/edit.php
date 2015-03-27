<?php $this->pageTitle=Yii::app()->name . ' - '."Profile";
$this->breadcrumbs=array(
	"Profile"=>array('profile'),
	"Edit Profile",
);
 // $this->widget('bootstrap.widgets.TbMenu', array(
    // 'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    // 'stacked'=>true, // whether this is a stacked menu
	// 'htmlOptions'=>array('style'=>'width:25%'),
    // 'items'=>array(
    // ((UserModule::isAdmin())
		// ? array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		// :array()),
	    // array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
	    // array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    // ),
// )); 
$this->menu=array(
	    array('label'=>'Edit Profile', 'url'=>array('edit')),
	    array('label'=>'Change password', 'url'=>array('changepassword')),
    
);
?><h3><?php echo 'Edit profile'; ?></h3>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="form ml34">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<div class="row"><?php echo 'Fields with <span class="required">*</span> are required.'; ?></div>

	<div class="row">
	<?php echo $form->errorSummary(array($model,$profile)); ?>
	</div>

<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname);
		
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		echo $form->error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
?>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-primary')); ?>
		<?php echo CHtml::button('Cancel', array('submit' => array('admin'),'class' => 'btn btn-primary')); ?>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

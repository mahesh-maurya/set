<?php
/* @var $this MenusController */
/* @var $model Menus */
/* @var $form CActiveForm */
?>

<div class="form ml34">
<?php   if (!empty($main_menuID))
		$model->main_menuID = $main_menuID;
		
		if (!empty($parentID))
		$model->parentID = $parentID;
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menus-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<div class="row">Fields with <span class="required">*</span> are required.</div>

	<div class="row">
	<?php echo $form->errorSummary($model); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'main_menuID'); ?>
		<?php echo $form->dropDownList($model,'main_menuID',CHtml::listData(MainMenu::getList("MENU-LIST"), "main_menuID", "menu_name"),array('empty'=>'Select Parent')); ?>
		<?php echo $form->error($model,'main_menuID'); ?>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'parentID'); ?>
		<?php echo $form->dropDownList($model,'parentID',CHtml::listData(Menus::getList("PARENT-LIST",array('main_menuID'=>$model->main_menuID)), "menuID", "menu_name"),array('empty'=>'Select Parent')); ?>
		<?php echo $form->error($model,'parentID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_name'); ?>
		<?php echo $form->textField($model,'menu_name',array('size'=>100,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'menu_name'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'menu_image',array()); ?>
	<?php echo $form->fileField($model,'menu_image', array('size'=>25,'maxlength'=>25)); ?>
	<?php if($model->menu_image != "") { ?> <img height="50px" width="50px" src="<?php echo ApplicationConfig::app()->params['url_path']['MenuOriginal'].$model->menu_image;?>"> <?php } ?>
	<?php echo $form->error($model,'menu_image'); ?>
	</div>
	
	<div class="row">
			<?php echo $form->labelEx($model,'menu_description'); ?>
			<?php echo $form->textArea($model,'menu_description',array()); ?>
			<?php echo $form->error($model,'menu_description'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'system_url'); ?>
		<?php echo $form->textField($model,'system_url',array('size'=>60,'maxlength'=>400)); ?>
		<?php echo $form->error($model,'system_url'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->radioButtonList($model,'active',ApplicationConfig::app()->params['scaling_params']['status'],array('separator'=>'')); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>
	<div class="row form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-primary')); ?>
		<?php // echo CHtml::button('Cancel', array('submit' =>ApplicationConfig::getURL("", "menus", "admin",array('id'=>$_GET['id'],'pid'=>$_GET['pid'])),'class' => 'btn btn-primary')); ?>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
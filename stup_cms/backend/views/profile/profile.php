<?php $this->pageTitle=Yii::app()->name . ' - '."Profile";
$this->breadcrumbs=array(
	"Profile",
);

$this->menu=array(
	//((UserModule::isAdmin())
	//	? array('label'=>'Manage Users'), 'url'=>array('/user/admin'))
	//	:array()),
	    array('label'=>'Edit Profile', 'url'=>array('edit')),
	    array('label'=>'Change password', 'url'=>array('changepassword')),
);
?><h3><?php echo 'Your profile'; ?></h3>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<table class="items table table-striped table-bordered table-condensed table-hover">
	<tr>
		<th class=""><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
	    <td><?php echo CHtml::encode($model->username); ?></td>
	</tr>
	<?php 
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
				//echo "<pre>"; print_r($profile); die();
			?>
	<tr>
		<th class=""><?php echo CHtml::encode($field->title); ?></th>
    	<td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
	</tr>
			<?php
			}//$profile->getAttribute($field->varname)
		}
	?>
	<tr>
		<th class=""><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
    	<td><?php echo CHtml::encode($model->email); ?></td>
	</tr>
	<tr>
		<th class=""><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
    	<td><?php echo ApplicationConfig::app()->getFormattedDate($model->create_at); ?></td>
	</tr>
	<tr>
		<th class=""><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
    	<td><?php echo ApplicationConfig::app()->getFormattedDate($model->lastvisit_at); ?></td>
	</tr>
	<tr>
		<th class=""><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
    	<td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></td>
	</tr>
</table>

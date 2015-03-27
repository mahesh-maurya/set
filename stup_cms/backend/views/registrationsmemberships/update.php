<?php
$this->breadcrumbs=array(
	'Registrations Memberships'=>array('admin'),
	$model->title=>array('view','id'=>$model->reg_prof_membership_id),
	'Update',
);
?>

<h4>Update Registration Membership <?php echo $model->reg_prof_membership_id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
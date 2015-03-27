<?php
$this->breadcrumbs=array(
	'Registrations Memberships'=>array('admin'),
	'Create',
);
?>

<h4>Add Registration Membership</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Projects'=>array('admin'),
	'Create',
);
?>

<h4>Create Project</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model,'sectors'=>$sectors)); ?>
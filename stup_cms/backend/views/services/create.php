<?php
$this->breadcrumbs=array(
	'Services'=>array('admin'),
	'Create',
);
?>

<h4>Add Service</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model,'sectors'=>$sectors)); ?>
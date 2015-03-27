<?php
$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	'Create',
);

?>

<h4>Create Page</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
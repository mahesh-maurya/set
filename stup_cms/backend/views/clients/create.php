<?php
$this->breadcrumbs=array(
	'Clients'=>array('admin'),
	'Create',
);
?>

<h4>Add Client</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
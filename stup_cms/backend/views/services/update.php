<?php
$this->breadcrumbs=array(
	'Services'=>array('admin'),
	$model->title=>array('view','id'=>$model->service_id),
	'Update',
);
?>

<h4>Update Service <?php echo $model->service_id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model,'sectors'=>$sectors)); ?>
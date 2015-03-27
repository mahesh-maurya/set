<?php
$this->breadcrumbs=array(
	'Clients'=>array('admin'),
	$model->title=>array('view','id'=>$model->client_id),
	'Update',
);
?>

<h4>Update Client <?php echo $model->client_id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
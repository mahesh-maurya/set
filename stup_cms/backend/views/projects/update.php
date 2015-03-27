<?php
$this->breadcrumbs=array(
	'Projects'=>array('admin'),
	$model->title=>array('view','id'=>$model->project_id),
	'Update',
);
?>

<h4>Update Project <?php echo $model->project_id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model,'sectors'=>$sectors)); ?>
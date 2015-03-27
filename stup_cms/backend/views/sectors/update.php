<?php
$this->breadcrumbs=array(
	'Sectors'=>array('admin'),
	$model->title=>array('view','id'=>$model->sector_id),
	'Update',
);
?>

<h4>Update Sector <?php echo $model->sector_id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
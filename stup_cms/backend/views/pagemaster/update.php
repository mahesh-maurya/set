<?php
$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	$model->page_id=>array('view','id'=>$model->page_id),
	'Update',
);
?>

<h4>Update Page <?php echo $model->page_id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
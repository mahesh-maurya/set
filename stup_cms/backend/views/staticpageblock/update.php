<?php
$this->breadcrumbs=array(
	'Static Page Block Contents'=>array('admin'),
	$model->title=>array('view','id'=>$model->static_page_id),
	'Update',
);
?>

<h4>Update Static Page Block Content <?php echo $model->static_page_id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model,'allpages'=>$allpages)); ?>
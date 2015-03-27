<?php
$this->breadcrumbs=array(
	'Home Page Slider Images'=>array('admin'),
	$model->title=>array('view','id'=>$model->frontpage_slider_image_id),
	'Update',
);
?>

<h4>Update Home Page Slider Image <?php echo $model->frontpage_slider_image_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
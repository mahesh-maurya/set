<?php
$this->breadcrumbs=array(
	'Sector Banners'=>array('admin'),
	$model->title=>array('view','id'=>$model->sector_banner_id),
	'Update',
);
?>

<h4>Update Sector Banner <?php echo $model->sector_banner_id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model,'allsectors'=>$allsectors)); ?>
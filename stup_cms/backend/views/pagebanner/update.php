<?php
$this->breadcrumbs=array(
	'Page Banners'=>array('admin'),
	$model->title=>array('view','id'=>$model->page_banner_id),
	'Update',
);
?>

<h4>Update Page Banner <?php echo $model->page_banner_id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model,'allpages'=>$allpages)); ?>
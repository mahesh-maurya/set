<?php
$this->breadcrumbs=array(
	'Sector Banners'=>array('admin'),
	'Create',
);
?>

<h4>Add Sector Banner</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model,'allsectors'=>$allsectors)); ?>
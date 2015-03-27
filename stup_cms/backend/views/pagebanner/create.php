<?php
$this->breadcrumbs=array(
	'Page Banners'=>array('admin'),
	'Create',
);
?>

<h4>Add Page Banner</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model,'allpages'=>$allpages)); ?>
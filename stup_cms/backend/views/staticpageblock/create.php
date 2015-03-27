<?php
$this->breadcrumbs=array(
	'Static Page Block Contents'=>array('admin'),
	'Create',
);
?>

<h4>Create Static Page Block Content</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model,'allpages'=>$allpages)); ?>
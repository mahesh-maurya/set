<?php
$this->breadcrumbs=array(
	'Site Configuration',
	'',
);

?>
<h3>Site Configuration</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
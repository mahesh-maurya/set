<?php
$this->breadcrumbs=array(
	'Manage'=>array('index'),
);?>
<h3> Manage database backup files</h3>

<?php $this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
));
?>

<?php
$this->breadcrumbs=array(
	'Page Masters',
);

$this->menu=array(
	array('label'=>'Create PageMaster','url'=>array('create')),
	array('label'=>'Manage PageMaster','url'=>array('admin')),
);
?>

<h1>Page Masters</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Sectors',
);

$this->menu=array(
	array('label'=>'Create Sectors','url'=>array('create')),
	array('label'=>'Manage Sectors','url'=>array('admin')),
);
?>

<h1>Sectors</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

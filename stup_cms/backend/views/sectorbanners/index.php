<?php
$this->breadcrumbs=array(
	'Sectorbanners',
);

$this->menu=array(
	array('label'=>'Create Sectorbanners','url'=>array('create')),
	array('label'=>'Manage Sectorbanners','url'=>array('admin')),
);
?>

<h1>Sectorbanners</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

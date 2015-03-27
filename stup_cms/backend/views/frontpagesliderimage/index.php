<?php
$this->breadcrumbs=array(
	'Frontpagesliderimages',
);

$this->menu=array(
	array('label'=>'Create Frontpagesliderimage','url'=>array('create')),
	array('label'=>'Manage Frontpagesliderimage','url'=>array('admin')),
);
?>

<h1>Frontpagesliderimages</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

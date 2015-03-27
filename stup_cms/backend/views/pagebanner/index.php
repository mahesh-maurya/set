<?php
$this->breadcrumbs=array(
	'Pagebanners',
);

$this->menu=array(
	array('label'=>'Create Pagebanner','url'=>array('create')),
	array('label'=>'Manage Pagebanner','url'=>array('admin')),
);
?>

<h1>Pagebanners</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

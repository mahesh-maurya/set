<?php
$this->breadcrumbs=array(
	'Configs',
);

$this->menu=array(
	array('label'=>'Create Config','url'=>array('create')),
	array('label'=>'Manage Config','url'=>array('admin')),
);
?>

<h3>Configs</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

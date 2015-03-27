<?php
$this->breadcrumbs=array(
	'Static Page Blocks',
);

$this->menu=array(
	array('label'=>'Create StaticPageBlock','url'=>array('create')),
	array('label'=>'Manage StaticPageBlock','url'=>array('admin')),
);
?>

<h1>Static Page Blocks</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	$model->page_id,
);
?>

<h4>View Page #<?php echo $model->page_id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type'=>'striped bordered condensed hover',
	'attributes'=>array(
		'page_id',
		'page_name',
		'url',
		'meta_description',
		'meta_keyword',
		'created_date',
		'updated_date',
		array(
		'name'=>'status',
		'value'=>($model->status=="1")?"Active":"Inactive",
		),
		'slug',
	),
)); ?>

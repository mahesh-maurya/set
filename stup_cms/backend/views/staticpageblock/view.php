<?php
$this->breadcrumbs=array(
	'Static Page Block Contents'=>array('admin'),
	$model->title,
);
?>

<h4>View Static Page Block Content #<?php echo $model->static_page_id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type'=>'striped bordered condensed hover',
	'attributes'=>array(
		'static_page_id',
		'page_menu',
		'title',
		'content',
		'type',
		'attachment',
		'slug',
		'created_date',
		'updated_date',
		array(
			'name'=>'status',
			'value'=>($model->status=='1')?"Active":"Inactive",
		),
		'url',
		'meta_description',
		'meta_keyword',
	),
)); ?>

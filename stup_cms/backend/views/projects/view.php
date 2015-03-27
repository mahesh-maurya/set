<?php
$this->breadcrumbs=array(
	'Projects'=>array('admin'),
	$model->title,
);
?>

<h4>View Project #<?php echo $model->project_id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type'=>'striped bordered condensed hover',
	'attributes'=>array(
		'project_id',
		array(
			'name'=>'sector_id',
			'value'=>!empty($model->sector_id)?Projects::showSectorDetail($model->sector_id):"",
		),
		'title',
		'description',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>!empty($model->image)?Projects::showimageNew($model->project_id):"",
		),
		'slug',
		'created_date',
		'updated_date',
		array(
			'name'=>'status',
			'value'=>($model->status=="1")?"Active":"Inactive",
		),
		'url',
		'meta_description',
		'meta_keyword',
		'project_position',
	),
)); ?>
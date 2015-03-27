<?php
$this->breadcrumbs=array(
	'Services'=>array('admin'),
	$model->title,
);
?>

<h4>View Service #<?php echo $model->service_id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type'=>'striped bordered condensed hover',
	'attributes'=>array(
		'service_id',
		array(
			'name'=>'sector_id',
			'value'=>!empty($model->sector_id)?Services::showSectorDetail($model->sector_id):"",
		),
		'title',
		'description',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>!empty($model->image)?Services::showimage($model->image):"",
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
		'service_position',
	),
)); ?>
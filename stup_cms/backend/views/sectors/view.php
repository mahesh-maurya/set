<?php
$this->breadcrumbs=array(
	'Sectors'=>array('admin'),
	$model->title,
);
?>

<h4>View Sector #<?php echo $model->sector_id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type'=>'striped bordered condensed hover',
	'attributes'=>array(
		'sector_id',
		'title',
		'description',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>!empty($model->image)?Sectors::showimage($model->image):"",
		),
		array(
			'name'=>'thumbnail_image',
			'type'=>'raw',
			'value'=>!empty($model->thumbnail_image)?Sectors::showthumbimage($model->thumbnail_image):"",
		),
		'slug',
		'slider_option',
		'created_date',
		'updated_date',
		array(
			'name'=>'status',
			'value'=>$model->status=="1"?"Active":"Inactive",
		),
		'url',
		'meta_description',
		'meta_keyword',
	),
)); ?>
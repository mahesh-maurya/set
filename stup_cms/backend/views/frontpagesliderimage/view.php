<?php
$this->breadcrumbs=array(
	'Home Page Slider Images'=>array('admin'),
	$model->title,
);
?>

<h4>View Home Page Slider Image #<?php echo $model->frontpage_slider_image_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type'=>'striped bordered condensed hover',
	'attributes'=>array(
		'frontpage_slider_image_id',
		'title',
		'description',
		'link',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>!empty($model->image)?Frontpagesliderimage::showimage($model->image):"",
		),
		'created_date',
		'updated_date',
		'slug',
		array(
			'name'=>'status',
			'value'=>($model->status=="1")?"Active":"Inactive",
		),
		'url',
		'meta_description',
		'meta_keyword',
	),
)); ?>

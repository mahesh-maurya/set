<?php
$this->breadcrumbs=array(
	'Page Banners'=>array('admin'),
	$model->title,
);
?>

<h4>View Page Banner #<?php echo $model->page_banner_id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type'=>'striped bordered condensed hover',
	'attributes'=>array(
		'page_banner_id',
		'page_name',
		'title',
		'link',
		'slug',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>!empty($model->image)?Pagebanner::showimage($model->image):"",
		),
		'created_date',
		'updated_date',
		array(
			'name'=>'status',
			'value'=>($model->status=="1")?"Active":"Inactive",
		),
		'url',
		'meta_description',
		'meta_keyword',
	),
)); ?>

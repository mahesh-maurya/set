<?php
$this->breadcrumbs=array(
	'Sector Banners'=>array('admin'),
	$model->title,
);
?>

<h4>View Sector Banner #<?php echo $model->sector_banner_id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type'=>'striped bordered condensed hover',
	'attributes'=>array(
		'sector_banner_id',
		array(
			'name'=>'sector_id',
			'value'=>!empty($model->sector_id)?Sectors::model()->findByPk($model->sector_id)->title:"",
		),
		'sector_slug',
		'title',
		'link',
		'slug',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>!empty($model->image)?Sectorbanners::showimage($model->image):"",
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

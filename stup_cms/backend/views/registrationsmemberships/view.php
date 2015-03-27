<?php
$this->breadcrumbs=array(
	'Registrations Memberships'=>array('admin'),
	$model->title,
);
?>

<h4>View Registration Membership #<?php echo $model->reg_prof_membership_id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'type'=>'striped bordered condensed hover',
	'attributes'=>array(
		'reg_prof_membership_id',
		'title',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>!empty($model->image)?RegistrationsMemberships::showlogoimage($model->image):"",
		),
		'slug',
		'link',
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

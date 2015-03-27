<?php
$this->breadcrumbs=array(
	'Configs'=>array('index'),
	$model->configID,
);

$this->menu=array(
	array('label'=>'List Config','url'=>array('index')),
	array('label'=>'Create Config','url'=>array('create')),
	array('label'=>'Update Config','url'=>array('update','id'=>$model->configID)),
	array('label'=>'Delete Config','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->configID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Config','url'=>array('admin')),
);
?>

<h3>View Config #<?php echo $model->configID; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'configID',
		'site_name',
		'site_email',
		'logo',
		'created',
		'modified',
	),
)); ?>

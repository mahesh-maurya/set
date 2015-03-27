<?php
$this->breadcrumbs=array(
	'Configs'=>array('index'),
	$model->configID=>array('view','id'=>$model->configID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Config','url'=>array('index')),
	array('label'=>'Create Config','url'=>array('create')),
	array('label'=>'View Config','url'=>array('view','id'=>$model->configID)),
	array('label'=>'Manage Config','url'=>array('admin')),
);
?>

<h3>Update Config <?php echo $model->configID; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
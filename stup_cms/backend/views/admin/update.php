<?php
$this->breadcrumbs=array(
	('Users')=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	('Update'),
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
    //array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
   // array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
);
?>

<h1><?php echo  'Update User'." ".$model->id; ?></h1>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>
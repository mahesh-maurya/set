<?php
$this->breadcrumbs=array(
	'Create',
);


$this->menu=array(
	array('label'=>'Manage Users', 'url'=>array('admin')),
    //array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
);
?>
<h3><?php echo "Create User"; ?></h3>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>
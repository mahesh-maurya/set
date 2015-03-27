<?php
$this->breadcrumbs=array(
	'Registrations Memberships',
);

$this->menu=array(
	array('label'=>'Create RegistrationsMemberships','url'=>array('create')),
	array('label'=>'Manage RegistrationsMemberships','url'=>array('admin')),
);
?>

<h1>Registrations Memberships</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

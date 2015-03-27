<?php
/* @var $this MainMenuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Menu List',
);


$this->menu=array(
	array('label'=>'Create Menu', 'url'=>array('create')),
    array('label'=>'Manage Menus', 'url'=>array('admin')),
);

?>

<h1>Menu List</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

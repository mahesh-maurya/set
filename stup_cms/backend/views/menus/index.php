<?php
/* @var $this MenusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Menuses',
);


?>

<h3>Menu Items</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

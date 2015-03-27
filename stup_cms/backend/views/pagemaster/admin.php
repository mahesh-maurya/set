<?php
$this->breadcrumbs=array(
	'Create Page'=>array('create'),
	'Manage',
);

?>

<h4>Pages</h4>

<?php
	$arr_method = array(''=>'All', '0'=>'Inactive', '1'=>'Active');
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'page-master-grid',
	'dataProvider'=>$model->search(),
	'emptyText' => 'No Pages Found',
	'type'=>'striped bordered condensed hover',
	'responsiveTable'=>true,
	'ajaxUpdate'=>'false',
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'Sr.no',
			'class'=>'IndexColumn',
		),
		'page_name',
		'url',
		'meta_description',
		'meta_keyword',
		'slug',
		array(
			'name'=>'status',
			'value'=>'($data->status=="1")?"Active":"Inactive"',
			'filter'=>CHtml::activeDropDownList($model, 'status', $arr_method),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'header'=>'Actions',
			'template' => '{view} {update} {delete} {active} {inactive}',
			'buttons'=>array
			(
				'active' => array
				(
					'label'=>'Make Inactive',
					'url'=>'Yii::app()->createUrl("pagemaster/makeinactive",array("id"=>$data->page_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."inactive.png", 
					'visible'=>'($data->status==="1")?true:false;'
				),
				'inactive' => array
				(
					'label'=>'Make Active',
					'url'=>'Yii::app()->createUrl("pagemaster/makeactive",array("id"=>$data->page_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."active.png", 
					'visible'=>'($data->status==="0")?true:false;'
				),			   
			),
		),
	),
)); ?>

<style>
	.span8{width:100%;}
	#page-master-grid_c7{width:70px;}
</style>
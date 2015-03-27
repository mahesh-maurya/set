<?php
$this->breadcrumbs=array(
	'Create Static Page Block Content'=>array('create'),
	'Manage',
);
?>

<h4>Static Page Block Content</h4>

<?php 
	$arr_method = array(''=>'All', '0'=>'Inactive', '1'=>'Active');
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'static-page-block-grid',
	'dataProvider'=>$model->search(),
	'emptyText' => 'No Static Page Contents Found',
	'type'=>'striped bordered condensed hover',
	'responsiveTable'=>true,
	'ajaxUpdate'=>'false',
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'Sr.no',
			'class'=>'IndexColumn',
		),
		'page_menu',
		'title',
		array(
			'name'=>'content',
			'filter'=>false,
			'value'=>'StaticPageBlock::showcontent($data->content)',
		),
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
					'url'=>'Yii::app()->createUrl("staticpageblock/makeinactive",array("id"=>$data->static_page_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."inactive.png", 
					'visible'=>'($data->status==="1")?true:false;'
				),
				'inactive' => array
				(
					'label'=>'Make Active',
					'url'=>'Yii::app()->createUrl("staticpageblock/makeactive",array("id"=>$data->static_page_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."active.png", 
					'visible'=>'($data->status==="0")?true:false;'
				),			   
			),
		),
	),
)); ?>

<style>
	.span8{width:100%;}
	#static-page-block-grid_c6{width:70px;}
</style>
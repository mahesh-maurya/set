<?php
$this->breadcrumbs=array(
	'Add Clients'=>array('create'),
	'Manage',
);
?>

<h4>Clients</h4>

<?php 
	$arr_method = array(''=>'All', '0'=>'Inactive', '1'=>'Active');
	$clints_types = array(''=>'All', '1'=>'Funding Agencies', '2'=>'Government Bodies', '3'=>'Contractors & Developers', '4'=>'Corporations');
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'clients-grid',
	'dataProvider'=>$model->search(),
	'emptyText' => 'No Clients Found',
	'type'=>'striped bordered condensed hover',
	'responsiveTable'=>true,
	'ajaxUpdate'=>'false',
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'Sr.no',
			'class'=>'IndexColumn',
		),
		array(
			'name'=>'client_type',
			'value'=>'!empty($data->client_type)?Clients::showClientType($data->client_type):""',
			'filter'=>CHtml::activeDropDownList($model, 'client_type', $clints_types),
		),
		'title',
		array(
			'name'=>'image',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'!empty($data->image)?Clients::showimage($data->image):""',
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
					'url'=>'Yii::app()->createUrl("clients/makeinactive",array("id"=>$data->client_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."inactive.png", 
					'visible'=>'($data->status==="1")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('clients-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('clients-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),
				'inactive' => array
				(
					'label'=>'Make Active',
					'url'=>'Yii::app()->createUrl("clients/makeactive",array("id"=>$data->client_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."active.png", 
					'visible'=>'($data->status==="0")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('clients-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('clients-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),			   
			),
		),
	),
)); ?>

<style>
	.span8{width:100%;}
	#clients-grid_c6{width:70px;}
</style>
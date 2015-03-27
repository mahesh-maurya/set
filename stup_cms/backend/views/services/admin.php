<?php
$this->breadcrumbs=array(
	'Add Service'=>array('create'),
	'Manage',
);
?>

<h4>Services</h4>

<?php 
	$arr_method = array(''=>'All', '0'=>'Inactive', '1'=>'Active');
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'services-grid',
	'dataProvider'=>$model->search(),
	'emptyText' => 'No Services Found',
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
			'name'=>'sector_id',
			'value'=>'!empty($data->sector_id)?Services::showSectorDetail($data->sector_id):""',
			'filter'=>CHtml::activeDropDownList($model, 'sector_id', $sectors_merge),
		),
		'title',
		array(
			'name'=>'description',
			'filter'=>false,
			'value'=>'!empty($data->description)?Services::showcontent($data->description):""',
		),
		array(
			'name'=>'image',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'!empty($data->image)?Services::showimage($data->image):""',
		),
		'slug',
		array(
			'name'=>'status',
			'value'=>'($data->status=="1")?"Active":"Inactive"',
			'filter'=>CHtml::activeDropDownList($model, 'status', $arr_method),
		),
		array(
		'name'=>'service_position',
		'filter'=>false,
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
					'url'=>'Yii::app()->createUrl("services/makeinactive",array("id"=>$data->service_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."inactive.png", 
					'visible'=>'($data->status==="1")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('services-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('services-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),
				'inactive' => array
				(
					'label'=>'Make Active',
					'url'=>'Yii::app()->createUrl("services/makeactive",array("id"=>$data->service_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."active.png", 
					'visible'=>'($data->status==="0")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('services-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('services-grid');
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
	#services-grid_c8{width:70px;}
</style>
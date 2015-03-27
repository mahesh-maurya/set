<?php
$this->breadcrumbs=array(
	'Add Sector'=>array('create'),
	'Manage',
);
?>

<h4>Sectors</h4>

<?php 
	$arr_method = array(''=>'All', '0'=>'Inactive', '1'=>'Active');
	$slider_positions = array(''=>'All', 'horizontal'=>'horizontal', 'vertical'=>'vertical');
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'sectors-grid',
	'dataProvider'=>$model->search(),
	'emptyText' => 'No Sectors Found',
	'type'=>'striped bordered condensed hover',
	'responsiveTable'=>true,
	'ajaxUpdate'=>'false',
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'Sr.no',
			'class'=>'IndexColumn',
		),
		'title',
		array(
			'name'=>'description',
			'filter'=>false,
			'value'=>'!empty($data->description)?Sectors::showcontent($data->description):""',
		),
		array(
			'name'=>'image',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'!empty($data->image)?Sectors::showimage($data->image):""',
		),
		array(
			'name'=>'thumbnail_image',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'!empty($data->thumbnail_image)?Sectors::showthumbimage($data->thumbnail_image):""',
		),
		array(
			'name'=>'slider_option',
			'filter'=>CHtml::activeDropDownList($model, 'slider_option', $slider_positions),
		),
		'slug',
		array(
			'name'=>'status',
			'value'=>'($data->status=="1")?"Active":"Inactive"',
			'filter'=>CHtml::activeDropDownList($model, 'status', $arr_method),
		),
		array(
			'name'=>'position',
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
					'url'=>'Yii::app()->createUrl("sectors/makeinactive",array("id"=>$data->sector_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."inactive.png", 
					'visible'=>'($data->status==="1")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('sectors-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('sectors-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),
				'inactive' => array
				(
					'label'=>'Make Active',
					'url'=>'Yii::app()->createUrl("sectors/makeactive",array("id"=>$data->sector_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."active.png", 
					'visible'=>'($data->status==="0")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('sectors-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('sectors-grid');
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
	#sectors-grid_c9{width:70px;}
</style>	
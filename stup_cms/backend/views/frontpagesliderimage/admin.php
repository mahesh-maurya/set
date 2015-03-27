<?php
$this->breadcrumbs=array(
	'Add Home Page Slider Image'=>array('create'),
	'Manage',
);
?>

<h4>Home Page Slider Images</h1>

<?php
	$arr_method = array(''=>'All', '0'=>'Inactive', '1'=>'Active');
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'frontpagesliderimage-grid',
	'dataProvider'=>$model->search(),
	'emptyText' => 'No Home Page Slider Images Found',
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
		'description',
		'link',
		array(
		'name'=>'image',
		'filter'=>false,
		'type'=>'raw',
		'value'=>'!empty($data->image)?Frontpagesliderimage::showimage($data->image):""',
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
					'url'=>'Yii::app()->createUrl("frontpagesliderimage/makeinactive",array("id"=>$data->frontpage_slider_image_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."inactive.png", 
					'visible'=>'($data->status==="1")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('frontpagesliderimage-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('frontpagesliderimage-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),
				'inactive' => array
				(
					'label'=>'Make Active',
					'url'=>'Yii::app()->createUrl("frontpagesliderimage/makeactive",array("id"=>$data->frontpage_slider_image_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."active.png", 
					'visible'=>'($data->status==="0")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('frontpagesliderimage-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('frontpagesliderimage-grid');
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
	#frontpagesliderimage-grid_c7{width:70px;}
</style>	
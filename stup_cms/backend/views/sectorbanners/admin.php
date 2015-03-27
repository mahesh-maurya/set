<?php
$this->breadcrumbs=array(
	'Add Sector Banner'=>array('create'),
	'Manage',
);
?>

<h4>Sector Banners</h4>

<?php 
	$arr_method = array(''=>'All', '0'=>'Inactive', '1'=>'Active');
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'sectorbanners-grid',
	'dataProvider'=>$model->search(),
	'emptyText' => 'No Sector Banners Found',
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
			'value'=>'!empty($data->sector_id)?Sectors::model()->showsectordata($data->sector_id):""',
			'filter'=>CHtml::activeDropDownList($model, 'sector_id', $sectors_merge),
		),
		'title',
		'link',
		'slug',
		array(
			'name'=>'image',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'!empty($data->image)?Sectorbanners::showimage($data->image):""',
		),
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
					'url'=>'Yii::app()->createUrl("sectorbanners/makeinactive",array("id"=>$data->sector_banner_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."inactive.png", 
					'visible'=>'($data->status==="1")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('sectorbanners-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('sectorbanners-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),
				'inactive' => array
				(
					'label'=>'Make Active',
					'url'=>'Yii::app()->createUrl("sectorbanners/makeactive",array("id"=>$data->sector_banner_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."active.png", 
					'visible'=>'($data->status==="0")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('sectorbanners-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('sectorbanners-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),			   
			),
		),
	),
));
?>

<style>
	.span8{width:100%;}
	#sectorbanners-grid_c7{width:70px;}
</style>
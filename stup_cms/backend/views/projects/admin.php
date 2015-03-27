<?php
$this->breadcrumbs=array(
	'Create Project'=>array('create'),
	'Manage',
);
?>

<h4>Projects</h4>

<?php 
	$arr_method = array(''=>'All', '0'=>'Inactive', '1'=>'Active');
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'projects-grid',
	'dataProvider'=>$model->search(),
	'emptyText' => 'No Projects Found',
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
			'value'=>'!empty($data->sector_id)?Projects::showSectorDetail($data->sector_id):""',
			'filter'=>CHtml::activeDropDownList($model, 'sector_id', $sectors_merge),
		),
		'title',
		array(
			'name'=>'description',
			'filter'=>false,
			'value'=>'Projects::showcontent($data->description)',
		),
		array(
			'name'=>'image',
			'filter'=>false,
			'type'=>'raw',
			/*'value'=>'!empty($data->image)?Projects::showimage($data->image):""',*/
			'value'=>'!empty($data->project_id)?Projects::showimageNewadmin($data->project_id):""',
		),
		'slug',
		array(
			'name'=>'status',
			'value'=>'($data->status=="1")?"Active":"Inactive"',
			'filter'=>CHtml::activeDropDownList($model, 'status', $arr_method),
		),
		array(
			'name'=>'project_position',
			'filter'=>false,
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'header'=>'Actions',
			'template' => '{view} {update} {delete} {active} {inactive} {viewallimages}',
			'buttons'=>array
			(
				'active' => array
				(
					'label'=>'Make Inactive',
					'url'=>'Yii::app()->createUrl("projects/makeinactive",array("id"=>$data->project_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."inactive.png", 
					'visible'=>'($data->status==="1")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('projects-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('projects-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),
				'inactive' => array
				(
					'label'=>'Make Active',
					'url'=>'Yii::app()->createUrl("projects/makeactive",array("id"=>$data->project_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."active.png", 
					'visible'=>'($data->status==="0")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('projects-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('projects-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),
				'viewallimages'=> array(
					'label'=>'View All Project Images',
					'url'=>'Yii::app()->createUrl("projects/viewallimages",array("id"=>$data->project_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."magni.png", 
				),			   
			),
		),
	),
)); ?>

<style>
	.span8{width:100%;}
	#projects-grid_c8{width:100px;}
</style>	
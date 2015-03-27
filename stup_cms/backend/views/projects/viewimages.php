<?php
$this->breadcrumbs=array(
	'Projects'=>array('admin'),
	'View All Images',
);
?>

<h4>Project Images</h4>

<?php 
	$arr_method = array(''=>'All', '0'=>'Inactive', '1'=>'Active');
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'projectsimages-grid',
	'dataProvider'=>$model->search(array('condition'=>'project_id='.$project_id)),
	'emptyText' => 'No Project Images Found',
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
		'name'=>'project_id',
		'filter'=>false,
		'value'=>'!empty($data->project_id)?Projects::showprojdetails($data->project_id):""',
		),
		array(
			'name'=>'image',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'!empty($data->image)?Projects::showimage($data->image):""',
		),
		array(
		'name'=>'sortorder',
		'type'  => 'raw',
		'value'=>'CHTML::textField($data->project_image_id,$data->sortorder,array(\'id\'=>$data->project_image_id,\'onkeyup\'=>\'ajaxsubmitorder(this)\',\'style\'=>\'width:30px\'))',
		'filter'=>false,
		),
		array(
			'name'=>'status',
			'value'=>'($data->status=="1")?"Active":"Inactive"',
			'filter'=>CHtml::activeDropDownList($model, 'status', $arr_method),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'header'=>'Actions',
			'template' => '{active} {inactive} {deleteimg}',
			'buttons'=>array
			(
				'active' => array
				(
					'label'=>'Make Inactive',
					'url'=>'Yii::app()->createUrl("projects/makeinactive_projimage",array("id"=>$data->project_image_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."inactive.png", 
					'visible'=>'($data->status==="1")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('projectsimages-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('projectsimages-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),
				'inactive' => array
				(
					'label'=>'Make Active',
					'url'=>'Yii::app()->createUrl("projects/makeactive_projimage",array("id"=>$data->project_image_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."active.png", 
					'visible'=>'($data->status==="0")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('projectsimages-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('projectsimages-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),
				'deleteimg' => array
				(
					'label'=>'Delete Image',
					'url'=>'Yii::app()->createUrl("projects/delete_projimage",array("id"=>$data->project_image_id,"proj_id"=>$data->project_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."dlt.png", 
					'visible'=>'($data->status==="1")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('projectsimages-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('projectsimages-grid');
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

<script>

function ajaxsubmitorder(control)
{
    var val=$(control).val();
    var id=$(control).attr('id');
	$.ajax({
	url:"<?php echo ApplicationConfig::getURL("", "projects", "sortitems"); ?>",
	data:"val="+val+"&id="+id,
	type:'POST',
	success:function(result){

	}

	});
	 
}
</script>

<style>
	.span8{width:100%;}
</style>	
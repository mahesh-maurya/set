<?php
$this->breadcrumbs=array(
	'Add Registration Membership'=>array('create'),
	'Manage',
);
?>

<h4>Registrations Memberships</h4>

<?php 
	$arr_method = array(''=>'All', '0'=>'Inactive', '1'=>'Active');
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'registrations-memberships-grid',
	'dataProvider'=>$model->search(),
	'emptyText' => 'No Registrations Memberships Found',
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
			'name'=>'image',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'!empty($data->image)?RegistrationsMemberships::showimage($data->image):""',
		),
		'slug',
		'link',
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
					'url'=>'Yii::app()->createUrl("registrationsmemberships/makeinactive",array("id"=>$data->reg_prof_membership_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."inactive.png", 
					'visible'=>'($data->status==="1")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('registrations-memberships-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('registrations-memberships-grid');
		                                        }
		                                    })
		                                    return false;
		                              }
		                              ",
				),
				'inactive' => array
				(
					'label'=>'Make Active',
					'url'=>'Yii::app()->createUrl("registrationsmemberships/makeactive",array("id"=>$data->reg_prof_membership_id))',
					'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."active.png", 
					'visible'=>'($data->status==="0")?true:false;',
					'click'=>"function(){
		                                    $.fn.yiiGridView.update('registrations-memberships-grid', {
		                                        type:'POST',
		                                        url:$(this).attr('href'),
		                                        success:function(data) {
		                                              $.fn.yiiGridView.update('registrations-memberships-grid');
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
	#registrations-memberships-grid_c6{width:70px;}
</style>
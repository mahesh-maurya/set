<?php
$this->breadcrumbs=array(
		'manage role'
	);
?>


<?php
		Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$.fn.yiiGridView.update('role-grid', {
				data: $(this).serialize()
			});
			return false;
		});
		");
?>
<div class="">
<h3>Manage Role</h3>
<?php 
 
$this->menu=array(
	array('label'=>'Create Role', 'url'=>array('role/create')),
    array('label'=>'Manage Roles', 'url'=>array('role/manageRole')),
    array('label'=>'Manage Permissions', 'url'=>array('rolePermission/index')),
);
?>

<?php //echo CHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<!-- <div class="search-form" style="display:none"> -->
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
<!--</div> search-form -->


<?php if(Yii::app()->user->hasFlash('success')):?>
    <div style="color: green;" class="info">
        <?php echo '<b>'.Yii::app()->user->getFlash('success').'</b>'; ?>
    </div>
<?php endif; ?>
<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'role-grid',
	'type'=>'striped bordered condensed hover',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		array('name'=>'id','htmlOptions'=>array('width'=>'10')),
		array('name'=>'name','htmlOptions'=>array('width'=>'250')),
		array('name'=>'status','htmlOptions'=>array('width'=>'50')),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		 	'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
			'template'=>'{update}{delete}',
			'buttons'=>array(
					'managepermissions'=>array(
							 'label'=>'Manage Permissions',
							 'url'=>'Yii::app()->createUrl("admin/permission/index/id/".$data->id)', 
							 'options'=>array('id'=>'preview_image'),
        					 //'imageUrl'=>BoatConfig::app()->params['theme']['imageUrl'].'view.png'
							 'imageUrl'=>Yii::app()->getBaseUrl().'/images/user-permission.png', 
        					 )					
			),
		
			),
		),
	));
?>	
</div>
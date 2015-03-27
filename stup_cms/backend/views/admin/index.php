<?php
$this->breadcrumbs=array(
	'Users'=>array('/user'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
   // array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>
<h3><?php echo "Manage Users"; ?></h3>



<?php //echo CHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<!-- <div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
    //'model'=>$model,
//)); ?>
</div>--> <!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	 'type'=>'striped bordered condensed hover',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/*array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
		),
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),*/
		'id',
		'username',
		'email',
		array(
			'name'=>'create_at',
			'value'=>'ApplicationConfig::app()->getFormattedDate($data->create_at)',
			'filter'=>false,
		),
		array(
			'name'=>'lastvisit_at',
			'value'=>'ApplicationConfig::app()->getFormattedDate($data->lastvisit_at)',
			'filter'=>false,
		),
		array(
			'name'=>'role',
			'value'=>'($data->role !="") ? Role::model()->getUserRoles("ROLE-IDS",array("id"=>$data->role)) : ""',
			'filter'=>false,
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{update}{delete}',
		),
	),
)); ?>

<?php
$this->breadcrumbs=array(
	'Profile Fields'=>array('admin'),
	'Manage',
);



$this->menu=array(
	//array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('create')),
   // array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
   // array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('profile-field-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>
<h1><?php echo 'Manage Profile Fields'; ?></h1>



<?php //echo CHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<!-- <div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
    //'model'=>$model,
//)); ?>
</div>-->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$model->search(),
	 'type'=>'striped bordered condensed hover',
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'varname',
			'type'=>'raw',
			'value'=>'UHtml::markSearch($data,"varname")',
		),
		array(
			'name'=>'title',
			'value'=>'UserModule::t($data->title)',
		),
		array(
			'name'=>'field_type',
			'value'=>'$data->field_type',
			'filter'=>ProfileField::itemAlias("field_type"),
		),
		'field_size',
		//'field_size_min',
		array(
			'name'=>'required',
			'value'=>'ProfileField::itemAlias("required",$data->required)',
			'filter'=>ProfileField::itemAlias("required"),
		),
		//'match',
		//'range',
		//'error_message',
		//'other_validator',
		//'default',
		'position',
		array(
			'name'=>'visible',
			'value'=>'ProfileField::itemAlias("visible",$data->visible)',
			'filter'=>ProfileField::itemAlias("visible"),
		),
		//*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
		),
	),
)); ?>

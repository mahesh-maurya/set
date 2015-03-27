<?php
/* @var $this MainMenuController */
/* @var $model MainMenu */
//$ob = new BackendApplicationConfig(); 
//var_dump($ob->app());exit;


$this->breadcrumbs=array(
	'Menu List'=>array('admin'),
	'Manage',
);


$this->menu=array(
	array('label'=>'Create Menu', 'url'=>array('create')),
    array('label'=>'Manage Menus', 'url'=>array('admin')),
    
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#main-menu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Manage Menus</h3>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
));*/ ?>
</div><!-- search-form -->

<?php  $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'main-menu-grid',
	'type'=>'striped bordered condensed hover',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'main_menuID',
		'menu_name',
		'menu_description',
		array(
		'name'=>'position',
		'value'=>'ApplicationConfig::app()->params["menus"]["position"][$data->position]'
		),
		'created',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}{manage_menuitem}',
			 'buttons'=>array
		    (
		        'manage_menuitem' => array
		        (
		            'url'=>'Yii::app()->createUrl("/menus/admin", array("id"=>$data->main_menuID, "pid"=>0))',
		        	 'options'=>array(
			                'id'=>'$data->main_menuID',
			            ),
			        'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."menuitem.png", 
			        'label' =>'Manage Menu Items'    
		        ),
		       
    		),
		),
	),
)); ?>

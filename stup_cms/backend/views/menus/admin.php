<?php
/* @var $this MenusController */
/* @var $model Menus */
//echo $_GET['id'];exit;
$this->breadcrumbs=array(
	'Menu Item List'=>ApplicationConfig::getURL("", "menus", "admin",array('id'=>$_GET['id'],'pid'=>$_GET['pid'])),
	'Manage',
);


 
$this->menu=array(
	array('label'=>'Create Menu Item', 'url'=>ApplicationConfig::getURL("", "menus", "create",array('id'=>$_GET['id'],'pid'=>$_GET['pid']))),
 	array('label'=>'List Menu Items', 'url'=>ApplicationConfig::getURL("", "menus", "admin",array('id'=>$_GET['id'],'pid'=>$_GET['pid']))),
 	array('label'=>'Manage Main Menus', 'url'=>array('mainMenu/admin')),
 	
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#menus-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php 
if(isset($_GET['pid']) && $_GET['pid'] == 0)
{
	if (isset($_GET['id']))
	{
		$mainMenuObj = MainMenu::model()->getModel("MENU-ID",array("main_menuID"=>$_GET['id']));
		$menuName =  $mainMenuObj->menu_name.'<a href="'.ApplicationConfig::getURL("", "mainMenu", "admin",array()).'" ><h6>Go to parent menu</h6></a>';
	}
	else 
	$menuName = "";
	
}	
else 
{
	if (isset($_GET['pid']))
	{
		$mainMenuObj = MainMenu::model()->getModel("SUBMENU-ID",array("main_menuID"=>$_GET['pid']));
		$menuName = $mainMenuObj->menu_name.'<a href="'.ApplicationConfig::getURL("", "menus", "admin",array('id'=>$_GET['id'],'pid'=>$mainMenuObj->parentID)).'" ><h6>Go to parent menu</h6></a>';
	}
	else 
	$menuName = "";
}
?>
<h3>Manage Menu Items For <?php echo $menuName; ?></h3>




<?php

 	Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	Yii::app()->clientScript->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js');
    $str_js = "
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
 
        $('#menus-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            update : function () {
                serial = $('#menus-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                $.ajax({
                    'url': '" . ApplicationConfig::getURL("", "menus", "sort") . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){
                    },
                    'error': function(request, status, error){
                        alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();
    ";
 
    Yii::app()->clientScript->registerScript('sortable-project', $str_js);
?>

<?php


$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'menus-grid',
	'type'=>'striped bordered condensed hover',
	'dataProvider'=>$model->search($_GET['id'],$_GET['pid']),
	'rowCssClassExpression'=>'"items[]_{$data->menuID}"',
	'filter'=>$model,
	'columns'=>array(
		
		array(
		
		'name'=>'main_menuID',
		'value'=>'MainMenu::model()->getModel("MENU-ID",array("main_menuID"=>$data->main_menuID))->menu_name'
		),
		'menu_name',
		'menu_description',
		array(
		'header'=>'Parent name',
		'name'=>'parentID',
		'value'=>'($data->parentID !="0") ? Menus::model()->getModel("MENU-ID-NAME",array("menuID"=>$data->parentID)) : ""',
		//'filter'=>CHtml::listData(Menus::getList("PARENT-LIST",array("main_menuID"=>$_GET['id'])), "menuID", "menu_name")
		),
		array(
			'name'=>'sortOrder',
			'type'  => 'raw',
			'value'=>'CHTML::textField($data->menuID,$data->sortOrder,array(\'id\'=>$data->menuID,\'onkeyup\'=>\'ajaxsubmitorder(this)\',\'style\'=>\'width:30px\'))',
			'filter'=>false,
		),
		
		array(
		'name'=>'active',
		'value' => 'ApplicationConfig::app()->params["scaling_params"]["status"][$data->active]',
		//'filter'=> ApplicationConfig::app()->params["scaling_params"]["status"]
		),
		//'created',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}{manage_menuitem}',
			 'buttons'=>array
		    (
		        'manage_menuitem' => array
		        (
		            'url'=>'Yii::app()->createUrl("/menus/admin", array("id"=>$_GET["id"], "pid"=>$data->menuID))',
		        	 'options'=>array(
			                'id'=>'$data->main_menuID',
			            ),
			        'imageUrl'=>ApplicationConfig::app()->params["theme"]["imageUrl"]."menuitem.png", 
			        'label' =>'Manage Submenus'    
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
	url:"<?php echo ApplicationConfig::getURL("", "menus", "sortitems"); ?>",
	data:"val="+val+"&id="+id,
	type:'POST',
	success:function(result){

	}

	});
	 
}
</script>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'install-grid',
	'dataProvider' => $dataProvider,
    'type'=>'striped bordered condensed hover',
	'columns' => array(
		'name',
		'size',
		'create_time',
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
			'template' => ' {download} {restore}',
			  'buttons'=>array
			    (
			        'download' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/download", array("file"=>$data["name"]))',
			        ),
			        'restore' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/restore", array("file"=>$data["name"]))',
					),
			        'delete' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/delete", array("file"=>$data["name"]))',
			        ),
			    ),		
		),
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{delete}',
			  'buttons'=>array
			    (

			        'delete' => array
			        (
			            'url'=>'Yii::app()->createUrl("backup/default/delete", array("file"=>$data["name"]))',
			        ),
			    ),		
		),
	),
)); ?>
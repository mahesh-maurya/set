<?php
$this->breadcrumbs=array(
	'Backup'=>array('backup'),
	'Restore',
);?>
<h3><?php echo 'Restore DB'; ?></h3>

<p>
	<?php if(isset($error)) echo $error; else echo 'Done';?>
</p>
<p><?php echo CHtml::link('View Site',Yii::app()->HomeUrl)?></p>

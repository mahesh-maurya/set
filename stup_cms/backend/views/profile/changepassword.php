<?php $this->pageTitle=Yii::app()->name . ' - '."Change Password";
$this->breadcrumbs=array(
	"Profile" => array('/profile'),
	"Change Password",
);
 // $this->widget('bootstrap.widgets.TbMenu', array(
    // 'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    // 'stacked'=>true, // whether this is a stacked menu
	// 'htmlOptions'=>array('style'=>'width:25%'),
    // 'items'=>array(
    // ((UserModule::isAdmin())
		// ? array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		// :array()),
	    // array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
	    // array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    // ),
// )); 

if($_SESSION['role']!=15)
{
	$this->menu=array(
		   //((UserModule::isAdmin())
			//? array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
			//:array()),
			array('label'=>'Edit Profile', 'url'=>array('edit')),
			array('label'=>'Change password', 'url'=>array('changepassword')),
	);
}
?>

<?php 

$history = Passwordhistory::model()->find(array('order'=>"created_at desc",'condition'=>'user_id='.Yii::app()->user->id));
$d = new DateTime($history->created_at);
$d->setTimezone( new DateTimeZone('Asia/Kolkata'));
$tsp2 = $d->getTimestamp();

$history = Passwordhistory::model()->find(array('order'=>"created_at desc",'condition'=>'user_id='.Yii::app()->user->id));
$d = new DateTime(date('Y-m-d H:i:s'));
$d->setTimezone( new DateTimeZone('Asia/Kolkata'));
$tsp1 = $d->getTimestamp();

/* if(($tsp1-$tsp2) < 2*24*60*60) 
{
?>
	<h3>You can change password after 2 days</h3>
<?php 

}
else 
{ */
?>
<h3><?php echo "Change password"; ?></h3>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<!--<div class="form ml34">-->
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array(
		'class'=>'well',
    ),
)); ?>
    <?php 
    if($flag == 1)
    {
    ?>
    <!--<div style="color:green;">
    Note: You have used this password before
    </div>-->
    </br>
    <?php } ?>
	<div class="row"><?php echo 'Fields with <span class="required">*</span> are required.'; ?></div>
	<div class="row">
    <?php echo $form->errorSummary($model); ?>
	</div>
	<div class="row">
	<?php echo $form->labelEx($model,'oldPassword'); ?>
	<?php echo $form->passwordField($model,'oldPassword'); ?>
	<?php echo $form->error($model,'oldPassword'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	
	<div class="row form-actions">
		<?php echo CHtml::submitButton('Save',array('class' => 'btn btn-primary')); ?>
		<?php echo CHtml::button('Cancel', array('submit' => array('admin'),'class' => 'btn btn-primary')); ?>
		
	</div>

<?php $this->endWidget(); ?>
<!--</div> form -->

<?php //} ?>

<style>
.row {
    margin-left: 4px;
}
</style>
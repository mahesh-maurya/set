<?php
/* @var $this RolePermissionController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
	'Role Permissions',
);
?>
<?php 

$this->menu=array(
	array('label'=>'Create Role', 'url'=>array('role/create')),
    array('label'=>'Manage Roles', 'url'=>array('role/manageRole')),
    array('label'=>'Manage Permissions', 'url'=>array('rolePermission/index')),
);
 
?>

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'form-id',
        'action' => ApplicationConfig::getURL("", "rolePermission", "index"),  //<- your form action here   
		'htmlOptions'=>array('name'=>'myform'),
)); ?>

<?php echo CHtml::beginForm(); ?>
<?php $count = 0;

//if($module && $module!=''){
 ?>
<table id="permission">
	<tr style="width:100%;">
		<th style="width:20%;">SR. NO</th>
		<th style="width:50%;">Features and Sub-Features</th>
		<?php foreach($role as $role_key => $role_value){ ?>
		<th style="width:10%;"><?php echo $role_value->name;  ?></th>
		<?php } ?>
	</tr>
	<?php foreach($controllerList as $i=>$item): ?>
	<tr style="background: #f5f5f5;width:100%;">
		<td style="width:20%;"><b><?php echo $count+1; ?></b></td>
		<td style="width:50%;"><b><?php echo $item; ?>Controller</b></td>
		
		<?php foreach($role as $role_key => $role_value){ ?>
		<td id="view" style="width:10%;">
		<input id ="<?php echo $role_value->name.$i.'_view'; ?>"  type="checkbox" name="view[<?php echo $role_value->name.$i; ?>]" <?php if(isset($arrView[$i]) && $arrView[$i] == 'yes'){ echo 'value="yes" checked="checked"';  }else{ echo 'value="no"';}?> onclick='setCheckboxValue("<?php echo $role_value->name.$i.'_view'; ?>");' >
		</td>
		<?php } ?>
		
	</tr>
	<?php 
	$user_actions = Metadata::app()->getActionswithfunction($i); 
	$childList = array();
	foreach ($user_actions as $value)
	            {	
	            	  $childList[$value] = $value; 
	            } 

	$childCount = 0;
	foreach ($childList as $key=>$value){
		$flag = 0;
		//$permission = Permission::model()->getModel('FIND-PERMISSION',array('moduleName'=>$module,'controllerName'=>$i,'actionName'=>$key));
		if(!empty($permission) && !empty($permission->access_permission)){
			$flag = 1;
		}
	?>
	<tr style="width:100%;">
		<td style="padding-left: 25px;width:20%;"><?php echo ($count+1).".".($childCount+1); ?></td>
		<td style="padding-left: 25px;width:50%;"><?php echo $value; ?></td>
		
		<?php foreach($role as $role_key => $role_value){ 
			$perm = array(
				'roleID' => $role_value->id,
				'perm_name' => $i."_".$key,
			);			
			?>
			<td id="view" style="width:10%;">
		 		<input id ="<?php echo $role_value->name."_".$i."_".$key.'_view'; ?>"  type="checkbox" name="role[<?php echo $role_value->id ?>][]" <?php echo "value=".".".$i.".".$key; ?> <?php if(isset($permission_arr[$role_value->id])){ if(in_array(".".$i.".".$key, $permission_arr[$role_value->id])){ echo 'checked="checked"'; }} ?> parentid = <?php echo $role_value->name.$i.'_view';?> >
			</td>
		<?php } ?>
		
	</tr>

	<?php $childCount++;} $count++; endforeach; ?>
</table>

<div class="form-actions">
		<?php echo CHtml::submitButton('Save',array('class' => 'btn btn-primary')); ?>
			
</div>
<input  type="hidden" name="moduleName" value="<?php echo $module ?>"> 
<!--  <b>Check All:-</b> <input type='checkbox' name='checkall' onclick='checkedAll();'> -->
<?php echo CHtml::endForm(); 

//}  ?>
<?php $this->endWidget(); ?>

<script type="text/javascript">
 function setCheckboxValue(id){
	 $('input[parentid="'+id+'"]').each(function(i,el){
		 if($('#'+id).is(':checked'))
		{
			  $('#'+id).attr('value','yes');
			  $(el).attr('checked', true);
			  
		} 
		 else
		 {	 $('#'+id).attr('value','no');
			 $(el).attr('checked', false);
			 
		 }
		   
		});
}
 function setCheckboxIndividual(obj){

		 if($(obj).is(':checked'))
		 {
		  	 
		 } 
		 else
		 {
			   
		 }  
		
}

</script>
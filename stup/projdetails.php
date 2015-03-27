<?php
$gethttphost="http://".$_SERVER['HTTP_HOST'];
$get_project_id=!empty($_POST['project_id'])?$_POST['project_id']:"";
$getprojects=file_get_contents($gethttphost."/stup_cms/common/json/projects.json");
$decodeprojectjson = json_decode($getprojects, true);
$desc="";
if(!empty($decodeprojectjson))
{
	foreach($decodeprojectjson as $key=>$val)
	{
		if($val['project_id']==$get_project_id)
		{
			$desc=html_entity_decode($val['description']);
		}
	}
}
echo $desc;exit;
?>
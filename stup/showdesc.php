<?php
$gethttphost="http://".$_SERVER['HTTP_HOST'];
$get_sector_id=!empty($_POST['sector_id'])?$_POST['sector_id']:"";
$getsectors=file_get_contents($gethttphost."/stup_cms/common/json/sectors.json");
$decodesectorjson = json_decode($getsectors, true);
$desc="";
if(!empty($decodesectorjson))
{
	foreach($decodesectorjson as $key=>$val)
	{
		if($val['sector_id']==$get_sector_id)
		{
			$desc=html_entity_decode($val['description']);
		}
	}
}
echo $desc;exit;
?>
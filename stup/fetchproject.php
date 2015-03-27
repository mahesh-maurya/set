<?php
$gethttphost="http://".$_SERVER['HTTP_HOST'];
$get_project_id=!empty($_POST['project_id'])?$_POST['project_id']:"";
$get_sectorslug=!empty($_POST['sectorslug'])?$_POST['sectorslug']:"";
$get_slideroption=!empty($_POST['slideroption'])?$_POST['slideroption']:"horizontal";
$getprojects=file_get_contents($gethttphost."/stup_cms/common/json/projects.json");
$decodeprojectjson = json_decode($getprojects, true);
$form_array=array();
if(!empty($decodeprojectjson))
{
	foreach($decodeprojectjson as $key=>$val)
	{
		if($val['sector_slug']==$get_sectorslug && $val['project_id']==$get_project_id)
		{
			$form_array[$key]['project_id']=$val['project_id'];
			$form_array[$key]['sector_id']=$val['sector_id'];
			$form_array[$key]['sector_slug']=$val['sector_slug'];
			$form_array[$key]['title']=$val['title'];
			$form_array[$key]['description']=$val['description'];
			$form_array[$key]['image']=$val['image'];
			$form_array[$key]['project_images']=$val['project_images'];
			$form_array[$key]['slug']=$val['slug'];
			$form_array[$key]['created_date']=$val['created_date'];
			$form_array[$key]['updated_date']=$val['updated_date'];
			$form_array[$key]['status']=$val['status'];
			$form_array[$key]['url']=$val['url'];
			$form_array[$key]['meta_description']=$val['meta_description'];
			$form_array[$key]['meta_keyword']=$val['meta_keyword'];
		}	
	}
	
	$final_array=array_values($form_array);
	$html="";
	if(!empty($final_array))
	{	
		$html.="<h1>PROJECTS</h1>";
		if($get_slideroption=="horizontal")
		{
			$html.="<div class='projSlider'>";
			$html.="<ul class='pro-bxslider'>";
			$fetchdescription="";
			foreach($final_array as $finalarr_key=>$finalarr_val)
			{
				$fetchdesc_projecttitle=$finalarr_val['title'];
				$fetchdescription=html_entity_decode($finalarr_val['description']);
				foreach($finalarr_val['project_images'] as $projimgkey=>$projimgval)
				{
					$html.="<li>";
					$html.="<div><img src='".$projimgval."'/></div>";
					$html.="</li>";
				}
			}
			$html.="</ul>";
			$html.="</div>";			
			$html.="<div class='slidrText'><h2 class='sliderheadline'>".$fetchdesc_projecttitle."<span class='descs'>Click here to read more</span></h2><br/><span class='desc-set' style='display:none;'>".$fetchdescription."</span><br/><br/></div>";
		}
		else
		{
			$fetchdescription="";
			$html.="<div class='scndprojSlider'>";
			$html.="<ul class='Scndpro-bxslider'>";
			foreach($final_array as $finalarr_key=>$finalarr_val)
			{
				$fetchdesc_projecttitle=$finalarr_val['title'];
				$fetchdescription=html_entity_decode($finalarr_val['description']);
				foreach($finalarr_val['project_images'] as $projimgkey=>$projimgval)
				{
					$html.="<li>";
					$html.="<img src='".$projimgval."' align='left' class='productSlider'/>";
					$html.="</li>";
				}
			}	
			$html.="</ul>";
			$html.="</div>";
			$html.="<div class='proSliderText'>".$fetchdesc_projecttitle."<br/>".$fetchdescription."<br/><br/></div>";
		}
	}
	echo $html;  
}
?>
    <script>
    $(document).ready(function() {
var a=1;
    $('.descs').click(function() {
        if( a==1){
        $('.desc-set').fadeIn(300);
            a=0;
        }
        else{
         $('.desc-set').fadeOut(300);
            a=1;
        }
        
    });
});
    
    </script>
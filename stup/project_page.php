<?php 
header("Access-Control-Allow-Origin: *");
$fetchurl=explode("?",$_SERVER['REQUEST_URI']);
$fetchslug=!empty($fetchurl[1])?$fetchurl[1]:""; 
$pagename="projectpage";
$gethttphost="http://".$_SERVER['HTTP_HOST'];
$getcontents=file_get_contents($gethttphost."/stup_cms/common/json/sectors.json");
$getprojects=file_get_contents($gethttphost."/stup_cms/common/json/projects.json");
$decodeprojectjson = json_decode($getprojects, true);
$decodecontentjson = json_decode($getcontents, true);
$desc_arr="";
$sector_id="";
if(!empty($decodecontentjson))
{
	foreach($decodecontentjson as $jsonkey=>$jsonval)
	{
		if($jsonval['slug']==$fetchslug)
		{
			$desc_arr=html_entity_decode($jsonval['description']);
			$sector_id=html_entity_decode($jsonval['sector_id']);
			$sector_slideroption=html_entity_decode($jsonval['slider_option']);
			
		}
	}
}

function sortby($arr, $index)
{
    $b = array();
    $c = array();
    foreach ($arr as $key => $value) {
        $b[$key] = $value[$index];
    }

    asort($b); //use asort() to sort array by ascending order of value OR use arsort() to sort array by descending order of value

    foreach ($b as $key => $value)
	{
        $c[] = $arr[$key];
    }

    return $c;
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>STUP</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/main.css">
</head>
<body class="sliderBody contactBg" ng-app="StupApp">
	<div class="menuOverlay"></div>
	<div class="homePage">
		<?php include("header.php");?>
	</div>
	<div class="clearfix"></div>
	<div class="projectPage">
		<section class="insideBanner introBanner" ng-controller="sectorsController">
			<div ng-repeat="sector in sectors | filter:{slug:'<?php echo $fetchslug;?>'}" ng-show="$first">
				<img ng-src="{{sector.sector_banner}}"/>
			</div>
			<div class="bannerCentral">
				<div class="caption1" ng-repeat="sector in sectors | filter:{slug:'<?php echo $fetchslug;?>'}" ng-show="$first">
					<span>{{sector.title| truncate:101}}</span>					
				</div>
			</div>
		</section>
		<section class="bannerText">
			<div class="centerDiv">
					
					<?php
					$fetchdescription_sector=html_entity_decode($desc_arr);
					$maindesc_count_sector=strlen($fetchdescription_sector);
					$remain_count_sector=$maindesc_count_sector-285;
					echo $fetchdescription_sector;	
					/*if(strlen($fetchdescription_sector) < 285)
					{
						echo $fetchdescription_sector;		
					}
					else
					{
						echo substr($fetchdescription_sector, 0 , 285)."..<a class='more' style='display:block;' href='javascript:;'>show more</a>";
					}*/
					?>
			</div>
		</section>
		<section class="serviceText">
			<div class="centerDiv">
                
				<div class="serviceDiv servicfrst">
					<h1>SERVICES</h1>
				</div>
				<div class="serviceDiv serviceScnd">
					<ul ng-controller="servicesController" class="colmn">
						<li ng-repeat="service in services | filter:{sector_slug:'<?php echo $fetchslug;?>'}" ng:show="$index >= 0 && $index <= 14">
							<span>{{service.title}}</span>
						</li>
					</ul>
				</div>
<!--
				<div class="serviceDiv serviceScnd serThrd">
					<ul ng-controller="servicesController">
						<li ng-repeat="service in services | filter:{sector_slug:'<?php echo $fetchslug;?>'}" ng:show="$index >=7 && $index <= 13">
							<span>{{service.title}}</span>
						</li>
					</ul>
				</div>
                			<div class="serviceDiv serviceScnd serThrd">
					<ul ng-controller="servicesController">
						<li ng-repeat="service in services | filter:{sector_slug:'<?php echo $fetchslug;?>'}" ng:show="$index >=14 && $index <= 20">
							<span>{{service.title}}</span>
						</li>
					</ul>
				</div>
-->
                    
			</div>
			<div class="clearfix"></div>
			<div class="innermiddleLine"></div>
		</section>
		<section class="projectDiv" ng-controller="projectsController">
			<div class="centerDiv assigndata">
				<h1>PROJECTS</h1>
				<?php
				if($sector_slideroption=="horizontal")
				{
				?>
					<div class="projSlider">
						<ul class="pro-bxslider" style="display:none">
							<?php
							$fetchimages=array();
							$fetchdesc_project="";
							$decodeprojectjson=sortby($decodeprojectjson, 'project_position');
							foreach($decodeprojectjson as $jsonkeyy=>$jsonvalue)
							{
								if($jsonvalue['sector_slug']==$fetchslug)
								{
									$fetchdesc_projecttitle=$jsonvalue['title'];
									$fetchdesc_project=$jsonvalue['description'];
									foreach($jsonvalue['project_images'] as $imkey=>$imval)
									{
									?>
										<li>
											<img src="<?php echo $imval;?>"/>
										</li>
									<?php	
									}
									break; 
								} 
							}
							?>
						</ul>
					</div>
                    <script type="text/javascript">
                       
                    </script>
					<div class="slidrText">
						<h2 class="sliderheadline"><?php echo $fetchdesc_projecttitle;?><span class="descs">Click here to read more</span></h2>
                        
                        <br/>
                           <div class="desc-set" style="display:none;">
						<?php
						$fetchdescription=html_entity_decode($fetchdesc_project);
						echo $fetchdescription."<br/>";
						?>
					</div>
                </div>
				<?php
				}
				else
				{
				?>
					<div class="scndprojSlider">
						<ul class="Scndpro-bxslider"  style="display:none">
							<?php
							$fetchdesc_project="";	
							$decodeprojectjson=sortby($decodeprojectjson, 'project_position');
							foreach($decodeprojectjson as $jsonkeyy=>$jsonvalue)
							{
								if($jsonvalue['sector_slug']==$fetchslug)
								{
									$fetchdesc_projecttitle=$jsonvalue['title'];
									$fetchdesc_project=$jsonvalue['description'];
									foreach($jsonvalue['project_images'] as $imkey=>$imval)
									{
									?>
										<li>
											<img src="<?php echo $imval;?>" align="left" class="productSlider"/>
										</li>	
									<?php
									}
									break; 
								}
							}
							?>
						</ul>
					</div>
					<div class="proSliderText">
						<h2 class="sliderheadline"><?php echo $fetchdesc_projecttitle;?><span class="descs">Click here to read more</span></h2>
                        
                        <br/>
                        <div class="desc-set" style="display:none;">
						<?php
						$fetchdescription=html_entity_decode($fetchdesc_project);
						echo $fetchdescription."<br/>";
						?>
                            </div>
					</div>	
				<?php
				}
				?>
			</div>
			<div class="clearfix"></div>
			<div class="airPortList">
				<div class="centerDiv">
					<ul class="menunarr">
						<?php
						$getindex=0;
						foreach($decodeprojectjson as $jsonkeyy=>$jsonvalue)
						{
							if($jsonvalue['sector_slug']==$fetchslug)
							{
								if($getindex==0)
								{
									$aplyclass='greenText';
								}
								else if($getindex==3 || $getindex==6)
								{
									//$aplyclass='noBorder';
									$aplyclass='';
								}
								else
								{
									$aplyclass='';
								}
							?>
								<li style="cursor:pointer;" id="<?php echo $getindex;?>" class="<?php echo $aplyclass;?>" prjid="<?php echo $jsonvalue['project_id'];?>" onclick="getProject('<?php echo $jsonvalue['project_id'];?>','<?php echo $getindex;?>','<?php echo $fetchslug;?>','<?php echo $sector_slideroption;?>')"><?php echo $jsonvalue['title'];?></li>
							<?php	
							$getindex++;
							}	
						}	
						?>
					</ul>
				</div>
			</div>	
            <div class="pdf-set">
            <p>To download PDF for this sector<a style="color:#ABDD68;margin-left:5px;" href="">Click here</a></p>
            </div>
		</section>
		<?php include("footer.php");?>
	</div>
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
	<script>
	function getProject(project_id,getindex,sectorslug,slideroptn)
	{
		$('.menunarr li').css("color","#a8a8a8");
		$.ajax({
		url : "fetchproject.php",
		type: "POST",
		data : "project_id="+project_id+"&sectorslug="+sectorslug+"&slideroption="+slideroptn,
		success: function(data, textStatus, jqXHR)
		{
			$('.menunarr li').removeClass('greenText');
			
			$(".assigndata").html(data);
			
			<?php
			if($sector_slideroption=="horizontal")
			{
			?>
				$('.pro-bxslider').bxSlider({infiniteLoop: false,});
			<?php
			}
			else
			{
			?>
				$('.Scndpro-bxslider').bxSlider({infiniteLoop: false,});
			<?php
			}
			?>
			$('.menunarr li').eq(getindex).css("color","#467f0a");
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
	 
		}
	});
	}	
	
	
   
	$(".more").click(function(){
		var get_sector_id="<?php echo $sector_id;?>";
		$.ajax({
			url : "showdesc.php",
			type: "POST",
			data : "sector_id="+get_sector_id,
			success: function(data, textStatus, jqXHR)
			{
				$('.bannerText .centerDiv').html(data);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
		 
			}
		});
	});
	</script>
	
</body>
</html>
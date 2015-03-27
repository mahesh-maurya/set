<?php
$pagename="home";
$gethttphost="http://".$_SERVER['HTTP_HOST'];
$getsliders=file_get_contents($gethttphost."/stup_cms/common/json/homepageslider.json");
$decodesliderjson = json_decode($getsliders, true);
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
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/vendor/modernizr-2.6.2.min.js"></script>  
	<script type="text/javascript" src="js/selectivizr-min.js"></script><!--[if (gte IE 6)&(lte IE 8)]-->
	
</head>

<body class="sliderBody contactBg" ng-app="StupApp">
	<div class="menuOverlay"></div>
	<div class="homePage">
		<div id="fullpage">
			<div class="section home" id="section0">
				<div class="homePageSlider">
					<ul class="home-bxslider" ng-controller="homepagebannerController">
						
						<!--<li ng-repeat="hmb in homebanners" class="liheight">
							<img ng-src="{{hmb.image}}" alt="" class="bigimg">
						</li>-->
						<?php
						foreach($decodesliderjson as $sliderkey=>$sliderval)
						{
						?>
							<li class="liheight">
								<img src="<?php echo $sliderval['image'];?>" alt="" class="bigimg">
							</li>	
						<?php
						}
						?>
					</ul>
				</div>
				<?php include("header.php");?>	
			</div>
			<div class="middleLine"></div>
			<div class="section collection" id="section2">
				<div class="aboutUs">
					<div class="centerContLarge">
						<div class="sector">SECTORS</div>
						<div class="sectorPara">STUP is a full service project delivery consultancy company offering integrated planning, architecture, engineering and project management services for buildings, power, transportation, telecommunications, commercial, institutional, recreational and manufacturing facility infrastructure.</div>
						<div class="clearfix"></div>
					</div>
					<div class="imgGallery">
						<ul ng-controller="sectorsController">
							<li ng-repeat="sector in sectors | orderBy:sector.position">
								<a href="project_page.php?{{sector.slug}}" class="galleryImg"><img src="{{sector.image_small}}" alt="">
									<div class="sectorOverlay">
										<div class="overlayText">
											<ul>
												<li>{{sector.title | truncate:50}}</li>
												<li class="playList"><img src="img/playicon.png" alt="" class="palyIcon"></li>
											</ul>
										</div>
									</div>
								</a>
							</li>
						</ul>
					</div>					
				</div>				
				<div class="centerContLarge overBotMar">
					<h1>OVERVIEW</h1>
					<div class="overview">
						<p>STUP is a full service project delivery consultancy company offering  integrated planning, architectural, engineering and project management services for transportation, marine, water, power, telecommunications, commercial, institutional, recreational and manufacturing facility infrastructure, and is an international firm with over 1400 professionals in more than 20 offices and global project locations.</p>
						<p>STUP has served over 10,000 clients in 33 countries on projects of tremendous diversity such as road master plans in Bangladesh, flyovers and bridges in Malaysia, highways in Kuwait, water supply in Laos, sports facilities in UAE, offshore facilities and hospitals in Oman, nuclear reactors, airports, and power plants in India, the presidential palace complex in Ghana, etc.</p>
					</div>
					<div class="overview vewmargin">
						<p>STUP’s wide range of resources and expertise offer comprehensive and single umbrella solutions (incorporating architectural, building and infrastructure engineering, mechanical, electrical and HVAC services) to technically challenging projects and services from planning to construction, for local and national governments, international financing institutions, private sector owners, contractors and public sector institutions</p>
						<p>STUP also provides optimized and innovative state of the art designs utilizing specialized expertise developed over 5 decades for the design and rehabilitation of buildings and major structures, which are locally adapted for economic constructability</p>
						<p>STUP places utmost value on its clients and offers them error free and lower cost designs with tight turnaround times by leveraging the resource base, cost structure and time zones of its Asian operations globally. </p>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php include("footer.php");?>
			</div>
		</div>
	</div>
	<script src="js/jquery.bxslider.min.js"></script>
	<script>
		/*home page banner slider*/
		$(document).ready(function(){
			$('.home-bxslider').bxSlider({
			minSlides: 1,
			maxSlides: 4,
			speed:1000,
			auto:true,
			mode: 'fade',
			});
		});
		
		
		$(window).load(function(){
			if ($(window).width() > 768) {
			var windowheight=$(window).outerHeight();
			$('.homePageSlider, .bigimg').css('height', (windowheight-0));
			
			};
		});
	</script>
 
</body>
</html>
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
<script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>

<body class="sliderBody" ng-app="StupApp">
	<div class="menuOverlay"></div>
	<div class="homePage">
		<?php include("header.php");?>
	</div>
	<div class="clearfix"></div>
	<div class="container">
		<div class="projectPage">
			<section class="insideBanner introBanner"> <img src="img/register_banner.png"/>
				<div class="bannerCentral">
					<div class=" caption2" style="">
						<span>Registrations and <br>Professional Memberships</span>
					</div>
				</div>
			</section>
			<section class="registrationMainDiv">
				<div class="centerContLarge">
					<ul class="registrationUl" ng-controller="regmembershipsController">
						<li ng-repeat="regmem in regmembers">
							<div class="regiImgDiv">
								<img src="{{regmem.image}}" alt="">
							</div>
							<p>{{regmem.title}}</p>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</section>
			<?php include("footer.php");?>	
		</div>
	</div>
</body>
</html>
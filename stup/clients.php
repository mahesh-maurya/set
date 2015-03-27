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
		<section class="insideBanner introBanner"> <img src="img/client_banner.png"/>
			<div class="bannerCentral">
				<div class="int-set caption1"><span>Clients</span></div>
			</div>
		</section>
		<section class="clientMainDiv">
			<div class="centerContLarge">
				<p>STUP has been retained by civic bodies/ municipalities, government agencies, public and private sector undertakings, individual owners and engineering contractors. In addition, consultancy services have been provided to several projects financed by clients such as:</p>
			</div>
			<section class="clientMainDiv">
				<div class="clientsTab">
					<div class="centerContLarge">
						<ul class="clientTabUl">
							<li><a href="javascript:void(0)" data-element="tabone" class="activeTab">Funding Agencies</a></li>
							<li><a href="javascript:void(0)" data-element="tabtwo">Government Bodies</a></li>
							<li><a href="javascript:void(0)" data-element="tabthree">Contractors & Developers</a></li>
							<li><a href="javascript:void(0)" data-element="tabfour">Corporations</a></li>
						</ul>
					</div>
				</div>
				<div class="clientLogoDiv centerContLarge" ng-controller="clientsController">
					<div class="commonTab tabone" style="display:block;">
						<ul class="tabClinetUl">
							<li ng-repeat="client_fa in clients | filter:{client_type:'Funding Agencies'}">
								<img src="{{client_fa.image}}" alt="">
								<p>{{client_fa.title}}</p>
							</li>
						</ul>
					</div>
					<div class="commonTab tabtwo">
						<ul class="tabClinetUl">
							<li ng-repeat="client_gb in clients | filter:{client_type:'Government Bodies'}">
								<img ng-src="{{client_gb.image}}" alt="">
								<p>{{client_gb.title}}</p>
							</li>
						</ul>
					</div>
					<div class="commonTab tabthree">
						<ul class="tabClinetUl">
							<li ng-repeat="client_cd in clients | filter:{client_type:'Contractors & Developers'}">
								<img ng-src="{{client_cd.image}}" alt="">
								<p>{{client_cd.title}}</p>
							</li>
						</ul>
					</div>
					<div class="commonTab tabfour">
						<ul class="tabClinetUl">
							<li ng-repeat="client_corp in clients | filter:{client_type:'Corporations'}">
								<img ng-src="{{client_corp.image}}" alt="">
								<p>{{client_corp.title}}</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="clearfix"></div>
			</section>
		</section>
		<?php include("footer.php");?>
	</div>
</body>
</html>
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
<style>
.careers-list{
	padding-top:25px;
}
.careers-list p{
	padding:0px 0px 20px 0px;
}
.career-email{
	color:#1e1e1e;
	text-decoration:none;
	margin:2px 0px;
	display:block;
}
@media screen and (min-width: 768px) and (max-width:1024px){
	.careers-list{
	padding-bottom:70px;
}
}

</style>

</head>

<body  class="sliderBody" ng-app="StupApp">

	<div class="menuOverlay"></div>

	<div class="homePage">

		<?php include("header.php");?>

	</div>

	<div class="clearfix"></div>

	<div class="container">

		<div class="projectPage">

			<section class="insideBanner introBanner"> <img src="img/career_banner.png"/>

				<div class="bannerCentral">

				  <div class="int-set caption1"><span>Careers</span></div>

				</div>

			</section>

			<section class="offceListDiv career-tab">

				<div class="centerContLarge">

					<p>Human Resources<br>
                     <a href="mailto:hr@stupmail.com" class="career-email">hr@stupmail.com</a></p>
					<div class="careers-list">
					<p>STUP is Asia's premier Design and Engineering Consultancy organization.</p>
                    <p>STUP currently employs over 1200 personnel and has offices in all Indian metros as well as in some other places abroad. </p>
                    <p>We strive to lead the Infrastructure and Real Estate Industries by staying at the forefront of technology, embracing and initiating change. </p>
                    <p>STUP seeks to recruit high caliber, innovative and self motivated individuals. It is our endeavor to provide the opportunities for our staff to achieve their fullest potential and to reward them accordingly. </p>
                    <p>Vacancies are advertised in relevant technical journals and newspapers. And also listed below. </p>
                    <p>If no vacancies are shown below, please re-visit this site at a later date.</p>
                    </div>

					<div class="clearfix"></div>

				</div>

			</section>

			<!--<div class="addressLine"><img src="img/home_middle-strip.png" alt=""></div>-->
			<?php include("footer.php");?>

		</div>

	</div>

</body>

</html>
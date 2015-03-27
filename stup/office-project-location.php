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

img{
	max-width:100%;
}


.offceListDiv .location-h1 {
    color: #2e6200;
    font-size: 44px;
    font-weight: 300;
    text-transform: uppercase;
	display:inline-block;
	width:31%;
	vertical-align:bottom;
	font-family:'oswald';
	line-height:45px;
	padding-top:0px;
	margin-bottom:42px;
	
}
.map-img{
	display:inline-block;
	width:68%;
	vertical-align:top;
	margin:44px 0px;
}

.word-img img {
    display: block;
    margin: 0 auto;
    width: 100%;
}
.hover-color{
	background:red;
	width:5px;
	height:5px;
	border-radius:5px;
}

@media screen and (max-width:800px){
.offceListDiv .location-h1 {
    display: block;
    font-size: 25px;
    line-height: 30px;
    padding: 0;
    width: 100%;
}
.map-img{
	display:block;
	width:100%;
	vertical-align:top;
	margin:20px 0px;
}
.laction-container{
    clear: both;
    margin: -8% auto 0;
    max-width: 980px;
    position: relative;
    width: 69%;
}
.offceListDiv {
	padding-left:0px;
}
}
@media screen and (min-width:641px) and (max-width:800px){
.map-img{
margin:70px 0px 125px;
}
.offceListDiv .location-h1 {
	padding:35px 35px;
}
}
@media screen and (min-width:801px) and (max-width:1200px){
.offceListDiv .location-h1 {
font-size: 41px;
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

			<section class="insideBanner introBanner"> <!--<img src="img/career_banner.png"/>-->

				<div class="bannerCentral laction-container">
				</div>

			</section>

			<section class="offceListDiv">

				<div class="centerContLarge">
					<h1 class="location-h1">Offices & <br>Project Location</h1>
					<div class="map-img">
                    <span class="word-img">
					<img src="img/wordmap-stup-img.jpg" alt="" usemap="#Map" border="0" class="map-02"></span>
					 <map name="Map">
					    <area shape="circle" coords="102,137,3" href="javascript:void(0);" alt="America" title="America" class="hover-img-02">
					    <area shape="circle" coords="318,109,3" href="javascript:void(0);" alt="France" title="France">
					    <area shape="circle" coords="317,147,3" href="javascript:void(0);" alt="Algeria" title="Algeria">
					    <area shape="circle" coords="289,185,4" href="javascript:void(0);" alt="Gambia" title="Gambia">
					    <area shape="circle" coords="309,196,3" href="javascript:void(0);" alt="Ghana" title="Ghana">
					    <area shape="circle" coords="345,157,5" href="javascript:void(0);" alt="Libya" title="Libya">
					    <area shape="circle" coords="370,211,5" href="javascript:void(0);" alt="Uganda" title="Uganda">
					    <area shape="circle" coords="377,225,5" href="javascript:void(0);" alt="Tanzania" title="Tanzania">
					    <area shape="circle" coords="370,141,4" href="javascript:void(0);" alt="Cyprus" title="Cyprus">
					    <area shape="circle" coords="378,150,4" href="javascript:void(0);" alt="Jordan" title="Jordan">
					    <area shape="circle" coords="392,144,4" href="javascript:void(0);" alt=" Kuwait" title=" Kuwait">
					    <area shape="circle" coords="395,153,3" href="javascript:void(0);" alt="American Express3" title="American Express3">
					    <area shape="circle" coords="396,160,3" href="javascript:void(0);" alt="Qatar" title="Qatar">
					    <area shape="circle" coords="402,163,3" href="javascript:void(0);" alt="Bahrain" title="Bahrain">
					    <area shape="circle" coords="397,182,4" href="javascript:void(0);" alt="Yemen" title="Yemen">
					    <area shape="circle" coords="412,141,4" href="javascript:void(0);" alt="Iran" title="Iran">
					    <area shape="circle" coords="410,162,4" href="javascript:void(0);" alt="U.A.E" title="U.A.E">
					    <area shape="circle" coords="415,171,3" href="javascript:void(0);" alt="Oman" title="Oman">
					    <area shape="circle" coords="430,140,4" href="javascript:void(0);" alt="Afghanistan" title="Afghanistan">
				        <area shape="circle" coords="456,66,4" href="javascript:void(0);" alt="Russia" title="Russia	">
					    <area shape="circle" coords="414,252,4" href="javascript:void(0);" alt="Mauritius" title="Mauritius">
					    <area shape="circle" coords="459,151,4" href="javascript:void(0);" alt="Nepal" title="Nepal">
					    <area shape="circle" coords="445,205,5" href="javascript:void(0);" alt="Maldives" title="Maldives">
					    <area shape="circle" coords="450,162,5" href="javascript:void(0);" alt="India" title="India">
					    <area shape="circle" coords="473,156,4" href="javascript:void(0);" alt="Bhutan" title="Bhutan">
					    <area shape="circle" coords="454,200,4" href="javascript:void(0);" alt="Sri Lanka" title="Sri Lanka">
					    <area shape="circle" coords="470,165,4" href="javascript:void(0);" alt="Bangladesh" title="Bangladesh">
					    <area shape="circle" coords="494,204,4" href="javascript:void(0);" alt="Malaysia" title="Malaysia">
					    <area shape="circle" coords="497,170,5" href="javascript:void(0);" alt="Vietnam" title="Vietnam">
					    <area shape="circle" coords="497,188,5" href="javascript:void(0);" alt="Cambodia" title="Cambodia">
					    <area shape="circle" coords="507,187,5" href="javascript:void(0);" alt="Laos" title="Laos">
					    <area shape="circle" coords="504,228,4" href="javascript:void(0);" alt="Indonesia" title="Indonesia">
					    <area shape="circle" coords="515,207,4" href="javascript:void(0);" alt="Brunei" title="Brunei">
					    <area shape="circle" coords="526,182,4" href="javascript:void(0);" alt="Philippines" title="Philippines">
					    <area shape="circle" coords="577,230,5" href="javascript:void(0);" alt="Papua New Guinea" title="Papua New Guinea">
					    <area shape="circle" coords="618,196,5" href="javascript:void(0);" alt="Micronesia" title="Micronesia">
					    <area shape="circle" coords="583,205,4" href="javascript:void(0);" alt="Marshall Islands" title="Marshall Islands">
					  </map>
					</div>
					<div class="clearfix"></div>

				</div>

			</section>

			<!--<div class="addressLine"><img src="img/home_middle-strip.png" alt=""></div>-->
			<?php include("footer.php");?>

		</div>

	</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/jquery.rwdImageMaps.min.js"></script>
<script src="js/jquery.rwdImageMaps.js"></script>
<script>
$(document).ready(function() {
	$('img[usemap]').rwdImageMaps();
});
</script>
</body>

</html>
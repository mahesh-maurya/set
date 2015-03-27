<?php
$gethttphost="http://".$_SERVER['HTTP_HOST'];
$getcontents=file_get_contents($gethttphost."/stup_cms/common/json/sectors.json");
$decodecontentjson = json_decode($getcontents, true);
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
<style>
.sectoreleft-img {
	display: inline-block;
	vertical-align: top;
	width: 49%;
	margin-right: 0.7%;
	position: relative;
	margin-bottom: 1%;
}
.sectoreright-img {
	display: inline-block;
	vertical-align: top;
	width: 49%;

}
article img {
	width: 100%;
	border: none;
	display:block;
}
.right-img {
	width: 100%;
}
.right-img .hoverShow{
    display: inline-block;
    vertical-align: top;
    margin-bottom: 2.2%;
    margin-right: 1.4%;
    width: 48%;
}
.hoverShow div.hoverDiv{
height:53px;
position:absolute;
bottom:0;
width:100%;
visibility:hidden;
}
.hoverShow:hover div.hoverDiv {
    visibility:visible;
}
.hoverShow {
    display:block;
    position:relative;
}
.hoverShow:hover .textHover{
	display: block !important;
	color:#f9ba4d;
	font-family: 'Open Sans Condensed', sans-serif;
	font-weight:300;
	
}

.sec-blog{
	margin-bottom:10px;
}
.hoverShow.hoverShow2 {
    margin-right:1.4%;
    width: 48.9%;
}
.hoverShow.hoverShow2.last_img{
	margin-right:0px;
}
.sectoreright-img.last-block{
width:48%;
}
.hoverShow div.hoverDiv {
padding-bottom: 22px;
padding-top: 15px;
height:auto;
}
.sectoreright-img .hoverDiv span,.sectoreleft-img .hoverDiv span{
	line-height:inherit;
}
@media (min-width: 0px) and (max-width:370px){
.hoverShow2,.sectoreright-img.last-block {
    width: 72%;
}
.sectoreleft-img,.sectoreright-img{
	width: 72%;
	margin-bottom: 0px;
}
.right-img .hoverShow{
width:100%;
}
.hoverShow {
    margin-bottom: 2%;
}
.txt-center{
	text-align:center;
}
}
@media (min-width: 371px) and (max-width:480px){
.hoverShow2,.sectoreright-img.last-block {
    width: 59%;
}
.sectoreleft-img,.sectoreright-img{
	width: 59%;
	margin-bottom: 0px;
}
.right-img .hoverShow{
width:100%;

}
.txt-center{
	text-align:center;
}
.hoverShow {
    margin-bottom: 2%;
}
}
@media (min-width: 481px) and (max-width:640px){
.hoverShow2,.sectoreright-img.last-block {
    width: 54%;
}
.sectoreleft-img,.sectoreright-img{
	width: 54%;
	margin-bottom: 0px;
}
.right-img .hoverShow{
width:100%;

}
.txt-center{
	text-align:center;
}
.hoverShow {
    margin-bottom: 2%;
}
}
@media (min-width: 641px) and (max-width:906px){
.hoverShow.hoverShow2 {
    margin-right: 2%;
    width: 48.2%;
}
.sectoreright-img.last-block {
    width: 47.7%;
}
}
</style>
</head>

<body class="sliderBody contactBg" ng-app="StupApp">
<div class="menuOverlay"></div>
<div class="homePage">
  <?php include("header.php");?>
</div>
<div class="clearfix"></div>
<div class="container">
  <div class="projectPage">
    <section class="insideBanner introBanner"> <img src="img/sector_banner.png"/> 
<div class="bannerCentral">
				<div class="int-set caption1"><span>SECTORS</span></div>
			</div>
    </section>
    <section class="sectorMainDiv">
      <div class="centerContLarge">
<!--        <h1>SECTORS</h1>-->
        <article class="txt-center">
          <div class="sectoreleft-img"> 
			<a href="project_page.php?<?php echo $decodecontentjson[0]['slug'];?>" class="hoverShow">
				<img src="<?php echo !empty($decodecontentjson[0]['image'])?$decodecontentjson[0]['image']:"";?>" alt=""/>
				<div class="hoverDiv"><span class="textHover"><?php echo !empty($decodecontentjson[0]['title'])?$decodecontentjson[0]['title']:"";?></span></div>
			</a>
          </div>
          <div class="sectoreright-img">
            <div class="right-img">
				<?php 
				for($scnt=1;$scnt<=4;$scnt++)
				{
				?>
					<a href="project_page.php?<?php echo $decodecontentjson[$scnt]['slug'];?>" class="hoverShow">
						<img src="<?php echo !empty($decodecontentjson[$scnt]['image'])?$decodecontentjson[$scnt]['image']:"";?>" alt=""/> 
						<div class="hoverDiv"><span class="textHover"><?php echo !empty($decodecontentjson[$scnt]['title'])?$decodecontentjson[$scnt]['title']:"";?></span></div>
					</a>
				<?php
				}
				?>
			</div>
          </div>
          <div class="clearfix"></div>
          <div class="sectoreleft-img"> 
			<a href="project_page.php?<?php echo !empty($decodecontentjson[5]['slug'])?$decodecontentjson[5]['slug']:"";?>" class="hoverShow">
				<img src="<?php echo !empty($decodecontentjson[5]['image'])?$decodecontentjson[5]['image']:"";?>" alt="" class="sec-blog">
				<div class="hoverDiv"><span class="textHover"><?php echo !empty($decodecontentjson[5]['title'])?$decodecontentjson[5]['title']:"";?></span></div>
			</a>
			<a href="project_page.php?<?php echo !empty($decodecontentjson[8]['slug'])?$decodecontentjson[8]['slug']:"";?>" class="hoverShow">
				<img src="<?php echo !empty($decodecontentjson[8]['image'])?$decodecontentjson[8]['image']:"";?>" alt="">
				<div class="hoverDiv"><span class="textHover"><?php echo !empty($decodecontentjson[8]['title'])?$decodecontentjson[8]['title']:"";?></span></div>
			</a>
          </div>
          <div class="sectoreright-img">
            <div class="right-img">
				<a href="project_page.php?<?php echo !empty($decodecontentjson[6]['slug'])?$decodecontentjson[6]['slug']:"";?>" class="hoverShow">
					<img src="<?php echo !empty($decodecontentjson[6]['image'])?$decodecontentjson[6]['image']:"";?>" alt=""> 
					<div class="hoverDiv"><span class="textHover"><?php echo !empty($decodecontentjson[6]['title'])?$decodecontentjson[6]['title']:"";?></span></div>
				</a>
                <a href="project_page.php?<?php echo !empty($decodecontentjson[7]['slug'])?$decodecontentjson[7]['slug']:"";?>" class="hoverShow">
					<img src="<?php echo !empty($decodecontentjson[7]['image'])?$decodecontentjson[7]['image']:"";?>" alt=""> 
					<div class="hoverDiv"><span class="textHover"><?php echo !empty($decodecontentjson[7]['title'])?$decodecontentjson[7]['title']:"";?></span></div>
				</a>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="sectoreleft-img">
            <div class="right-img">
				<a href="project_page.php?<?php echo !empty($decodecontentjson[9]['slug'])?$decodecontentjson[9]['slug']:"";?>" class="hoverShow hoverShow2">
					<img src="<?php echo !empty($decodecontentjson[9]['image'])?$decodecontentjson[9]['image']:"";?>" alt=""> 
					<div class="hoverDiv"><span class="textHover"><?php echo !empty($decodecontentjson[9]['title'])?$decodecontentjson[9]['title']:"";?></span></div>
				</a>
				<a href="project_page.php?<?php echo !empty($decodecontentjson[10]['slug'])?$decodecontentjson[10]['slug']:"";?>" class="hoverShow hoverShow2 last_img">
					<img src="<?php echo !empty($decodecontentjson[10]['image'])?$decodecontentjson[10]['image']:"";?>" alt="">
					<div class="hoverDiv"><span class="textHover"><?php echo !empty($decodecontentjson[10]['title'])?$decodecontentjson[10]['title']:"";?></span></div>
				</a>

            </div>
          </div>
          <div class="sectoreright-img last-block">
			<a href="project_page.php?<?php echo !empty($decodecontentjson[11]['slug'])?$decodecontentjson[11]['slug']:"";?>" class="hoverShow">
				<img src="<?php echo !empty($decodecontentjson[11]['image'])?$decodecontentjson[11]['image']:"";?>" alt=""> 
				<div class="hoverDiv"><span class="textHover"><?php echo !empty($decodecontentjson[11]['title'])?$decodecontentjson[11]['title']:"";?></span></div>
			</a>
          </div>
        </article>
      </div>
      <div class="clearfix"></div>
    </section>
    <?php include("footer.php");?>
  </div>
</div>
<!--
<script>
$(document).ready(function(){
	$('.hoverShow').hover(function(){
		$(this).children('.hoverDiv').animate({bottom : '0px'});		
	}, function(){
		$('.hoverDiv').animate({bottom : '-54px'});	
	});	    
});
</script>-->



</body>
</html>
<footer class="footer">
	<div class="footerLine"></div>
	<?php
	if(!empty($pagename) && $pagename!="projectpage")
	{
		echo "<span class='overviewBg'><img src='img/overviewbg.png' alt=''></span>";
	}	
	?>
	
	<div class="headercenterContLarge">
		<div class="frstFooterDiv"><a href="index.php"><img src="img/footerlogo.png" alt=""></a></div>
		<div class="footerDiv">
			<h1>Overview</h1>
			<ul>
				<li><a href="introduction.php">Introduction</a></li>
				<li><a href="boardofdirectors.php">Directors</a></li>
				<li><a href="allsectors.php">List of sector</a></li>
				<li><a href="clients.php">Clients</a></li>
				<li><a href="registration.php">Registrations and Professional <br>
				Memberships</a></li>
				<li><a href="services.php">services</a></li>
       				<li><a href="office-project-location.php">Project Location Map</a></li>        
			</ul>
		</div>
		<div class="footerDiv middleFooter">
			<h1>SECTORS</h1>
			<ul ng-controller="sectorsController">
				<li ng-repeat="sector in sectors.slice(0,6) | orderBy:sector.position">
					<a href="project_page.php?{{sector.slug}}">{{sector.title}}</a>
				</li>
			</ul>
		</div>
		<div class="footerDiv footerMarging">
			<ul ng-controller="sectorsController">
				<li ng-repeat="sector in sectors.slice(6,12) | orderBy:sector.position">
					<a href="project_page.php?{{sector.slug}}">{{sector.title}}</a>
				</li>
			</ul>
		</div>
		
		<div class="footerDiv lastfooterDiv">
			<h2><a href="list_of_offices.php">OFFICES</a></h2>
			<h2><a href="careers.php">careers</a></h2>
			<h2><a href="contactus.php">contact us</a></h2>
		</div>
		<div class="footerYears">
			<img src="img/footer50.png" alt="">
		</div>
		<div class="clearfix"></div>
	</div>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script> 
<?php
if(!empty($pagename) && $pagename=="projectpage")
{
?>
	<script src="js/jquery.bxslider.min.js"></script> 
<?php
}
?>

<script src="js/angular.js"></script>
<script src="js/functions_angular.js"></script>
<script src="js/common.js"></script> 
<script>
  function mobileview() {
    if (screen.width < 980)
      $('head').append('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">');      
  }
  mobileview();
</script>
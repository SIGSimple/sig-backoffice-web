<!DOCTYPE html>
<html lang="en" ng-app="sig_backoffice">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SIG BackOffice | Colaborative Management SaaS.</title>

	<!--STYLESHEET-->
	<!--=================================================-->

	<!--Open Sans Font [ OPTIONAL ] -->
 	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">


	<!--Bootstrap Stylesheet [ REQUIRED ]-->
	<link href="css/bootstrap.min.css" rel="stylesheet">


	<!--Nifty Stylesheet [ REQUIRED ]-->
	<link href="css/nifty.min.css" rel="stylesheet">

	
	<!--Font Awesome [ OPTIONAL ]-->
	<link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">


	<!--Demo [ DEMONSTRATION ]-->
	<link href="css/demo/nifty-demo.min.css" rel="stylesheet">

	
	<!--Bootstrap Timepicker [ OPTIONAL ]-->
	<link href="plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">


	<!--Bootstrap Datepicker [ OPTIONAL ]-->
	<link href="plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">


	<!-- CUSTOM -->
	<link href="css/custom.css" rel="stylesheet">


	<!--SCRIPT-->
	<!--=================================================-->

	<!--Page Load Progress Bar [ OPTIONAL ]-->
	<link href="plugins/pace/pace.min.css" rel="stylesheet">
	<script src="plugins/pace/pace.min.js"></script>
</head>

<body>
	<div id="container" class="cls-container">
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay" class="bg-img img-balloon"></div>
		
		<!-- HEADER -->
		<!--===================================================-->
		<div class="cls-header cls-header-lg">
			<div class="cls-brand">
				<a class="box-inline" href="#">
					<!-- <img alt="Nifty Admin" src="img/logo.png" class="brand-icon"> -->
					<span class="brand-title">SIG <span class="text-thin">BackOffice</span></span>
				</a>
			</div>
		</div>

		<div class="cls-content">
			<?php include($_GET['page'].'.php'); ?>
		</div>
		
		<!-- DEMO PURPOSE ONLY -->
		<!--===================================================-->
		<div class="demo-bg">
			<div id="demo-bg-list">
				<div class="demo-loading"><i class="fa fa-refresh"></i></div>
				<img class="demo-chg-bg bg-trans" src="img/bg-img/thumbs/bg-trns.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-1.jpg" alt="Background Image">
				<img class="demo-chg-bg active" src="img/bg-img/thumbs/bg-img-2.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-4.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-5.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-6.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-7.jpg" alt="Background Image">
			</div>
		</div>
		<!--===================================================-->
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->
		
	<!--JAVASCRIPT-->
	<!--=================================================-->

	<!--jQuery [ REQUIRED ]-->
	<script src="js/jquery-2.1.1.min.js"></script>


	<!--BootstrapJS [ RECOMMENDED ]-->
	<script src="js/bootstrap.min.js"></script>


	<!--Fast Click [ OPTIONAL ]-->
	<script src="plugins/fast-click/fastclick.min.js"></script>

	
	<!--Nifty Admin [ RECOMMENDED ]-->
	<script src="js/nifty.min.js"></script>


	<!--Background Image [ DEMONSTRATION ]-->
	<script src="js/demo/bg-images.js"></script>


	<!--Bootstrap Timepicker [ OPTIONAL ]-->
	<script src="plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>


	<!--Bootstrap Datepicker [ OPTIONAL ]-->
	<script src="plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

	<!--Underscore [ REQUIRED ]-->
	<script src="js/underscore.min.js"></script>

	<!--Angular [ REQUIRED ]-->
	<script src="bower_components/angular/angular.min.js"></script>

	<!--Angular [ REQUIRED ]-->
	<script src="js/ui-bootstrap-custom-0.13.0.min.js"></script>
	<script src="js/ui-bootstrap-custom-tpls-0.13.0.min.js"></script>

	<!--Moment [ REQUIRED ]-->
	<script src="bower_components/moment/moment.js"></script>
	<script src="bower_components/moment/locale/pt-br.js"></script>

	<!--Moment [ REQUIRED ]-->
	<script src="bower_components/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="bower_components/moment/locale/pt-br.js"></script>

	<!--CUSTOM-->
	<script src="js/custom.js"></script>
	<script src="js/extras.js"></script>

	<script src="js/angular-app.js"></script>
	<script src="js/service/user-logged.js"></script>
	<script src="js/controller/<?=($_GET['page'])?>.js"></script>
</body>
</html>

<?php

/*
Template Name: Dashboard v2
*/

get_header(); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
#dashboard {
	padding: 50px 0;	
}
#dashboard .row {
	float: none;	
}
#dashboard .huge {
	font-size: 40px;	
}
#dashboard .navbar-default .container-fluid {
    background-color: #f8f8f8;
    border-color: #e7e7e7;
}
.progress-panel {
	padding-top: 20px;
}
.progress-panel .col-sm-6 * {
	margin: 0;
}
.progress-panel .progress {
	height: 60px;
}

</style>

</header>


	<div id="content" class="site-content">

<div id="dashboard" class="container">
	
	<!-- dashboard nav -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">TCM Membership</a></li>
					<li><a href="#">Purchases</a></li>
					<li><a href="#">Referrals</a></li>
					<li><a href="#">Settings</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- /dashboard nav -->
	
	<!-- page header -->
	<div class="row">
		<div class="col-sm-12">
	        <h1 class="page-header">TCM Membership</h1>
	    </div>
	</div>
	<!-- /page header -->
	
	<!-- progress panel -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-body progress-panel">
					<div class="row">
						<div class="col-sm-2 text-left">
							<img src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/gold.jpg">
						</div>
						<div class="col-sm-6 text-left">
								<h3>Johnny Cage</h3>
								<h3>Status: Gold Member</h3>
								<h3>Loyalty Points: 1,800</h3>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>TCM Credits</h3></div>
								<div class="panel-body"><h2>$100</h2></div>
							</div>
						</div>	
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="progress">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"><span class="sr-only">40% Complete (success)</span></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /progress panel -->
	
	<!-- stat panel -->
	<div class="row">
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-user-plus fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">3</div>
							<div>Benefits Activated</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-shopping-cart fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">10</div>
							<div>Total Purchases</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-share fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">5</div>
							<div>Total Referrals</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<!-- /stat panel -->



</div>


<?php get_footer(); ?>
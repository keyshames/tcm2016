<?php

/*
Template Name: Dashboard v3
*/

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<?php get_header(); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/css/dashboard.css">
</header>
<style>.gy {color: #777777;}
.g {color :#5cb85c}</style>

	<div id="content" class="site-content">

<div id="dashboard" class="container">

	<!-- page header -->
	<div class="row">
		<div class="col-sm-12">
	        <h1 class="page-header">Dashboard</h1>
	    </div>
	</div>
	<!-- /page header -->
	
	<!-- stats -->
	<div class="row">
		

					<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<span class="glyphicon glyphicon-piggy-bank"></span>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">$<?=get_credit_balance()?></div>
							<div>TCM Credits</div>
						</div>
					</div>
				</div>
				<a href="../referral-panel">
					<div class="panel-body">
						<span class="pull-left">Earn Credits</span>
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
							<div class="huge"><?=count_purchases()?></div>
							<div>Total Purchases</div>
						</div>
					</div>
				</div>
				<a href="../purchase-history">
					<div class="panel-body">
						<span class="pull-left">View History</span>
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
							<i class="fa fa-user fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?=count_referrals()?></div>
							<div>Total Referrals</div>
						</div>
					</div>
				</div>
				<a href="../referral-history">
					<div class="panel-body">
						<span class="pull-left">View History</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
					
	
		
	</div>
	<!-- /stats-->
	

	
	<!-- points -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>My Rewards</h3></div>
				<div class="panel-body">
					<br>
					<h5>Membership Level: <text class="g"><b><?=get_user_info('loyalty_status')?></b></text></h5>
					<h5>Loyalty Points: <text class="g"><b><?=get_user_info('loyalty_points')?></b></text></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=get_progress()?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=get_progress()?>%"><span class="sr-only"><?=get_progress()?>% Complete (success)</span></div>
					</div>
					<h5 class=""><b><?=get_next_unlock() - get_user_info('loyalty_points')?> LP</b> to reach the next level. </h5>
					<br>
					<h5>Earning loyalty points is easy! Just keep shopping in our store and inviting your friends to join!</h5>
				</div>
			</div>
		</div>
	</div>
	<!-- /points -->
	
	<!-- email -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>My Referrals</h3></div>
				<div class="panel-body">
					<br>
					<h5><b>Referral Link</b></h5>
					<h2 class="g">http://thecannabismethod.com/?cp=<?=get_aff_coupon()?></a></h2>
					<br>
					<h5><b>Coupon Code</b></h5>
					<h2 class="g"><b><?=get_aff_coupon()?></b></h2>
					<br>
					<h5>Invite friends using your referral link or coupon code and earn more TCM credits!</h5>
				</div>
			</div>
		</div>
	</div>
	<!-- /email -->

</div>


<?php get_footer();?>
<?php

/*
Template Name: Dashboard 2
*/

get_header();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://thecannabismethod.com/wp-content/themes/zerif-lite-child/css/dashboard.css">
</header>


	<div id="content" class="site-content">

<div id="dashboard" class="container">

	<!-- page header -->
	<div class="row">
		<div class="col-sm-12">
	        <h1 class="page-header">Welcome back, <?=get_first_name()?>!</h1>
	    </div>
	</div>
	<!-- /page header -->
	
	<!-- stats -->
	<div class="row">
		
		<div class="col-sm-4">
			<a href="../referral-panel">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<img src="data:image/png;base64,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"/>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">$<?=get_credit_balance()?></div>
								<div>TCM Credits</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<span class="pull-left">Earn Credits</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</div>
			</a>
		</div>
				
		<div class="col-sm-4">
			<a href="../referral-history">
				<div class="panel panel-default">
					<div class="panel-heading">		
						<div class="row">
							<div class="col-xs-3">
								<img src="data:image/png;base64,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"/>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?=count_referrals()?></div>
								<div>Total Referrals</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<span class="pull-left">View History</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</div>
			</a>
		</div>
		
		<div class="col-sm-4">
			<a href="../purchase-history">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<img src="data:image/png;base64,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"/>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">#<?=get_last_order()?></div>
								<div>Last Order</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<span class="pull-left">View History</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</div>
			</a>
		</div>
		
	</div>
	<!-- /stats-->
	
	<!-- level -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Membership Level</h3></div>
				<div class="panel-body">
					<h2><?=get_user_info('loyalty_status')?></h2>
					<div class="badge-wrap">
						<img class="badge-icon" src="https://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/green.png">
						<img class="badge-icon" src="https://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/silver<?=( get_user_info('loyalty_points') < $unlock_points['Silver'] ? "-2" : "" )?>.png">
						<img class="badge-icon" src="https://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/gold<?=( get_user_info('loyalty_points') < $unlock_points['Gold'] ? "-2" : "" )?>.png">
						<img class="badge-icon" src="https://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/platinum<?=( get_user_info('loyalty_points') < $unlock_points['Platinum'] ? "-2" : "" )?>.png">
					</div>
					<h5><a data-toggle="modal" data-target="#myModal">What are levels? <i class="fa fa-arrow-circle-right"></i></a></h5>
					<br>
					<h2><?=get_user_info('loyalty_points')?> LP</h2>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=get_progress()?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=get_progress()?>%"><span class="sr-only"><?=get_progress()?>% Complete (success)</span></div>
					</div>
					<h5><?=get_progress_counter()?></h5>
				</div>
			</div>
		</div>
	</div>
	<!-- /points -->

	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title"><b>TCM Loyalty Program</b></h3>
				</div>
				<div class="modal-body">
					<p>
						Membership Levels reward loyal TCM customers by providing additional membership benifits. 
						When you shop at our store, you earn 10 loyalty points for every $1 that you donate. 
						As you accumulate more points, TCM recognizes your loyalty by moving you up to the next level.
					</p>
					<p>Levels are unlocked when you reach any one of the following point totals.</p>
					<p>
						<b>Silver</b>: 1,500<br>
						<b>Gold</b>: 3,000<br>
						<b>Platinum</b>: 6,000<br>
					</p>
					<p>Membership status and loyalty points are reset every month.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- /Modal -->

  



</div>


<?php get_footer();?>
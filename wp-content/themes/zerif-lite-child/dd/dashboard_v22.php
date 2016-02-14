<?php

/*
Template Name: Dashboard v2
*/

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<?php get_header(); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/css/dashboard.css">
</header>


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
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>TCM Membership</h3></div>
				<div class="panel-body">
					<div class="col-sm-4">dd
							<img class="badge-icon" src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/silver<?=( get_user_info('loyalty_points') < $unlock_points['Silver'] ? "-2" : "" )?>.png">
					</div>
					<div class="col-sm-8">dd
					</div>
				</div>
			</div>
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
					<img class="badge-icon" src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/bronze<?=( get_user_info('loyalty_points') < $unlock_points['Bronze'] ? "-2" : "" )?>.png">
					<img class="badge-icon" src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/silver<?=( get_user_info('loyalty_points') < $unlock_points['Silver'] ? "-2" : "" )?>.png">
					<img class="badge-icon" src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/gold<?=( get_user_info('loyalty_points') < $unlock_points['Gold'] ? "-2" : "" )?>.png">
				</div>
			</div>
		</div>
	</div>
	<!-- /level -->
	
	<!-- level -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Membership Level</h3></div>
				<div class="panel-body">
					<h2><?=get_user_info('loyalty_status')?></h2>
					<img class="badge-icon" src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/bronze<?=( get_user_info('loyalty_points') < $unlock_points['Bronze'] ? "-2" : "" )?>.png">
					<img class="badge-icon" src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/silver<?=( get_user_info('loyalty_points') < $unlock_points['Silver'] ? "-2" : "" )?>.png">
					<img class="badge-icon" src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/gold<?=( get_user_info('loyalty_points') < $unlock_points['Gold'] ? "-2" : "" )?>.png">
				</div>
			</div>
		</div>
	</div>
	<!-- /level -->
	
	<!-- points -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Loyalty Points</h3></div>
				<div class="panel-body">
					<h2><?=get_user_info('loyalty_points')?> LP</h2>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=get_progress()?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=get_progress()?>%"><span class="sr-only"><?=get_progress()?>% Complete (success)</span></div>
					</div>
					<h5><b><?=get_next_unlock() - get_user_info('loyalty_points')?> LP</b> to reach the next level. </h5>
				</div>
			</div>
		</div>
	</div>
	<!-- /points -->
	
	<!-- email -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Email</h3></div>
				<div class="panel-body"><h2><?=get_user_info('user_email')?></h2></div>
			</div>
		</div>
	</div>
	<!-- /email -->

</div>


<?php get_footer();?>
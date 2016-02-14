<?php

/*
Template Name: Dashboard
*/

get_header(); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
	.row.profile {
	 	text-align: left; 
	}
	.profile-content h1 {
	 	padding-bottom: 7px;
	}
	.profile-content h3 {
	    font-weight: bold;
	}
	.profile-content .user-name {
	 	margin: 0!important;
	}
	.profile-content .user-status span {
		color: #23a941;
		font-size: 24px!important;
	}
	.profile-content .points-until {
		float: right; 
	}
	.profile-content table.user-stats, .profile-content table.user-stats td {
		border: none;
	}
	.profile-content table.user-stats {
		max-width: 500px;
	}
	.profile-content table.user-stats span {
		color: #23a941;
		font-weight: bold;
	}
</style>
<script>
jQuery( document ).ready(function( $ ) {
  $('.profile-usermenu ul.nav li').removeClass('active');
  $('.profile-usermenu ul.nav li:nth-child(1)').addClass('active');
});
</script>
</header>


	<div id="content" class="site-content">

<div id="invite" class="container">
  <div class="row profile">
		<div class="col-md-3">
			<?php include('dashboard-nav.php');?>
		</div>
		<div class="col-md-9">
			<div class="profile-content">
				<h1>TCM Membership</h1>
				<h5 class="user-name">Johnny Cage</h5>
				<h3 class="user-status">Status: <span>Gold Member</span></h3>
				<span class="points-total">1,800 Loyalty Points</span><span class="points-until">1,200 to Platinum</span>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:60%">
						<span class="sr-only">70% Complete</span>
					</div>
				</div>
				<table class="user-stats">
					<tr><td>Total Purchases</td><td>18</td></tr>
					<tr><td>TCM Credits</td><td>$30</td></tr>
					<tr><td>Referral Link</td><td><span>http://thecannabismethod.com?promo=buds</span></td></tr>
					<tr><td>Refferal Code</td><td><span>buds</span></td></tr>	
					<tr><td>Completed Refferals</td><td>3</td></tr>
					<tr><td>Pending Refferals</td><td>5</td></tr>
					<tr><td>Member Since</td><td>2015</td></tr>
				</table>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>
<?php

/*
Template Name: Referral Panel
*/

get_header();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://www.thecannabismethod.com/wp-content/themes/zerif-lite-child/css/dashboard.css">
</header>


		<div id="content" class="site-content">

<div id="dashboard" class="container">

	<div class="row">
		<div class="col-sm-12">
	        <h1 class="page-header" style="text-align: center">Earn Credits</h1>
	    </div>
	</div>
		
	<div class="row">
		<div class="col-sm-12">
			<div style="padding: 0 20px 20px">
				Friends get a <b>$20</b> discount once they sign up using your referral link, and you earn a <b>$10</b> TCM credit once they complete their first purchase.*
				If they are already registered, they can enter your coupon code during their first checkout to qualify for the promo.<br><br>
				Send the referral link or coupon code below to your friends and start earning TCM credits.
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Referral Link</h3></div>
				<div class="panel-body">
					<h2 class="aff_link" data-toggle="tooltip" data-html="true" data-placement="top" title="Copy to clipboard">
						http://thecannabismethod.com/?cp=<?=get_aff_coupon_code()?></a></h2>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Referral Code</h3></div>
				<div class="panel-body">
					<h2 class="aff_link" data-toggle="tooltip" data-html="true" data-placement="top" title="Copy to clipboard">
						<?=get_aff_coupon_code()?></h2>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-12">
			<small>*Promo is only valid for referral purchases of $60 or more<small>
		</div>
	</div>
	
</div>

<script>
	jQuery(document).ready(function($) {
		/*tool tip*/
		$('[data-toggle="tooltip"]').tooltip();
		/*copy to clipboard*/
		$('body').append('<input id="clipBoard" type="text" style="opacity: 0;position: absolute;bottom: 0; z-index: -100;">');
		$('.aff_link').click(function(e) {
			var link = $(this).html();
			$('#clipBoard').val(link); // local storage
			document.execCommand('copy', false, document.getElementById('clipBoard').select());
			$(this).attr('title', 'Copied').tooltip('fixTitle').tooltip('show');
		});
		$('.aff_link').mouseout(function() {
			$(this).attr('title', 'Copy to clipboard').tooltip('fixTitle');
		});
	});
</script>


<?php get_footer(); ?>
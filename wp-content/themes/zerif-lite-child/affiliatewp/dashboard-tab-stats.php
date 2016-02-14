<div id="affwp-affiliate-dashboard-referral-counts" class="affwp-tab-content">

	<h4>Stats Overview</h4>

	<table class="affwp-table" style="width:100%">
		<thead>
			<tr>
				<th>Weekly Earnings</th>
				<th>Total Earnings</th>
				<th>Weekly Referrals</th>
				<th>Total Referrals</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td><?php echo affwp_get_affiliate_unpaid_earnings( affwp_get_affiliate_id(), true ); ?></td>
				<td><?php echo affwp_get_affiliate_earnings( affwp_get_affiliate_id(), true ); ?></td>
				<td><?php echo affwp_count_referrals( affwp_get_affiliate_id(), 'unpaid' ); ?></td>
				<td><?php echo affwp_count_referrals( affwp_get_affiliate_id(), 'paid' ); ?></td>
			</tr>
		</tbody>
	</table>

	<?php do_action( 'affwp_affiliate_dashboard_after_counts', affwp_get_affiliate_id() ); ?>

</div>
<br>

<div id="affwp-affiliate-dashboard-referral-counts" class="affwp-tab-content">

	<h4>Referral Offers</h4>

	<table class="affwp-table" style="width:100%">
		<thead>
			<tr>
				<th>Affiliate URL</th>
				<th>Coupon Code</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td><span class="aff_link" data-toggle="tooltip" data-html="true" data-placement="top" title="Copy to clipboard">
					http://thecannabismethod.com/?cp=<?=get_aff_coupon_code()?></span></td>
				<td><span class="aff_link" data-toggle="tooltip" data-html="true" data-placement="top" title="Copy to clipboard">
					<?=get_aff_coupon_code()?></span></td>
			</tr>
		</tbody>
	</table>

</div>
<br>

<div id="affwp-affiliate-dashboard-graphs" class="affwp-tab-content">

	<h4>Referrals Graph</h4>

	<?php
	$graph = new Affiliate_WP_Referrals_Graph;
	$graph->set( 'x_mode', 'time' );
	$graph->set( 'affiliate_id', affwp_get_affiliate_id() );
	$graph->display();
	?>

	<?php do_action( 'affwp_affiliate_dashboard_after_graphs', affwp_get_affiliate_id() ); ?>

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

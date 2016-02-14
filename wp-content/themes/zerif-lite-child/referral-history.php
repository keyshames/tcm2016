<?php

/*
Template Name: Referral History
*/

get_header();

$referrals = affiliate_wp()->referrals->get_referrals(
	array(
		'number'       => $per_page,
		'offset'       => $per_page * ( $page - 1 ),
		'affiliate_id' => affwp_get_affiliate_id(),
		'status'       => array( 'paid', 'unpaid', 'rejected' ),
	)
);

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://www.thecannabismethod.com/wp-content/themes/zerif-lite-child/css/dashboard.css">
</header>


		<div id="content" class="site-content">

<div id="dashboard" class="container">

	<div class="row">
		<div class="col-sm-12">
	        <h1 class="page-header">Referral History</h1>
	    </div>
	</div>
		
	<div class="row">
		<div class="col-sm-12">
			<table>
				<tr><th>ID</th><th>Date</th><th>Status</th><th>Credit</th></tr>
				
				<?php if ( $referrals ) : ?>
					
					<?php foreach ( $referrals as $referral ) : ?>
						<tr>
							<td>#<?=$referral->reference?></td>
							<td><?=date_i18n( 'Y-m-d', strtotime( $referral->date ) );?></td>
							<td><?=filter_ref_status($referral->status);?></td>
							<td><?=affwp_currency_filter( affwp_format_amount( $referral->amount ) );?></td>
						</tr>
					<?php endforeach; ?>
					
				<?php else : ?>
					
					<tr>
						<td colspan="4"><?='You have not made any referrals yet.';?></td>
					</tr>
					
				<?php endif; ?>
				
			</table>
		</div>
	</div>
	
</div>


<?php get_footer(); ?>
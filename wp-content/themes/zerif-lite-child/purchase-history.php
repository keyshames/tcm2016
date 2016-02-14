<?php

/*
Template Name: Purchase History
*/

get_header();

$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
	'numberposts' => $order_count,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_type'   => wc_get_order_types( 'view-orders' ),
	'post_status' => array_keys( wc_get_order_statuses() )
) ) );

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://www.thecannabismethod.com/wp-content/themes/zerif-lite-child/css/dashboard.css">
</header>


		<div id="content" class="site-content">

<div id="dashboard" class="container">

	<div class="row">
		<div class="col-sm-12">
	        <h1 class="page-header">Purchase History</h1>
	    </div>
	</div>
		
	<div class="row">
		<div class="col-sm-12">
			<table>
				<tr><th>ID</th><th>Date</th><th>Status</th><th>Total</th></tr>
				
				<?php if ($customer_orders) : ?>
					
						<?php foreach ( $customer_orders as $customer_order ) :
							$order = wc_get_order( $customer_order );
							$order->populate( $customer_order );
						?>
							<tr>
								<td>#<?=$order->get_order_number();?></td>
								<td><?=date_i18n( 'Y-m-d', strtotime( $order->order_date ) );?></td>
								<td><?=wc_get_order_status_name( $order->get_status() );?></td>
								<td><?=$order->get_formatted_order_total();?></td>
							</tr>
							
						<?php endforeach; ?>
						
				<?php else : ?>
					
					<tr>
						<td colspan="4"><?='You have not made any purchases yet.';?></td>
					</tr>
					
				<?php endif; ?>
				
			</table>
		</div>
	</div>
	
</div>


<?php get_footer(); ?>
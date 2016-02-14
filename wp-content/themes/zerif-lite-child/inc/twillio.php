<?php

function admin_sms_alert($order_id) {
	
	global $woocommerce;
	$order = new WC_Order($order_id);
	
	$billing_firstname	= get_post_meta($order_id, '_billing_first_name', true);
	$billing_lastname	= get_post_meta($order_id, '_billing_last_name', true);
	$billing_phone		= get_post_meta($order_id, '_billing_phone', true);
	$shipping_address1	= get_post_meta($order_id, '_billing_address_1', true);
	$shipping_address2	= get_post_meta($order_id, '_billing_address_2', true);
	$medallion			= strtoupper(get_user_meta($order->user_id, 'loyalty_status', true));
	$order_amount 		= get_post_meta($order_id, '_order_total', true);
	
	$pay_type = get_post_meta($order_id, '_payment_method', true);
	if ($pay_type=='cod') $pay_method = 'Cash on delivery';
	else $pay_method = 'Credit card on delivery';
	
	$order_item = $order->get_items();
	foreach( $order_item as $product ) {
		$product_meta[] = $product['name'].' ('.strtok($product['item_meta']['size'][0], ' ').')';
	}
	$product_list = implode("\n", $product_meta);
	
	$admin_sms =
		"New Order #{$order_id}\n".
		"$product_list\n".
		"$medallion\n".
		"Total \${$order_amount}\n".
		"$pay_method\n".
		"$billing_firstname $billing_lastname\n".
		"$shipping_address1".($shipping_address2?" {$shipping_address2}":'')."\n".
		"$billing_phone";
		
	require('twilio-php/Services/Twilio.php');
	 
	$account_sid = 'AC48732db704fe33f0601c8b61bd1519b8'; 
	$auth_token  = 'b881c619f25d20143bbbf6ac4d0d3429'; 
	
	$admin_phone = array(
		'+13109253443',
		'+18185102424',
		'+18183392676'
	);
	
	foreach ($admin_phone as $number) {
		$client = new Services_Twilio($account_sid, $auth_token); 
		$client->account->messages->create(array( 
			'To' => $number,
			'From' => "+13232104996",
			'Body' => $admin_sms
		));	
	}
}
add_action("woocommerce_checkout_order_processed", "admin_sms_alert", 1, 1);

?>
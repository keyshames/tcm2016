<?php

function add_scripts() {
	wp_enqueue_style( 'parent-style', get_stylesheet_uri() );
	wp_enqueue_script( 'scripts', get_theme_root_uri().'/zerif-lite-child/js/scripts.js', array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'add_scripts' );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

function get_user_info($i) { // $i = meta_key
	global $current_user;
	get_currentuserinfo();
	return $current_user->$i;
}

function custom_pre_get_posts_query( $q ) {
	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;
	if ( is_shop() && isset($_GET['sort']) ) {
		$show=array();
		if ($_GET['indica']==1) $show[]='Indica';
		if ($_GET['sativa']==1) $show[]='Sativa';
		if ($_GET['hybrid']==1) $show[]='Hybrid';
		if ($_GET['con']==1) 	$show[]='Concentrates';
		if ($_GET['pen']==1) 	$show[]='Vapor Pens';
		if ($_GET['all']==1) 	$show=array('Indica','Sativa','Hybrid','Concentrates','Vapor Pens');
		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => $show, // Only show these catg
			'operator' => 'IN'
		)));
	}
	remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );
}
add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_update_profile ($user_id) {
	global $ultimatemember;
	um_fetch_user( $user_id );
	
	$profilefirstname = um_user( 'first_name' );
	update_user_meta( $user_id, 'billing_first_name', $profilefirstname );
	update_user_meta( $user_id, 'shipping_first_name', $profilefirstname );
	
	$profilelastname = um_user( 'last_name' );
	update_user_meta( $user_id, 'billing_last_name', $profilelastname );
	update_user_meta( $user_id, 'shipping_last_name', $profilelastname );

	$profileaddress1 = um_user( 'street_address' );
	update_user_meta( $user_id, 'billing_address_1', $profileaddress1 );
	update_user_meta( $user_id, 'shipping_address_1', $profileaddress1 );
	
	$profileaddress2 = um_user( 'address2' );
	update_user_meta( $user_id, 'billing_address_2', $address2 );
	update_user_meta( $user_id, 'shipping_address_2', $address2 );

	$profilecity = um_user( 'city' );
	update_user_meta( $user_id, 'billing_city', $profilecity);
	update_user_meta( $user_id, 'shipping_city', $profilecity);
	
	$profilezip_code = um_user( 'zip_code' );
	update_user_meta( $user_id, 'billing_postcode', $profilezip_code);
	update_user_meta( $user_id, 'shipping_postcode', $profilezip_code);
	
	$profileemail = um_user( 'user_email' );
	update_user_meta( $user_id, 'billing_email', $profileemail);
	
	$profilephone = um_user( 'phone_number' );
	update_user_meta( $user_id, 'billing_phone', $profilephone);
	
	return $user_id;
}
add_action ('um_post_registration_save', 'custom_update_profile',99);


/////////////////////////////////////////////////////////////////////////////////////////////////////////

$unlock_points = array(
	'Bronze' => 5,
	'Silver' => 20,
	'Gold' => 50
);

function init_aff_coupon( $user_id ) {
	global $ultimatemember;
	um_fetch_user( $user_id );
	
	$coupon_code = generate_coupon_code();
	$amount = '20';
	$discount_type = 'fixed_cart';
	$affiliate_id = affwp_get_affiliate_id( $user_id );				
	$coupon = array(
		'post_title' => $coupon_code,
		'post_content' => '',
		'post_excerpt' => 'Affiliate #'.$affiliate_id,
		'post_status' => 'publish',
		'post_author' => 1,
		'post_type'	=> 'shop_coupon'
	);				
	$new_coupon_id = wp_insert_post( $coupon );
	
	update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
	update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
	update_post_meta( $new_coupon_id, 'individual_use', 'no' );
	update_post_meta( $new_coupon_id, 'product_ids', '' );
	update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
	update_post_meta( $new_coupon_id, 'usage_limit', '' );
	update_post_meta( $new_coupon_id, 'usage_limit_per_user', '1' );
	update_post_meta( $new_coupon_id, 'minimum_amount', '60' );
	update_post_meta( $new_coupon_id, 'expiry_date', '' );
	update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
	update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
	update_post_meta( $new_coupon_id, 'affwp_discount_affiliate', $affiliate_id );
}
add_action( 'um_post_registration_save', 'init_aff_coupon' );

function generate_coupon_code() {
	$char = str_shuffle( 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' );
	$string = $char[0].$char[1].rand(0,9).rand(0,9);
	return $string;
}

function init_user_stats( $user_id ) {
	global $ultimatemember;
	um_fetch_user( $user_id );
	update_user_meta( $user_id, 'loyalty_status', 'Newbie' );
	update_user_meta( $user_id, 'loyalty_points', 0 );
}
add_action( 'um_post_registration_save', 'init_user_stats' );

function add_stats_column( $columns ) {
	 $columns['loyalty_status'] = __( 'Status', 'theme' );
	 $columns['loyalty_points'] = __( 'Points', 'theme' );
	 return $columns;
}
add_filter( 'manage_users_columns', 'add_stats_column' );

function show_stats_data( $value, $column_name, $user_id ) {
	 if ( 'loyalty_status' == $column_name )
		 return get_user_meta( $user_id, 'loyalty_status', true );
	 elseif ( 'loyalty_points' == $column_name )
		 return get_user_meta( $user_id, 'loyalty_points', true );
}
add_action( 'manage_users_custom_column', 'show_stats_data', 10, 3 );

function get_next_unlock() {
	global $unlock_points;
	switch ( get_user_info( 'loyalty_status' ) ) {
		case 'Bronze':
			return $unlock_points['Silver'];
		case 'Silver':
			return $unlock_points['Gold'];	
		default:
			return $unlock_points['Bronze'];			
	}
}

function get_progress() {
	$total = get_user_info( 'loyalty_points' ) / get_next_unlock() * 100;
	return $total;
}

function get_credit_balance() {
	$current_balance = get_user_info( 'affwp_wc_credit_balance' );
	return $current_balance; 
}

function count_purchases() {
	$orders = get_posts( array(
	    'numberposts' => -1,
	    'meta_key'    => '_customer_user',
	    'meta_value'  => get_current_user_id(),
	    'post_type'   => wc_get_order_types(),
	    'post_status' => array_keys( wc_get_order_statuses() ),
	) );
	$total = count( $orders );
	return $total;
}

function count_referrals() {
	$total = affwp_count_referrals( affwp_get_affiliate_id(), 'unpaid' ) + affwp_count_referrals( affwp_get_affiliate_id(), 'paid' );
	return $total;
}

function filter_ref_status($status) {
	if ( 'unpaid' == $status ) return 'Pending';
	else return ucfirst($status);
}

function set_aff_coupon_cookie() {
    if ( !isset( $_COOKIE['affwp_cp2'] ) && isset( $_GET['cp'] ) ) {
    	if ( preg_match( "/^[a-zA-Z]{2}[0-9]{2}$/", $_GET['cp'] ) ) {
    		$coupon = $_GET['cp'];
			setcookie( 'affwp_cp2', $coupon, strtotime( '+1 days' ), '/' );
		}
    }
}
add_action( 'init', 'set_aff_coupon_cookie');

function apply_aff_coupon() {
    global $woocommerce;
    if ( $woocommerce->cart->has_discount( $_COOKIE['affwp_cp2'] ) )
    	return;
	elseif ( isset( $_COOKIE['affwp_cp2'] ) )
		$woocommerce->cart->add_discount( $_COOKIE['affwp_cp2'] );
}
add_action( 'woocommerce_before_cart', 'apply_aff_coupon' );

function unset_aff_coupon_cookie() {
	if ( isset( $_COOKIE['affwp_cp2'] ) )
		setcookie( 'affwp_cp2', $coupon, strtotime( '-1 days' ), '/' );
}
add_action( 'affwp_insert_referral', 'unset_aff_coupon_cookie' );

function after_referral_completed( $referral_id, $new_status, $old_status ) {
	if ( 'paid' == $new_status ) {
		$referral = affiliate_wp()->referrals->get_by( 'referral_id', $referral_id );
		$affiliate_id = $referral->affiliate_id;
		$user_id = affwp_get_affiliate_user_id( $affiliate_id );
		$points = get_user_meta( $user_id, 'loyalty_points', true ) + 1;
		update_user_meta( $user_id, 'loyalty_points', $points );
	}
}
add_action( 'affwp_set_referral_status', 'after_referral_completed', 10, 3 );

function after_purchase_completed( $order_id ) {
	$order = new WC_Order( $order_id );
	$user_id = $order->user_id;
	$points = get_user_meta( $user_id, 'loyalty_points', true ) + 1;
	update_user_meta( $user_id, 'loyalty_points', $points );
}
add_action( 'woocommerce_order_status_completed', 'after_purchase_completed' );

function update_user_status() {
	$points = get_user_info( 'loyalty_points' );
	$unlock = get_next_unlock();
	if ( $points >= $unlock ) {
		global $unlock_points;
		$new_status = array_search( $unlock, $unlock_points );
		$user_id = get_current_user_id();
		update_user_meta( $user_id, 'loyalty_status', $new_status );
	}
}

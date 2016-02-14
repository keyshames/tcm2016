<?php

include "inc/registration.php";
include "inc/checkout.php";
//include "inc/onfleet.php";
//include "inc/twillio.php";


function add_scripts() {
	wp_enqueue_style( 'parent-style', get_stylesheet_uri() );
	wp_enqueue_style( 'prefix-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0' );
	wp_enqueue_script( 'scripts', get_theme_root_uri().'/zerif-lite-child/js/scripts.js', array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'add_scripts' );

/*move coupon field from checkout to cart*/
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_before_cart', 'woocommerce_checkout_coupon_form' );

function get_user_info($i) { // return meta_key value
	global $current_user;
	get_currentuserinfo();
	return $current_user->$i;
}


function get_first_name() {
	um_fetch_user( $user_id );
	return um_user('display_name');
}


function custom_pre_get_posts_query( $q ) {
	if ( !$q->is_main_query() ) return;
	if ( !$q->is_post_type_archive() ) return;
	if ( basename($_SERVER['PHP_SELF'])=='edit.php' ) return;
	if ( is_shop() ) {
		$show=array();
		if ($_GET['all']==1 || !isset($_GET['sort'])) $show=array('Indica','Sativa','Hybrid','Concentrates','Edibles','Vapor Pens');
		if ($_GET['ind']==1) $show[]='Indica';
		if ($_GET['sat']==1) $show[]='Sativa';
		if ($_GET['hyb']==1) $show[]='Hybrid';
		if ($_GET['con']==1) $show[]='Concentrates';
		if ($_GET['edi']==1) $show[]='Edibles';
		if ($_GET['vap']==1) $show[]='Vapor Pens';
		if ($_GET['spl']==1) $show[]='Specials';
		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => $show,
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


function init_aff_coupon( $user_id ) {
	global $ultimatemember;
	um_fetch_user( $user_id );
	
	$string = str_shuffle( 'abcdefghijklmnopqrstuvwxyz' );
	$coupon_code = $string[0].$string[1].rand(0,9).rand(0,9);
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
	update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
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


function init_loyalty_stats( $user_id ) {
	global $ultimatemember;
	um_fetch_user( $user_id );
	
	update_user_meta( $user_id, 'loyalty_status', 'Green' );
	update_user_meta( $user_id, 'loyalty_points', 0 );
	update_user_meta( $user_id, 'loyalty_date', date( 'Y-m-d', strtotime( "+30 days" ) ) );
}
add_action( 'um_post_registration_save', 'init_loyalty_stats' );


function add_loyalty_stats_column( $columns ) {
	 $columns['loyalty_status'] = __( 'Status', 'theme' );
	 $columns['loyalty_points'] = __( 'Points', 'theme' );
	 $columns['loyalty_date'] = __( 'Reset Date', 'theme' );
	 return $columns;
}
add_filter( 'manage_users_columns', 'add_loyalty_stats_column' );


function show_loyalty_stats_data( $value, $column_name, $user_id ) {
	 if ( 'loyalty_status' == $column_name )
		 return get_user_meta( $user_id, 'loyalty_status', true );
	 
	 elseif ( 'loyalty_points' == $column_name )
		 return get_user_meta( $user_id, 'loyalty_points', true );
	 
	 elseif ( 'loyalty_date' == $column_name )
		 return get_user_meta( $user_id, 'loyalty_date', true );
}
add_action( 'manage_users_custom_column', 'show_loyalty_stats_data', 10, 3 );


function remove_user_posts_column($column_headers) {
    unset($column_headers['posts']);
    return $column_headers;
}
add_action('manage_users_columns','remove_user_posts_column');


$unlock_points = array(
	'Green' => 0,
	'Silver' => 1500,
	'Gold' => 3000,
	'Platinum' => 6000
);


function get_next_unlock( $user_id, $loyalty_status ) {
	global $unlock_points;
	
	if ( $user_id && !$loyalty_status )
		$loyalty_status = get_user_meta( $user_id, 'loyalty_status', true );
	elseif ( !$user_id  && !$loyalty_status ) 
		$loyalty_status = get_user_info( 'loyalty_status' );
		
	switch ( $loyalty_status ) {
		case 'Green':
			return $unlock_points['Silver'];
		case 'Silver':
			return $unlock_points['Gold'];
		case 'Gold':
			return $unlock_points['Platinum'];
		case 'Platinum':
			return $unlock_points['Platinum'];		
	}
}


function get_progress() {
	$total = ( get_user_info( 'loyalty_points' ) - $unlock_points[get_user_info('loyalty_status')] ) / ( get_next_unlock() - $unlock_points[get_user_info('loyalty_status')] ) * 100;
	return $total;
}


function get_progress_counter() {
	if ( 'Platinum' != get_user_info( 'loyalty_status' ) ) {
		global $unlock_points;
		$points_remaining = get_next_unlock() - get_user_info( 'loyalty_points' );
		$next_level = array_search( get_next_unlock(), $unlock_points );
		
		return "<b>$points_remaining LP</b> to unlock $next_level.";
	} else {
		return "Congrats! You've unlocked the Platinum Medallion.";
	}
}


function get_reset_date() {
	$status = get_user_info( 'loyalty_status' );
	if ( $status=='Green' ) return;
	
	$date_reset = new DateTime( get_user_info( 'loyalty_date' ) );
	$date_today = new DateTime( date( "Y-m-d" ) );
	$countdown  = intval( $date_today->diff( $date_reset )->format( '%R%a' ) );
	
	if ( $countdown>0 ) {
		return "<p><b>$countdown days</b> of $status benifits remaining.</p>";
	} elseif ( $countdown<=0 ) {
		$user_id = get_current_user_id();
		update_user_meta( $user_id, 'loyalty_status', 'Green' );
		update_user_meta( $user_id, 'loyalty_points', 0 );
		update_user_meta( $user_id, 'loyalty_date', date( 'Y-m-d', strtotime( "+30 days" ) ) );
	}
}


function get_credit_balance() {
	$current_balance = get_user_info( 'affwp_wc_credit_balance' );
	if ( $current_balance )
		return $current_balance;
	else
		return 0;
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


function filter_ref_status( $status ) {
	if ( 'unpaid' == $status )
		return 'Pending';
	else
		return ucfirst( $status );
}


function get_user_orders() {
	$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
		'numberposts' => $order_count,
		'meta_key'    => '_customer_user',
		'meta_value'  => get_current_user_id(),
		'post_type'   => wc_get_order_types( 'view-orders' ),
		'post_status' => array_keys( wc_get_order_statuses() )
	) ) );
	
	return $customer_orders;
}


function get_last_order() {
	$customer_order = current( get_user_orders() );
	if (!$customer_order) return;
	$order = wc_get_order( $customer_order );
	$order->populate( $customer_order );
	
	return $order->get_order_number();

}


function get_aff_coupon_code() {
	$affwp_sad = affiliatewp_show_affiliate_coupons();
	$affwp_coupons = $affwp_sad->get_coupons();
	$coupons = array();
	if ( $affwp_coupons ) {
		foreach ( $affwp_coupons as $coupon ) {
			$coupons[] = $coupon['code'];
		}
	}
	return end($coupons);
}


function set_aff_coupon_cookie() {
    if ( !isset( $_COOKIE['affwp_cp2'] ) && isset( $_GET['cp'] ) && preg_match( "/^[a-zA-Z]{2}[0-9]{2}$/", $_GET['cp'] ) ) {
		$coupon = $_GET['cp'];
		setcookie( 'affwp_cp2', $coupon, strtotime( '+1 days' ), '/' );
    }
}
add_action( 'init', 'set_aff_coupon_cookie');


function apply_aff_coupon_cookie() {
    global $woocommerce;
	$level = get_user_info( 'loyalty_status' );
	$order = get_last_order();
	$total = floatval( preg_replace( '#[^\d.]#', '', $woocommerce->cart->get_cart_total() ) );

    if ( $level!='Green' || $order>0 || $woocommerce->cart->has_discount( $_COOKIE['affwp_cp2'] ) ) {
    	return;
	} elseif ( $total<3660 && isset( $_COOKIE['affwp_cp2'] ) ) {
		echo'<div class="woocommerce-error">The minimum spend for this coupon is $60.00.</div>';
	} elseif ( isset( $_COOKIE['affwp_cp2'] ) ) {
		$woocommerce->cart->add_discount( $_COOKIE['affwp_cp2'] );
		echo'<div class="woocommerce-message">Coupon code applied successfully.</div>';
		wc_clear_notices();
	}
}
add_action( 'woocommerce_before_cart', 'apply_aff_coupon_cookie' );


function unset_aff_coupon_cookie() {
	if ( isset( $_COOKIE['affwp_cp2'] ) )
		setcookie( 'affwp_cp2', $coupon, strtotime( '-1 days' ), '/' );
}
add_action( 'affwp_insert_referral', 'unset_aff_coupon_cookie' );


function add_loyalty_points( $user_id, $add_points ) {
	$point_balance = get_user_meta( $user_id, 'loyalty_points', true ) + $add_points;
	$next_unlock = get_next_unlock( $user_id );
	
	update_user_meta( $user_id, 'loyalty_points', $point_balance );
	
	if ( $point_balance >= $next_unlock ) {
		global $unlock_points;
		
		do {
			$new_status = array_search( $next_unlock, $unlock_points );
			$next_unlock  = get_next_unlock( $null, $new_status );
		} while ( ( $point_balance >= $next_unlock ) && ( $new_status != 'Platinum') );
		
		update_user_meta( $user_id, 'loyalty_status', $new_status );
		update_user_meta( $user_id, 'loyalty_date', date( 'Y-m-d', strtotime( "+30 days" ) ) );
	}
}


function after_purchase_completed( $order_id ) {
	$order = new WC_Order( $order_id );
	$user_id = $order->user_id;
	$order_total = $order->order_total;
	$reward_points = $order_total * 10;
	
	add_loyalty_points( $user_id, $reward_points );
}
add_action( 'woocommerce_order_status_completed', 'after_purchase_completed' );


$ref_step = 0;
function aff_modify_first_referral_amount( $referral_amount, $affiliate_id, $amount, $reference, $product_id ) {
	global $ref_step;
	if ( $ref_step < 1) {
		$referral_amount = 10.00;
	} else {
		$referral_amount = 0;
	}
	$ref_step++;
	return $referral_amount;
}
add_filter( 'affwp_calc_referral_amount', 'aff_modify_first_referral_amount', 10, 5 );


function update_user_password() {

	if ( empty($_POST) ) return;

	$current_password = $_POST['current_user_password'];
	$password = $_POST['user_password'];
	$user = wp_get_current_user();
	$user_id = get_current_user_id();
	
	if ( !wp_check_password( $current_password, $user->data->user_pass, $user->ID ) ) {
		echo '<div class="alert alert-danger" role="alert">The current password you entered is not valid</div>';
	} else {
		wp_update_user( array( 'ID' => $user_id, 'user_pass' => $password ) );
		echo '<div class="alert alert-success" role="alert">Your password has been updated</div>';
	}
}


function update_user_shipping() {
	
	if ( empty($_POST) ) return;
	
	$user_id = get_current_user_id();

	$profileaddress1 = $_POST['user_address1'];
	update_user_meta( $user_id, 'shipping_address_1', $profileaddress1 );
	
	$profileaddress2 = $_POST['user_address2'];
	update_user_meta( $user_id, 'shipping_address_2', $profileaddress2  );

	$profilecity = $_POST['user_city'];
	update_user_meta( $user_id, 'shipping_city', $profilecity );
	
	$profilezip_code = $_POST['user_zip'];
	update_user_meta( $user_id, 'shipping_postcode', $profilezip_code );
	
	$profilephone = $_POST['user_phone'];
	update_user_meta( $user_id, 'billing_phone', $profilephone );
	
	echo '<div class="alert alert-success" role="alert">Your shipping address has been updated</div>';
}


function aff_disable_cart_button() {
	$role = get_user_info( 'role' );
	if ( $role=='affiliate' ) {
		echo'
		<script>
			jQuery(document).ready(function($) {
				$(".single_add_to_cart_button").click(function(e) {
					e.preventDefault();
					alert("Sorry, but this feature has been disabled. Affilates are not allowed to place orders.");
				});
			});
		</script>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'aff_disable_cart_button' );


function aff_cart_redirect() {
	$role = get_user_info( 'role' );
	if ( $role=='affiliate' ) {
		header( 'Location: https://thecannabismethod.com/' );
		exit;
	}
}
add_action( 'woocommerce_before_cart', 'aff_cart_redirect' );


function apply_membership_benifits() {
	global $woocommerce;
	$level = get_user_info( 'loyalty_status' );
	$total = floatval( preg_replace( '#[^\d.]#', '', $woocommerce->cart->get_cart_total() ) );
	
	if ( $level=='Green' || $woocommerce->cart->has_discount( $level ) ) {
		return;
	} elseif ( $total<3660 ) {
		/* echo'<div class="woocommerce-error">The minimum spend for membership discounts is $60.00.</div>'; */
	} else {
		$woocommerce->cart->add_discount( $level );
		echo'<div class="woocommerce-message">Membership discount applied successfully.</div>';
		wc_clear_notices();
	}
}
add_action( 'woocommerce_before_cart', 'apply_membership_benifits' );


function add_specials_menu() {
	$level = get_user_info( 'loyalty_status' );
	$role = get_user_info( 'role' );
	if ( $level=='Platinum' || $role=='admin') {
		echo"
		<script>
			jQuery(document).ready(function($) {
				$('#menu-item-17 > ul > li:first-of-type').before('<li class=\"menu-item menu-item-type-custom menu-item-object-custom\"><a href=\"https://thecannabismethod.com/?sort=menu_order&spl=1\"><b>10 Gram Specials</b></a></li>');
			});
			
		</script>";
	}
}
add_action( 'wp_head', 'add_specials_menu' );


function coupon_validation( $valid, $coupon ) {
	global $woocommerce;
	$level = strtolower( get_user_info( 'loyalty_status' ) );
	$order = get_last_order();
	$code  = $coupon->code;

	if ( preg_match( "/^[a-zA-Z]{2}[0-9]{2}$/", $code ) && $order>0 ) $valid = false;
	elseif ( strstr( " silver, gold, platinum ", $code ) && $level!=$code ) $valid = false;
	else $valid = true;
	
	return $valid;
}
add_filter( 'woocommerce_coupon_is_valid', 'coupon_validation', 10, 2 );


function add_product_badge() {
	global $product;
	$postdate = get_the_time ( 'Y-m-d' );
	$postdatestamp = strtotime ( $postdate );
	$newness  = 10;

	if ((time () - (60 * 60 * 24 * $newness)) < $postdatestamp)
		echo '<div class="shape badge-new"><div class="shape-text">NEW</div></div>';
	else if ( $product->is_on_sale() )
		echo '<div class="shape badge-sale"><div class="shape-text">SALE</div></div>';

}
add_action('woocommerce_before_shop_loop_item', 'add_product_badge' );


/*function custom_login(){
	global $pagenow;
	if( 'wp-login.php' == $pagenow ) {
		wp_redirect('https://thecannabismethod.com/');
		exit();
	}
}
add_action('init','custom_login');*/
 
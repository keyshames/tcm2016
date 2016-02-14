<?php

function action_um_before_register_fields(){
	echo"<a href='https://thecannabismethod.hellomd.com/signup'>
			<img src='https://s3-us-west-2.amazonaws.com/hellomd-production/partner_banners/Medical-Marijuana-Card-Doctor-HelloMD_485x149.png'/>
		</a>";
}
add_action('um_before_register_fields', 'action_um_before_register_fields');

function action_um_post_registration_save( $user_id, $args ) {
	
	include "helpers/request.php";
	
	$url	  = "https://www.hellomd.com/api/v1/users/".$args['hellomd_id'];
	$method	  = "get";
	$user	  = "ada451d4deb7df16e8362527b7cf9fe6379a5c9";
	$password = "f137de1fd4c5cc85f38f49afa4752648bf0f617";
	
	$response = wp_curl($url, $method, $user, $password);
	
	
	var_dump($response, true);
	exit;
}
add_action( 'um_post_registration_save', 'action_um_post_registration_save', 10, 2 ); 





<?php

function wp_curl($url, $method, $user, $password, $post_data = null){
	$curl=curl_init($url);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_USERPWD, "$user:$password");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	if ($method == 'post'){
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
	}
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	
	$curl_response = curl_exec($curl);
	$response = json_decode($curl_response);
	curl_close($curl);
	return $response;
}
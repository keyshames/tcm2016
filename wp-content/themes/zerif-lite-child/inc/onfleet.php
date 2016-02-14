<?php

if ($_GET['check']) { echo $_GET['check']; exit; }

function request($url, $method, $post_data = null){
	$curl=curl_init($url);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_USERPWD, "cb674643e0119ce18785a0ccc6f251e9:");
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

function wp_db($sql){
	$servername = "localhost";
	$username 	= "thecann8_wo5312";
	$password 	= "uVPVE98tIR2b";
	$dbname 	= "thecann8_wo5312";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$q = $conn->query($sql);
	$conn->close();
	return $q;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$data = json_decode(file_get_contents("php://input"));
	$task_id = $data->taskId;
	$trig_id = $data->triggerId;
	$sql = "SELECT * FROM wp_posts WHERE task_id='{$task_id}'";
	if(wp_db($sql) && ($trig_id == 3)){
		$sql = "UPDATE wp_posts SET post_status='wc-completed' WHERE task_id='{$task_id}' AND post_type='shop_order'";
		wp_db($sql);
		exit;
	}
}

function onfleet($order_id) {
	
	global $woocommerce;
	$order = new WC_Order( $order_id );
	
	$name		  = get_post_meta($order_id, '_billing_first_name', true).' '.get_post_meta( $order_id, '_billing_last_name', true);
	$phone		  = get_post_meta($order_id, '_billing_phone', true);
	$address	  = get_post_meta($order_id, '_shipping_address_1', true);
	$number		  = substr($address, 0, strpos($address, ' '));
	$street		  = substr($address, strpos($address, ' '));
	$apartment	  = get_post_meta($order_id, '_shipping_address_2', true);
	$city		  = get_post_meta($order_id, '_shipping_city', true);
	$medallion	  = strtoupper(get_user_meta($order->user_id, 'loyalty_status', true));
	$order_amount = get_post_meta($order_id, '_order_total', true);
	
	if (get_post_meta( $order_id, '_payment_method', true )=='cod')
		$pay_method = 'Cash on delivery';
	else
		$pay_method = 'Credit card on delivery';
	
	$order_items = $order->get_items();
	foreach($order_items as $product){
		$product_meta[] = $product['name'].' ('.strtok($product['item_meta']['size'][0], ' ').')';
	}
	$product_list = implode("\\n", $product_meta);
	
	$notes =
		"Order #{$order_id}\\n\\n".
		"$product_list\\n".
		"$medallion\\n\\n".
		"Total \${$order_amount}\\n".
		"$pay_method";
	
	function create_destination($number, $street, $apartment, $city){
		$json_data =
			'{"address":{
				"number":"'.$number.'",
				"street":"'.$street.'",
				"apartment":"'.$apartment.'",
				"city":"'.$city.'",
				"state":"CA",
				"country":"USA"
			}}';
		$response = request('https://onfleet.com/api/v2/destinations', 'post', $json_data);
		return $response->id;
	}
	
	function get_recipient($name){
		$url = 'https://onfleet.com/api/v2/recipients/name/'.rawurlencode($name);
		$response = request($url, 'get');
		if (!$response->id) return 'missing';
		return $response->id;
	}
	
	function create_recipient($name, $phone){
		$json_data=
			'{"name":"'.$name.'",
			"phone":"'.$phone.'"}';
		$response = request('https://onfleet.com/api/v2/recipients', 'post', $json_data);
		if (!$response->id) return 'duplicate';
		else return $response->id;
	}
	
	function create_task($destination, $recipient, $notes){
		$json_data =
			'{"merchant":"6FMcvdZ2CkFRb*iE1Zrr*XDQ",
			"executor":"6FMcvdZ2CkFRb*iE1Zrr*XDQ",
			"destination":"'.$destination.'",
			"recipients":["'.$recipient.'"],
			"notes":"'.$notes.'",
			"completeAfter":'.round(microtime(true) * 1000).'}';
		$response = request('https://onfleet.com/api/v2/tasks', 'post', $json_data);
		return $response;
	}
	
	$destination = create_destination($number, $street, $apartment, $city);
	$recipient = get_recipient($name);
	if ($recipient == 'missing'){
		$recipient = create_recipient($name, $phone);
	}
	$task = create_task($destination, $recipient, $notes);
	
	if (!$task->id) return 'error';
	else {
		$sql = "UPDATE wp_posts SET task_id='{$task->id}' WHERE id={$order_id}";
		wp_db($sql);
	}	
}
add_action("woocommerce_checkout_order_processed", "onfleet", 1, 1);

?>
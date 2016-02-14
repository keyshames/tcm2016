<?php

function wc_minimum_order_amount() {
	
    global $woocommerce;
	$postcode = get_user_meta(get_current_user_id(), 'shipping_postcode', true);
	
	if (strstr(' 90024 90027 90028 90029 90034 90036 90038 90039 90046 90048 90064 90066 90067 90068 90069 90095 90230 90291 90401 90402 90403 90404 90405 91505 91506 91602 91604 91607 91608 90010 90012 90019 90020 90025 90232 91601 91606 90073 90031 90090 90005 90004 90026 90035 90056 90211 90212 ', $postcode))
		$minimum = 60;
	else if	(strstr(' 90045 90049 90016 90292 91423 90008 90018 90045 90049 90210 90245 90272 90293 90077 90094 91403 91436 90079 90210 90007 90015 90017 90057 90071 90089 90266 90013 90014 ', $postcode))
		$minimum = 100;
	else
		$minimum = false;
	
	if ($minimum == false){
		
		wc_print_notice( 
			sprintf('We are unable to service your area at this time. Please give us a call at (323) 450-7708 to discuss arrangements for your delivery.' , 
				wc_price($minimum), 
				wc_price(WC()->cart->subtotal)
			), 'error' 
		);
		
		echo"<script>
				jQuery(document).ready(function($) {
					$('.checkout-button').addClass('disabled');
					$('.checkout-button').click(function(e) { e.preventDefault(); });
				});
			</script>";
			
	} elseif (WC()->cart->subtotal < $minimum ){
    	
        if(is_cart()){
        	
            wc_print_notice(
                sprintf('Based on your zip code '.$postcode.', you must have an order with a minimum of %s to checkout. Your current order total is %s.' , 
                    wc_price($minimum), 
                    wc_price(WC()->cart->subtotal)
                ), 'error' 
            );
			
			echo"
				<script>
					jQuery(document).ready(function($) {
						$('.checkout-button').addClass('disabled');
						$('.checkout-button').click(function(e) { e.preventDefault(); });
					});
				</script>";
		
        } else {
        	
            wc_add_notice( 
                sprintf('Based on your zip code '.$postcode.', you must have an order with a minimum of %s to checkout. Your current order total is %s.' , 
                    wc_price($minimum), 
                    wc_price(WC()->cart->subtotal)
                ), 'error' 
            );
			
        }
    }
	
}
add_action('woocommerce_checkout_process', 'wc_minimum_order_amount');
add_action('woocommerce_before_cart', 'wc_minimum_order_amount');

?>
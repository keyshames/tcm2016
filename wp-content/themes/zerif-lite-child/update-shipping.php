<?php

/*
Template Name: Update Shipping Address
*/

get_header();
?>
<link rel="stylesheet" href="http://www.thecannabismethod.com/wp-content/themes/zerif-lite-child/css/dashboard.css">
</header>


		<div id="content" class="site-content">

<div id="dashboard" class="container">
		
	<!-- content -->
	<div class="row">
		<div class="col-sm-5 col-centered text-left">
			
			<?php
				update_user_shipping();
				$user_id = get_current_user_id(); 
			?>
			
			<div class="um-form">
				<form method="post">
					
					<div class="um-account-heading"><i class="fa fa-asterisk"></i></i></i>Change Delivery Address</div>
												
					<div class="um-field um-field-user_address1">
						<div class="um-field-label">
							<label for="user_address1">Address</label><div class="um-clear"></div>
						</div>
						<div class="um-field-area">
							<input class="um-form-field valid" type="text" name="user_address1" id="user_address1" value="<?=get_user_meta( $user_id, 'shipping_address_1', true )?>" maxlength="30">
						</div>
					</div>
					
					<div class="um-field um-field-user_address2">
						<div class="um-field-area">
							<input class="um-form-field valid" type="text" name="user_address2" id="user_address2" value="<?=get_user_meta( $user_id, 'shipping_address_2', true )?>" placeholder="Apartment, suite, unit etc. (optional)" maxlength="30">
						</div>
					</div>
					
					<div class="um-field um-field-user_city">
						<div class="um-field-label">
							<label for="user_city">City</label><div class="um-clear"></div>
						</div>
						<div class="um-field-area">
							<input class="um-form-field valid" type="text" name="user_city" id="user_city" value="<?=get_user_meta( $user_id, 'shipping_city', true )?>" maxlength="30">
						</div>
					</div>
					
					<div class="um-field um-field-user_zip">
						<div class="um-field-label">
							<label for="confirm_user_zip">Zip</label><div class="um-clear"></div>
						</div>
						<div class="um-field-area">
							<input class="um-form-field valid" type="text" name="user_zip" id="user_zip" value="<?=get_user_meta( $user_id, 'shipping_postcode', true )?>" maxlength="5">
						</div>
					</div>
					
					<div class="um-field um-field-user_phone">
						<div class="um-field-label">
							<label for="confirm_user_phone">Phone</label><div class="um-clear"></div>
						</div>
						<div class="um-field-area">
							<input class="um-form-field valid" type="text" name="user_phone" value="<?=get_user_meta( $user_id, 'billing_phone', true )?>" id="user_phone" maxlength="11">
						</div>
					</div>
					
					<div class="um-col-alt um-col-alt-b">
						<div class="um-left">
							<input class="um-button" type="submit" name="um_account_submit" id="um_account_submit" value="Update Delivery Address">
						</div>
					</div>
					
					<div class="um-clear"></div>
					
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /content -->
	
	<script>
		jQuery(document).ready(function($) {
			/*form validation*/
			$('.um-button').click(function(e) {
				e.preventDefault();
				error = 0;
				$('.um-field-error').remove();
				$('.um-form-field').each(function () {
					if (!$(this).val() && $(this).attr('ID')!='user_address2') {
						$(this).parent().append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>Field is required</div>');
						error = 1;
					} else if (($(this).attr('ID')=='user_zip' && $(this).val().length < 5) || ($(this).attr('ID')=='user_phone' && $(this).val().length < 10) || ($(this).attr('ID')!='user_address2' && $(this).val().length < 3)) {
						$(this).parent().append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>Field is too short</div>');
						error = 1;
					} else if ($(this).attr('ID')=='user_zip' || $(this).attr('ID')=='user_phone'){
						input = $(this).val();
						reg = /[^0-9]/g;
						if(reg.test(input)) {
							$(this).parent().append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>Numbers only</div>');
							error = 1;
						}
					} else {
						input = $(this).val();
						reg = /[^0-9a-zA-Z\ \.\#]/g;
						if(reg.test(input)) {
							$(this).parent().append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>Letters and numbers only</div>');
							error = 1;
						}
					}
				});
				if (error === 0) {
					$('.um-form > form').submit();
				}
			});
		});
	</script>


<?php get_footer(); ?>
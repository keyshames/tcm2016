<?php

/*
Template Name: Update Password
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
			
			<?php update_user_password(); ?>
			
			<div class="um-form">
				<form method="post">
					
					<div class="um-account-heading"><i class="fa fa-asterisk"></i></i></i>Change Password</div>
					
					<div class="um-field um-field-user_password">
						<div class="um-field-label">
							<label for="current_user_password">Current Password</label><div class="um-clear"></div>
						</div>
						<div class="um-field-area">
							<input class="um-form-field valid" type="password" name="current_user_password" id="current_user_password" maxlength="30">
						</div>
					</div>
																
					<div class="um-field um-field-user_password">
						<div class="um-field-label">
							<label for="user_password">New Password</label><div class="um-clear"></div>
						</div>
						<div class="um-field-area">
							<input class="um-form-field valid" type="password" name="user_password" id="user_password" maxlength="30">
						</div>
					</div>
					
					<div class="um-field um-field-user_password">
						<div class="um-field-label">
							<label for="confirm_user_password">Confirm Password</label><div class="um-clear"></div>
						</div>
						<div class="um-field-area">
							<input class="um-form-field valid" type="password" name="confirm_user_password" id="confirm_user_password" maxlength="30">
						</div>
					</div>
					
					<div class="um-col-alt um-col-alt-b">
						<div class="um-left">
							<input class="um-button" type="submit" name="um_account_submit" id="um_account_submit" value="Update Password">
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
					if (!$(this).val()) {
						$(this).parent().append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>Field is required</div>');
						error = 1;
					} else if ($(this).attr('ID')=='user_password' && $(this).val().length < 8) {
						$(this).parent().append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>Password 8 characters minimum</div>');
						error = 1;
					} else if ($(this).attr('ID')=='confirm_user_password' && ($(this).val() !== $('#user_password').val())) {
						$(this).parent().append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>Passwords do not match</div>');
						error = 1;
					}
				});
				if (error === 0) {
					$('.um-form > form').submit();
				}
			});
		});
	</script>


<?php get_footer(); ?>
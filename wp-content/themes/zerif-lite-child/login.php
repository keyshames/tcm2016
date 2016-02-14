<?php

/*
Template Name: Login
*/

$role = get_user_info( 'role' );
if (is_user_logged_in() && $role=='affiliate') {
	header('Location: ../affiliate-area/?tab=stats');
} else if (is_user_logged_in()) {
	header('Location: ../dashboard_v2');
}

get_header(); ?>

</header>


		<div id="content" class="site-content">

<div id="login" class="container">

	<?php echo do_shortcode( '[ultimatemember form_id=727]' );?>

</div>


<?get_footer(); ?>
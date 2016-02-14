<?php
/**
 * The template for displaying all WooCommerce pages.
 */
get_header(); ?>

<style>
	#content > .container > .content-left-wrap.col-md-12 {
	  	padding-top: 40px;
	}
	#main > div.page-description {
		margin-top: 0px; 
	}
</style>

<link href="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/css/lightbox.css" rel="stylesheet">
<script src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/js/lightbox.min.js"></script>

<div class="clear"></div>

</header> <!-- / END HOME SECTION  -->


<div id="content" class="site-content">

	<div class="container">

		<div class="content-left-wrap col-md-12">

			<div id="primary" class="content-area">

				<main id="main" class="site-main" role="main">
			
					<?php
						echo do_shortcode( '[masterslider id="1"]' );
						include 'nav-filter.php';
						woocommerce_content();
					?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .content-left-wrap -->
		
	</div><!-- .container -->
	
	
<?php get_footer(); ?>
<?php

/**

 * The template for displaying the footer.

 *

 * Contains the closing of the #content div and all content after

 *

 * @package zerif

 */

?>

	</div><!-- .site-content -->

<footer id="footer">

<div class="container">


	<?php
		$footer_sections = 0;
		$zerif_address = get_theme_mod('zerif_address',__('Company address','zerif-lite'));
		$zerif_address_icon = get_theme_mod('zerif_address_icon',get_template_directory_uri().'/images/map25-redish.png');
		
		$zerif_email = get_theme_mod('zerif_email','<a href="mailto:contact@site.com">contact@site.com</a>');
		$zerif_email_icon = get_theme_mod('zerif_email_icon',get_template_directory_uri().'/images/envelope4-green.png');
		
		$zerif_phone = get_theme_mod('zerif_phone','<a href="tel:0 332 548 954">0 332 548 954</a>');
		$zerif_phone_icon = get_theme_mod('zerif_phone_icon',get_template_directory_uri().'/images/telephone65-blue.png');

		$zerif_socials_facebook = get_theme_mod('zerif_socials_facebook','#');
		$zerif_socials_twitter = get_theme_mod('zerif_socials_twitter','#');
		$zerif_socials_linkedin = get_theme_mod('zerif_socials_linkedin','#');
		$zerif_socials_behance = get_theme_mod('zerif_socials_behance','#');
		$zerif_socials_dribbble = get_theme_mod('zerif_socials_dribbble','#');
			
		$zerif_copyright = get_theme_mod('zerif_copyright');

		if(!empty($zerif_address) || !empty($zerif_address_icon)):
			$footer_sections++;
		endif;
		
		if(!empty($zerif_email) || !empty($zerif_email_icon)):
			$footer_sections++;
		endif;
		
		if(!empty($zerif_phone) || !empty($zerif_phone_icon)):
			$footer_sections++;
		endif;
		if(!empty($zerif_socials_facebook) || !empty($zerif_socials_twitter) || !empty($zerif_socials_linkedin) || !empty($zerif_socials_behance) || !empty($zerif_socials_dribbble) || 
		!empty($zerif_copyright)):
			$footer_sections++;
		endif;
		
		if( $footer_sections == 1 ):
			$footer_class = 'col-md-12';
		elseif( $footer_sections == 2 ):
			$footer_class = 'col-md-6';
		elseif( $footer_sections == 3 ):
			$footer_class = 'col-md-4';
		elseif( $footer_sections == 4 ):
			$footer_class = 'col-md-3';
		else:
			$footer_class = 'col-md-3';
		endif;
		
		/* COMPANY ADDRESS */
		if( !empty($zerif_address) ):
		  echo '<div class="col-md-3 company-details">
					<div class="icon-top red-text">
						<a href="https://thecannabismethod.com/index.php/map/">
							<img src="https://thecannabismethod.com/wp-content/themes/zerif-lite/images/map25-redish.png"><br>
							<span>Delivery Map</span>
						</a>
					</div>
				</div>';
		endif;
		
		/* COMPANY EMAIL */
		
		if( !empty($zerif_email) ):
		  echo '<div class="col-md-3 company-details">
					<div class="icon-top green-text">
						<a href="mailto:support@thecannabismethod.com">
							<img src="https://thecannabismethod.com/wp-content/themes/zerif-lite/images/envelope4-green.png"><br>
							<span>support@thecannabismethod.com</span>
						</a>
					</div>
				</div>';
		endif;
		
		/* COMPANY PHONE NUMBER */
		
		if( !empty($zerif_phone) ):
		  echo '<div class="col-md-3 company-details">
					<div class="icon-top blue-text">
						<a href="tel:323 450 7708">
							<img src="https://thecannabismethod.com/wp-content/themes/zerif-lite/images/telephone65-blue.png"><br>
							<span>(323) 450-7708</span>
						</a>
					</div>
				</div>';
		endif;
		
		if( !empty($zerif_socials_facebook) || !empty($zerif_socials_twitter) || !empty($zerif_socials_linkedin) || !empty($zerif_socials_behance) || !empty($zerif_socials_dribbble) || 
		!empty($zerif_copyright)):
		
					echo '<div class="'.$footer_class.' copyright">';
					if(!empty($zerif_socials_facebook) || !empty($zerif_socials_twitter) || !empty($zerif_socials_linkedin) || !empty($zerif_socials_behance) || !empty($zerif_socials_dribbble)):
						echo '<ul class="social">';
						
						/* leafly */
						echo '<li><a target="_blank" href="https://www.leafly.com/dispensary-info/the-cannabis-method"><img src="https://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/lf.png"></a></li>';
						
						/* twitter */
						if( !empty($zerif_socials_twitter) ):
							echo '<li><a target="_blank" href="https://twitter.com/tcannabismethod"><i class="fa fa-twitter"></i></a></li>';
						endif;
						/* instagram */
						if( !empty($zerif_socials_twitter) ):
							echo '<li><a target="_blank" href="https://instagram.com/thecannabismethod"><i class="fa fa-instagram"></i></a></li>';
						endif;

						echo '</ul>';
					endif;	
			
			
					if( !empty($zerif_copyright) ):
						echo esc_attr($zerif_copyright);
					endif;
					
					echo '</div>';
			
		endif;
	?>

</div> <!-- / END CONTAINER -->

</footer> <!-- / END FOOOTER  -->



<?php wp_footer(); ?>



</body>

</html>

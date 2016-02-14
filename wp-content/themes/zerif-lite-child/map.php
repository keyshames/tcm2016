<?php

/*
Template Name: Map
*/

get_header(); ?>

</header>


	<div id="content" class="site-content">

<div id="map" class="container">
	<style>
    .google-maps {
        position: relative;
        padding-bottom: 75%; // This is the aspect ratio
        height: 0;
        overflow: hidden;
    }
    .google-maps iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
    }
</style>

<p>Are you outside of our coverage zone?  Contact us at <a href="mailto:support@thecannabismethod.com">support@thecannabismethod.com</a>.  We may be able to help.</p> 
<div class="google-maps">
	<iframe src="https://www.google.com/maps/d/embed?mid=zwSldOv1-oBU.k01wdm1d3yrs&z=12" width="640" height="480"></iframe>
</div>
</div>


<?php get_footer(); ?>
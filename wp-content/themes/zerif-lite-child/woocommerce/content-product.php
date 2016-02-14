<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>
<style>
table, td {	 	 
	border:0;
	padding:0;
	margin:0;	 	 
}	 	 
td.label, td a, .single_variation_wrap {	 	 
	display:none!important;	 	 
}
.woocommerce-result-count {
 	display:none;
}
ul.products {
	display:-webkit-flex;
	-webkit-flex-flow:row wrap;
	justify-content:left;
	margin:0 0 20px!important;
	padding:0!important;
}
ul.products::before, ul.products::after {
	display:none!important;	
}
.site-content .container {
	padding:0; 
}
form.variations_form {
	width:100%;
	position:absolute;
	bottom:20px;
  	padding: 0 20px;
}
td {
	vertical-align:middle;
}
.single_add_to_cart_button {
	width:140px!important;
  	height:46px;
 	margin:0!important;
  	border-radius:5px!important;
  	float:right!important;
}
.grdt {
	height:inherit;
	background:linear-gradient(to bottom,rgba(0,0,0,0) 0,rgba(0,0,0,.1) 30%,rgba(0,0,0,.5) 50%,rgba(0,0,0,1) 100%);
}
.itemInfo {
	width:100%;
	position:absolute;
	bottom:60px;
	text-align:left!important;
	text-shadow: 0 0 10px #000;
}
.itemInfo h3 {
	display:block!important;
	min-height:0!important;
	margin:0 0 8px 20px!important;
	padding:0!important;
	font-size:28px!important;
	line-height:normal!important;
	color:#fff!important;
}
.itemDesc {
	display: -webkit-flex;
	margin: 0 20px 20px;	
	color:#fff;
}
.itemDesc p {
	-webkit-order:1;
	-webkit-flex: 0 1 auto;
	min-width:0px;
	margin:0!important;
	text-overflow:ellipsis;
}
.itemDesc a {
	-webkit-order:2;
	-webkit-flex:1 0 auto;
	min-width:0px;
	padding-left:8px!important;
	text-overflow:ellipsis;
}
.hideTxt {
    white-space:nowrap;
    overflow:hidden;
}
.showTxt {
	width:auto!important;
	white-space:normal;
	overflow:visible;
}
#main button {
	background:#23a941!important;
}
#main button:hover {
	background:#1a7f31!important;
}
#main a.toggleTxt {
	color:#23a941!important;
}
#main a.toggleTxt:hover {
	text-decoration:underline;
}
a[rel=tag] {
    border: 2px solid;
    border-radius: 10px;
    padding: 0 5px 2px;
    margin-left: 20px;
    float: none!important;
    vertical-align: super;
}
a[rel=tag]:hover {
	text-decoration:none!important;
}
#categ {
	width: 221px;
	border-radius: 5px!important;
}
.fa-search-plus {
	font-size: 20px;
	color:#23a941;
	margin: 20px 20px 0 0;
	float:right;
}
.fa-search-plus:hover {
	color:#1a7f31;
}
li[class*='indica'] a[rel='tag'] {
	color:#D732D7!important;
}
li[class*='hybrid'] a[rel='tag'] {
	color:#00c5ff!important;
}
li[class*='edibles'] a[rel='tag'] {
	color:#fa3500!important;
}
li[class*='concentrates'] a[rel='tag'] {
	color:#FFA500!important;
}
li[class*='vapor-pens'] a[rel='tag'] {
	color:#FF69B4!important;
}
li[class*='specials'] a[rel='tag'] {
	color:#FFD500!important;
}
a[rel='tag'] {
	background: rgba(0, 0, 0, 0.4); 
}
#main > ul.products {
	margin-top:0;
}
@media screen and (max-width: 480px) {
	#main > ul.products li {
		margin-bottom:15px;
	}
	.itemInfo h3 {
		font-size:20px!important;	
	}
	.itemInfo > a {
		font-size:14px;
		vertical-align: text-bottom;
	}
}
.page-description {
	width:100%; 
}
.woocommerce-page .woocommerce-error {
	margin: 20px 0 0!important;
}
.woocommerce-page .woocommerce-message {
	display:inline-block;
	width:100%!important;
	max-width:975px;
	margin: 20px 0 0!important;
  	clear:both;
  	border-top-color:transparent;
    background:#23a941;
}
.woocommerce-message a {
	color:#fff!important;
  	background:#2cd351!important;
}
.woocommerce-message:before, .woocommerce-error:before {
	color:#fff!important;
}
#main button.disable, #main button.disable:hover {
	background:grey!important;
}
.vote a {
	display:inline!important; 
}
.vote {
	color:#fff;
	line-height: normal;
}
#popWrap {
	display:none;
  	width:30%;
	height:325px;
	position:fixed;
	z-index:100;
  	top:25%;
  	left:35%;
  	overflow:hidden;
    font-family: Lato, sans-serif;
  	font-size: 16px;
  	line-height:normal!important;
}
@media screen and (max-width: 1024px) {
    #popWrap {
	 	width:50%;
		left:25%;
    }
}
@media screen and (max-width: 480px) {
    #popWrap {
	 	width:80%;
		left:10%;
    }
}
#popWrap .hidePop {
  	position:absolute;
  	z-index:101;
    top:0;
  	right:0;
	margin:5px 10px 0 0;
  	font-size:20px!important;
  	text-decoration:none!important;
	color:#808080!important;
}
#popWrap .hidePop:hover {
  	color:#e96656!important;	
}
.wp-polls, .wp-polls-form {
  	width:100%;
	height:100%;
	position:absolute;
 	top:0;
  	left:0;
}
.wp-polls-form {
	top:-17%; 
}
.wp-polls-ul {
	display: table;
    margin:0 auto!important;
}
.wp-polls-ul li {
	margin-bottom:15px!important;
}
#popWrap input[type="button"] {
  background:#23a941!important;
  font-weight:700;
  border:0;
  border-radius:5px;
}
#popWrap input[type="button"]:hover {
  background: #1a7f31!important;
}
body * {
	-webkit-user-select:none;
}
@media screen and (min-width: 1024px) {
	#main ul.products {
		min-height: 790px;
	}
}
a.page-numbers:hover {
    background:#23a941!important;
    color: #FFF;
}
div.itemInfo > a:nth-child(1),
div.itemInfo > a:nth-child(1) * {
  	pointer-events:none!none;
  	cursor: default!important;
	text-decoration:none!important; 
}

</style>

<li <?php post_class( $classes ); ?> style="background:url(<?=wp_get_attachment_url( get_post_thumbnail_id() );?>) no-repeat; background-size:cover;">
	
	<div class='grdt'>
		
		<?php
			/* lightbox */
			echo '<a href="'.wp_get_attachment_url( get_post_thumbnail_id() ).'" data-lightbox="'.$post->ID.'"><i class="fa fa-search-plus"></i></a>';
			global $product;
			$attachment_ids = $product->get_gallery_attachment_ids();
			foreach( $attachment_ids as $attachment_id ) {
			  echo '<a href="'.wp_get_attachment_url( $attachment_id ).'" data-lightbox="'.$post->ID.'" class="hide"></a>';
			}
		?>
		
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<div class='itemInfo'>
			
			<?php			
				/* product title */
				do_action( 'woocommerce_shop_loop_item_title' );
			
				/* category badge */
				echo $product->get_categories( '<span class="posted_in">' . sizeof( get_the_terms( $post->ID, 'product_cat' ) ). ' ', '.</span>' );
			?>
			
			<div class='itemDesc'>
				
				<?php
					/* product description */
					echo apply_filters( 'the_content', get_post_field('post_content', $product_id) );
				?>
				
			</div>
			
		</div>
			
		<?php
			/* cart button */
			if($product->product_type == "variable") woocommerce_variable_add_to_cart(); 
			else woocommerce_template_loop_add_to_cart(); 
		?>
	
	</div>
		
</li>





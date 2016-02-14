<html>
<body style="background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;">

<div style="max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;">

	<div style="color: #444444;font-weight: normal;">
		<a href="http://thecannabismethod.com/" target="_blank"><img style="display:block;width:300px;margin: 20px auto;" src="http://thecannabismethod.com/wp-content/uploads/2015/10/logo@2x.jpg"/></a>
		
		<div style="clear:both"></div>
	</div>
	
	<div style="padding: 0 30px 30px 30px;border-top: 3px solid #eeeeee;border-bottom: 3px solid #eeeeee;">
		
		<div style="padding: 15px; text-align: left;">
			Your recent order on <?php echo date( 'm-d-Y', strtotime( $order->order_date ) ); ?> with The Cannabis method has been delivered.  Thank you for choosing The Cannabis Method for all of your cannabis needs.  
			<br><br>
		</div>
		
		<div style="padding: 0 0 30px 0;">
		
			<div style="background: #eee;color: #444;padding: 12px 15px; border-radius: 3px;font-weight: bold;font-size: 16px;">
				<?='Order #'.$order->get_order_number()?>
			</div>
		
			<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
				<thead>
					<tr>
						<th class="td" scope="col" style="text-align:left;"><?php _e( 'Product', 'woocommerce' ); ?></th>
						<th class="td" scope="col" style="text-align:left;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
						<th class="td" scope="col" style="text-align:left;"><?php _e( 'Price', 'woocommerce' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php echo $order->email_order_items_table( $order->is_download_permitted(), true, $order->has_status( 'processing' ) ); ?>
				</tbody>
				<tfoot>
					<?php
						if ( $totals = $order->get_order_item_totals() ) {
							$i = 0;
							foreach ( $totals as $total ) {
								$i++;
								?><tr>
									<th class="td" scope="row" colspan="2" style="text-align:left; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
									<td class="td" style="text-align:left; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
								</tr><?php
							}
						}
					?>
				</tfoot>
			</table>
		
		</div>
		
		<div style="padding: 0 15px; text-align: left;">
			Leaf A Review<br>
			Leave us feedback on <a target="_blank" href="https://www.leafly.com/dispensary-info/the-cannabis-method">Leafly.com</a> and recieve a $10 OFF code on your next delivery! 
		</div>
		
	</div>
	
	<div style="color: #666;padding: 20px 30px">
		
		<div style="">Thanks,</div>
		<div style="">The Cannabis Method Support Team</div>
		<a href="http://thecannabismethod.com/" target="_blank" style="color: #23a941;">www.thecannabismethod.com</a>
		<br><br>
		<div style="">
			<a href="https://twitter.com/tcannabismethod" target="_blank"><img style="width: 18px;padding: 5px"  src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/tw.jpg"/></a>
			<a href="https://instagram.com/thecannabismethod" target="_blank"><img style="width: 18px;padding: 5px" src="http://thecannabismethod.com/wp-content/themes/zerif-lite-child/img/ig.jpg"/></a>
		</div>
		
	</div>

</div>

</body>
</html>
<?php

//Exit if accessed directly
if(!defined('ABSPATH')){
	return; 	
}

global $jp_cp_gl_qtyen_value,$jp_cp_ad_rl_en_value,$jp_cp_ad_rl_enm_value,$jp_cp_ad_rl_tl_value,$jp_cp_gl_splk_value,$jp_cp_gl_fullcart_value;

$cart_contents = WC()->cart->get_cart();
$show_full_cart = $jp_cp_gl_fullcart_value ? true : false;

if(!$show_full_cart){
	if(isset($cart_contents[$cart_item_key])){
		foreach ($cart_contents as $key => $value) {
			if($key != $cart_item_key) unset($cart_contents[$key]);
		}
	}
	else{
		return false;
	}
	
}

$cart_data = $cart_contents;


?>

<?php if(empty($cart_data)): ?>

	<span class="jp-cp-empty-cart-notice"><?php _e('Su Carrito está Vacio.','added-to-cart-popup-woocommerce'); ?></span>

	<a class="xcp-btn jp-cp-sn-btn" href="<?php echo $jp_cp_gl_splk_value  ? $jp_cp_gl_splk_value : get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e('Shop Now','added-to-cart-popup-woocommerce'); ?></a>


<?php else: ?>
	<div class="jp-cp-cart-table-cont">
		<table class="jp-cp-cart">
			<?php if($show_full_cart): ?>
				<tr class="jp-cp-ths">
					<th class="xcp-rhead"><?php _e('Remove','added-to-cart-popup-woocommerce'); ?></th>
					<th><?php _e('Image','added-to-cart-popup-woocommerce'); ?></th>
					<th><?php _e('Title','added-to-cart-popup-woocommerce'); ?></th>
					<th class="xcp-phead"><?php _e('Price','added-to-cart-popup-woocommerce'); ?></th>
					<th><?php _e('Quantity','added-to-cart-popup-woocommerce'); ?></th>
					<th><?php _e('Total','added-to-cart-popup-woocommerce'); ?></th>
				</tr>
			<?php endif; ?>

		<?php

		foreach ( $cart_data as $cart_item_key => $cart_item ) {

				if(function_exists('wc_pb_is_bundled_cart_item')){
					if(wc_pb_is_bundled_cart_item($cart_item)) continue;
				}

				//Woocommerce Bundled Products
					$bundled_parent  = $bundled_child = null;
					$extra_classes 	 = array();
					if(isset($cart_item['bundled_items'])){
						$bundled_parent = true;
						$extra_classes[] = 'jp-cp-bundled-parent';
					}
					elseif(isset($cart_item['bundled_by'])){
						$bundled_child = true;
						$extra_classes[] = 'jp-cp-bundled-child';
					}


					//Mix and match
					if(isset($cart_item['mnm_contents'])){
						$bundled_parent = true;
						$extra_classes[] = 'jp-cp-mnm-parent';
					}
					elseif(isset($cart_item['mnm_container'])){
						$bundled_child = true;
						$extra_classes[] = 'jp-cp-mnm-child';
					}

					//Composite products
					if(isset($cart_item['composite_children'])){
						$bundled_parent = true;
						$extra_classes[] = 'jp-cp-comp-parent';
					}
					elseif(isset($cart_item['composite_parent'])){
						$bundled_child = true;
						$extra_classes[] = 'jp-cp-comp-child';
					}


					//Chained
					if( isset( $cart_item['chained_item_of'] ) ){
						$bundled_child = true;
						$extra_classes[] = 'jp-cp-chained-child';
					}


					if($bundled_parent){
						$extra_classes[] = 'jp-cp-is-parent';
					}
					elseif($bundled_child){
						$extra_classes[] = 'jp-cp-is-child';
					}

				//If yith bundle
				if( isset( $cart_item['bundled_by'] )  || isset( $cart_item['woosb_parent_id']) ) continue;

				$is_yith_bundle_parent = true;
				$bundled_html = '';

				if( isset( $cart_item['cartstamp'] ) && !empty( $cart_item['cartstamp'] )  ) {
					foreach ( $cart_item['cartstamp'] as $ch_product_data ) {
						$child_product = wc_get_product( $ch_product_data['product_id'] );		
						$bundled_html .= '<span>'.$child_product->get_title().'</span>';
					}
				}

				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );


				
				$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

				
				$product_name =  apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
				
										

				$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

				$product_subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

				// Meta data
				$attributes = '';

				//Variation
				$attributes .= $_product->is_type('variable') || $_product->is_type('variation')  ? wc_get_formatted_variation($_product) : '';
				// Meta data
				if(version_compare( WC()->version , '3.3.0' , "<" )){
					$attributes .=  WC()->cart->get_item_data( $cart_item );
				}
				else{
					$attributes .=  wc_get_formatted_cart_item_data( $cart_item );
				}

				$defaults = array(
					'input_value' 	=> $cart_item['quantity'],
                    'max_value' 	=>  apply_filters( 'woocommerce_quantity_input_max', $_product->get_max_purchase_quantity(), $_product ),
                    'min_value' 	=> apply_filters( 'woocommerce_quantity_input_min', $_product->get_min_purchase_quantity(), $_product ),
                    'step'      	=> apply_filters( 'woocommerce_quantity_input_step', 1, $_product ),
                    'pattern'   	=> apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' ),
                );

                if( isset( $cart_item['composite_parent'] ) ){
                	$composite_item = $cart_item[ 'composite_data' ][ $cart_item['composite_item'] ];
                	$defaults['min_value'] = $composite_item['quantity_min'];
                	$defaults['max_value'] = $composite_item['quantity_max'];
                }

                $args = apply_filters( 'woocommerce_quantity_input_args', $defaults , $_product );

		?>

			<tr class="jp-cp-pdetails <?php echo implode(' ',$extra_classes); ?>" data-jp_cp_key="<?php echo $cart_item_key; ?>">
				
				<td class="jp-cp-remove">
					<?php if(!$bundled_child): ?>
						<span class="jp-cp-icon-close jp-cp-remove-pd"></span>
					<?php endif; ?>
				</td>
				<td class="jp-cp-pimg"><?php echo $thumbnail; ?></td>
				<td class="jp-cp-ptitle"><a href="<?php echo $product_permalink; ?>"><?php echo $product_name; ?></a>

					<?php if($attributes): ?>
						<div class="jp-cp-variations"><?php echo $attributes; ?></div>
					<?php endif; ?>

					<?php if( isset( $is_yith_bundle_parent ) ): ?>
						<div class="jp-cp-yith-bundled-items"><?php echo $bundled_html; ?></div>
					<?php endif; ?>

				</td>
				<td class="jp-cp-pprice"><?php echo $product_price; ?></td>
				<td class="jp-cp-pqty">

					<?php if ( $_product->is_sold_individually() || !$jp_cp_gl_qtyen_value ): ?>
						<span><?php echo $cart_item['quantity']; ?></span>				
					<?php else: ?>
						<div class="jp-cp-qtybox">
						<span class="xcp-minus xcp-chng">-</span>
						<input type="number" class="jp-cp-qty" max="<?php esc_attr_e( 0 < $args['max_value'] ? $args['max_value'] : '' ); ?>" min="<?php esc_attr_e($args['min_value']); ?>" step="<?php echo esc_attr_e($args['step']); ?>" value="<?php echo $cart_item['quantity'] ?>" pattern="<?php esc_attr_e( $args['pattern'] ); ?>">
						<span class="xcp-plus xcp-chng">+</span></div>
					<?php endif; ?>

				</td>
				<td class="jp-cp-ptotal"><?php echo $product_subtotal; ?></td>
			</tr>
		<?php }; ?>

		</table>
	</div>

	<div class="jp-cp-table-bottom">
		
		<?php if($show_full_cart): ?>
			<a class="jp-cp-empct"><span class="jp-cp-icon-close"></span><?php _e('Empty Cart','added-to-cart-popup-woocommerce'); ?></a>
		<?php endif; ?>

		<div class="jp-cp-cart-total">
			<span class="xcp-totxt"><?php _e('Total','added-to-cart-popup-woocommerce');?> : </span><span class="xcp-ctotal"><?php echo wc_price(WC()->cart->subtotal); ?></span></div>
	</div>

	<div class="jp-cp-cart-btns">
		<a class="jp-cp-btn-vc xcp-btn" href="<?php echo wc_get_cart_url(); ?>"><?php _e('View Cart','added-to-cart-popup-woocommerce'); ?></a>
		<a class="jp-cp-btn-ch xcp-btn" href="<?php echo wc_get_checkout_url(); ?>"><?php _e('Checkout','added-to-cart-popup-woocommerce'); ?></a>
		<a class="jp-cp-close xcp-btn" href="<?php echo apply_filters('jp_cp_continue_shopping_url',''); ?>"><?php _e('Continue Shopping','added-to-cart-popup-woocommerce'); ?></a>
	</div>


<?php endif; ?>

<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

global $jp_cp_ad_bk_ict_value;

$cart_items_total = wc_price(WC()->cart->subtotal);
$count_value 	  = WC()->cart->get_cart_contents_count();
$items_txt = $count_value === 1 ? __('item','added-to-cart-popup-woocommerce') : __('items','added-to-cart-popup-woocommerce');

?>

<a class="jp-cp-sc-cont">
	<span class="jp-cp-sc-icon <?php echo $jp_cp_ad_bk_ict_value; ?>"></span>
	<span class="jp-cp-sc-count"><?php echo $count_value; ?></span><?php echo ' '.$items_txt.' - '; ?>
	<span class="jp-cp-sc-total"><?php echo wc_price(WC()->cart->subtotal); ?></span>
</a>

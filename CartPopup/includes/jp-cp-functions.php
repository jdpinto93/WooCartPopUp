<?php

//Exit if accessed directly
if(!defined('ABSPATH')){
    return;     
}


//Hooking related products

add_action('jp_cp_related_products','woocommerce_template_loop_product_link_open',5); // Open Link

add_action('jp_cp_related_products','woocommerce_show_product_loop_sale_flash',10); // Sale flash

add_action('jp_cp_related_products','woocommerce_template_loop_product_thumbnail',15); // Product Image

//Title HTML
function jp_cp_related_product_title(){
	echo '<span class="jp-cp-rel-title">'.get_the_title().'</span>';
}
add_action('jp_cp_related_products','jp_cp_related_product_title',20);

//Price HTML
function jp_cp_related_product_price(){
	global $product;
	echo '<span class="jp-cp-rel-price">'.wc_price($product->get_price()).'</span>';
}
add_action('jp_cp_related_products','jp_cp_related_product_price',25);

add_action('jp_cp_related_products','woocommerce_template_loop_product_link_close',30); // Close Link



//Add to cart link
function jp_cp_related_product_atc(){
	global $jp_cp_ad_rl_enatc_value;
	if(!$jp_cp_ad_rl_enatc_value) return;
	echo do_shortcode( '[add_to_cart id="' . get_the_ID() . '" style="" show_price="false"]');
}
add_action('jp_cp_related_products','jp_cp_related_product_atc',35);


function jp_cp_shop_item_hidden(){
	global $product;
	echo '<input type="hidden" class="xcp-hidden-id" value="'.$product->get_id().'">';
}
add_action('woocommerce_after_shop_loop_item','jp_cp_shop_item_hidden',1);	


//Menu Shortcode
function jp_cp_cart_shortcode_func(){
	ob_start();
	wc_get_template('jp-cp-shortcode.php','','',JP_CP_PATH.'/templates/');
	return ob_get_clean();
}
add_shortcode('jp_cp_cart','jp_cp_cart_shortcode_func');



?>
<?php

//Exit if accessed directly
if(!defined('ABSPATH')){
    return;     
}

global $product , $woocommerce , $jp_cp_ad_rl_no_value , $jp_cp_ad_rl_ty_value , $jp_cp_ad_rl_tl_value;


        $type        = $jp_cp_ad_rl_ty_value;
        $items_count = $jp_cp_ad_rl_no_value ? $jp_cp_ad_rl_no_value : 5;
        $cart        = WC()->cart->get_cart();
        $cart_is_empty = WC()->cart->is_empty();

        $suggested_products = array();
        $exclude_ids = array();

        if(!$cart_is_empty){
            foreach ($cart as $cart_item) {
                $exclude_ids[] = $cart_item['product_id'];
            }

            switch ($type) {
            case 'cross-sells':
                $suggested_products = WC()->cart->get_cross_sells();
                break;

            case 'up-sells':

                $last_cart_item = end($cart);
                $product_id     = $last_cart_item['product_id'];
                $variation_id   = $last_cart_item['variation_id'];

                if($variation_id){
                    $product = wc_get_product($product_id);
                    $suggested_products = $product->get_upsell_ids();
                }
                else{
                    $suggested_products = $last_cart_item['data']->get_upsell_ids();
                }
                break;

            case 'related':
                $cart_rand = shuffle($cart);

                foreach ($cart as $cart_item) {
                    if(count($suggested_products) >= $items_count)
                        break;


                    $product_id = $cart_item['variation_id'] ? $cart_item['variation_id'] : $cart_item['product_id'];
                    $related_products   = wc_get_related_products($product_id,$items_count,$exclude_ids);
                    $suggested_products = array_merge($suggested_products,$related_products);
                }
                break;
            }

        }


//Default arguments for query
$args = array(
    'post_type'             => 'product',
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => 1,
    'no_found_rows'         => 1,
    'posts_per_page'        => $items_count,
    'post__not_in'          => $exclude_ids,
    'orderby'               => 'rand',
    'meta_query'            => array(
            array(
            'key' => '_stock_status',
            'value' => 'instock',
            'compare' => '=',
        )
    )
);

$suggested_products = apply_filters( 'jp_cp_related_product_ids', $suggested_products );

if(!empty($suggested_products)){
    $args['post__in'] = $suggested_products;
}


$products = new WP_Query($args);

if ( $products->have_posts() ) :  ?>
    <?php do_action('jp_cp_before_suggested_products'); ?>

        <span class="xcp-rel-head"><?php echo $jp_cp_ad_rl_tl_value; ?></span>
        <div class="jp-cp-rel-slider">
            <ul class="jp-cp-rel-prods">
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    <?php global $product; ?>
                    <li <?php post_class('jp-cp-rel-sing'); ?>>                
                        <?php do_action( 'jp_cp_related_products' ); ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

    <?php do_action('jp_cp_after_suggested_products'); ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
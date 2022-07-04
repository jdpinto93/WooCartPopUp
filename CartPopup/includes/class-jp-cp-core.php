<?php

if(!defined('ABSPATH')){
	return;
}

class Jp_CP_Core{

	protected static $instance = null;

	public $action = null;

	public $action_ckey = null;

	//Get instance
	public static function get_instance(){
		if(self::$instance === null){
			self::$instance = new self();
		}
		return self::$instance;
	}


	public function __construct(){
		add_action('wc_ajax_jp_cp_add_to_cart',array($this,'jp_cp_add_to_cart'));
		add_action('wc_ajax_jp_cp_update_cart',array($this,'jp_cp_update_cart'));
		add_action('wc_ajax_jp_cp_undo_item',array($this,'jp_cp_undo_item'));
		add_filter('woocommerce_add_to_cart_fragments',array($this,'set_ajax_fragments'),10,1);
		add_action('woocommerce_add_to_cart',array($this,'set_last_added_cart_item_key'),10,6);
		add_action('wp_ajax_jp_cp_undo_item',array($this,'jp_cp_undo_item'));
		add_action('wp_ajax_nopriv_jp_cp_undo_item',array($this,'jp_cp_undo_item'));
		add_action('wp_ajax_jp_cp_empty_cart',array($this,'jp_cp_empty_cart'));
		add_action('wp_ajax_nopriv_jp_cp_empty_cart',array($this,'jp_cp_empty_cart'));
	}


	//Get cart Content
	public function get_cart_content(){

		$args = array(
			'cart_item_key' => $this->action_ckey,
			'action' 		=> $this->action
		);

		ob_start();
		wc_get_template('jp-cp-content.php',$args,'',JP_CP_PATH.'/templates/');
		return ob_get_clean();
	}

	public function get_notice_html(){

		if(!$this->action) return;

		switch ($this->action) {
			case 'add':
				$notice = __('Item successfully added to your cart','added-to-cart-popup-woocommerce');
				break;

			case 'update':
				$notice = __('Item updated successfully','added-to-cart-popup-woocommerce');
				break;

			case 'remove':
				$notice = __('Item removed from your cart','added-to-cart-popup-woocommerce').'<span class="jp-cp-undo" data-jp_ckey="'.$this->action_ckey.'">Undo?</span>';
				break;

			case 'empty':
				$notice = __('Your cart is currently empty','added-to-cart-popup-woocommerce');

		}

		return '<span class="jp-cp-icon-check"></span>'.$notice;
	}


	//add to cart ajax on single product page
	public function jp_cp_add_to_cart(){
		global $woocommerce,$jp_cp_gl_qtyen_value,$jp_cp_gl_ibtne_value;

		if(!isset($_POST['action']) || $_POST['action'] != 'jp_cp_add_to_cart' || !isset($_POST['add-to-cart'])){
			die();
		}
		
		if( wc_notice_count('error') > 0 ){
			// print notice
			ob_start();

	    	echo wc_print_notices();

			$js_data =  array(
				'error' => ob_get_clean()
			);

			wc_clear_notices(); // clear other notice
			wp_send_json($js_data);
		}
		else {
			// trigger action for added to cart in ajax
			do_action( 'woocommerce_ajax_added_to_cart', intval( $_POST['add-to-cart'] ) );

			wc_clear_notices(); // clear other notice
			WC_AJAX::get_refreshed_fragments();	
		}

		die();
	}


	// Set ajax fragments
	public function set_ajax_fragments($fragments){
		global $jp_cp_ad_rl_en_value,$jp_cp_ad_rl_enm_value,$jp_cp_gl_fullcart_value;

		$cart_count   = WC()->cart->get_cart_contents_count();
		$notice_html  = $this->action ? $this->get_notice_html() : '';
		$notice_class = $this->action ? 'jp-cp-atcn-active' : '';

		
		$cart_content = $this->get_cart_content();
	

		//Cart content
		$fragments['div.jp-cp-content'] = '<div class="jp-cp-content">'.$cart_content.'</div>';

		//Cart count
		$fragments['span.xcp-bk-count'] = '<span class="xcp-bk-count">'.$cart_count.'</span>';

		//Notice
		$fragments['div.jp-cp-atcn'] = '<div class="jp-cp-atcn '.$notice_class.'">'.$notice_html.'</div>';
	
		//Related products
		if(!$jp_cp_ad_rl_en_value || (!$jp_cp_ad_rl_enm_value && wp_is_mobile()) || $this->action == 'update'){

		}
		else{
			$related_products = $this->get_related_products();
			$fragments['div.jp-cp-rp-container'] = '<div class="jp-cp-rp-container">'.$related_products.'</div>';
		}

		//Shortcode data
		ob_start();
		wc_get_template('jp-cp-shortcode.php','','',JP_CP_PATH.'/templates/');
		$fragments['a.jp-cp-sc-cont'] = ob_get_clean();

		return $fragments;
	}


	//Store last added cart item key
	public function set_last_added_cart_item_key($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data){
		$this->action = 'add';
		$this->action_ckey = $cart_item_key;
	}


	//Update cart quantity
	public function jp_cp_update_cart(){
		
		//Form Input Values
		$cart_key = sanitize_text_field($_POST['cart_key']);
		$new_qty = (float) $_POST['new_qty'];

		if(!is_numeric($new_qty) || $new_qty < 0 || !$cart_key){
			wp_send_json(array('error' => __('Something went wrong','side-cart-woocommerce')));
		}
		

		$cart_success = $new_qty == 0 ? WC()->cart->remove_cart_item($cart_key) : WC()->cart->set_quantity($cart_key,$new_qty);
		
		if($cart_success){
			$this->action = $new_qty == 0 ? 'remove' : 'update';
			$this->action_ckey = $cart_key;
			WC_AJAX::get_refreshed_fragments();
		}
		else{
			if(wc_notice_count('error') > 0){
	    		echo wc_print_notices();
			}
		}
		die();
	}


	//Undo
	public function jp_cp_undo_item(){
		$cart_key = sanitize_text_field($_POST['cart_key']);
		if(!$cart_key) return;

		$cart_success = WC()->cart->restore_cart_item($cart_key);

		if($cart_success){
			$this->action = 'add';
			$this->action_ckey = $cart_key;
			WC_AJAX::get_refreshed_fragments();
		}
		else{
			if(wc_notice_count('error') > 0){
	    		echo wc_print_notices();
			}
		}
		die();

	}

	//Empty cart
	public function jp_cp_empty_cart(){
		WC()->cart->empty_cart();
		$this->action = 'empty';
		WC_AJAX::get_refreshed_fragments();
	}


	//Get related products
	public function get_related_products(){
		$args = array(
			'action' => $this->action
		);

		ob_start();
		wc_get_template('jp-cp-related.php',$args,'',JP_CP_PATH.'/templates/');
		return ob_get_clean();

	}


}


?>

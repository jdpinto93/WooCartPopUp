<?php

//Exit if accessed directly
if(!defined('ABSPATH')){
	return; 	
}

class Jp_CP_Public{

	protected static $instance = null;

	public function __construct(){
		add_action('wp_enqueue_scripts',array($this,'enqueue_scripts'));
		add_action('plugins_loaded',array($this,'load_txt_domain'),99);
		add_action('wp_footer',array($this,'get_popup_markup'));
		add_filter( 'pre_option_woocommerce_cart_redirect_after_add', array($this,'prevent_cart_redirect'),10,1);
	}

	//Get class instance
	public static function get_instance(){
		if(self::$instance === null){
			self::$instance = new self();
		}	
		return self::$instance; 
	}


	//Inline styles from cart popup settings
	public static function get_inline_styles(){
		global $jp_cp_sy_pw_value,$jp_cp_sy_imgw_value,$jp_cp_sy_btnbg_value,$jp_cp_sy_btnc_value,$jp_cp_sy_btns_value,$jp_cp_sy_btnbr_value,$jp_cp_sy_tbc_value,$jp_cp_sy_tbs_value,$jp_cp_gl_ibtne_value,$jp_cp_gl_vcbtne_value,$jp_cp_gl_chbtne_value,$jp_cp_ad_rl_no_value,$jp_cp_ad_rl_pm_value,$jp_cp_ad_rl_pts_value,$jp_cp_ad_bk_bs_value,$jp_cp_ad_bk_bc_value,$jp_cp_ad_bk_bbgc_value,$jp_cp_ad_bk_icc_value,$jp_cp_ad_bk_icbg_value,$jp_cp_ad_ti_hbg_value,$jp_cp_ad_ti_hc_value,$jp_cp_ad_ti_tw_value,$jp_cp_ad_ti_ta_value,$jp_cp_ad_sy_cbg_value,$jp_cp_ad_sy_cc_value,$jp_cp_ad_sy_ctc_value,$jp_cp_ad_sy_cbimg_value,$jp_cp_ad_gl_ctc_value,$jp_cp_ad_gl_ctbg_value,$jp_cp_ad_gl_ctfs_value,$jp_cp_ad_gl_ctbs_value,$jp_cp_ad_gl_ctbc_value,$jp_cp_ad_sy_rpc_value,$jp_cp_gl_qtyen_value,$jp_cp_gl_spinen_value;

	$style = '';
	if(!$jp_cp_gl_ibtne_value){
		$style .= 'span.xcp-chng{
			display: none;
		}';
	}

	if(!$jp_cp_gl_vcbtne_value){
		$style .= 'a.jp-cp-btn-vc{
			display: none;
		}';
	}

	if(!$jp_cp_gl_chbtne_value){
		$style .= 'a.jp-cp-btn-ch{
			display: none;
		}';
	}

	if($jp_cp_gl_qtyen_value && $jp_cp_gl_ibtne_value){
		$style .= 'td.jp-cp-pqty{
		    min-width: 120px;
		}';
	}

	$sp_width = (100/$jp_cp_ad_rl_no_value) - ($jp_cp_ad_rl_pm_value);
	$sp_margin = $jp_cp_ad_rl_pm_value/2;

	if($jp_cp_ad_ti_ta_value == 'left'){
		$style .= '.jp-cp-variations{
			float: left;
		}';
	}
	elseif($jp_cp_ad_ti_ta_value == 'center'){
		$style .= '.jp-cp-variations{
			margin: 0 auto;
		}';

	}
	elseif($jp_cp_ad_ti_ta_value == 'right'){
		$style .= '.jp-cp-variations{
			float: right;
		}';
	}


	if(!$jp_cp_gl_spinen_value){
		$style .= '.jp-cp-adding,.jp-cp-added{display:none!important}';
	}


	$style .= "
		table.jp-cp-cart tr.jp-cp-ths{
			background-color: $jp_cp_ad_ti_hbg_value;
		}
		tr.jp-cp-ths th{
			color: $jp_cp_ad_ti_hc_value;
		}
		.jp-cp-container{
			max-width: {$jp_cp_sy_pw_value}px;
			background-color: {$jp_cp_ad_sy_cbg_value};
			background-image: url({$jp_cp_ad_sy_cbimg_value});
		}
		.jp-cp-container , li.jp-cp-rel-sing h3 , li.jp-cp-rel-sing .product_price , input.jp-cp-qty , li.jp-cp-rel-sing .amount , .jp-cp-empct , .jp-cp-ptitle a{
			color: {$jp_cp_ad_sy_ctc_value}
		}
		.xcp-chng ,.jp-cp-qtybox{
    		border-color: {$jp_cp_ad_sy_ctc_value};
		}
		input.jp-cp-qty{
			background-color: {$jp_cp_ad_sy_cbg_value};
		}
		.xcp-btn{
			background-color: {$jp_cp_sy_btnbg_value};
			color: {$jp_cp_sy_btnc_value};
			font-size: {$jp_cp_sy_btns_value}px;
			border-radius: {$jp_cp_sy_btnbr_value}px;
			border: 1px solid {$jp_cp_sy_btnbg_value};
		}
		.xcp-btn:hover{
			color: {$jp_cp_sy_btnc_value};
		}
		td.jp-cp-pimg{
			width: {$jp_cp_sy_imgw_value}%;
		}
		table.jp-cp-cart , table.jp-cp-cart td{
			border: 0;
		}
		table.jp-cp-cart tr{
			border-top: {$jp_cp_sy_tbs_value}px solid;
			border-bottom: {$jp_cp_sy_tbs_value}px solid;
			border-color: {$jp_cp_sy_tbc_value};
		}
		.jp-cp-rel-sing{
		    width: $sp_width%;
		    display: inline-block;
		    margin: 0 $sp_margin%;
		    float: left;
		    text-align: center;
		}
		.jp-cp-rel-title , .jp-cp-rel-price .amount , .jp-cp-rel-sing a.add_to_cart_button{
			font-size: 13px;
		}

		.jp-cp-basket{
			background-color: {$jp_cp_ad_bk_bbgc_value};
		}
		.xcp-bk-icon{
   			font-size: {$jp_cp_ad_bk_bs_value}px;
   			color: {$jp_cp_ad_bk_bc_value};
		}
		.xcp-bk-count{
			color: {$jp_cp_ad_bk_icc_value};
			background-color: {$jp_cp_ad_bk_icbg_value};
		}

		span.jp-cp-close{
			color: {$jp_cp_ad_sy_cc_value};
		}

		.jp-cp-hdtxt , span.xcp-rel-head{
			background-color: {$jp_cp_ad_gl_ctbg_value};
			color: {$jp_cp_ad_gl_ctc_value};
			font-size: {$jp_cp_ad_gl_ctfs_value}px;
		}
		
		.jp-cp-hdtxt{
			border-bottom: {$jp_cp_ad_gl_ctbs_value}px solid {$jp_cp_ad_gl_ctbc_value};
		}

		span.xcp-rel-head{
			border-bottom: {$jp_cp_ad_gl_ctbs_value}px solid {$jp_cp_ad_gl_ctbc_value};
			border-top: {$jp_cp_ad_gl_ctbs_value}px solid {$jp_cp_ad_gl_ctbc_value};
		}

		td.jp-cp-remove .jp-cp-remove-pd{
			color: $jp_cp_ad_sy_rpc_value;
		}

		table.jp-cp-cart td.jp-cp-ptitle{
			width: $jp_cp_ad_ti_tw_value%;
			text-align: $jp_cp_ad_ti_ta_value;
		}";

		return $style;
	}


	//enqueue stylesheets & scripts
	public function enqueue_scripts(){
		global $jp_cp_gl_resetbtn_value,$jp_cp_ad_sy_sbt_value,$jp_cp_ad_bk_bdr_value;

		wp_enqueue_style('jp-cp-style',JP_CP_URL.'/assets/css/jp-cp-style.css',null,JP_CP_VERSION);
		wp_enqueue_style('jp-scrollbar-style',JP_CP_URL.'/lib/scrollbar/jquery.mCustomScrollbar.min.css');
		
		wp_enqueue_script('jp-cp-js',JP_CP_URL.'/assets/js/jp-cp-js.js',array('jquery'),JP_CP_VERSION,true);
		wp_enqueue_script('jp-scrollbar-js',JP_CP_URL.'/lib/scrollbar/jquery.mCustomScrollbar.concat.min.js');

		wp_localize_script('jp-cp-js','jp_cp_localize',array(
			'adminurl'     		=> admin_url().'admin-ajax.php',
			'homeurl' 			=> get_bloginfo('url'),
			'wc_ajax_url' 		=> WC_AJAX::get_endpoint( "%%endpoint%%" ),
			'reset_cart'		=> $jp_cp_gl_resetbtn_value,
			'sbtheme'			=> $jp_cp_ad_sy_sbt_value,
			'drag_basket' 		=> $jp_cp_ad_bk_bdr_value
		));

		wp_add_inline_style('jp-cp-style',self::get_inline_styles());

	}


	//Load text domain
	public function load_txt_domain(){
		$domain = 'added-to-cart-popup-woocommerce';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		load_textdomain( $domain, WP_LANG_DIR . '/'.$domain.'-' . $locale . '.mo' ); //wp-content languages
		load_plugin_textdomain( $domain, FALSE, basename(JP_CP_PATH) . '/languages/' ); // Plugin Languages
	}


	//Get popup markup
	public function get_popup_markup(){
		if(is_cart() || is_checkout()){return;}
		wc_get_template('jp-cp-popup-template.php','','',JP_CP_PATH.'/templates/');
	}

	//Prevent cart redirect
	public function prevent_cart_redirect($value){
		if(!is_admin()){
			return 'no';
		}

		return $value;
	}

}

?>
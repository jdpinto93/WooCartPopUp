<?php

//Exit if accessed directly
if(!defined('ABSPATH')){
	return; 	
}

global $jp_cp_ad_gl_ct_value,$jp_cp_ad_bk_en_value,$jp_cp_ad_bk_ict_value,$jp_cp_gl_fullcart_value;

?>

<div class="jp-cp-opac"></div>
<div class="jp-cp-modal">
	<div class="jp-cp-container">
		<div class="jp-cp-outer">
			<div class="jp-cp-cont-opac"></div>
			<span class="jp-cp-preloader jp-cp-icon-spinner"></span>
		</div>

		<span class="jp-cp-close jp-cp-icon-cross"></span>

		<?php if($jp_cp_gl_fullcart_value): ?>
			<div class="jp-cp-hdtxt"><?php echo $jp_cp_ad_gl_ct_value; ?></div>
		<?php endif; ?>

		<div class="jp-cp-atcn"></div>

		<div class="jp-cp-container-scroll ">

			<?php do_action('jp_cp_before_cart_content'); ?>

			<div class="jp-cp-content"></div>

			<?php do_action('jp_cp_after_cart_content'); ?>

			<div class="jp-cp-rp-container"></div>

		</div>
	</div>
</div>


<?php if($jp_cp_ad_bk_en_value): ?>
	<div class ="jp-cp-basket">
		<span class="xcp-bk-count"><?php echo WC()->cart->get_cart_contents_count();  ?></span>
		<span class="xcp-bk-icon <?php echo $jp_cp_ad_bk_ict_value; ?>"></span>
	</div>
<?php endif; ?>


<div class="jp-cp-notice-box" style="display: none;">
	<div>
	  <span class="jp-cp-notice"></span>
	</div>
</div>

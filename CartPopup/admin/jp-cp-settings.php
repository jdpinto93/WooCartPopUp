<?php
//Exit if accessed directly
if(!defined('ABSPATH')){
	return;
}
?>
<?php settings_errors(); ?>
<div class="jp-container">
	<div class="jp-main">

		<form method="POST" action="options.php" class="jp-cp-form">
			<?php settings_fields('jp-cp-group'); ?>
			<?php do_settings_sections('jp_cp'); ?>
			<?php submit_button(); ?>
		</form>

	<div class="jp-sidebar">
		<?php require_once JP_CP_PATH.'/admin/jp-cp-sidebar.php'; ?>
	</div>
</div>
<?php
	$plugins_list = array(
		array(
			'title' 	=> 'Configuracion del carrito',
			'dashicon'  => 'dashicons-unlock',
			'desc' 		=> 'Por favor ajuste el carrito que se muestra en el escritorio a las necesidades de su tienda',
			'support' 		=> 'https://www.webmasteryagency.com/#shortcode-26-19',
		),
	)
?>

<a class="jp-sidebar-toggle">Ocultar</a>
<div class="jp-other-plugins">
	<div class="jp-sidebar-head">
		<span class="jp-op-head">Panel de Indicaciones</span>
	</div>

	<ul class="jp-op-list">

		<?php foreach($plugins_list as $plugin): ?>
			<li class="jp-op-plugin">
				<div class="jp-op-plugin-icon">
					<span class="dashicons <?php echo $plugin['dashicon']; ?>"></span>
				</div>

				<div class="jp-op-plugin-details">
					<span class="jp-op-plugin-head"><?php echo $plugin['title']; ?></span>
					<span class="jp-op-plugin-about"><?php echo $plugin['desc']; ?></span>
					<a href="<?php echo $plugin['support']; ?>">Contactar a Soporte</a>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
	<a href="https://github.com/jdpinto93/">Visitanos en Github</a>
</div>
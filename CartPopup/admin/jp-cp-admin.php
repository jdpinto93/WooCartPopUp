<?php
//Exit if accessed directly
if(!defined('ABSPATH')){
	return;
}

// Enqueue Scripts & Stylesheet
function jp_cp_admin_enqueue($hook){
	if('toplevel_page_jp_cp' != $hook){
		return;
	}
	wp_enqueue_media();
	wp_enqueue_style('jp-cp-admin-css',plugins_url('/assets/css/jp-cp-admin-css.css',__FILE__),null,'1.2');
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('jp-cp-admin-js',plugins_url('/assets/js/jp-cp-admin-js.js',__FILE__),array('jquery','wp-color-picker'),'1.2',true);
}
add_action('admin_enqueue_scripts','jp_cp_admin_enqueue');

//Settings page
function jp_cp_menu_settings(){
	add_menu_page( 'PopUp Carrito', 'PopUp Carrito', 'manage_options', 'jp_cp', 'jp_cp_settings_cb', 'dashicons-cart', 61 );
	add_action('admin_init','jp_cp_settings');
}
add_action('admin_menu','jp_cp_menu_settings');

//Settings callback function
function jp_cp_settings_cb(){
	include plugin_dir_path(__FILE__).'jp-cp-settings.php';
}

//Custom settings
function jp_cp_settings(){

	/*****************************/
	/** BASIC REGISTER SETTINGS **/
	/*****************************/

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-gl-atcem'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-gl-fullcart'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-gl-ibtne'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-gl-qtyen'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-gl-vcbtne'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-gl-chbtne'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-gl-spinen'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-gl-splk'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-sy-pw'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-sy-imgw'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-sy-btnc'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-sy-btnbg'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-sy-btns'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-sy-btnbr'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-sy-tbs'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-sy-tbc'
 	);

 	/*********************************/
	/** Advanced REGISTER SETTINGS **/
	/*******************************/

	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-rl-en'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-rl-enm'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-rl-enatc'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-rl-tl'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-rl-no'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-rl-ty'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-rl-pm'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-rl-pts'
 	);

 	//Basket

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-bk-en'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-bk-ict'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-bk-bdr'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-bk-bs'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-bk-bc'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-bk-bbgc'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-bk-icc'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-bk-icbg'
 	);

 	//Product item

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-ti-hbg'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-ti-hc'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-ti-tw'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-ti-ta'
 	);

 	//General 

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-gl-ct'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-gl-ctc'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-gl-ctbg'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-gl-ctfs'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-gl-ctbs'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-gl-ctbc'
 	);

 	//Style Options

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-sy-cbimg'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-sy-cbg'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-sy-ctc'
 	);

 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-sy-cc'
 	);


 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-sy-rpc'
 	);


 	register_setting(
		'jp-cp-group',
	 	'jp-cp-ad-sy-sbt'
 	);


	/***************/
	/** SECTIONS **/
	/*************/

	//Begin Basic
 	add_settings_section(
		'jp-cp-main',
		'',
		'jp_cp_main_cb',
		'jp_cp'
	);

	add_settings_section(
		'jp-cp-gl',
		'',
		'jp_cp_gl_cb',
		'jp_cp'
	);

	add_settings_section(
		'jp-cp-sy',
		'',
		'jp_cp_sy_cb',
		'jp_cp'
	);

	//End Basic - Begin Advanced
	add_settings_section(
		'jp-cp-adv',
		'',
		'jp_cp_adv_cb',
		'jp_cp'
	);

	add_settings_section(
		'jp-cp-ad-rl',
		'',
		'jp_cp_ad_rl_cb',
		'jp_cp'
	);

	add_settings_section(
		'jp-cp-ad-bk',
		'',
		'jp_cp_ad_bk_cb',
		'jp_cp'
	);

	add_settings_section(
		'jp-cp-ad-ti',
		'',
		'jp_cp_ad_ti_cb',
		'jp_cp'
	);

	add_settings_section(
		'jp-cp-ad-gl',
		'',
		'jp_cp_ad_gl_cb',
		'jp_cp'
	);

	add_settings_section(
		'jp-cp-ad-sy',
		'',
		'jp_cp_ad_sy_cb',
		'jp_cp'
	);

	add_settings_section(
		'jp-cp-adv-end',
		'',
		'jp_cp_adv_end_cb',
		'jp_cp'
	);


	/*****************************/
	/** BASIC  SETTINGS FIELD   **/
	/*****************************/

	add_settings_field(
		'jp-cp-gl-atcem',
		'Habilitar en móvil',
		'jp_cp_gl_atcem_cb',
		'jp_cp',
		'jp-cp-gl'
	);

	add_settings_field(
		'jp-cp-gl-fullcart',
		'Carrito Completo',
		'jp_cp_gl_fullcart_cb',
		'jp_cp',
		'jp-cp-gl'
	);

	add_settings_field(
		'jp-cp-gl-ibtne',
		'+/- Boton de Cantidad',
		'jp_cp_gl_ibtne_cb',
		'jp_cp',
		'jp-cp-gl'
	);

	add_settings_field(
		'jp-cp-gl-qtyen',
		'Actualizar Cantidad',
		'jp_cp_gl_qtyen_cb',
		'jp_cp',
		'jp-cp-gl'
	);

	add_settings_field(
		'jp-cp-gl-vcbtne',
		'Botón de Ver carrito',
		'jp_cp_gl_vcbtne_cb',
		'jp_cp',
		'jp-cp-gl'
	);

	add_settings_field(
		'jp-cp-gl-chbtne',
		'Boton de Finalizar Compra',
		'jp_cp_gl_chbtne_cb',
		'jp_cp',
		'jp-cp-gl'
	);

	add_settings_field(
		'jp-cp-gl-spinen',
		'Mostrar spinner',
		'jp_cp_gl_spinen_cb',
		'jp_cp',
		'jp-cp-gl'
	);

	add_settings_field(
		'jp-cp-gl-splk',
		'Link de la Tienda',
		'jp_cp_gl_splk_cb',
		'jp_cp',
		'jp-cp-gl'
	);


	add_settings_field(
		'jp-cp-sy-pw',
		'Ancho del PopUp',
		'jp_cp_sy_pw_cb',
		'jp_cp',
		'jp-cp-sy'
	);


	add_settings_field(
		'jp-cp-sy-imgw',
		'Ancho de la Imagen',
		'jp_cp_sy_imgw_cb',
		'jp_cp',
		'jp-cp-sy'
	);

	add_settings_field(
		'jp-cp-sy-btnbg',
		'Color de fondo del botón',
		'jp_cp_sy_btnbg_cb',
		'jp_cp',
		'jp-cp-sy'
	);

	add_settings_field(
		'jp-cp-sy-btnc',
		'Color del texto del botón',
		'jp_cp_sy_btnc_cb',
		'jp_cp',
		'jp-cp-sy'
	);

	add_settings_field(
		'jp-cp-sy-btns',
		'Tamaño de fuente del botón',
		'jp_cp_sy_btns_cb',
		'jp_cp',
		'jp-cp-sy'
	);

	add_settings_field(
		'jp-cp-sy-btnbr',
		'Radio del borde del botón',
		'jp_cp_sy_btnbr_cb',
		'jp_cp',
		'jp-cp-sy'
	);

	add_settings_field(
		'jp-cp-sy-tbs',
		'Tamaño del borde del artículo',
		'jp_cp_sy_tbs_cb',
		'jp_cp',
		'jp-cp-sy'
	);

	add_settings_field(
		'jp-cp-sy-tbc',
		'Color del borde del artículo',
		'jp_cp_sy_tbc_cb',
		'jp_cp',
		'jp-cp-sy'
	);

	/*****************************/
	/** ADVANCED SETTINGS FIELD **/
	/*****************************/

	add_settings_field(
		'jp-cp-ad-rl-en',
		'Habilitar productos sugeridos',
		'jp_cp_ad_rl_en_cb',
		'jp_cp',
		'jp-cp-ad-rl'
	);

	add_settings_field(
		'jp-cp-ad-rl-enm',
		'Productos sugeridos en el móvil',
		'jp_cp_ad_rl_enm_cb',
		'jp_cp',
		'jp-cp-ad-rl'
	);

	add_settings_field(
		'jp-cp-ad-rl-enatc',
		'Añadir al carrito',
		'jp_cp_ad_rl_enatc_cb',
		'jp_cp',
		'jp-cp-ad-rl'
	);

	add_settings_field(
		'jp-cp-ad-rl-tl',
		'Título de los productos sugeridos',
		'jp_cp_ad_rl_tl_cb',
		'jp_cp',
		'jp-cp-ad-rl'
	);

	add_settings_field(
		'jp-cp-ad-rl-no',
		'Número de productos sugeridos',
		'jp_cp_ad_rl_no_cb',
		'jp_cp',
		'jp-cp-ad-rl'
	);

	add_settings_field(
		'jp-cp-ad-rl-ty',
		'Tipo de productos sugeridos',
		'jp_cp_ad_rl_ty_cb',
		'jp_cp',
		'jp-cp-ad-rl'
	);


	add_settings_field(
		'jp-cp-ad-rl-pm',
		'Margin de Productos sugeridos',
		'jp_cp_ad_rl_pm_cb',
		'jp_cp',
		'jp-cp-ad-rl'
	);

	add_settings_field(
		'jp-cp-ad-rl-pts',
		'Tamaño de fuente de los productos',
		'jp_cp_ad_rl_pts_cb',
		'jp_cp',
		'jp-cp-ad-rl'
	);


	//Basket

	add_settings_field(
		'jp-cp-ad-bk-en',
		'Mostrar Carrito',
		'jp_cp_ad_bk_en_cb',
		'jp_cp',
		'jp-cp-ad-bk'
	);

	add_settings_field(
		'jp-cp-ad-bk-ict',
		'Icono de el Carrito',
		'jp_cp_ad_bk_ict_cb',
		'jp_cp',
		'jp-cp-ad-bk'
	);


	add_settings_field(
		'jp-cp-ad-bk-bdr',
		'Carrito Arrastrable',
		'jp_cp_ad_bk_bdr_cb',
		'jp_cp',
		'jp-cp-ad-bk'
	);


	add_settings_field(
		'jp-cp-ad-bk-bs',
		'Tamaño del Carrito',
		'jp_cp_ad_bk_bs_cb',
		'jp_cp',
		'jp-cp-ad-bk'
	);

	add_settings_field(
		'jp-cp-ad-bk-bc',
		'Color del Carrito',
		'jp_cp_ad_bk_bc_cb',
		'jp_cp',
		'jp-cp-ad-bk'
	);

	add_settings_field(
		'jp-cp-ad-bk-bbgc',
		'Color de Fondo del Carrito',
		'jp_cp_ad_bk_bbgc_cb',
		'jp_cp',
		'jp-cp-ad-bk'
	);


	add_settings_field(
		'jp-cp-ad-bk-icc',
		'Color del contador del Carrito',
		'jp_cp_ad_bk_icc_cb',
		'jp_cp',
		'jp-cp-ad-bk'
	);

	add_settings_field(
		'jp-cp-ad-bk-icbg',
		'Color de fondo del contador del carrito',
		'jp_cp_ad_bk_icbg_cb',
		'jp_cp',
		'jp-cp-ad-bk'
	);

	//P* Product item options

	add_settings_field(
		'jp-cp-ad-ti-hbg',
		'Color de fondo de la cabecera de la tabla',
		'jp_cp_ad_ti_hbg_cb',
		'jp_cp',
		'jp-cp-ad-ti'
	);

	add_settings_field(
		'jp-cp-ad-ti-hc',
		'Color de Fondo de la cabecera',
		'jp_cp_ad_ti_hc_cb',
		'jp_cp',
		'jp-cp-ad-ti'
	);

	add_settings_field(
		'jp-cp-ad-ti-tw',
		'Ancho del titulo de producto',
		'jp_cp_ad_ti_tw_cb',
		'jp_cp',
		'jp-cp-ad-ti'
	);

	add_settings_field(
		'jp-cp-ad-ti-ta',
		'Alineacion del titulo del producto',
		'jp_cp_ad_ti_ta_cb',
		'jp_cp',
		'jp-cp-ad-ti'
	);

	//P* General Options

	add_settings_field(
		'jp-cp-ad-gl-ct',
		'Texto de su carrito',
		'jp_cp_ad_gl_ct_cb',
		'jp_cp',
		'jp-cp-ad-gl'
	);

	add_settings_field(
		'jp-cp-ad-gl-ctc',
		'Color del texto del título',
		'jp_cp_ad_gl_ctc_cb',
		'jp_cp',
		'jp-cp-ad-gl'
	);

	add_settings_field(
		'jp-cp-ad-gl-ctbg',
		'Color de fondo del título',
		'jp_cp_ad_gl_ctbg_cb',
		'jp_cp',
		'jp-cp-ad-gl'
	);

	add_settings_field(
		'jp-cp-ad-gl-ctfs',
		'Tamaño de fuente del título',
		'jp_cp_ad_gl_ctfs_cb',
		'jp_cp',
		'jp-cp-ad-gl'
	);

	add_settings_field(
		'jp-cp-ad-gl-ctbs',
		'Tamaño del borde del título',
		'jp_cp_ad_gl_ctbs_cb',
		'jp_cp',
		'jp-cp-ad-gl'
	);

	add_settings_field(
		'jp-cp-ad-gl-ctbc',
		'Color del borde del título',
		'jp_cp_ad_gl_ctbc_cb',
		'jp_cp',
		'jp-cp-ad-gl'
	);



	//P* Other Style Options

	add_settings_field(
		'jp-cp-ad-sy-cbimg',
		'Imagen de fondo del contenedor',
		'jp_cp_ad_sy_cbimg_cb',
		'jp_cp',
		'jp-cp-ad-sy'
	);

	add_settings_field(
		'jp-cp-ad-sy-cbg',
		'Color de fondo del contenedor',
		'jp_cp_ad_sy_cbg_cb',
		'jp_cp',
		'jp-cp-ad-sy'
	);

	add_settings_field(
		'jp-cp-ad-sy-ctc',
		'Color del texto del contenedor',
		'jp_cp_ad_sy_ctc_cb',
		'jp_cp',
		'jp-cp-ad-sy'
	);

	add_settings_field(
		'jp-cp-ad-sy-cc',
		'Botón de cierre del contenedor',
		'jp_cp_ad_sy_cc_cb',
		'jp_cp',
		'jp-cp-ad-sy'
	);


	add_settings_field(
		'jp-cp-ad-sy-rpc',
		'Color del Boton de Remover',
		'jp_cp_ad_sy_rpc_cb',
		'jp_cp',
		'jp-cp-ad-sy'
	);

	add_settings_field(
		'jp-cp-ad-sy-sbt',
		'Tema de la barra de desplazamiento',
		'jp_cp_ad_sy_sbt_cb',
		'jp_cp',
		'jp-cp-ad-sy'
	);

}

/***** Custom Settings Callback *****/

//Main - General Settings callback
function jp_cp_main_cb(){
	?>

<?php 	/** Settings Tab **/ ?>
	<div class="jp-tabs">
		<ul>
			<li class="tab-1 active-tab">Configuración Basica</li>
			<li class="tab-2">Configuración Avanzada</li>
		</ul>
	</div>

<?php 	/** Settings Tab **/ ?>

	<?php
	$tab = '<div class="main-settings settings-tab settings-tab-active" tab-class ="tab-1">';  //Begin Main settings
	echo $tab;
}


function jp_cp_gl_cb(){
	echo '<h2>Opciones generales</h2>';
}

function jp_cp_sy_cb(){
	echo '<h2>Opciones de estilo</h2>';
}

function jp_cp_adv_cb(){
	echo '</div>';
	echo '<div class="advanced-settings settings-tab" tab-class="tab-2">';
}

function jp_cp_ad_rl_cb(){
	echo '<h2>Productos sugeridos</h2>';
}

function jp_cp_ad_bk_cb(){
	echo '<h2>Cesta de Carrito</h2>';
}

function jp_cp_ad_ti_cb(){
	echo '<h2>Elementos de la tabla</h2>';
}


function jp_cp_ad_gl_cb(){
	echo '<h2>Opciones generales</h2>';
}

function jp_cp_ad_sy_cb(){
	echo '<h2>Otras opciones de estilo</h2>';
}

function jp_cp_adv_end_cb(){
	echo '</div>';
}


/*****************************/
/** BASIC SETTINGS CALLBACK **/
/*****************************/


//Enable on Mobile Devices
$jp_cp_gl_atcem_value = sanitize_text_field(get_option('jp-cp-gl-atcem','true'));
function jp_cp_gl_atcem_cb(){
	global $jp_cp_gl_atcem_value;
	$html  = '<input type="checkbox" name="jp-cp-gl-atcem" id="jp-cp-gl-atcem" value="true"'.checked('true',$jp_cp_gl_atcem_value,false).'>';
	$html .= '<label for="jp-cp-gl-atcem">Habilitar en dispositivos móviles.</label>';
	echo $html;
}

$jp_cp_gl_fullcart_value = sanitize_text_field(get_option('jp-cp-gl-fullcart','true'));
function jp_cp_gl_fullcart_cb(){
	global $jp_cp_gl_fullcart_value;
	$html  = '<input type="checkbox" name="jp-cp-gl-fullcart" id="jp-cp-gl-fullcart" value="true"'.checked('true',$jp_cp_gl_fullcart_value,false).'>';
	$html .= '<label for="jp-cp-gl-fullcart">Mostrar todos los artículos del carrito.</label>';
	echo $html;
}

//Enable +/- button
$jp_cp_gl_ibtne_value = sanitize_text_field(get_option('jp-cp-gl-ibtne','true'));
function jp_cp_gl_ibtne_cb(){
	global $jp_cp_gl_ibtne_value;
	$html  = '<input type="checkbox" name="jp-cp-gl-ibtne" id="jp-cp-gl-ibtne" value="true"'.checked('true',$jp_cp_gl_ibtne_value,false).'>';
	$html .= '<label for="jp-cp-gl-ibtne"> Habilitar botones de aumento/disminución de cantidad.</label>';
	echo $html;
}

//Allow Quantity Update
$jp_cp_gl_qtyen_value = sanitize_text_field(get_option('jp-cp-gl-qtyen','true'));
function jp_cp_gl_qtyen_cb(){
	global $jp_cp_gl_qtyen_value;
	$html  = '<input type="checkbox" name="jp-cp-gl-qtyen" id="jp-cp-gl-qtyen" value="true"'.checked('true',$jp_cp_gl_qtyen_value,false).'>';
	$html .= '<label for="jp-cp-gl-qtyen">Permitir a los usuarios actualizar la cantidad desde la ventana emergente.</label>';
	echo $html;
}


//View Cart button
$jp_cp_gl_vcbtne_value = sanitize_text_field(get_option('jp-cp-gl-vcbtne','true'));
function jp_cp_gl_vcbtne_cb(){
	global $jp_cp_gl_vcbtne_value;
	$html  = '<input type="checkbox" name="jp-cp-gl-vcbtne" id="jp-cp-gl-vcbtne" value="true"'.checked('true',$jp_cp_gl_vcbtne_value,false).'>';
	$html .= '<label for="jp-cp-gl-vcbtne">Habilitar el botón Ver carrito.</label>';
	echo $html;
}

//Checkout button
$jp_cp_gl_chbtne_value = sanitize_text_field(get_option('jp-cp-gl-chbtne','true'));
function jp_cp_gl_chbtne_cb(){
	global $jp_cp_gl_chbtne_value;
	$html  = '<input type="checkbox" name="jp-cp-gl-chbtne" id="jp-cp-gl-chbtne" value="true"'.checked('true',$jp_cp_gl_chbtne_value,false).'>';
	$html .= '<label for="jp-cp-gl-chbtne">Habilitar el botón de pago.</label>';
	echo $html;
}


//Enable spin icon
$jp_cp_gl_spinen_value = sanitize_text_field(get_option('jp-cp-gl-spinen','true'));
function jp_cp_gl_spinen_cb(){
	global $jp_cp_gl_spinen_value;
	$html  = '<input type="checkbox" name="jp-cp-gl-spinen" id="jp-cp-gl-spinen" value="true"'.checked('true',$jp_cp_gl_spinen_value,false).'>';
	$html .= '<label for="jp-cp-gl-spinen">Mostrar el ícono giratorio/Marcar al agregar al carrito.</label>';
	echo $html;
}


//Enable spin icon
$jp_cp_gl_splk_value = sanitize_text_field(get_option('jp-cp-gl-splk',''));
function jp_cp_gl_splk_cb(){
	global $jp_cp_gl_splk_value;
	$html  = '<input type="text" name="jp-cp-gl-splk" id="jp-cp-gl-splk" value="'.$jp_cp_gl_splk_value.'">';
	$html .= '<label for="jp-cp-gl-splk">Enlace de la página de la tienda cuando el carrito está vacío.</label>';
	echo $html;
}


//Style Options Callback

//Popup Width
$jp_cp_sy_pw_value = sanitize_text_field(get_option('jp-cp-sy-pw',650));
function jp_cp_sy_pw_cb(){
	global $jp_cp_sy_pw_value;
	$html  = '<input type="number" name="jp-cp-sy-pw" id="jp-cp-sy-pw" value="'.$jp_cp_sy_pw_value.'">';
	$html .= '<label for="jp-cp-sy-pw">Valor en píxeles (Predeterminado: 650).</label>';
	echo $html;
}


//Image Width
$jp_cp_sy_imgw_value = sanitize_text_field(get_option('jp-cp-sy-imgw','20'));
function jp_cp_sy_imgw_cb(){
	global $jp_cp_sy_imgw_value;
	$html  = '<input type="number" name="jp-cp-sy-imgw" id="jp-cp-sy-imgw" value="'.$jp_cp_sy_imgw_value.'">';
	$html .= '<label for="jp-cp-sy-imgw">Valor en porcentaje (Predeterminado: 20).</label>';
	echo $html;
}

//Button Background Color
$jp_cp_sy_btnbg_value = sanitize_text_field(get_option('jp-cp-sy-btnbg','#a46497'));
function jp_cp_sy_btnbg_cb(){
	global $jp_cp_sy_btnbg_value;
	$html  = '<input type="text" name="jp-cp-sy-btnbg" id="jp-cp-sy-btnbg" class="color-field" value="'.$jp_cp_sy_btnbg_value.'"';
	echo $html;
}

//Button text Color
$jp_cp_sy_btnc_value = sanitize_text_field(get_option('jp-cp-sy-btnc','#ffffff'));
function jp_cp_sy_btnc_cb(){
	global $jp_cp_sy_btnc_value;
	$html  = '<input type="text" name="jp-cp-sy-btnc" id="jp-cp-sy-btnc" class="color-field" value="'.$jp_cp_sy_btnc_value.'"';
	echo $html;
}

//Button Font Size
$jp_cp_sy_btns_value = sanitize_text_field(get_option('jp-cp-sy-btns','14'));
function jp_cp_sy_btns_cb(){
	global $jp_cp_sy_btns_value;
	$html  = '<input type="number" name="jp-cp-sy-btns" id="jp-cp-sy-btns" value="'.$jp_cp_sy_btns_value.'">';
	$html .= '<label for="jp-cp-sy-btns">Tamaño en px (Predeterminado 14).</label>';
	echo $html;
}

//Button Border Radius
$jp_cp_sy_btnbr_value = sanitize_text_field(get_option('jp-cp-sy-btnbr','14'));
function jp_cp_sy_btnbr_cb(){
	global $jp_cp_sy_btnbr_value;
	$html  = '<input type="number" name="jp-cp-sy-btnbr" id="jp-cp-sy-btnbr" value="'.$jp_cp_sy_btnbr_value.'">';
	$html .= '<label for="jp-cp-sy-btnbr">Tamaño en px (Predeterminado 5).</label>';
	echo $html;
}


//Tr Border Size
$jp_cp_sy_tbs_value = sanitize_text_field(get_option('jp-cp-sy-tbs','1'));
function jp_cp_sy_tbs_cb(){
	global $jp_cp_sy_tbs_value;
	$html  = '<input type="number" name="jp-cp-sy-tbs" id="jp-cp-sy-tbs" value="'.$jp_cp_sy_tbs_value.'">';
	$html .= '<label for="jp-cp-sy-tbs">Tamaño en px (Predeterminado 1).</label>';
	echo $html;
}


//Table Border Color
$jp_cp_sy_tbc_value = sanitize_text_field(get_option('jp-cp-sy-tbc','#ebe9eb'));
function jp_cp_sy_tbc_cb(){
	global $jp_cp_sy_tbc_value;
	$html  = '<input type="text" class="color-field" name="jp-cp-sy-tbc" id="jp-cp-sy-tbc" value="'.$jp_cp_sy_tbc_value.'">';
	echo $html;
}

/********************************/
/** ADVANCED SETTINGS CALLBACK **/
/********************************/

//Enable Suggested Products
$jp_cp_ad_rl_en_value = sanitize_text_field(get_option('jp-cp-ad-rl-en','true'));
function jp_cp_ad_rl_en_cb(){
	global $jp_cp_ad_rl_en_value;
	$html  = '<input type="checkbox" name="jp-cp-ad-rl-en" id="jp-cp-ad-rl-en" value="true"'.checked('true',$jp_cp_ad_rl_en_value,false).'>';
	$html .= '<label for="jp-cp-ad-rl-en">Habilitar productos sugeridos.</label>';
	echo $html;
}

//Enable Suggested Products on mobile
$jp_cp_ad_rl_enm_value = sanitize_text_field(get_option('jp-cp-ad-rl-enm','false'));
function jp_cp_ad_rl_enm_cb(){
	global $jp_cp_ad_rl_enm_value;
	$html  = '<input type="checkbox" name="jp-cp-ad-rl-enm" id="jp-cp-ad-rl-enm" value="true"'.checked('true',$jp_cp_ad_rl_enm_value,false).'>';
	$html .= '<label for="jp-cp-ad-rl-enm">Habilite los productos sugeridos en dispositivos móviles.</label>';
	echo $html;
}

//Enable add to cart button
$jp_cp_ad_rl_enatc_value = sanitize_text_field(get_option('jp-cp-ad-rl-enatc','true'));
function jp_cp_ad_rl_enatc_cb(){
	global $jp_cp_ad_rl_enatc_value;
	$html  = '<input type="checkbox" name="jp-cp-ad-rl-enatc" id="jp-cp-ad-rl-enatc" value="true"'.checked('true',$jp_cp_ad_rl_enatc_value,false).'>';
	$html .= '<label for="jp-cp-ad-rl-enatc">Habilite el botón Agregar al carrito para los productos sugeridos.</label>';
	echo $html;
}

//Suggested Products Title
$jp_cp_ad_rl_tl_value = sanitize_text_field(get_option('jp-cp-ad-rl-tl','Products you may like'));
function jp_cp_ad_rl_tl_cb(){
	global $jp_cp_ad_rl_tl_value;
	$html  = '<input type="text" name="jp-cp-ad-rl-tl" id="jp-cp-ad-rl-tl" value="'.$jp_cp_ad_rl_tl_value.'">';
	$html .= '<label for="jp-cp-ad-rl-tl">Título de los productos sugeridos.</label>';
	echo $html;
}

//Number of suggested products
$jp_cp_ad_rl_no_value = (int) sanitize_text_field(get_option('jp-cp-ad-rl-no',5));
function jp_cp_ad_rl_no_cb(){
	global $jp_cp_ad_rl_no_value;
	$html  = '<input type="number" name="jp-cp-ad-rl-no" id="jp-cp-ad-rl-no" value="'.$jp_cp_ad_rl_no_value.'">';
	$html .= '<label for="jp-cp-ad-rl-no">Número de productos sugeridos.</label>';
	echo $html;
}

//Type of suggested Products
$jp_cp_ad_rl_ty_value = sanitize_text_field(get_option('jp-cp-ad-rl-ty','related'));
function jp_cp_ad_rl_ty_cb(){
	global $jp_cp_ad_rl_ty_value;
	?>
	<select name="jp-cp-ad-rl-ty">
		<option value="related" <?php selected('related',$jp_cp_ad_rl_ty_value); ?>>Productos relacionados</option>
		<option value="cross-sells" <?php selected('cross-sells',$jp_cp_ad_rl_ty_value); ?>>Cross-sells</option>
		<option value="up-sells" <?php selected('up-sells',$jp_cp_ad_rl_ty_value); ?>>Up-sells</option>
	</select>
	<?php
}


//Suggested product margin
$jp_cp_ad_rl_pm_value = (int) sanitize_text_field(get_option('jp-cp-ad-rl-pm',2));
function jp_cp_ad_rl_pm_cb(){
	global $jp_cp_ad_rl_pm_value;
	$html  = '<input type="number" name="jp-cp-ad-rl-pm" id="jp-cp-ad-rl-pm" value="'.$jp_cp_ad_rl_pm_value.'">';
	$html .= '<label for="jp-cp-ad-rl-pm">Margin entre productos (Valor en Porcentaje, Predeterminado: 2)</label>';
	echo $html;
}

//Font Size
$jp_cp_ad_rl_pts_value = sanitize_text_field(get_option('jp-cp-ad-rl-pts',13));
function jp_cp_ad_rl_pts_cb(){
	global $jp_cp_ad_rl_pts_value;
	$html  = '<input type="number" name="jp-cp-ad-rl-pts" id="jp-cp-ad-rl-pts" value="'.$jp_cp_ad_rl_pts_value.'">';
	$html .= '<label for="jp-cp-ad-rl-pts">Tamaño de fuente (Valor en px, Predeterminado: 13).</label>';
	echo $html;
}


//****** CART BASKET ******//

//Enable Basket
$jp_cp_ad_bk_en_value = sanitize_text_field(get_option('jp-cp-ad-bk-en','true'));
function jp_cp_ad_bk_en_cb(){
	global $jp_cp_ad_bk_en_value;
	$html  = '<input type="checkbox" name="jp-cp-ad-bk-en" id="jp-cp-ad-bk-en" value="true"'.checked('true',$jp_cp_ad_bk_en_value,false).'>';
	$html .= '<label>Mostrar icono de cesta</label>';
	echo $html;
}

//Basket Icon type
$jp_cp_ad_bk_ict_value = sanitize_text_field(get_option('jp-cp-ad-bk-ict','jp-cp-icon-basket1'));
function jp_cp_ad_bk_ict_cb(){
	global $jp_cp_ad_bk_ict_value;
	?>
	<select name="jp-cp-ad-bk-ict" id="jp-cp-ad-bk-ict">
		<option value="jp-cp-icon-basket1" <?php selected($jp_cp_ad_bk_ict_value,'jp-cp-icon-basket1'); ?>>&#xe903; Icono 1</option>
		<option value="jp-cp-icon-basket2" <?php selected($jp_cp_ad_bk_ict_value,'jp-cp-icon-basket2'); ?>>&#xe904; Icono 2</option>
		<option value="jp-cp-icon-basket3" <?php selected($jp_cp_ad_bk_ict_value,'jp-cp-icon-basket3'); ?>>&#xe905; Icono 3</option>
		<option value="jp-cp-icon-basket4" <?php selected($jp_cp_ad_bk_ict_value,'jp-cp-icon-basket4'); ?>>&#xe901; Icono 4</option>
		<option value="jp-cp-icon-basket5" <?php selected($jp_cp_ad_bk_ict_value,'jp-cp-icon-basket5'); ?>>&#xe900; Icono 5</option>
		<option value="jp-cp-icon-basket6" <?php selected($jp_cp_ad_bk_ict_value,'jp-cp-icon-basket6'); ?>>&#xe902; Icono 6</option>
	</select>
	<?php
}

//Basket draggable
$jp_cp_ad_bk_bdr_value = sanitize_text_field(get_option('jp-cp-ad-bk-bdr','true'));
function jp_cp_ad_bk_bdr_cb(){
	global $jp_cp_ad_bk_bdr_value;
	$html  = '<input type="checkbox" name="jp-cp-ad-bk-bdr" id="jp-cp-ad-bk-bdr" value="true"'.checked('true',$jp_cp_ad_bk_bdr_value,false).'>';
	$html .= '<label for="jp-cp-ad-bk-bdr">Arrastra la cesta a cualquier lugar de la pantalla.</label>';
	echo $html;
}

//Basket size
$jp_cp_ad_bk_bs_value = sanitize_text_field(get_option('jp-cp-ad-bk-bs',40));
function jp_cp_ad_bk_bs_cb(){
	global $jp_cp_ad_bk_bs_value;
	$html  = '<input type="number" name="jp-cp-ad-bk-bs" id="jp-cp-ad-bk-bs" value="'.$jp_cp_ad_bk_bs_value.'">';
	$html .= '<label for="jp-cp-ad-bk-bs">Valor en píxeles. (Predeterminado: 40)</label>';
	echo $html;
}

//Basket Color
$jp_cp_ad_bk_bc_value = sanitize_text_field(get_option('jp-cp-ad-bk-bc','#444444'));
function jp_cp_ad_bk_bc_cb(){
	global $jp_cp_ad_bk_bc_value;
	$html  = '<input type="text" name="jp-cp-ad-bk-bc" id="jp-cp-ad-bk-bc" value="'.$jp_cp_ad_bk_bc_value.'" class="color-field">';
	echo $html;
}

//Basket Background Color
$jp_cp_ad_bk_bbgc_value = sanitize_text_field(get_option('jp-cp-ad-bk-bbgc','#ffffff'));
function jp_cp_ad_bk_bbgc_cb(){
	global $jp_cp_ad_bk_bbgc_value;
	$html  = '<input type="text" name="jp-cp-ad-bk-bbgc" id="jp-cp-ad-bk-bbgc" value="'.$jp_cp_ad_bk_bbgc_value.'" class="color-field">';
	echo $html;
}


//Basket Count Color
$jp_cp_ad_bk_icc_value = sanitize_text_field(get_option('jp-cp-ad-bk-icc','#ffffff'));
function jp_cp_ad_bk_icc_cb(){
	global $jp_cp_ad_bk_icc_value;
	$html  = '<input type="text" name="jp-cp-ad-bk-icc" id="jp-cp-ad-bk-icc" value="'.$jp_cp_ad_bk_icc_value.'" class="color-field">';
	echo $html;
}

//Basket Count background Color
$jp_cp_ad_bk_icbg_value = sanitize_text_field(get_option('jp-cp-ad-bk-icbg','#cc0086'));
function jp_cp_ad_bk_icbg_cb(){
	global $jp_cp_ad_bk_icbg_value;
	$html  = '<input type="text" name="jp-cp-ad-bk-icbg" id="jp-cp-ad-bk-icbg" value="'.$jp_cp_ad_bk_icbg_value.'" class="color-field">';
	echo $html;
}

/** Table Items Options **/

//Table Head Background Color
$jp_cp_ad_ti_hbg_value = sanitize_text_field(get_option('jp-cp-ad-ti-hbg','#eeeeee'));
function jp_cp_ad_ti_hbg_cb(){
	global $jp_cp_ad_ti_hbg_value;
	$html  = '<input type="text" name="jp-cp-ad-ti-hbg" id="jp-cp-ad-ti-hbg" value="'.$jp_cp_ad_ti_hbg_value.'" class="color-field">';
	echo $html;
}

//Table Head text Color
$jp_cp_ad_ti_hc_value = sanitize_text_field(get_option('jp-cp-ad-ti-hc','#000000'));
function jp_cp_ad_ti_hc_cb(){
	global $jp_cp_ad_ti_hc_value;
	$html  = '<input type="text" name="jp-cp-ad-ti-hc" id="jp-cp-ad-ti-hc" value="'.$jp_cp_ad_ti_hc_value.'" class="color-field">';
	echo $html;
}

//Item title Width
$jp_cp_ad_ti_tw_value = sanitize_text_field(get_option('jp-cp-ad-ti-tw',40));
function jp_cp_ad_ti_tw_cb(){
	global $jp_cp_ad_ti_tw_value;
	$html  = '<input type="number" name="jp-cp-ad-ti-tw" id="jp-cp-ad-ti-tw" value="'.$jp_cp_ad_ti_tw_value.'">';
	$html .= '<label for="jp-cp-ad-ti-tw">Ancho de la columna del título del artículo. (Valor en porcentaje - Predeterminado: 40)</label>';
	echo $html;
}

//Item title align
$jp_cp_ad_ti_ta_value = sanitize_text_field(get_option('jp-cp-ad-ti-ta','left'));
function jp_cp_ad_ti_ta_cb(){
	global $jp_cp_ad_ti_ta_value;
	?>
	<select name="jp-cp-ad-ti-ta">
		<option value="left" <?php selected('left',$jp_cp_ad_ti_ta_value); ?>>Left</option>
		<option value="center" <?php selected('center',$jp_cp_ad_ti_ta_value); ?>>Center</option>
		<option value="right" <?php selected('right',$jp_cp_ad_ti_ta_value); ?>>Right</option>
	</select>
	<?php
}


/*** General Options ***/

//Your cart Text
$jp_cp_ad_gl_ct_value = sanitize_text_field(get_option('jp-cp-ad-gl-ct','Your Cart'));
function jp_cp_ad_gl_ct_cb(){
	global $jp_cp_ad_gl_ct_value;
	$html  = '<input type="text" name="jp-cp-ad-gl-ct" id="jp-cp-ad-gl-ct" value="'.$jp_cp_ad_gl_ct_value.'">';
	echo $html;
}

//Cart Text Color
$jp_cp_ad_gl_ctc_value = sanitize_text_field(get_option('jp-cp-ad-gl-ctc','#000000'));
function jp_cp_ad_gl_ctc_cb(){
	global $jp_cp_ad_gl_ctc_value;
	$html  = '<input type="text" name="jp-cp-ad-gl-ctc" id="jp-cp-ad-gl-ctc" value="'.$jp_cp_ad_gl_ctc_value.'" class="color-field">';
	echo $html;
}

//Cart Text Background
$jp_cp_ad_gl_ctbg_value = sanitize_text_field(get_option('jp-cp-ad-gl-ctbg'));
function jp_cp_ad_gl_ctbg_cb(){
	global $jp_cp_ad_gl_ctbg_value;
	$html  = '<input type="text" name="jp-cp-ad-gl-ctbg" id="jp-cp-ad-gl-ctbg" value="'.$jp_cp_ad_gl_ctbg_value.'" class="color-field">';
	echo $html;
}

//Cart Text Font Size
$jp_cp_ad_gl_ctfs_value = sanitize_text_field(get_option('jp-cp-ad-gl-ctfs',16));
function jp_cp_ad_gl_ctfs_cb(){
	global $jp_cp_ad_gl_ctfs_value;
	$html  = '<input type="number" name="jp-cp-ad-gl-ctfs" id="jp-cp-ad-gl-ctfs" value="'.$jp_cp_ad_gl_ctfs_value.'" >';
	$html .= '<label for="jp-cp-ad-gl-ctfs">Valor en píxeles. (Predeterminado: 16)</label>';
	echo $html;
}

//Cart Text Border size
$jp_cp_ad_gl_ctbs_value = sanitize_text_field(get_option('jp-cp-ad-gl-ctbs',2));
function jp_cp_ad_gl_ctbs_cb(){
	global $jp_cp_ad_gl_ctbs_value;
	$html  = '<input type="number" name="jp-cp-ad-gl-ctbs" id="jp-cp-ad-gl-ctbs" value="'.$jp_cp_ad_gl_ctbs_value.'" >';
	$html .= '<label for="jp-cp-ad-gl-ctbs">Valor en píxeles. (Predeterminado: 2)</label>';
	echo $html;
}

//Cart Text Border color
$jp_cp_ad_gl_ctbc_value = sanitize_text_field(get_option('jp-cp-ad-gl-ctbc','#000000'));
function jp_cp_ad_gl_ctbc_cb(){
	global $jp_cp_ad_gl_ctbc_value;
	$html  = '<input type="text" name="jp-cp-ad-gl-ctbc" id="jp-cp-ad-gl-ctbc" value="'.$jp_cp_ad_gl_ctbc_value.'" class="color-field">';
	echo $html;
}


/*** Style Options ***/

//Container background Image
$jp_cp_ad_sy_cbimg_value = esc_attr(get_option('jp-cp-ad-sy-cbimg'));
function jp_cp_ad_sy_cbimg_cb(){
	global $jp_cp_ad_sy_cbimg_value;
	$html = '<input type="button" id="xmedia-btn" class="button y-cbprbtn" value="Select">';
	$html .= '<input type="hidden" name="jp-cp-ad-sy-cbimg" id ="jp-cp-ad-sy-cbimg" value="'.$jp_cp_ad_sy_cbimg_value.'">';
	$html .= '<button class="jp-remove-media button">X Eliminar</button>';
	$html .= '<span class="jp-media-name"></span>';
	$html .= '<p class="description">Formatos soportados: JPEG,PNG </p>';
	echo $html;	
}

//Container Background Color
$jp_cp_ad_sy_cbg_value = sanitize_text_field(get_option('jp-cp-ad-sy-cbg','#ffffff'));
function jp_cp_ad_sy_cbg_cb(){
	global $jp_cp_ad_sy_cbg_value;
	$html  = '<input type="text" name="jp-cp-ad-sy-cbg" id="jp-cp-ad-sy-cbg" value="'.$jp_cp_ad_sy_cbg_value.'" class="color-field">';
	echo $html;
}

//Container Text Color
$jp_cp_ad_sy_ctc_value = sanitize_text_field(get_option('jp-cp-ad-sy-ctc','#000000'));
function jp_cp_ad_sy_ctc_cb(){
	global $jp_cp_ad_sy_ctc_value;
	$html  = '<input type="text" name="jp-cp-ad-sy-ctc" id="jp-cp-ad-sy-ctc" value="'.$jp_cp_ad_sy_ctc_value.'" class="color-field">';
	echo $html;
}

//Container Close Button
$jp_cp_ad_sy_cc_value = sanitize_text_field(get_option('jp-cp-ad-sy-cc','#000000'));
function jp_cp_ad_sy_cc_cb(){
	global $jp_cp_ad_sy_cc_value;
	$html  = '<input type="text" name="jp-cp-ad-sy-cc" id="jp-cp-ad-sy-cc" value="'.$jp_cp_ad_sy_cc_value.'" class="color-field">';
	echo $html;
}



//Remove Product color
$jp_cp_ad_sy_rpc_value = sanitize_text_field(get_option('jp-cp-ad-sy-rpc','#ea0a0a'));
function jp_cp_ad_sy_rpc_cb(){
	global $jp_cp_ad_sy_rpc_value;
	$html  = '<input type="text" name="jp-cp-ad-sy-rpc" id="jp-cp-ad-sy-rpc" value="'.$jp_cp_ad_sy_rpc_value.'" class="color-field">';
	echo $html;
}


//Scroll Bar Theme
$jp_cp_ad_sy_sbt_value = sanitize_text_field(get_option('jp-cp-ad-sy-sbt','dark'));
function jp_cp_ad_sy_sbt_cb(){
	global $jp_cp_ad_sy_sbt_value;
	?>
	<select name="jp-cp-ad-sy-sbt">
		<option value="dark" <?php selected('dark',$jp_cp_ad_sy_sbt_value); ?>>Dark</option>
		<option value="light" <?php selected('light',$jp_cp_ad_sy_sbt_value); ?>>Light</option>
		<option value="rounded" <?php selected('rounded',$jp_cp_ad_sy_sbt_value); ?>>Rounded light</option>
		<option value="rounded-dark" <?php selected('rounded-dark',$jp_cp_ad_sy_sbt_value); ?>>Rounded dark</option>
	</select>
	<?php
}
?>
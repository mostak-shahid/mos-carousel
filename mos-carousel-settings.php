<?php
function mos_carousel_settings_init() {
	register_setting( 'mos_carousel', 'mos_carousel_options' );
	add_settings_section('mos_carousel_section_top_nav', '', 'mos_carousel_section_top_nav_cb', 'mos_carousel');
	add_settings_section('mos_carousel_section_dash_start', '', 'mos_carousel_section_dash_start_cb', 'mos_carousel');
	add_settings_section('mos_carousel_section_dash_end', '', 'mos_carousel_section_end_cb', 'mos_carousel');
	
	add_settings_section('mos_carousel_section_scripts_start', '', 'mos_carousel_section_scripts_start_cb', 'mos_carousel');
	add_settings_field( 'field_jquery', __( 'JQuery', 'mos_carousel' ), 'mos_carousel_field_jquery_cb', 'mos_carousel', 'mos_carousel_section_scripts_start', [ 'label_for' => 'jquery', 'class' => 'mos_carousel_row', 'mos_carousel_custom_data' => 'custom', ] );
	add_settings_field( 'field_owl', __( 'Owl Carousel', 'mos_carousel' ), 'mos_carousel_field_owl_cb', 'mos_carousel', 'mos_carousel_section_scripts_start', [ 'label_for' => 'owl', 'class' => 'mos_carousel_row', 'mos_carousel_custom_data' => 'custom', ] );
	add_settings_field( 'field_css', __( 'Custom Css', 'mos_carousel' ), 'mos_carousel_field_css_cb', 'mos_carousel', 'mos_carousel_section_scripts_start', [ 'label_for' => 'mos_carousel_css' ] );
	add_settings_field( 'field_js', __( 'Custom Js', 'mos_carousel' ), 'mos_carousel_field_js_cb', 'mos_carousel', 'mos_carousel_section_scripts_start', [ 'label_for' => 'mos_carousel_js' ] );
	add_settings_section('mos_carousel_section_scripts_end', '', 'mos_carousel_section_end_cb', 'mos_carousel');

}
add_action( 'admin_init', 'mos_carousel_settings_init' );

function get_mos_carousel_active_tab () {
	$output = array(
		//'option_prefix' => admin_url() . "/options-general.php?page=mos_carousel_settings&tab=",
		'option_prefix' => "?post_type=slider&page=mos_slider_settings&tab=",
	);
	if (isset($_GET['tab'])) $active_tab = $_GET['tab'];
	elseif (isset($_COOKIE['plugin_active_tab'])) $active_tab = $_COOKIE['plugin_active_tab'];
	else $active_tab = 'dashboard';
	$output['active_tab'] = $active_tab;
	return $output;
}
function mos_carousel_section_top_nav_cb( $args ) {
	$data = get_mos_carousel_active_tab ();
	?>
    <ul class="nav nav-tabs">
        <li class="tab-nav <?php if($data['active_tab'] == 'dashboard') echo 'active';?>"><a data-id="dashboard" href="<?php echo $data['option_prefix'];?>dashboard">Dashboard</a></li>
        <li class="tab-nav <?php if($data['active_tab'] == 'scripts') echo 'active';?>"><a data-id="scripts" href="<?php echo $data['option_prefix'];?>scripts">Advanced CSS, JS</a></li>
    </ul>
	<?php
}
function mos_carousel_section_dash_start_cb( $args ) {
	$data = get_mos_carousel_active_tab ();
	$options = get_option( 'mos_carousel_options' );
	?>
	<div id="mos-carousel-dashboard" class="tab-con <?php if($data['active_tab'] == 'dashboard') echo 'active';?>">
		<?php var_dump($options) ?>

	<?php
}
function mos_carousel_section_scripts_start_cb( $args ) {
	$data = get_mos_carousel_active_tab ();
	?>
	<div id="mos-carousel-scripts" class="tab-con <?php if($data['active_tab'] == 'scripts') echo 'active';?>">
	<?php
}
function mos_carousel_field_jquery_cb( $args ) {
	$options = get_option( 'mos_carousel_options' );
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><input name="mos_carousel_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php echo isset( $options[ $args['label_for'] ] ) ? ( checked( $options[ $args['label_for'] ], 1, false ) ) : ( '' ); ?>><?php esc_html_e( 'Yes I like to add JQuery from Plugin.', 'mos_carousel' ); ?></label>
	<?php
}
function mos_carousel_field_owl_cb( $args ) {
	$options = get_option( 'mos_carousel_options' );
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><input name="mos_carousel_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php echo isset( $options[ $args['label_for'] ] ) ? ( checked( $options[ $args['label_for'] ], 1, false ) ) : ( '' ); ?>><?php esc_html_e( 'Yes I like to add Owl Carousel from Plugin.', 'mos_carousel' ); ?></label>
	<?php
}
function mos_carousel_field_css_cb( $args ) {
	$options = get_option( 'mos_carousel_options' );
	?>
	<textarea name="mos_carousel_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $options[ $args['label_for'] ] ) ? esc_html_e($options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("mos_carousel_css"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function mos_carousel_field_js_cb( $args ) {
	$options = get_option( 'mos_carousel_options' );
	?>
	<textarea name="mos_carousel_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $options[ $args['label_for'] ] ) ? esc_html_e($options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("mos_carousel_js"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function mos_carousel_section_end_cb( $args ) {
	$data = get_mos_carousel_active_tab ();
	?>
	</div>
	<?php
}


function mos_carousel_options_page() {
	// add_menu_page( 'Settings', 'Slider Settings', 'manage_options', 'mos_carousel', 'mos_carousel_options_page_html' );
	add_submenu_page( 'edit.php?post_type=slider', 'Settings', 'Slider Settings', 'manage_options', 'mos_slider_settings', 'mos_carousel_admin_page' );
}
add_action( 'admin_menu', 'mos_carousel_options_page' );

function mos_carousel_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'mos_carousel_messages', 'mos_carousel_message', __( 'Settings Saved', 'mos_carousel' ), 'updated' );
	}
	settings_errors( 'mos_carousel_messages' );
	?>
	<div class="wrap mos-carousel-wrapper">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
		<?php
		settings_fields( 'mos_carousel' );
		do_settings_sections( 'mos_carousel' );
		submit_button( 'Save Settings' );
		?>
		</form>
	</div>
	<?php
}
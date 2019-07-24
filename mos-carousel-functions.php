<?php
function mos_carousel_admin_enqueue_scripts(){
	$page = @$_GET['page'];
	global $pagenow, $typenow;
	/*var_dump($pagenow); //options-general.php(If under settings)/edit.php(If under post type)
	var_dump($typenow); //post type(If under post type)
	var_dump($page); //mos_slider_settings(If under settings)*/
	
	if ($pagenow == 'edit.php' AND $page == 'mos_slider_settings') {
		wp_enqueue_style( 'mos-carousel-admin', plugins_url( 'css/mos-carousel-admin.css', __FILE__ ) );

		//wp_enqueue_media();

		wp_enqueue_script( 'jquery' );
		
		/*Editor*/
		//wp_enqueue_style( 'docs', plugins_url( 'plugins/CodeMirror/doc/docs.css', __FILE__ ) );
		wp_enqueue_style( 'codemirror', plugins_url( 'plugins/CodeMirror/lib/codemirror.css', __FILE__ ) );
		wp_enqueue_style( 'show-hint', plugins_url( 'plugins/CodeMirror/addon/hint/show-hint.css', __FILE__ ) );

		wp_enqueue_script( 'codemirror', plugins_url( 'plugins/CodeMirror/lib/codemirror.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'css', plugins_url( 'plugins/CodeMirror/mode/css/css.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'javascript', plugins_url( 'plugins/CodeMirror/mode/javascript/javascript.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'show-hint', plugins_url( 'plugins/CodeMirror/addon/hint/show-hint.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'css-hint', plugins_url( 'plugins/CodeMirror/addon/hint/css-hint.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'javascript-hint', plugins_url( 'plugins/CodeMirror/addon/hint/javascript-hint.js', __FILE__ ), array('jquery') );
		/*Editor*/

		wp_enqueue_script( 'mos-carousel-functions', plugins_url( 'js/mos-carousel-functions.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'mos-carousel-admin', plugins_url( 'js/mos-carousel-admin.js', __FILE__ ), array('jquery') );
	}

}
add_action( 'admin_enqueue_scripts', 'mos_carousel_admin_enqueue_scripts' );
function mos_carousel_enqueue_scripts(){
	global $mos_carousel_option;
	if ($mos_carousel_option['jquery']) {
		wp_enqueue_script( 'jquery' );
	}
	if ($mos_carousel_option['owl']) {
		wp_enqueue_style( 'animate.min', plugins_url( 'css/animate.min.css', __FILE__ ) );

		wp_enqueue_style( 'owl.carousel.min', plugins_url( 'plugins/owlcarousel/owl.carousel.min.css', __FILE__ ) );
		wp_enqueue_style( 'owl.theme.default.min', plugins_url( 'plugins/owlcarousel/owl.theme.default.min.css', __FILE__ ) );

		wp_enqueue_script( 'owl.carousel.min', plugins_url( 'plugins/owlcarousel/owl.carousel.min.js', __FILE__ ), array('jquery') );
	}
	wp_enqueue_style( 'mos-carousel', plugins_url( 'css/mos-carousel.css', __FILE__ ) );
	wp_enqueue_script( 'mos-carousel-functions', plugins_url( 'js/mos-carousel-functions.js', __FILE__ ), array('jquery') );
	wp_enqueue_script( 'mos-carousel', plugins_url( 'js/mos-carousel.js', __FILE__ ), array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'mos_carousel_enqueue_scripts' );
function mos_carousel_ajax_scripts(){
	wp_enqueue_script( 'mos-carousel-ajax', plugins_url( 'js/mos-carousel-ajax.js', __FILE__ ), array('jquery') );
	$ajax_params = array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'ajax_nonce' => wp_create_nonce('mos_carousel_verify'),
	);
	wp_localize_script( 'mos-carousel-ajax', 'ajax_obj', $ajax_params );
}
add_action( 'wp_enqueue_scripts', 'mos_carousel_ajax_scripts' );
add_action( 'admin_enqueue_scripts', 'mos_carousel_ajax_scripts' );
function mos_carousel_scripts() {
	global $mos_carousel_option;
	if ($mos_carousel_option['css']) {
		?>
		<style>
			<?php echo $mos_carousel_option['css'] ?>
		</style>
		<?php
	}
	if ($mos_carousel_option['js']) {
		?>
		<style>
			<?php echo $mos_carousel_option['js'] ?>
		</style>
		<?php
	}
}
add_action( 'wp_footer', 'mos_carousel_scripts', 100 );


function mos_slider_fnc( $atts = array(), $content = '' ) {
	$output = '';
	$dataMobile = array();
	$atts = shortcode_atts( array(
		'id' => '',
	), $atts, 'mos-slide' );

	if ($atts['id'] and preg_match('/^[0-9]+$/', $atts['id'])){
		$images = get_post_meta( $atts['id'], '_mos_slider_images', true );
		$images_mobile = get_post_meta( $atts['id'], '_mos_slider_images_mobile', true );
		foreach ($images_mobile as $key => $value) {
			$dataMobile[] = $value;
		}
		// var_dump($images);
		/*
array(1) {
  [221]=>
  string(71) "http://localhost/ablechildafrica/wp-content/uploads/2019/06/home-bg.jpg"
}
		*/
		$button_text = get_post_meta( $atts['id'], '_mos_slider_button_text', true );
		$button_url = get_post_meta( $atts['id'], '_mos_slider_button_url', true );
		$content_post = get_post($atts['id']);
		$content = $content_post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		//$output .= '<div class="slider-wrapper">';
		$output .= '<div id="mos-carousel-'.$atts['id'].'" class="owl-carousel owl-theme">';
		$n = 0;
		foreach ( $images as $attachment_id => $attachment_url ) {
			if ($dataMobile[$n]) $dataImage = $dataMobile[$n];
			else $dataImage = $attachment_url;
			$n++;
			$output .= '<div class="item" data-image="'.$dataImage.'" style="background-image:url('.$attachment_url.')">';			
			$output .= '</div>';
		}
		
		$output .= '</div><!--/#owl-carousel-'.$atts['id'].'-->';
		//$output .= '</div><!--/.slider-wrapper-->';
		$output .= '<div class="banner-content">';
		$output .= '<div class="content-wrapper">';
		$output .= '<div class="container">';
		$output .= '<h2 class="banner-title">' . get_the_title($atts['id']).'</h2>';
		$output .= '<div class="banner-desc">' . $content.'</div>';
		if ($button_text AND $button_url) $output .= '<a class="btn-banner" href="'.$button_url.'">' . $button_text . ' <i class="fa fa-angle-right"></i></a>';
		$output .= '<div id="banner-nav"></div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="slide-progress"></div>';
		$output .= '</div>';
	}
	return $output;
}
add_shortcode( 'mos-slide', 'mos_slider_fnc' );
<?php
function loginpageeditor_enqueue_scripts() { 
	$locale = get_locale();
	wp_enqueue_style('jqueryui_css', plugins_url('assets/css/dist/jquery-ui.css', __DIR__ ));
	wp_enqueue_style('devotion_css', plugins_url('assets/css/styles.css?v='.date('his'), __DIR__ ));
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script('jquery-ui-tooltip');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_media();
	wp_enqueue_script('devotion_fa', plugins_url('assets/js/dist/all.min.js', __DIR__ ), array('jquery'));
	wp_enqueue_script('devotion_sa', plugins_url('assets/js/dist/sweetalert.min.js', __DIR__ ), array('jquery'));
	wp_enqueue_script('devotion_js', plugins_url('assets/js/functions.min.js?v='.date('his'), __DIR__ ), array('wp-color-picker', 'jquery'));
}
add_action('admin_enqueue_scripts', 'loginpageeditor_enqueue_scripts');